<?= $this->extend('templates/layout_admin') ?>

<?= $this->section("main") ?>

<?php
    $somenteLeitura = $action === "view";
    $bloqueio       = $somenteLeitura ? "disabled" : "";
    $nivelAtual     = setValue("nivel", $dados);
    $statusAtual    = setValue("statusRegistro", $dados);
?>

<div class="container">

    <?= mensagem() ?>

    <div class="admin-panel">

        <div class="admin-panel-header">
            <h3>Usuário<?= subTitulo($action) ?></h3>
            <?= btnCrud('voltarp') ?>
        </div>

        <?= form_open("Usuario/store") ?>

            <input type="hidden" name="id" value="<?= (int) $dados['id'] ?>">

            <div class="row g-3">

                <div class="col-12 col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control <?= !empty($erros['nome']) ? 'is-invalid' : '' ?>"
                        name="nome" id="nome" value="<?= setValue("nome", $dados) ?>" <?= $bloqueio ?>>
                    <?= setMsgErrorCampo("nome", $erros) ?>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">E-mail</label>
                    <input type="email" class="form-control" value="<?= esc($dados['email']) ?>" disabled>
                    <div class="form-text">O e-mail é o login e não muda por aqui.</div>
                </div>

                <div class="col-12 col-md-6">
                    <label for="nivel" class="form-label">Nível</label>
                    <select class="form-select <?= !empty($erros['nivel']) ? 'is-invalid' : '' ?>" name="nivel" id="nivel" <?= $bloqueio ?>>
                        <option value="1"  <?= $nivelAtual == "1"  ? "selected" : "" ?>>Administrador</option>
                        <option value="11" <?= $nivelAtual == "11" ? "selected" : "" ?>>Cliente</option>
                    </select>
                    <?= setMsgErrorCampo("nivel", $erros) ?>
                </div>

                <div class="col-12 col-md-6">
                    <label for="statusRegistro" class="form-label">Status</label>
                    <select class="form-select <?= !empty($erros['statusRegistro']) ? 'is-invalid' : '' ?>" name="statusRegistro" id="statusRegistro" <?= $bloqueio ?>>
                        <option value="1" <?= $statusAtual == "1" ? "selected" : "" ?>>Ativo</option>
                        <option value="2" <?= $statusAtual == "2" ? "selected" : "" ?>>Inativo (bloqueado)</option>
                    </select>
                    <div class="form-text">Usuário inativo não consegue entrar e perde o acesso na próxima página que abrir.</div>
                    <?= setMsgErrorCampo("statusRegistro", $erros) ?>
                </div>

            </div>

            <div class="mt-4 pt-3 border-top">
                <?= btnCrud('voltarm') ?>
                <?php if (! $somenteLeitura): ?>
                    <button type="submit" class="btn btn-brand"><i class="fa fa-check me-1"></i> Gravar</button>
                <?php endif; ?>
            </div>

        <?= form_close() ?>

    </div>

</div>

<?= $this->endSection() ?>
