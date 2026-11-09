<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Bloqueia o acesso às áreas restritas do painel administrativo
     * para quem não estiver autenticado (sessão 'isLoggedIn').
     *
     * @param array|null $arguments
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('isLoggedIn')) {

            // Guarda a página que a pessoa tentou abrir: depois do login ela volta para lá
            // (o Login::signIn só aceita caminhos internos, então não há risco de redirecionar para fora)
            $destino = uri_string();

            return redirect()->to('login?destino=' . urlencode($destino))
                             ->with('msgError', 'Faça login para continuar.');
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
