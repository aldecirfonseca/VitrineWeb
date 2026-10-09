<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cidade extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'uf_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
            ],
            'nome' => [
                'type'          => 'VARCHAR',
                'constraint'    => 60,              
            ],
            'codIBGE' => [
                'type'          => 'VARCHAR',
                'constraint'    => 7,
            ],
            'created_at' => [
                'type'          => 'DATETIME',
                'null'          => true,
            ], 
            'updated_at' => [
                'type'          => 'DATETIME',
                'null'          => true,
            ], 
            'deleted_at' => [
                'type'          => 'DATETIME',
                'null'          => true,
            ], 
        ]);

        // Cria a chave primária
        $this->forge->addKey('id', true);
        $this->forge->addKey('uf_id');
        $this->forge->addForeignKey('uf_id', 'uf', 'id', 'CASCADE', 'RESTRICT');

        // Cria a table
        $this->forge->createTable('cidade', false, ['engine' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('cidade');
    }
}
