<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    public $UsuarioModel;

	/**
	 * signIn
	 *
	 * @return void
	 */
    public function signIn() 
    {
		$post 		= $this->request->getPost();
		$login 		= $post['email'];
		$password 	= $post['senha'];

		$UsuarioModel = new UsuarioModel();

		// buscar o usuário na base de dados

		$dadosUsuario = $UsuarioModel->getByEmail(trim($login));

		// O Super usuário é criado pela seed: php spark db:seed DatabaseSeeder

		if (!is_null($dadosUsuario)) {

			// Verifica o status do usuário

			if ($dadosUsuario['statusRegistro'] == 1) {

				//	Verifica a senha do usuário

				if (password_verify(trim($password), $dadosUsuario['senha'])) {

					// Sessões de controle do usuário

					if (isset($post['manterConectado'])) {
						$tempoPdraoLogin = 864000;	// 10 Dias
					} else {
						$tempoPdraoLogin = 3600;	// 1 Hora
					}

					session()->setTempdata('isLoggedIn'		, true						, $tempoPdraoLogin);
					session()->setTempdata('userId'			, $dadosUsuario['id']		, $tempoPdraoLogin);
					session()->setTempdata('userNome'		, $dadosUsuario['nome']		, $tempoPdraoLogin);
					session()->setTempdata('userEmail'		, $dadosUsuario['email']	, $tempoPdraoLogin);
					session()->setTempdata('userNivel'		, $dadosUsuario['nivel']	, $tempoPdraoLogin);
					session()->setTempdata('userPessoa_id'	, $dadosUsuario['pessoa_id'], $tempoPdraoLogin);

					// Aceita apenas caminhos internos (ex: Sistema/home) para evitar redirecionamento para outro site

					$destino = trim($post['destino'] ?? '');

					if (!preg_match('#^[A-Za-z0-9_-]+(/[A-Za-z0-9_-]+)*$#', $destino)) {
						$destino = 'Sistema/home';
					}

					return redirect()->to('/' . $destino);

					//

					
				} else {
					return redirect()->back()->with("msgError", "Usuário ou Senha incorretos.")->withInput();
				}
			
			} else {
				return redirect()->back()->with("msgError", "Usuário BLOQUEADO/INATIVO, acesso indisponível.")->withInput();
			}

		} else {
			return redirect()->back()->with("msgError", "Usuário ou Senha incorretos.")->withInput();
		}
    }

    /**
	 * signOut
	 *
	 * @return void
	 */
	public function signOut()
	{
		session()->destroy();               // destroy as sessions
		return redirect()->to(base_url());
    }
}
