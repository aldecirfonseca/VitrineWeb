<?= $this->extend('templates/layout_admin') ?>

<?= $this->section("main") ?> 

<div class="container">

    <div class="row">

        <div class="col-10">
            <h3>Categoria de Produtos<?= subTitulo($action) ?></h3>
        </div>
        <div class="col-2 text-right">
            <?= btnCrud('voltarp') ?>
        </div>

    </div>

    <?= form_open("Categoria/" . getAcao($action)) ?>

        <input type="hidden" name="id" id="id" value="<?= setValue("id", $dados) ?>">
        <input type="hidden" name="action" id="action" value="<?= $action ?>">

        <div class="row mt-3">

            <div class="col-9 form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" 
                name="descricao" id="descricao" 
                value="<?= setValue("descricao", $dados) ?>">
                <?= setMsgErrorCampo("descricao", $erros) ?>
            </div>

            <div class="col-3">
                <label for="statusRegistro">Status</label>
                <div class="form-group">
                    <select class="form-control" name="statusRegistro" id="statusRegistro" required>
                        <option value=""  <?= (setValue("statusRegistro", $dados) == ""  ? "selected" : "") ?>>...</option>
                        <option value="1" <?= (setValue("statusRegistro", $dados) == "1" ? "selected" : "") ?>>Ativo</option>
                        <option value="2" <?= (setValue("statusRegistro", $dados) == "2" ? "selected" : "") ?>>Inativo</option>
                    </select>
                </div>
                <?= setMsgErrorCampo("statusRegistro", $erros) ?>
            </div>

        </div>

        <div class="row ml-1 mt-5 mb-5">
            <?= btnCrud('voltarm') ?>
            <button type="submit" class="btn btn-outline-secondary" id="btGravar">Gravar</button>
        </div>

    <?= form_close() ?>

</div>

<?= $this->endSection() ?>