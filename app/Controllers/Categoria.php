<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\ProdutoModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Categoria extends BaseController
{
    private const ACOES = ["insert", "update", "delete", "view"];

    private CategoriaModel $CategoriaModel;

    public function __construct()
    {
        $this->CategoriaModel = new CategoriaModel();
    }

    /**
     * Lista as categorias.
     *
     * @return string
     */
    public function index()
    {
        // Antes a lista ia "crua" para a view, que não tinha como acessá-la por um nome.
        // Agora ela vai dentro de um array associativo e vira a variável $lista na view.
        return view("admin/listaCategoria", [
            "lista" => $this->CategoriaModel->lista(),
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
            $dados = $this->CategoriaModel->getById((int) $id);

            if (is_null($dados)) {
                throw PageNotFoundException::forPageNotFound("Categoria não encontrada.");
            }
        }

        $erros = [];

        return view("admin/formCategoria", compact("action", "dados", "erros"));
    }

    /**
     * Grava (insere ou atualiza) uma categoria.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function store()
    {
        $action = $this->request->getPost("action");
        $id     = (int) $this->request->getPost("id");

        if (! in_array($action, ["insert", "update"], true)) {
            return redirect()->to("Categoria");
        }

        $dados = [
            "id"             => $id > 0 ? $id : null,
            "descricao"      => $this->request->getPost("descricao"),
            "statusRegistro" => $this->request->getPost("statusRegistro"),
        ];

        if (!$this->CategoriaModel->save($dados)) {
            $erros = $this->CategoriaModel->errors();

            return view("admin/formCategoria", compact("action", "dados", "erros"));
        }

        session()->setFlashdata("msgSucesso", "Categoria salva com sucesso.");

        return redirect()->to("Categoria");
    }

    /**
     * Exclui uma categoria (se nenhum produto estiver usando).
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete()
    {
        $id = (int) $this->request->getPost("id");

        $totalProdutos = (new ProdutoModel())->totalPorCategoria($id);

        if ($totalProdutos > 0) {
            session()->setFlashdata("msgError", "Esta categoria tem {$totalProdutos} produto(s) e não pode ser excluída. Inative-a ou mude os produtos de categoria.");
        } elseif (!$this->CategoriaModel->delete($id)) {
            session()->setFlashdata("msgError", "Erro ao excluir a categoria.");
        } else {
            session()->setFlashdata("msgSucesso", "Categoria excluída com sucesso.");
        }

        return redirect()->to("Categoria");
    }
}
