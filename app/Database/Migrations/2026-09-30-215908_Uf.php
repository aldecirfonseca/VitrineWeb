<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Uf extends Migration
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
            'sigla' => [
                'type'          => 'VARCHAR',
                'constraint'    => 2,
            ],
            'descricao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 60,              
            ],
            'regiao' => [
                'type'          => 'TINYINT',
                'constraint'    => 2,
                'unsigned'      => true,            
            ], 
            'codIBGE' => [
                'type'          => 'VARCHAR',
                'constraint'    => 2,
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
        
        // Cria a chave unica para o campo Sigla
        $this->forge->addUniqueKey('sigla');

        // Cria a table
        $this->forge->createTable('uf', false, ['engine' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('uf');
    }
}
