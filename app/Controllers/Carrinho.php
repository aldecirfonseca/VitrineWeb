<?php

namespace App\Controllers;

use App\Models\PedidoItemModel;
use App\Models\PedidoModel;
use App\Models\ProdutoModel;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Carrinho de compras guardado na SESSÃO.
 *
 * Estrutura de session('carrinho'):
 *   [
 *     7  => ['nome' => 'Camiseta', 'preco' => 59.90, 'quantidade' => 2, 'imagem' => 'a1b2.jpg'],
 *     12 => [...],
 *   ]
 * A chave é o id do produto. Nada vai para o banco até o pedido ser fechado.
 */
class Carrinho extends BaseController
{
    private ProdutoModel $ProdutoModel;

    public function __construct()
    {
        $this->ProdutoModel = new ProdutoModel();
    }

    /**
     * Mostra o carrinho.
     *
     * @return string
     */
    public function index()
    {
        $itens = $this->sincronizar($avisos);

        return view("carrinho", [
            "itens"  => $itens,
            "total"  => $this->total($itens),
            "avisos" => $avisos,
        ]);
    }

    /**
     * Adiciona um produto (ou soma a quantidade, se ele já estiver no carrinho).
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function adicionar()
    {
        $produtoId  = (int) $this->request->getPost("produto_id");
        $quantidade = max(1, (int) $this->request->getPost("quantidade"));

        // Preço e estoque vêm do banco: o formulário só informa QUAL produto e QUANTOS
        $produto = $this->ProdutoModel->getVitrine($produtoId);

        if (is_null($produto)) {
            return redirect()->back()->with("msgError", "Produto indisponível.");
        }

        $carrinho = $this->getCarrinho();
        $novaQtd  = ($carrinho[$produtoId]["quantidade"] ?? 0) + $quantidade;

        if ($novaQtd > (int) $produto["estoque"]) {
            return redirect()->back()->with("msgError", "Temos só {$produto['estoque']} unidade(s) de \"{$produto['nome']}\" em estoque.");
        }

        $carrinho[$produtoId] = [
            "nome"       => $produto["nome"],
            "preco"      => (float) $produto["preco"],
            "quantidade" => $novaQtd,
            "imagem"     => $produto["imagem"],
        ];

        $this->setCarrinho($carrinho);

        return redirect()->to("Carrinho")->with("msgSucesso", "\"{$produto['nome']}\" adicionado ao carrinho.");
    }

    /**
     * Atualiza as quantidades (formulário com quantidade[ID] = N).
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function atualizar()
    {
        $carrinho    = $this->getCarrinho();
        $quantidades = (array) $this->request->getPost("quantidade");

        foreach ($quantidades as $produtoId => $qtd) {
            $produtoId = (int) $produtoId;
            $qtd       = (int) $qtd;

            if (! isset($carrinho[$produtoId])) {
                continue;
            }

            if ($qtd <= 0) {
                unset($carrinho[$produtoId]);
            } else {
                $carrinho[$produtoId]["quantidade"] = $qtd;
            }
        }

        $this->setCarrinho($carrinho);

        // sincronizar() corta a quantidade que passar do estoque; os avisos aparecem na próxima tela
        $this->sincronizar($avisos);

        if (empty($avisos)) {
            return redirect()->to("Carrinho")->with("msgSucesso", "Carrinho atualizado.");
        }

        return redirect()->to("Carrinho");
    }

    /**
     * Remove um produto do carrinho.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function remover()
    {
        $carrinho = $this->getCarrinho();

        unset($carrinho[(int) $this->request->getPost("produto_id")]);

        $this->setCarrinho($carrinho);

        return redirect()->to("Carrinho")->with("msgSucesso", "Produto removido do carrinho.");
    }

    /**
     * Esvazia o carrinho.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function limpar()
    {
        session()->remove("carrinho");

        return redirect()->to("Carrinho")->with("msgSucesso", "Carrinho esvaziado.");
    }

    /**
     * Revisão antes de fechar o pedido (rota com filtro "auth").
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function checkout()
    {
        $itens = $this->sincronizar($avisos);

        if (empty($itens)) {
            return redirect()->to("Carrinho")->with("msgError", "Seu carrinho está vazio.");
        }

        return view("checkout", [
            "itens"  => $itens,
            "total"  => $this->total($itens),
            "avisos" => $avisos,
        ]);
    }

    /**
     * Fecha o pedido: tudo acontece em PedidoModel::finalizar(), dentro de uma transação.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function finalizar()
    {
        $carrinho = $this->getCarrinho();

        if (empty($carrinho)) {
            return redirect()->to("Carrinho")->with("msgError", "Seu carrinho está vazio.");
        }

        $PedidoModel = new PedidoModel();

        $pedidoId = $PedidoModel->finalizar((int) session()->get("userId"), $carrinho);

        if (is_null($pedidoId)) {
            return redirect()->to("Carrinho")->with("msgError", $PedidoModel->mensagemErro);
        }

        session()->remove("carrinho");

        return redirect()->to("Carrinho/confirmacao/" . $pedidoId);
    }

    /**
     * Página de "pedido recebido".
     *
     * @param int $pedidoId
     * @return string
     */
    public function confirmacao($pedidoId)
    {
        $pedido = (new PedidoModel())->find((int) $pedidoId);

        // Um cliente não pode ver o pedido de outro trocando o número na URL
        if (is_null($pedido) || (int) $pedido["usuario_id"] !== (int) session()->get("userId")) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view("pedidoConfirmado", [
            "pedido" => $pedido,
            "itens"  => (new PedidoItemModel())->getByPedido((int) $pedidoId),
        ]);
    }

