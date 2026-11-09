<?= $this->extend('templates/layout_admin') ?>

<?= $this->section("main") ?>

<?php
    // Em "view" e "delete" o formulário só mostra os dados
    $somenteLeitura = in_array($action, ["view", "delete"]);
    $bloqueio       = $somenteLeitura ? "disabled" : "";
    $statusAtual    = setValue("statusRegistro", $dados, "1");
?>

<div class="container">

    <?= mensagem() ?>

    <div class="admin-panel">

        <div class="admin-panel-header">
            <h3>Categoria de Produtos<?= subTitulo($action) ?></h3>
            <?= btnCrud('voltarp') ?>
        </div>

        <?php if ($action === "delete"): ?>
            <div class="alert alert-warning">Confirme a exclusão da categoria abaixo.</div>
        <?php endif; ?>

        <?= form_open("Categoria/" . getAcao($action)) ?>

            <input type="hidden" name="id" id="id" value="<?= setValue("id", $dados) ?>">
            <input type="hidden" name="action" id="action" value="<?= esc($action) ?>">

            <div class="row g-3">

                <div class="col-12 col-md-9">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control <?= !empty($erros['descricao']) ? 'is-invalid' : '' ?>"
                        name="descricao" id="descricao" maxlength="50"
                        value="<?= setValue("descricao", $dados) ?>" <?= $bloqueio ?>>
                    <?= setMsgErrorCampo("descricao", $erros) ?>
                </div>

                <div class="col-12 col-md-3">
                    <label for="statusRegistro" class="form-label">Status</label>
                    <select class="form-select <?= !empty($erros['statusRegistro']) ? 'is-invalid' : '' ?>"
                        name="statusRegistro" id="statusRegistro" <?= $bloqueio ?>>
                        <option value="1" <?= $statusAtual == "1" ? "selected" : "" ?>>Ativo</option>
                        <option value="2" <?= $statusAtual == "2" ? "selected" : "" ?>>Inativo</option>
                    </select>
                    <?= setMsgErrorCampo("statusRegistro", $erros) ?>
                </div>

            </div>

            <div class="mt-4 pt-3 border-top">
                <?= btnCrud('voltarm') ?>

                <?php if ($action === "delete"): ?>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o me-1"></i> Confirmar exclusão</button>
                <?php elseif ($action !== "view"): ?>
                    <button type="submit" class="btn btn-brand" id="btGravar"><i class="fa fa-check me-1"></i> Gravar</button>
                <?php endif; ?>
            </div>

        <?= form_close() ?>

    </div>

</div>

<?= $this->endSection() ?>
