<?php
    // Administrador troca a senha dentro do painel; cliente, dentro da loja.
    // As duas telas usam a seção "main", então a mesma view serve para os dois layouts.
    $layout = (int) session()->get('userNivel') === 1 ? 'templates/layout_admin' : 'templates/layout_publico';
?>
<?= $this->extend($layout) ?>

<?= $this->section("main") ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <?= mensagem() ?>

            <div class="form-card">
                <h3 class="h4 mb-4">Trocar a senha</h3>

                <?= form_open("trocarSenha", ["class" => "row g-3"]) ?>

                    <div class="col-12">
                        <label for="senhaAtual" class="form-label">Senha atual</label>
                        <input type="password" class="form-control" name="senhaAtual" id="senhaAtual" required>
                    </div>

                    <div class="col-12">
                        <label for="senha" class="form-label">Nova senha</label>
                        <input type="password" class="form-control" name="senha" id="senha" minlength="6" required>
                    </div>

                    <div class="col-12">
                        <label for="confirmaSenha" class="form-label">Confirme a nova senha</label>
                        <input type="password" class="form-control" name="confirmaSenha" id="confirmaSenha" minlength="6" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-brand w-100"><i class="fa fa-check me-1"></i> Gravar</button>
                    </div>

                <?= form_close() ?>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
