<?php

namespace App\Filters;

use App\Models\UsuarioModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Controle de acesso das rotas.
     *
     *   ['filter' => 'auth']    -> basta estar logado
     *   ['filter' => 'auth:1']  -> logado E com nível 1 (administrador)
     *   ['filter' => 'auth:1,11'] -> qualquer um dos níveis da lista
     *
     * O que vem depois dos ":" chega aqui em $arguments, como array de strings.
     *
     * @param array|null $arguments
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 1) Está logado? -------------------------------------------------
        if (! $session->get('isLoggedIn')) {

            // Guarda a página que a pessoa tentou abrir: depois do login ela volta para lá
            // (o Login::signIn só aceita caminhos internos, então não há risco de redirecionar para fora)
            $destino = uri_string();

            return redirect()->to('login?destino=' . urlencode($destino))
                             ->with('msgError', 'Faça login para continuar.');
        }

        // 2) O usuário ainda existe e está ativo? ---------------------------
        // A sessão foi criada no login; se o administrador bloquear o usuário ou mudar o nível
        // depois disso, a sessão não sabe. Por isso conferimos no banco a cada página protegida.
        $usuario = (new UsuarioModel())->find((int) $session->get('userId'));

        if (is_null($usuario) || (int) $usuario['statusRegistro'] !== 1) {

            // Tira só os dados de login. Com session()->destroy() a mensagem abaixo
            // (flashdata, que também mora na sessão) se perderia.
            $session->remove(['isLoggedIn', 'userId', 'userNome', 'userEmail', 'userNivel', 'userPessoa_id']);

            return redirect()->to('login')->with('msgError', 'Seu acesso foi bloqueado. Fale com a loja.');
        }

        $session->set('userNivel', $usuario['nivel']);      // nível sempre atualizado

        // 3) Tem o nível exigido pela rota? -------------------------------
        if (! empty($arguments) && ! in_array((string) $usuario['nivel'], $arguments, true)) {

            // Não diz que a página existe nem o que tem nela: só nega
            return redirect()->to('/')->with('msgError', 'Você não tem permissão para acessar esta página.');
        }
    }

    /**
     * @param array|null $arguments
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nada a fazer após a resposta.
    }
}
