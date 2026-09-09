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
                <section>
                    <div class="blog-banner">
                        <div class="row">
                            <div class="col-10 mt-5 mb-5 text-left">
                                <h1 style="color: #384aeb;">' . $subTitulo . '</h1>
                            </div>
                            <div class="col-2 mt-5 mb-5 text-right">
                                <a href="' .  base_url() . '/' . $parametro['controller'] . $link . '" class="btn btn-secondary btn-sm btn-icons-crud" title="Novo"><i class="fa fa-' . $icone .'" aria-hidden="true"></i></a>    
                            </div>
                        </div>
                    </div>
                </section>
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
            <select name="statusRegistro" id="statusRegistro" class="form-control" required>
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

        $texto .= '<div class="row mr-2 ml-2">
                        <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>' . session()->get('msgError') . '</strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>';
    }

    if (session()->msgSucesso != "") {

        $texto .= '<div class="row mr-2 ml-2 ">
                        <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                            <strong>' . session()->get('msgSucesso') . '</strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
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
        return '<a class="mr-2" style="font-size: 18px !important;" 
                    href="' . base_url() . $controller .'/form/insert/'. $id . '" 
                    title="Novo Registro"><i class="fa fa-pencil" aria-hidden="true"></i>
                </a>';
    } elseif ($tipoBtn == "update") {
        return '<a href="'. base_url() . $controller . '/form/update/' . $id . '" class="mr-2" style="font-size: 18px !important;" title="Alterar Registro"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
    } elseif ($tipoBtn == "delete") {
        return '<a href="' . base_url() . $controller . '/form/delete/' . $id . '" class="mr-2" style="font-size: 18px !important;" title="Excluir Registro"><i class="fa fa-times" aria-hidden="true"></i></a>';
    } elseif ($tipoBtn == "view") {
        return '<a href="' . base_url() . $controller . '/form/view/' . $id . '" class="mr-2" style="font-size: 18px !important;" title="Visualizar Registro"><i class="fa fa-eye" aria-hidden="true"></i></a>';
    } elseif ($tipoBtn == "voltarp") {
        return '<a href="' . base_url() . $controller . '" class="mr-2" style="font-size: 18px !important;" title="Voltar"><i class="fa fa-sign-out" aria-hidden="true"></i></a>';
    } elseif ($tipoBtn == "voltarm") {
        return '<a href="' . base_url() . $controller . '" class="mr-3" style="font-size: 26px !important;" title="Voltar"><i class="fa fa-sign-out" aria-hidden="true"></i></a>';
    } 

    return '';
}

/**
 * getDataTables
 *
 * @param string $table_id 
 * @return string
 */
function getDataTables($table_id)
{
    return '
        <script type="text/javascript" src="' . base_url() . 'assets/datatables/datatables.min.js"></script>
        <script>
            $(document).ready( function() {
                $("#' . $table_id . '").DataTable( {
                    language:   {
                                    "sEmptyTable":      "Nenhum registro encontrado",
                                    "sInfo":            "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                                    "sInfoEmpty":       "Mostrando 0 até 0 de 0 registros",
                                    "sInfoFiltered":    "(Filtrados de _MAX_ registros)",
                                    "sInfoPostFix":     "",
                                    "sInfoThousands":   ".",
                                    "sLengthMenu":      "_MENU_ resultados por página",
                                    "sLoadingRecords":  "Carregando...",
                                    "sProcessing":      "Processando...",
                                    "sZeroRecords":     "Nenhum registro encontrado",
                                    "sSearch":          "Pesquisar",
                                    "oPaginate": {
                                        "sNext":        "Próximo",
                                        "sPrevious":    "Anterior",
                                        "sFirst":       "Primeiro",
                                        "sLast":        "Último"
                                    },
                                    "oAria": {
                                        "sSortAscending":   ": Ordenar colunas de forma ascendente",
                                        "sSortDescending":  ": Ordenar colunas de forma descendente"
                                    }
                                }
                });
            } );
        </script>
    ';
}
