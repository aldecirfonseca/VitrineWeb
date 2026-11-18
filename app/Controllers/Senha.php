<?php

namespace App\Controllers;

use App\Libraries\EnvioEmail;
use App\Models\UsuarioModel;

/**
 * Recuperação de senha (sem login) e troca de senha (logado).
 */
class Senha extends BaseController
{
    private UsuarioModel $UsuarioModel;

    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();
    }

    // ------------------------------------------------------------------
    // Recuperação: "Esqueci minha senha"
    // ------------------------------------------------------------------

    /**
     * Formulário onde a pessoa informa o e-mail.
     */
    public function esqueci()
    {
        return view("esqueciSenha");
    }

    /**
     * Gera o token e manda o link por e-mail.
     *
     * A resposta é SEMPRE a mesma, exista ou não o e-mail: assim ninguém usa
     * esta tela para descobrir quem tem conta na loja.
     */
    public function enviarLink()
    {
        if (! $this->validate(["email" => "required|valid_email"])) {
            return redirect()->back()->withInput()->with("msgError", "Informe um e-mail válido.");
        }

        $email   = trim($this->request->getPost("email"));
        $usuario = $this->UsuarioModel->getByEmail($email);

        if (! is_null($usuario) && (int) $usuario["statusRegistro"] === 1) {

            $token = $this->UsuarioModel->criarTokenRecuperacao((int) $usuario["id"]);

            EnvioEmail::enviar($usuario["email"], "VitrineWeb - Criar uma nova senha", "recuperarSenha", [
                "nome"  => $usuario["nome"],
                "link"  => base_url("redefinirSenha/" . $token),
                "horas" => UsuarioModel::VALIDADE_TOKEN_HORAS,
            ]);
        }

        return redirect()->to("esqueciSenha")->with(
            "msgSucesso",
            "Se o e-mail estiver cadastrado, você vai receber um link para criar uma nova senha. O link vale por "
            . UsuarioModel::VALIDADE_TOKEN_HORAS . " hora."
        );
    }

    /**
     * Abre o formulário de nova senha a partir do link do e-mail.
     *
     * @param string $token
     */
    public function redefinir($token)
    {
        if (is_null($this->UsuarioModel->getByTokenValido($token))) {
            return redirect()->to("esqueciSenha")->with("msgError", "Link inválido ou vencido. Peça um novo.");
        }

        return view("redefinirSenha", ["token" => $token]);
    }

    /**
     * Grava a nova senha e invalida o token.
     */
    public function gravar()
    {
        $token   = (string) $this->request->getPost("token");
        $usuario = $this->UsuarioModel->getByTokenValido($token);

        if (is_null($usuario)) {
            return redirect()->to("esqueciSenha")->with("msgError", "Link inválido ou vencido. Peça um novo.");
        }

        $erro = $this->validarNovaSenha();

        if ($erro !== null) {
            return redirect()->back()->with("msgError", $erro);
        }

        $this->UsuarioModel->gravarNovaSenha((int) $usuario["id"], $this->request->getPost("senha"));

        return redirect()->to("login")->with("msgSucesso", "Senha alterada! Entre com a nova senha.");
    }

    // ------------------------------------------------------------------
    // Troca de senha de quem está logado (rotas com filtro "auth")
    // ------------------------------------------------------------------

    public function trocar()
    {
        return view("trocarSenha");
    }

    public function gravarTroca()
    {
        $usuario = $this->UsuarioModel->find((int) session()->get("userId"));

        if (is_null($usuario) || ! password_verify((string) $this->request->getPost("senhaAtual"), $usuario["senha"])) {
            return redirect()->back()->with("msgError", "A senha atual não confere.");
        }

        $erro = $this->validarNovaSenha();

        if ($erro !== null) {
            return redirect()->back()->with("msgError", $erro);
        }

        $this->UsuarioModel->gravarNovaSenha((int) $usuario["id"], $this->request->getPost("senha"));

        return redirect()->to("trocarSenha")->with("msgSucesso", "Senha alterada com sucesso.");
    }

    /**
     * Regras da nova senha (usadas na recuperação e na troca).
     *
     * @return string|null mensagem de erro, ou null se estiver tudo certo
     */
    private function validarNovaSenha(): ?string
    {
        $senha    = trim((string) $this->request->getPost("senha"));
        $confirma = trim((string) $this->request->getPost("confirmaSenha"));

        if (mb_strlen($senha) < 6) {
            return "A nova senha deve ter pelo menos 6 caracteres.";
        }

        if ($senha !== $confirma) {
            return "A confirmação não confere com a nova senha.";
        }

        return null;
    }
}