    // ------------------------------------------------------------------
    // Métodos de apoio (private: não viram rota)
    // ------------------------------------------------------------------

    private function getCarrinho(): array
    {
        return session()->get("carrinho") ?? [];
    }

    private function setCarrinho(array $carrinho): void
    {
        session()->set("carrinho", $carrinho);
    }

    /**
     * Confere o carrinho com o banco: preço atualizado, produto ainda ativo
     * e quantidade dentro do estoque. Nunca confie no que está guardado na sessão.
     *
     * @param array|null $avisos recebe (por referência) as mensagens do que foi ajustado
     */
    private function sincronizar(?array &$avisos = null): array
    {
        $carrinho = $this->getCarrinho();
        $avisos   = [];

        foreach ($carrinho as $produtoId => $item) {

            $produto = $this->ProdutoModel->getVitrine((int) $produtoId);

            if (is_null($produto) || (int) $produto["estoque"] === 0) {
                $avisos[] = "\"{$item['nome']}\" saiu do carrinho porque não está mais disponível.";
                unset($carrinho[$produtoId]);
                continue;
            }

            if ($item["quantidade"] > (int) $produto["estoque"]) {
                $avisos[] = "A quantidade de \"{$produto['nome']}\" foi ajustada para {$produto['estoque']}, o total em estoque.";
                $item["quantidade"] = (int) $produto["estoque"];
            }

            $carrinho[$produtoId] = [
                "nome"       => $produto["nome"],
                "preco"      => (float) $produto["preco"],
                "quantidade" => $item["quantidade"],
                "imagem"     => $produto["imagem"],
            ];
        }

        $this->setCarrinho($carrinho);

        // Requisição POST termina em redirect: o aviso precisa ir para o flashdata (próxima tela).
        // Requisição GET já mostra a tela: o aviso vai direto para a view.
        if (! empty($avisos) && $this->request->getMethod() === "POST") {
            session()->setFlashdata("msgError", implode("<br>", array_map("esc", $avisos)));
        }

        return $carrinho;
    }

    private function total(array $itens): float
    {
        $total = 0;

        foreach ($itens as $item) {
            $total += $item["preco"] * $item["quantidade"];
        }

        return round($total, 2);
    }
}
