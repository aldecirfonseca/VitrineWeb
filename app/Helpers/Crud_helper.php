<?php

/**
 * exibeTitulo
 *
 * @param string $titulo 
 * @param array $parametro 
 * @return string
 */
function exibeTitulo($titulo, $parametro = ['acao' => 'lista'])
{
    if (!isset($parametro['controller'])) {
        $parametro['controller'] = $titulo;
    }

    $subTitulo  = $titulo;
    $link       = '/lista';
    $icone      = 'list';

    if ($parametro['acao'] == 'new') {
        $subTitulo .= ' - Novo';
    } else  if ($parametro['acao'] == 'update') {
        $subTitulo .= ' - Alteração';
    } else  if ($parametro['acao'] == 'delete') {
        $subTitulo .= ' - Exclusão';
    } else  if ($parametro['acao'] == 'view') {
        $subTitulo .= ' - Visualização';
    } else  if ($parametro['acao'] == 'lista') {
        $link       = '/form/new/0';
        $icone      = 'plus';
    }

    $texto = '
                <div class="admin-panel-header">
                    <h3>' . $subTitulo . '</h3>
                    <a href="' .  base_url() . '/' . $parametro['controller'] . $link . '" class="btn btn-brand btn-sm" title="Novo"><i class="fa fa-' . $icone .'" aria-hidden="true"></i></a>
                </div>
    ';

    $texto .= mensagem();

    return $texto;
}


/**
 * getStatusRegistro
 *
 * @param int $status 
 * @return string
 */
function getStatusRegistro($status) : string
{
    if ($status == 1) {
        return "Ativo";
    } elseif ($status == 2) {
        return "Inativo";
    } else {
        return "...";
    }
}

/**
 * subTitulo
 *
 * @param string $acao 
 * @return string
 */
function subTitulo($acao) : string
{
    if ($acao == "insert"){
        return " - Inclusão";
    } elseif ($acao == "update") {
        return " - Alteração";
    } elseif ($acao == "delete") {
        return " - Exclusão";
    } elseif ($acao == "view") {
        return " - Visualização";
    }
}

/**
 * setValue
 *
 * @param string $campo 
 * @param array $dados 
 * @param string $defaultValue 
 * @return void
 */
function setValue($campo, $dados = [], $defaultValue = "")
{
    if (!empty(set_value($campo))) {
        return set_value($campo);
    } else {
        if (isset($dados[$campo])) {
            return $dados[$campo];
        } else {
            return $defaultValue;
        }
    }
}

/**
 * setMsgErrorCampo
 *
 * @param string $chave 
 * @param array $errors 
 * @return string
 */
function setMsgErrorCampo($chave, $errors)
{
    $texto = '';

    if (!empty($errors[$chave])) {
        $texto = '<div class="text-danger mt-2">' . $errors[$chave] . "</div>";
    }
    
    return $texto;
}

/**
 * getAcao
 *
 * @param string $acao 
 * @return string
 */
function getAcao($acao)
{
    if (($acao == "insert") or ($acao == "update")) {
        return "store";
    } else {
        return $acao;
    }
}

/**
 * comboboxStatus
 *
 * @param int $status 
 * @return string
 */
function comboboxStatus($status = 0)
{
    return '<label for="statusRegistro" class="form-label">Status</label>
            <select name="statusRegistro" id="statusRegistro" class="form-select" required>
                <option value=""  ' . (isset($status) ? ($status == 0 ? "selected" : "") : "") . '>...</option>
                <option value="1" ' . (isset($status) ? ($status == 1 ? "selected" : "") : "") . '>Ativo</option>
                <option value="2" ' . (isset($status) ? ($status == 2 ? "selected" : "") : "") . '>Inativo</option>
            </select>';
}

/**
 * mensagem
 *
 * @return string
 */
function mensagem()
{
    $texto = '';

    if (session()->msgError != "") {

        $texto .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>' . session()->get('msgError') . '</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }

    if (session()->msgSucesso != "") {

        $texto .= '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>' . session()->get('msgSucesso') . '</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }

    return $texto;
}

/**
 * getController
 *
 * @return string
 */
function getController()
{
    $router = service("router");
    $controller = explode('\\', $router->controllerName());

    return $controller[3];
}

/**
 * btnCrud
 *
 * @param string $tipoBtn 
 * @param int $id 
 * @return string
 */
function btnCrud($tipoBtn, $id = 0)
{
    $controller = getController();

    if ($tipoBtn == "insert") {
        return '<a class="btn btn-brand btn-sm"
                    href="' . base_url() . $controller .'/form/insert/'. $id . '"
                    title="Novo Registro"><i class="fa fa-plus" aria-hidden="true"></i> Novo
                </a>';
    } elseif ($tipoBtn == "update") {
        return '<a href="'. base_url() . $controller . '/form/update/' . $id . '" class="btn btn-outline-brand btn-sm me-1" title="Alterar Registro"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
    } elseif ($tipoBtn == "delete") {
        return '<a href="' . base_url() . $controller . '/form/delete/' . $id . '" class="btn btn-outline-danger btn-sm me-1" title="Excluir Registro"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
    } elseif ($tipoBtn == "view") {
        return '<a href="' . base_url() . $controller . '/form/view/' . $id . '" class="btn btn-outline-secondary btn-sm me-1" title="Visualizar Registro"><i class="fa fa-eye" aria-hidden="true"></i></a>';
    } elseif ($tipoBtn == "voltarp") {
        return '<a href="' . base_url() . $controller . '" class="btn btn-outline-secondary btn-sm" title="Voltar"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>';
    } elseif ($tipoBtn == "voltarm") {
        return '<a href="' . base_url() . $controller . '" class="btn btn-outline-secondary me-2" title="Voltar"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>';
    }

    return '';
}
