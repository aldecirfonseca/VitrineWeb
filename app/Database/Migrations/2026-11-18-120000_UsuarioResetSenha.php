<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Acrescenta à tabela usuario os campos da recuperação de senha.
 *
 * Exemplo de alteração de tabela já existente: addColumn() / dropColumn().
 */
class UsuarioResetSenha extends Migration
{
    public function up()
    {
        $this->forge->addColumn('usuario', [
            // Guardamos o HASH (sha256) do token, nunca o token puro:
            // quem ler o banco não consegue usar o link
            'resetToken' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
                'after'      => 'senha',
            ],
            'resetExpira' => [
                'type'  => 'DATETIME',
                'null'  => true,
                'after' => 'resetToken',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('usuario', ['resetToken', 'resetExpira']);
    }
}
