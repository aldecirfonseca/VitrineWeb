<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PedidoItem extends Migration
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
            'pedido_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'produto_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'quantidade' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            // Preço copiado do produto no momento da compra: se o preço mudar depois, o pedido não muda
            'precoUnitario' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('pedido_id');
        $this->forge->addKey('produto_id');
        $this->forge->addForeignKey('pedido_id', 'pedido', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('produto_id', 'produto', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('pedido_item', false, ['engine' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('pedido_item');
    }
}
