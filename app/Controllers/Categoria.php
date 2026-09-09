<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categoria extends BaseController
{
    private $CategoriaModel;

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->CategoriaModel = new CategoriaModel();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        return view("admin/listaCategoria", 
            $this->CategoriaModel->lista()
        );
    }

    /**
     * Exibe o formulário de inclusão/alteração de categoria.
     *
     * @param string $action
     * @param int $id
     * @return string
     */
    public function form($action = "insert", $id = 0)
    {
        $dados = ($id > 0) ? $this->CategoriaModel->getById($id) : [];
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

        $dados = [
            "id"            => $id > 0 ? $id : null,
            "descricao"      => $this->request->getPost("descricao"),
            "statusRegistro" => $this->request->getPost("statusRegistro"),
        ];

        if (!$this->CategoriaModel->save($dados)) {
            $erros = $this->CategoriaModel->errors();

            return view("admin/formCategoria", compact("action", "dados", "erros"));
        }

        session()->setFlashdata("msgSucesso", "Categoria salva com sucesso.");

        return redirect()->to("categoria");
    }

    /**
     * Exclui uma categoria.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete()
    {
        $id = (int) $this->request->getPost("id");

        if (!$this->CategoriaModel->delete($id)) {
            session()->setFlashdata("msgError", "Erro ao excluir a categoria.");
        } else {
            session()->setFlashdata("msgSucesso", "Categoria excluída com sucesso.");
        }

        return redirect()->to("categoria");
    }
}