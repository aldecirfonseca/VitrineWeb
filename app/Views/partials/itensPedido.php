<?php
/**
 * Tabela de itens de um pedido (reaproveitada no admin, na confirmação e em "Meus pedidos").
 *
 * @var array $itens  linhas de pedido_item com nome e imagem do produto
 * @var float $total  total gravado no pedido
 */
?>
<div class="table-responsive">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Produto</th>
                <th class="text-end">Preço unit. (R$)</th>
                <th class="text-end">Qtd.</th>
                <th class="text-end">Subtotal (R$)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itens as $item): ?>
                <tr>
                    <td>
                        <img src="<?= imagemProduto($item['imagem']) ?>" alt="" width="48" height="48" class="rounded me-2 object-fit-cover">
                        <?= esc($item['nome']) ?>
                    </td>
                    <td class="text-end"><?= formatValor($item['precoUnitario']) ?></td>
                    <td class="text-end"><?= $item['quantidade'] ?></td>
                    <td class="text-end"><?= formatValor($item['precoUnitario'] * $item['quantidade']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total</th>
                <th class="text-end">R$ <?= formatValor($total) ?></th>
            </tr>
        </tfoot>
    </table>
</div>
