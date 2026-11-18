<?php
/**
 * E-mail de confirmação enviado ao cliente quando o pedido é fechado.
 *
 * @var string $nome
 * @var array  $pedido
 * @var array  $itens
 */
?>
<!DOCTYPE html>
<html lang="pt-br">
<body style="margin:0; padding:24px; background:#f4f4f4; font-family:Arial, sans-serif; color:#333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; margin:0 auto; background:#fff; border-radius:8px;">
        <tr>
            <td style="padding:24px;">
                <h2 style="margin:0 0 8px;">Pedido #<?= $pedido['id'] ?> recebido!</h2>
                <p style="margin:0 0 16px;">Olá, <?= esc($nome) ?>. Obrigado pela compra na VitrineWeb.</p>

                <table width="100%" cellpadding="6" cellspacing="0" style="border-collapse:collapse; font-size:14px;">
                    <tr style="background:#f0efec;">
                        <th align="left">Produto</th>
                        <th align="right">Qtd.</th>
                        <th align="right">Subtotal</th>
                    </tr>
                    <?php foreach ($itens as $item): ?>
                        <tr style="border-bottom:1px solid #eee;">
                            <td><?= esc($item['nome']) ?></td>
                            <td align="right"><?= $item['quantidade'] ?></td>
                            <td align="right">R$ <?= formatValor($item['precoUnitario'] * $item['quantidade']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="2" align="right">Total</th>
                        <th align="right">R$ <?= formatValor($pedido['total']) ?></th>
                    </tr>
                </table>

                <p style="margin:24px 0 0;">
                    Acompanhe o andamento em
                    <a href="<?= base_url("MeusPedidos/" . $pedido['id']) ?>">Meus pedidos</a>.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
