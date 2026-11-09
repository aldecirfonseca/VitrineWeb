<?php

namespace App\Controllers;

use App\Models\PedidoItemModel;
use App\Models\PedidoModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Pedido extends BaseController
{
    private PedidoModel $PedidoModel;
    private PedidoItemModel $PedidoItemModel;

    public function __construct()
    {
        $this->PedidoModel     = new PedidoModel();
        $this->PedidoItemModel = new PedidoItemModel();
    }

    // ------------------------------------------------------------------
    // Painel administrativo
    // ------------------------------------------------------------------

    /**
     * Lista todos os pedidos.
     *
     * @return string
     */
    public function index()
    {
        return view("admin/listaPedido", [
            "lista" => $this->PedidoModel->listaAdmin(),
        ]);
    }

    /**
     * Detalhe do pedido, com a troca de status.
     *
     * @param int $id
     * @return string
     */
    public function form($id)
    {
        $pedido = $this->PedidoModel->getComCliente((int) $id);

        if (is_null($pedido)) {
            throw PageNotFoundException::forPageNotFound("Pedido não encontrado.");
        }

        return view("admin/formPedido", [
            "pedido" => $pedido,
            "itens"  => $this->PedidoItemModel->getByPedido((int) $id),
        ]);
    }

    /**
     * Grava o novo status. Cancelar devolve os itens ao estoque.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function status()
    {
        $id     = (int) $this->request->getPost("id");
        $status = (int) $this->request->getPost("statusPedido");

        if (! in_array($status, [1, 2, 3, 4, 9], true)) {
            return redirect()->back()->with("msgError", "Status inválido.");
        }

        if ($this->PedidoModel->alterarStatus($id, $status)) {
            session()->setFlashdata("msgSucesso", "Status do pedido #{$id} alterado para \"" . getStatusPedido($status) . "\".");
        } else {
            session()->setFlashdata("msgError", $this->PedidoModel->mensagemErro);
        }

        return redirect()->to("Pedido/form/view/" . $id);
    }

    // ------------------------------------------------------------------
    // Área do cliente
    // ------------------------------------------------------------------

    /**
     * Pedidos do cliente logado.
     *
     * @return string
     */
    public function meus()
    {
        return view("meusPedidos", [
            "lista" => $this->PedidoModel->listaPorUsuario((int) session()->get("userId")),
        ]);
    }

    /**
     * Detalhe de um pedido do cliente logado.
     *
     * @param int $id
     * @return string
     */
    public function meuDetalhe($id)
    {
        $pedido = $this->PedidoModel->find((int) $id);

        if (is_null($pedido) || (int) $pedido["usuario_id"] !== (int) session()->get("userId")) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view("meuPedidoDetalhe", [
            "pedido" => $pedido,
            "itens"  => $this->PedidoItemModel->getByPedido((int) $id),
        ]);
    }
}
