<?php
/**
 * formatValor
 *
 * @param float $valor 
 * @param int $decimais 
 * @return float
 */
function formatValor($valor, $decimais = 2)
{
    return number_format($valor, $decimais, ",", ".");
}

/**
 * strToNumer - Converte um valor string no formato decimal para float
 *
 * @param string $valor 
 * @return float
 */
function strToNumer($valor)
{
    $valor = trim((string) $valor);

    // Sem vírgula o valor já está no formato do banco ("59.90"): não mexe.
    // Sem esta checagem, "59.90" virava "5990".
    if (strpos($valor, ",") === false) {
        return $valor;
    }

    return str_replace(",", ".", str_replace(".", "", $valor));
}

/**
 * imagemProduto - URL da imagem do produto (miniatura por padrão)
 *
 * @param string|null $imagem
 * @param bool $miniatura
 * @return string
 */
function imagemProduto($imagem, $miniatura = true)
{
    return \App\Libraries\ImagemProduto::url($imagem, $miniatura);
}

/**
 * sanitizarHtml - limpa o HTML vindo do CKEditor antes de exibir na vitrine
 *
 * Mantém só as tags de formatação e remove atributos de evento (onclick...)
 * e links "javascript:". Em produção, prefira uma biblioteca como o HTMLPurifier.
 *
 * @param string|null $html
 * @return string
 */
function sanitizarHtml($html)
{
    $permitidas = '<p><br><strong><b><em><i><u><ul><ol><li><h2><h3><h4><blockquote><a>';

    $html = strip_tags((string) $html, $permitidas);
    $html = preg_replace('/\s+on[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);
    $html = preg_replace('/(href|src)\s*=\s*("|\')\s*javascript:[^"\']*\2/i', '$1="#"', $html);

    return $html;
}

/**
 * qtdItensCarrinho - soma das quantidades do carrinho (contador do menu)
 *
 * @return int
 */
function qtdItensCarrinho()
{
    return array_sum(array_column(session()->get('carrinho') ?? [], 'quantidade'));
}

/**
 * categoriasMenu - categorias ativas para o menu da vitrine
 *
 * @return array
 */
function categoriasMenu()
{
    static $categorias = null;      // consulta o banco uma vez por requisição

    if ($categorias === null) {
        try {
            $categorias = (new \App\Models\CategoriaModel())->listaAtivas();
        } catch (\Throwable $e) {
            $categorias = [];       // banco ainda sem a tabela: a página abre mesmo assim
        }
    }

    return $categorias;
}