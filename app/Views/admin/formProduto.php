<?= $this->extend('templates/layout_admin') ?>

<?= $this->section("main") ?>

<?php
    // Em "view" e "delete" o formulário só mostra os dados
    $somenteLeitura = in_array($action, ["view", "delete"]);
    $bloqueio       = $somenteLeitura ? "disabled" : "";
    $categoriaAtual = setValue("categoria_id", $dados);
    $statusAtual    = setValue("statusRegistro", $dados, "1");
?>

<div class="container">

    <?= mensagem() ?>

    <div class="admin-panel">

        <div class="admin-panel-header">
            <h3>Produto<?= subTitulo($action) ?></h3>
            <?= btnCrud('voltarp') ?>
        </div>

        <?php if ($action === "delete"): ?>
            <div class="alert alert-warning">
                Confirme a exclusão do produto abaixo. Ele sai da vitrine, mas continua nos pedidos já feitos.
            </div>
        <?php endif; ?>

        <?php // form_open_multipart() = form_open() + enctype="multipart/form-data" (obrigatório para upload) ?>
        <?= form_open_multipart("Produto/" . getAcao($action)) ?>

            <input type="hidden" name="id" value="<?= setValue("id", $dados) ?>">
            <input type="hidden" name="action" value="<?= esc($action) ?>">

            <div class="row g-3">

                <div class="col-12 col-md-8">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control <?= !empty($erros['nome']) ? 'is-invalid' : '' ?>"
                        name="nome" id="nome" maxlength="100" value="<?= setValue("nome", $dados) ?>" <?= $bloqueio ?>>
                    <?= setMsgErrorCampo("nome", $erros) ?>
                </div>

                <div class="col-12 col-md-4">
                    <label for="categoria_id" class="form-label">Categoria</label>
                    <select class="form-select <?= !empty($erros['categoria_id']) ? 'is-invalid' : '' ?>"
                        name="categoria_id" id="categoria_id" <?= $bloqueio ?>>
                        <option value="">...</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id'] ?>" <?= $categoriaAtual == $categoria['id'] ? 'selected' : '' ?>>
                                <?= esc($categoria['descricao']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= setMsgErrorCampo("categoria_id", $erros) ?>
                </div>

                <div class="col-12 col-md-4">
                    <label for="preco" class="form-label">Preço (R$)</label>
                    <input type="text" inputmode="decimal" class="form-control <?= !empty($erros['preco']) ? 'is-invalid' : '' ?>"
                        name="preco" id="preco" placeholder="0,00" value="<?= setValue("preco", $dados) ?>" <?= $bloqueio ?>>
                    <?= setMsgErrorCampo("preco", $erros) ?>
                </div>

                <div class="col-12 col-md-4">
                    <label for="estoque" class="form-label">Estoque</label>
                    <input type="number" min="0" step="1" class="form-control <?= !empty($erros['estoque']) ? 'is-invalid' : '' ?>"
                        name="estoque" id="estoque" value="<?= setValue("estoque", $dados, "0") ?>" <?= $bloqueio ?>>
                    <?= setMsgErrorCampo("estoque", $erros) ?>
                </div>

                <div class="col-12 col-md-4">
                    <label for="statusRegistro" class="form-label">Status</label>
                    <select class="form-select <?= !empty($erros['statusRegistro']) ? 'is-invalid' : '' ?>"
                        name="statusRegistro" id="statusRegistro" <?= $bloqueio ?>>
                        <option value="1" <?= $statusAtual == "1" ? "selected" : "" ?>>Ativo</option>
                        <option value="2" <?= $statusAtual == "2" ? "selected" : "" ?>>Inativo</option>
                    </select>
                    <?= setMsgErrorCampo("statusRegistro", $erros) ?>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label d-block">Foto atual</label>
                    <img src="<?= imagemProduto($dados['imagem'] ?? null) ?>" alt="Foto do produto"
                         class="img-thumbnail" width="160" height="160">
                </div>

                <?php if (! $somenteLeitura): ?>
                    <div class="col-12 col-md-8">
                        <label for="imagem" class="form-label">
                            <?= $action === "insert" ? "Foto do produto" : "Trocar a foto (opcional)" ?>
                        </label>
                        <input type="file" class="form-control <?= !empty($erros['imagem']) ? 'is-invalid' : '' ?>"
                            name="imagem" id="imagem" accept="image/jpeg,image/png,image/webp">
                        <div class="form-text">JPG, PNG ou WEBP, até 2 MB. A miniatura 400x400 é gerada automaticamente.</div>
                        <?= setMsgErrorCampo("imagem", $erros) ?>
                    </div>
                <?php endif; ?>

                <div class="col-12">
                    <label for="descricao" class="form-label">Descrição</label>
                    <?php if ($somenteLeitura): ?>
                        <div class="border rounded p-3 bg-light"><?= sanitizarHtml($dados['descricao'] ?? '') ?></div>
                    <?php else: ?>
                        <textarea class="form-control" name="descricao" id="descricao" rows="6"><?= setValue("descricao", $dados) ?></textarea>
                    <?php endif; ?>
                </div>

            </div>

            <div class="mt-4 pt-3 border-top">
                <?= btnCrud('voltarm') ?>

                <?php if ($action === "delete"): ?>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o me-1"></i> Confirmar exclusão</button>
                <?php elseif ($action !== "view"): ?>
                    <button type="submit" class="btn btn-brand"><i class="fa fa-check me-1"></i> Gravar</button>
                <?php endif; ?>
            </div>

        <?= form_close() ?>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>

<?php if (! $somenteLeitura): ?>
    <!-- CKEditor 5 (build "classic" que já está em public/assets/ckeditor5) -->
    <script src="<?= base_url("assets/ckeditor5/ckeditor.js") ?>"></script>
    <script src="<?= base_url("assets/ckeditor5/translations/pt-br.js") ?>"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#descricao'), { language: 'pt-br' })
            .catch(function (erro) { console.error(erro); });
    </script>
<?php endif; ?>

<?= $this->endSection() ?>
