<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home');
    }

    public function faleconosco()
    {
        $dados = [];
        $erros = [];

        return view("faleconosco", compact("dados", "erros"));
    }

    /**
     * Recebe e valida o formulário de contato da página "Fale conosco".
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function enviarContato()
    {
        $regras = [
            "nome"     => "required|min_length[3]",
            "email"    => "required|valid_email",
            "assunto"  => "required",
            "mensagem" => "required|min_length[10]",
        ];

        $dados = $this->request->getPost();

        if (!$this->validate($regras)) {
            $erros = $this->validator->getErrors();

            return view("faleconosco", compact("dados", "erros"));
        }

        session()->setFlashdata("msgSucesso", "Sua mensagem foi enviada com sucesso! Em breve entraremos em contato.");

        return redirect()->to("faleconosco");
    }

    public function sobrenos()
    {
        return view("sobrenos");
    }
}
