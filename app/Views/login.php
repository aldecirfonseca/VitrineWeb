<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<!-- ##### Cabeçalho da página ##### -->
<section class="page-hero" style="background-image: url('<?= base_url() ?>assets/img/bg-img/breadcumb.jpg');">
    <div class="container">
        <span class="section-eyebrow">Minha conta</span>
        <h1>Entrar na sua conta</h1>
        <p>Acesse para acompanhar pedidos, favoritos e finalizar suas compras mais rápido.</p>
    </div>
</section>

<!-- ##### Login ##### -->
<section class="py-5">
    <div class="container">
        <div class="row g-4 g-lg-5 justify-content-center">

            <!-- Novo por aqui -->
            <div class="col-12 col-lg-5">
                <span class="section-eyebrow">Novo por aqui?</span>
                <h2 class="mb-3">Crie sua conta</h2>
                <p class="text-muted mb-4">
                    Cadastre-se para acompanhar seus pedidos, salvar favoritos e agilizar suas
                    próximas compras na VitrineWeb.
                </p>
                <a href="<?= base_url("criarNovaConta") ?>" class="btn btn-outline-brand btn-lg">
                    <i class="fa fa-user-plus me-1"></i> Criar nova conta
                </a>
            </div>

            <!-- Formulário -->
            <div class="col-12 col-lg-7">
                <div class="form-card">
                    <h5 class="mb-4">Entre com seu login</h5>

                    <?= mensagem() ?>

                    <?= form_open("Login/signIn", ["class" => "row g-3", "id" => "loginForm"]) ?>

                        <?php // Vem do AuthFilter (?destino=...). Vazio = o signIn usa Sistema/home ?>
                        <input type="hidden" name="destino" value="<?= esc($destino ?? '') ?>">

                        <div class="col-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>"
                                name="email" id="email" value="<?= setValue('email', $data ?? []) ?>" placeholder="voce@email.com">
                            <?= setMsgErrorCampo('email', $errors ?? []) ?>
                        </div>

                        <div class="col-12">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control <?= !empty($errors['senha']) ? 'is-invalid' : '' ?>"
                                name="senha" id="senha" placeholder="Sua senha">
                            <?= setMsgErrorCampo('senha', $errors ?? []) ?>
                        </div>

                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="manterConectado" name="manterConectado">
                                <label class="form-check-label" for="manterConectado">Mantenha-me conectado</label>
                            </div>
                            <a href="#" class="small">Esqueceu a senha?</a>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-brand btn-lg w-100">Entrar</button>
                        </div>

                    <?= form_close() ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>
