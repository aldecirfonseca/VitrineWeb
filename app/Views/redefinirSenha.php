<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<section class="page-hero" style="background-image: url('<?= base_url() ?>assets/img/bg-img/breadcumb.jpg');">
    <div class="container">
        <span class="section-eyebrow">Minha conta</span>
        <h1>Criar uma nova senha</h1>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="form-card">

                    <?= mensagem() ?>

                    <?= form_open("redefinirSenha", ["class" => "row g-3"]) ?>

                        <input type="hidden" name="token" value="<?= esc($token) ?>">

                        <div class="col-12">
                            <label for="senha" class="form-label">Nova senha</label>
                            <input type="password" class="form-control" name="senha" id="senha" minlength="6" required>
                            <div class="form-text">Pelo menos 6 caracteres.</div>
                        </div>

                        <div class="col-12">
                            <label for="confirmaSenha" class="form-label">Confirme a nova senha</label>
                            <input type="password" class="form-control" name="confirmaSenha" id="confirmaSenha" minlength="6" required>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-brand btn-lg w-100">Gravar nova senha</button>
                        </div>

                    <?= form_close() ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
