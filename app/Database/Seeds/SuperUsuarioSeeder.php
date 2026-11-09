<?php

namespace App\Database\Seeds;

use App\Models\UsuarioModel;
use CodeIgniter\Database\Seeder;

/**
 * Cria o usuário administrador inicial do painel.
 *
 * Login: administrador@vitrine.com.br
 * Senha: fasm@2026   (troque depois do primeiro acesso)
 */
class SuperUsuarioSeeder extends Seeder
{
    public function run()
    {
        $email = 'administrador@vitrine.com.br';

        $UsuarioModel = new UsuarioModel();

        if (! is_null($UsuarioModel->getByEmail($email))) {
            return;     // já existe: nada a fazer
        }

        $agora = date('Y-m-d H:i:s');

        $aPessoa = [
            'nome'           => 'Administrador',
            'statusRegistro' => 1,
            'created_at'     => $agora,
            'updated_at'     => $agora,
        ];

        $aEndereco = [
            'tipoEndereco' => 1,
            'created_at'   => $agora,
            'updated_at'   => $agora,
        ];

        $aUsuario = [
            'nome'           => 'Administrador',
            'nivel'          => 1,              // 1 = Administrador
            'statusRegistro' => 1,
            'email'          => $email,
            'senha'          => password_hash('fasm@2026', PASSWORD_DEFAULT),
            'created_at'     => $agora,
            'updated_at'     => $agora,
        ];

        // Reaproveita o método com transação que o cadastro de cliente já usa
        $UsuarioModel->insertUsuario($aPessoa, $aEndereco, $aUsuario);
    }
}
