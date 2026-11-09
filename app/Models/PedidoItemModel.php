<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoItemModel extends Model
{
    protected $table      = 'pedido_item';
    protected $primaryKey = 'id';

    protected $allowedFields = ['pedido_id', 'produto_id', 'quantidade', 'precoUnitario'];

    protected $useTimestamps = true;

    /**
     * Itens de um pedido, com nome e imagem do produto.
     */
    public function getByPedido(int $pedidoId): array
    {
        return $this->select('pedido_item.*, produto.nome, produto.imagem')
                    ->join('produto', 'produto.id = pedido_item.produto_id')
                    ->where('pedido_item.pedido_id', $pedidoId)
                    ->orderBy('pedido_item.id')
                    ->findAll();
    }
}
