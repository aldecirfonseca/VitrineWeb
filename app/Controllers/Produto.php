<?php

namespace App\Controllers;

use App\Libraries\ImagemProduto;
use App\Models\CategoriaModel;
use App\Models\ProdutoModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Produto extends BaseController
{
    private const ACOES = ["insert", "update", "delete", "view"];

    private ProdutoModel $ProdutoModel;
    private CategoriaModel $CategoriaModel;

    public function __construct()
    {
        $this->ProdutoModel   = new ProdutoModel();
        $this->CategoriaModel = new CategoriaModel();
    }

    /**
     * Lista os produtos.
     *
     * @return string
     */
    public function index()
    {
        return view("admin/listaProduto", [
            "lista" => $this->ProdutoModel->listaAdmin(),
        ]);
    }

    /**
     * Exibe o formulário de inclusão, alteração, exclusão ou visualização.
     *
     * @param string $action
     * @param int $id
     * @return string
     */
    public function form($action = "insert", $id = 0)
    {
        if (! in_array($action, self::ACOES, true)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $dados = [];

        if ($action !== "insert") {
            $dados = $this->buscarOu404((int) $id);

            // No banco o preço fica "59.90"; no formulário mostramos "59,90"
            $dados["preco"] = formatValor($dados["preco"]);
        }

        return $this->exibirForm($action, $dados, []);
    }

    /**
     * Grava (insere ou atualiza) um produto, com upload da imagem.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function store()
    {
        $action = $this->request->getPost("action");
        $id     = (int) $this->request->getPost("id");

        if (! in_array($action, ["insert", "update"], true)) {
            return redirect()->to("Produto");
        }

        $atual = ($action === "update") ? $this->buscarOu404($id) : null;

        $dados = [
            "id"             => $action === "update" ? $id : null,
            "categoria_id"   => $this->request->getPost("categoria_id"),
            "nome"           => $this->request->getPost("nome"),
            "descricao"      => $this->request->getPost("descricao"),
            "preco"          => strToNumer($this->request->getPost("preco")),     // "1.234,56" -> "1234.56"
            "estoque"        => $this->request->getPost("estoque"),
            "statusRegistro" => $this->request->getPost("statusRegistro"),
            "imagem"         => $atual["imagem"] ?? null,
        ];

        $erros = [];

        // 1) Valida a imagem ----------------------------------------------
        $arquivo    = $this->request->getFile("imagem");
        $temArquivo = $arquivo !== null && $arquivo->getError() !== UPLOAD_ERR_NO_FILE;

        // Na inclusão a imagem é obrigatória; na alteração só valida se veio um arquivo novo
        if ($action === "insert" || $temArquivo) {

            $regraImagem = "is_image[imagem]|mime_in[imagem,image/jpeg,image/png,image/webp]|max_size[imagem,2048]";

            if ($action === "insert") {
                $regraImagem = "uploaded[imagem]|" . $regraImagem;
            }

            $regras = [
                "imagem" => [
                    "label"  => "Imagem",
                    "rules"  => $regraImagem,
                    "errors" => [
                        "uploaded" => "Envie a foto do produto.",
                        "max_size" => "A imagem deve ter no máximo 2 MB.",
                        "mime_in"  => "Envie uma imagem JPG, PNG ou WEBP.",
                    ],
                ],
            ];

            if (! $this->validate($regras)) {
                $erros = $this->validator->getErrors();
            }
        }

        // 2) Valida os outros campos com as regras do Model -----------------
        //    (assim todos os erros aparecem juntos, na mesma tela)
        if (! $this->ProdutoModel->validate($dados)) {
            $erros = array_merge($erros, $this->ProdutoModel->errors());
        }

        if (! empty($erros)) {
            return $this->exibirForm($action, $dados, $erros);
        }

        // 3) Grava o arquivo e depois o registro ----------------------------
        $imagemNova = null;

        if ($temArquivo && $arquivo->isValid() && ! $arquivo->hasMoved()) {
            $imagemNova      = ImagemProduto::salvarUpload($arquivo);
            $dados["imagem"] = $imagemNova;
        }

        if (! $this->ProdutoModel->save($dados)) {
            ImagemProduto::remover($imagemNova);    // não deixa arquivo órfão na pasta

            return $this->exibirForm($action, $dados, $this->ProdutoModel->errors());
        }

        // Trocou a foto: apaga a antiga (e a miniatura dela)
        if ($imagemNova !== null && ! empty($atual["imagem"])) {
            ImagemProduto::remover($atual["imagem"]);
        }

        session()->setFlashdata("msgSucesso", "Produto salvo com sucesso.");

        return redirect()->to("Produto");
    }

    /**
     * Exclui um produto.
     *
     * É soft delete (preenche deleted_at): a imagem fica no disco porque
     * pedidos antigos ainda mostram o produto.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete()
    {
        $id = (int) $this->request->getPost("id");

        if (!$this->ProdutoModel->delete($id)) {
            session()->setFlashdata("msgError", "Erro ao excluir o produto.");
        } else {
            session()->setFlashdata("msgSucesso", "Produto excluído com sucesso.");
        }

        return redirect()->to("Produto");
    }

    /**
     * Busca o produto ou devolve a página 404.
     */
    private function buscarOu404(int $id): array
    {
        $produto = $this->ProdutoModel->getById($id);

        if (is_null($produto)) {
            throw PageNotFoundException::forPageNotFound("Produto não encontrado.");
        }

        return $produto;
    }

    /**
     * Monta a view do formulário (usada no form() e quando a gravação falha).
     */
    private function exibirForm(string $action, array $dados, array $erros): string
    {
        $categorias = $this->CategoriaModel->listaAtivas();

        // Produto de uma categoria que foi inativada: mantém a categoria atual na lista,
        // senão o <select> trocaria a categoria sem o usuário perceber
        $categoriaAtual = (int) ($dados["categoria_id"] ?? 0);

        if ($categoriaAtual > 0 && ! in_array($categoriaAtual, array_map("intval", array_column($categorias, "id")), true)) {
            $inativa = $this->CategoriaModel->getById($categoriaAtual);

            if (! is_null($inativa)) {
                $inativa["descricao"] .= " (inativa)";
                $categorias[] = $inativa;
            }
        }

        return view("admin/formProduto", [
            "action"     => $action,
            "dados"      => $dados,
            "erros"      => $erros,
            "categorias" => $categorias,
        ]);
    }
}
