<?= $this->extend('templates/layout_admin') ?>

<?= $this->section("main") ?>

<div class="container">

    <div class="admin-panel">

        <div class="admin-panel-header">
            <h3>Categoria de Produtos<?= subTitulo($action) ?></h3>
            <?= btnCrud('voltarp') ?>
        </div>

        <?= form_open("Categoria/" . getAcao($action)) ?>

            <input type="hidden" name="id" id="id" value="<?= setValue("id", $dados) ?>">
            <input type="hidden" name="action" id="action" value="<?= $action ?>">

            <div class="row g-3">

                <div class="col-12 col-md-9">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control <?= !empty($erros['descricao']) ? 'is-invalid' : '' ?>"
                        name="descricao" id="descricao"
                        value="<?= setValue("descricao", $dados) ?>">
                    <?= setMsgErrorCampo("descricao", $erros) ?>
                </div>

                <div class="col-12 col-md-3">
                    <label for="statusRegistro" class="form-label">Status</label>
                    <select class="form-select <?= !empty($erros['statusRegistro']) ? 'is-invalid' : '' ?>" name="statusRegistro" id="statusRegistro" required>
                        <option value=""  <?= (setValue("statusRegistro", $dados) == ""  ? "selected" : "") ?>>...</option>
                        <option value="1" <?= (setValue("statusRegistro", $dados) == "1" ? "selected" : "") ?>>Ativo</option>
                        <option value="2" <?= (setValue("statusRegistro", $dados) == "2" ? "selected" : "") ?>>Inativo</option>
                    </select>
                    <?= setMsgErrorCampo("statusRegistro", $erros) ?>
                </div>

            </div>

            <div class="mt-4 pt-3 border-top">
                <?= btnCrud('voltarm') ?>
                <button type="submit" class="btn btn-brand" id="btGravar"><i class="fa fa-check me-1"></i> Gravar</button>
            </div>

        <?= form_close() ?>

    </div>

</div>

<?= $this->endSection() ?>
