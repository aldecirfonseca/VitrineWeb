<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<section class="page-hero" style="background-image: url('<?= base_url() ?>assets/img/bg-img/breadcumb.jpg');">
    <div class="container">
        <span class="section-eyebrow">Minha conta</span>
        <h1>Esqueci minha senha</h1>
        <p>Informe o e-mail da sua conta e enviaremos um link para criar uma nova senha.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="form-card">

                    <?= mensagem() ?>

                    <?= form_open("esqueciSenha", ["class" => "row g-3"]) ?>

                        <div class="col-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email" required
                                   value="<?= esc(old("email") ?? "") ?>" placeholder="voce@email.com">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-brand btn-lg w-100">Enviar link</button>
                        </div>

                        <div class="col-12 text-center">
                            <a href="<?= base_url("login") ?>" class="small">Voltar para o login</a>
                        </div>

                    <?= form_close() ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
