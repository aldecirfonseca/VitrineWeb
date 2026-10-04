<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

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


	/**
	 * Carrega a view Login
	 *
	 * @return void
	 */
	public function login()
	{
		return view("login");
	}

	/**
	 * Carrega a view Criar nova Conta
	 *
	 * @return void
	 */
	public function criarNovaConta()
	{
		return view("criarNovaConta", ['data' => [], 'errors' => []]);
	}

	/**
	 * gravarNovaConta
	 *
	 * @return void
	 */
	public function gravarNovaConta()
	{
		$UsuarioModel = new UsuarioModel();

		$post = $this->request->getPost();
		
		// verificar se usuário já tem conta
		$temUsuario = $UsuarioModel->where("email", $post['email'])->first();

		if (is_null($temUsuario)) {

			if (trim($post['senha']) == trim($post['confirmaSenha'])) {

				$created_at = date("Y-m-d H:i:s");
	
				$aPessoa = [
					"nome"		        => $post['nome'],
					"ddd1"		        => $post['ddd1'],
					"celular1"		    => $post['celular1'],
					"statusRegistro"	=> 1,
					"created_at"		=> $created_at,
					"updated_at"		=> $created_at
				]; 
		
				$aEndereco = [
					"tipoEndereco"      => 1,
					"created_at"		=> $created_at,
					"updated_at"		=> $created_at
				];
				
				$aUsuario = [
					"nome"				=> $post['nome'],
					"nivel"				=> 11,                   // 11 = Cliente
					"statusRegistro"	=> 1,
					"email"				=> $post['email'],
					"senha"				=> password_hash(trim($post['senha']), PASSWORD_DEFAULT),
					"pessoa_id"		    => null,
					"created_at"		=> $created_at,
					"updated_at"		=> $created_at
				];
		
				if ($UsuarioModel->insertUsuario($aPessoa, $aEndereco, $aUsuario) > 0) {
					return redirect("criarNovaConta")->with("msgSucesso", "Conta criada com sucesso! Faça login para continuar.");
				} else {

					session()->setFlashdata("msgError", implode('<br>', $UsuarioModel->errors()));

					return view('criarNovaConta', [
						'data'		=> $post,
						'errors' 	=> $UsuarioModel->errors()
					]);
				}
	
			} else {
				session()->setFlashdata("msgError", "Senhas não conferem.");
			} 
			
		} else {
			session()->setFlashdata("msgError", "Usuário já existe na plataforma.");
		}

		return view('criarNovaConta', [
				'data'		=> $post,
				'errors' 	=> []
			]);

	}
}
