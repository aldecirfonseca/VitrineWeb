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
            return redirect()->to('/login')->with('msgError', 'Faça login para acessar o painel administrativo.');
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
