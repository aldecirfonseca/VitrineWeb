<?php
/**
 * E-mail enviado para a loja quando alguém usa o "Fale conosco".
 *
 * @var string $nome
 * @var string $email
 * @var string $assunto
 * @var string $mensagem
 */
?>
<!DOCTYPE html>
<html lang="pt-br">
<body style="margin:0; padding:24px; background:#f4f4f4; font-family:Arial, sans-serif; color:#333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; margin:0 auto; background:#fff; border-radius:8px;">
        <tr>
            <td style="padding:24px;">
                <h2 style="margin:0 0 16px;">Nova mensagem pelo site</h2>
                <p style="margin:0 0 4px;"><strong>Nome:</strong> <?= esc($nome) ?></p>
                <p style="margin:0 0 4px;"><strong>E-mail:</strong> <?= esc($email) ?></p>
                <p style="margin:0 0 16px;"><strong>Assunto:</strong> <?= esc($assunto) ?></p>
                <p style="margin:0; white-space:pre-line;"><?= esc($mensagem) ?></p>
                <p style="margin:24px 0 0; font-size:12px; color:#888;">Use "Responder" para falar direto com quem escreveu.</p>
            </td>
        </tr>
    </table>
</body>
</html>
