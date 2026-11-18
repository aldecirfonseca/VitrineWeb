<?php

namespace App\Libraries;

/**
 * Envio de e-mail do VitrineWeb.
 *
 * O corpo do e-mail é uma VIEW (app/Views/emails/...), igual a uma página.
 * A configuração do servidor fica em app/Config/Email.php, e o usuário e a senha
 * do SMTP SOMENTE no .env (nunca no Git):
 *
 *   email.SMTPUser = <usuário da caixa de testes do Mailtrap>
 *   email.SMTPPass = <senha da caixa de testes do Mailtrap>
 */
class EnvioEmail
{
    /**
     * Envia um e-mail montado a partir de uma view.
     *
     * @param string      $para          destinatário
     * @param string      $assunto       assunto
     * @param string      $view          nome da view dentro de app/Views/emails/
     * @param array       $dados         variáveis para a view
     * @param string|null $responderPara e-mail usado no "Responder" (Reply-To)
     * @param string|null $responderNome nome do Reply-To
     * @return bool true se o servidor aceitou a mensagem
     */
    public static function enviar(
        string $para,
        string $assunto,
        string $view,
        array $dados = [],
        ?string $responderPara = null,
        ?string $responderNome = null
    ): bool {
        $config = config('Email');
        $html   = view('emails/' . $view, $dados);

        // Sem usuário de SMTP no .env não adianta tentar: registra no log e segue.
        // Em desenvolvimento o conteúdo vai para o log (writable/logs), útil para pegar
        // o link de recuperação de senha durante a aula, mesmo sem o Mailtrap configurado.
        if ($config->protocol === 'smtp' && $config->SMTPUser === '') {
            log_message('warning', "E-mail NÃO enviado (configure email.SMTPUser e email.SMTPPass no .env): \"{$assunto}\" para {$para}");

            if (ENVIRONMENT === 'development') {
                log_message('info', "Conteúdo do e-mail \"{$assunto}\":\n" . self::somenteTexto($html));
            }

            return false;
        }

        $email = service('email');
        $email->clear(true);                // o serviço é compartilhado: limpa o envio anterior

        $email->setFrom($config->fromEmail, $config->fromName);
        $email->setTo($para);
        $email->setSubject($assunto);
        $email->setMessage($html);
        $email->setAltMessage(self::somenteTexto($html));   // versão texto para leitores sem HTML

        if (! empty($responderPara)) {
            $email->setReplyTo($responderPara, $responderNome ?? '');
        }

        if ($email->send(false)) {
            return true;
        }

        // printDebugger() mostra a conversa com o servidor SMTP: vai para o log, nunca para a tela
        log_message('error', 'Falha ao enviar e-mail: ' . $email->printDebugger(['headers']));

        return false;
    }

    /**
     * Converte o HTML do e-mail em texto simples, mantendo as quebras de linha e os links.
     */
    private static function somenteTexto(string $html): string
    {
        $html = preg_replace('/<a\s[^>]*href="([^"]+)"[^>]*>(.*?)<\/a>/is', '$2 ($1)', $html);
        $html = preg_replace('/<(br|\/p|\/tr|\/h[1-6]|\/li)\s*\/?>/i', "\n", $html);
        $texto = html_entity_decode(strip_tags($html), ENT_QUOTES, 'UTF-8');

        return trim(preg_replace("/\n\s*\n+/", "\n\n", $texto));
    }
}
