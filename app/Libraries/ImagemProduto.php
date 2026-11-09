<?php

namespace App\Libraries;

use CodeIgniter\HTTP\Files\UploadedFile;

/**
 * Centraliza tudo que envolve a imagem do produto:
 * gravar o upload, gerar a miniatura, apagar e montar a URL.
 *
 * Os arquivos ficam em public/uploads/produto/
 *   <nome-aleatorio>.jpg        -> imagem original
 *   thumb_<nome-aleatorio>.jpg  -> miniatura 400x400
 */
class ImagemProduto
{
    public const PASTA = 'uploads/produto/';

    /**
     * Move o arquivo enviado para a pasta de produtos e gera a miniatura.
     *
     * @return string Nome do arquivo gravado (é o que vai para o banco)
     */
    public static function salvarUpload(UploadedFile $arquivo): string
    {
        // Nunca use o nome original: ele vem do usuário e pode repetir ou conter caracteres perigosos
        $nome = $arquivo->getRandomName();

        $arquivo->move(self::caminho(), $nome);

        self::gerarMiniatura($nome);

        return $nome;
    }

    /**
     * Gera a miniatura quadrada (corta o excesso pelo centro).
     */
    public static function gerarMiniatura(string $nome): void
    {
        service('image')
            ->withFile(self::caminho() . $nome)
            ->fit(400, 400, 'center')
            ->save(self::caminho() . 'thumb_' . $nome);
    }

    /**
     * Apaga a imagem e a miniatura do disco.
     */
    public static function remover(?string $nome): void
    {
        if (empty($nome)) {
            return;
        }

        foreach ([$nome, 'thumb_' . $nome] as $arquivo) {
            // basename(): garante que ninguém apague um arquivo fora da pasta (ex: "../../index.php")
            $caminho = self::caminho() . basename($arquivo);

            if (is_file($caminho)) {
                unlink($caminho);
            }
        }
    }

    /**
     * URL pública da imagem (ou de uma imagem padrão, se o produto não tiver foto).
     */
    public static function url(?string $nome, bool $miniatura = true): string
    {
        if (empty($nome) || ! is_file(self::caminho() . $nome)) {
            return base_url('assets/img/core-img/sem-imagem.svg');
        }

        return base_url(self::PASTA . ($miniatura ? 'thumb_' : '') . $nome);
    }

    /**
     * Caminho físico da pasta (FCPATH = pasta public/).
     */
    public static function caminho(): string
    {
        return FCPATH . self::PASTA;
    }
}
