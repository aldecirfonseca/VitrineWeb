<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    public const STATUS_RECEBIDO  = 1;
    public const STATUS_PAGO      = 2;
    public const STATUS_ENVIADO   = 3;
    public const STATUS_ENTREGUE  = 4;
    public const STATUS_CANCELADO = 9;

    protected $table      = 'pedido';
    protected $primaryKey = 'id';

    protected $allowedFields = ['usuario_id', 'total', 'statusPedido'];

    protected $useTimestamps = true;

    /**
     * Mensagem do último erro de finalizar()/alterarStatus(), para mostrar ao usuário.
     */
    public string $mensagemErro = '';

    /**
     * Fecha o pedido: grava o pedido, os itens e baixa o estoque.
     * Tudo dentro de UMA transação: ou grava tudo, ou não grava nada.
     *
     * @param array $carrinho [produto_id => ['quantidade' => n, ...]]
     * @return int|null id do pedido criado (null = não gravou, veja $mensagemErro)
     */
    public function finalizar(int $usuarioId, array $carrinho): ?int
    {
        $db = $this->db;

        $db->transBegin();

        try {
            $total = 0;
            $itens = [];

            foreach ($carrinho as $produtoId => $item) {

                $quantidade = (int) $item['quantidade'];

                // O preço vem SEMPRE do banco, nunca da sessão ou do formulário
                $produto = $db->table('produto')
                              ->where('id', (int) $produtoId)
                              ->where('statusRegistro', 1)
                              ->where('deleted_at', null)
                              ->get()
                              ->getRowArray();

                if (is_null($produto) || $quantidade < 1) {
                    throw new \DomainException('Um dos produtos do carrinho não está mais disponível.');
                }

                // Baixa o estoque só se ainda houver quantidade suficiente.
                // A condição fica no próprio UPDATE: se dois clientes comprarem o último item
                // ao mesmo tempo, só um UPDATE altera a linha.
                $db->table('produto')
                   ->set('estoque', 'estoque - ' . $quantidade, false)
                   ->where('id', $produto['id'])
                   ->where('estoque >=', $quantidade)
                   ->update();

                if ($db->affectedRows() === 0) {
                    throw new \DomainException("Estoque insuficiente para \"{$produto['nome']}\". Disponível: {$produto['estoque']}.");
                }

                $itens[] = [
                    'produto_id'    => $produto['id'],
                    'quantidade'    => $quantidade,
                    'precoUnitario' => $produto['preco'],
                ];

                $total += $produto['preco'] * $quantidade;
            }

            if (empty($itens)) {
                throw new \DomainException('O carrinho está vazio.');
            }

            $agora = date('Y-m-d H:i:s');

            $db->table('pedido')->insert([
                'usuario_id'   => $usuarioId,
                'total'        => round($total, 2),
                'statusPedido' => self::STATUS_RECEBIDO,
                'created_at'   => $agora,
                'updated_at'   => $agora,
            ]);

            $pedidoId = (int) $db->insertID();

            foreach ($itens as &$item) {
                $item['pedido_id']  = $pedidoId;
                $item['created_at'] = $agora;
                $item['updated_at'] = $agora;
            }
            unset($item);

            $db->table('pedido_item')->insertBatch($itens);

            if ($db->transStatus() === false) {
                throw new \DomainException('Não foi possível gravar o pedido.');
            }

            $db->transCommit();     // confirma tudo de uma vez

            return $pedidoId;

        } catch (\Throwable $e) {

            $db->transRollback();   // desfaz tudo: nenhum estoque baixado, nenhum pedido gravado

            log_message('error', 'Pedido não finalizado: ' . $e->getMessage());

            // DomainException = regra de negócio, a mensagem pode ir para o cliente.
            // Qualquer outro erro (ex: DatabaseException) pode ter detalhes da SQL: mensagem genérica.
            $this->mensagemErro = $e instanceof \DomainException
                ? $e->getMessage()
                : 'Não foi possível finalizar o pedido. Tente novamente.';

            return null;
        }
    }

    /**
     * Muda o status do pedido. Cancelar devolve os itens ao estoque (na mesma transação).
     */
    public function alterarStatus(int $pedidoId, int $novoStatus): bool
    {
        $pedido = $this->find($pedidoId);

        if (is_null($pedido)) {
            $this->mensagemErro = 'Pedido não encontrado.';
            return false;
        }

        if ((int) $pedido['statusPedido'] === self::STATUS_CANCELADO) {
            $this->mensagemErro = 'Pedido cancelado não pode mudar de status.';
            return false;
        }

        $db = $this->db;

        $db->transBegin();

        try {
            if ($novoStatus === self::STATUS_CANCELADO) {

                $itens = $db->table('pedido_item')->where('pedido_id', $pedidoId)->get()->getResultArray();

                foreach ($itens as $item) {
                    $db->table('produto')
                       ->set('estoque', 'estoque + ' . (int) $item['quantidade'], false)
                       ->where('id', $item['produto_id'])
                       ->update();
                }
            }

            $this->update($pedidoId, ['statusPedido' => $novoStatus]);

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Falha ao gravar.');
            }

            $db->transCommit();

            return true;

        } catch (\Throwable $e) {

            $db->transRollback();

            log_message('error', 'Status do pedido não alterado: ' . $e->getMessage());

            $this->mensagemErro = 'Não foi possível alterar o status do pedido.';

            return false;
        }
    }

    /**
     * Pedidos de um cliente, do mais novo para o mais antigo.
     */
    public function listaPorUsuario(int $usuarioId): array
    {
        return $this->where('usuario_id', $usuarioId)
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }

    /**
     * Todos os pedidos, com o nome do cliente (painel administrativo).
     */
    public function listaAdmin(): array
    {
        return $this->select('pedido.*, usuario.nome AS cliente, usuario.email')
                    ->join('usuario', 'usuario.id = pedido.usuario_id')
                    ->orderBy('pedido.id', 'DESC')
                    ->findAll();
    }

    /**
     * Um pedido com o nome do cliente.
     */
    public function getComCliente(int $pedidoId): ?array
    {
        return $this->select('pedido.*, usuario.nome AS cliente, usuario.email')
                    ->join('usuario', 'usuario.id = pedido.usuario_id')
                    ->where('pedido.id', $pedidoId)
                    ->first();
    }
}
