<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PessoaEndereco extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pessoa_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tipoEndereco' => [
                'type'       => 'TINYINT',
                'constraint' => 2,
                'unsigned'   => true,
            ],
            'logradouro' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'numero' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'complemento' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'bairro' => [
                'type'       => 'VARCHAR',
                'constraint' => 80,
                'null'       => true,
            ],
            'cep' => [
                'type'       => 'VARCHAR',
                'constraint' => 9,
                'null'       => true,
            ],
            'cidade_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('pessoa_id');
        $this->forge->addKey('cidade_id');
        $this->forge->addForeignKey('pessoa_id', 'pessoa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('cidade_id', 'cidade', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('pessoaendereco', false, ['engine' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('pessoaendereco');
    }
}
