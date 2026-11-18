<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Usuários no painel administrativo (rotas com filtro "auth:1").
 *
 * O administrador vê todos os usuários, muda o nível e bloqueia ou ativa o acesso.
 * Clientes se cadastram sozinhos pela loja; aqui não há inclusão.
 */
class Usuario extends BaseController
{
    private const ACOES = ["update", "view"];

    private UsuarioModel $UsuarioModel;

    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();
    }

    public function index()
    {
        return view("admin/listaUsuario", [
            "lista" => $this->UsuarioModel->listaAdmin(),
        ]);
    }

    /**
     * @param string $action
     * @param int $id
     */
    public function form($action = "view", $id = 0)
    {
        if (! in_array($action, self::ACOES, true)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $dados = $this->UsuarioModel->find((int) $id);

        if (is_null($dados)) {
            throw PageNotFoundException::forPageNotFound("Usuário não encontrado.");
        }

        return view("admin/formUsuario", [
            "action" => $action,
            "dados"  => $dados,
            "erros"  => [],
        ]);
    }

    public function store()
    {
        $id    = (int) $this->request->getPost("id");
        $atual = $this->UsuarioModel->find($id);

        if (is_null($atual)) {
            throw PageNotFoundException::forPageNotFound("Usuário não encontrado.");
        }

        $dados = [
            "nome"           => $this->request->getPost("nome"),
            "nivel"          => $this->request->getPost("nivel"),
            "statusRegistro" => $this->request->getPost("statusRegistro"),
        ];

        // O administrador não pode se bloquear nem se rebaixar: ficaria sem acesso ao painel
        if ($id === (int) session()->get("userId")
            && ((int) $dados["nivel"] !== UsuarioModel::NIVEL_ADMIN || (int) $dados["statusRegistro"] !== 1)) {

            return view("admin/formUsuario", [
                "action" => "update",
                "dados"  => array_merge($atual, $dados),
                "erros"  => ["nivel" => "Você não pode bloquear nem tirar o nível de administrador do seu próprio usuário."],
            ]);
        }

        if (! $this->UsuarioModel->update($id, $dados)) {
            return view("admin/formUsuario", [
                "action" => "update",
                "dados"  => array_merge($atual, $dados),
                "erros"  => $this->UsuarioModel->errors(),
            ]);
        }

        return redirect()->to("Usuario")->with("msgSucesso", "Usuário salvo com sucesso.");
    }
}
