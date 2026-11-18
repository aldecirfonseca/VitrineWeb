<?php
/**
 * E-mail com o link para criar uma nova senha.
 *
 * @var string $nome
 * @var string $link
 * @var int    $horas
 */
?>
<!DOCTYPE html>
<html lang="pt-br">
<body style="margin:0; padding:24px; background:#f4f4f4; font-family:Arial, sans-serif; color:#333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; margin:0 auto; background:#fff; border-radius:8px;">
        <tr>
            <td style="padding:24px;">
                <h2 style="margin:0 0 16px;">Criar uma nova senha</h2>
                <p style="margin:0 0 16px;">Olá, <?= esc($nome) ?>. Recebemos um pedido para criar uma nova senha na VitrineWeb.</p>
                <p style="margin:0 0 24px;">
                    <a href="<?= esc($link) ?>" style="background:#222; color:#fff; padding:12px 20px; border-radius:4px; text-decoration:none;">Criar nova senha</a>
                </p>
                <p style="margin:0 0 8px; font-size:13px;">O link vale por <?= (int) $horas ?> hora e só pode ser usado uma vez.</p>
                <p style="margin:0; font-size:13px; color:#888;">Se não foi você, ignore este e-mail: sua senha continua a mesma.</p>
            </td>
        </tr>
    </table>
</body>
</html>
