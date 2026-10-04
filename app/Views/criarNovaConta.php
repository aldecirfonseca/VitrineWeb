<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<!-- ##### Cabeçalho da página ##### -->
<section class="page-hero" style="background-image: url('<?= base_url() ?>assets/img/bg-img/breadcumb2.jpg');">
    <div class="container">
        <span class="section-eyebrow">Minha conta</span>
        <h1>Criar nova conta</h1>
        <p>Leva menos de um minuto — depois é só aproveitar sua vitrine personalizada.</p>
    </div>
</section>

<!-- ##### Criar conta ##### -->
<section class="py-5">
    <div class="container">
        <div class="row g-4 g-lg-5 justify-content-center">

            <!-- Já possui conta -->
            <div class="col-12 col-lg-5">
                <span class="section-eyebrow">Já possui conta?</span>
                <h2 class="mb-3">Faça login</h2>
                <p class="text-muted mb-4">
                    Entre com seu e-mail e senha para acompanhar seus pedidos e continuar de onde parou.
                </p>
                <a href="<?= base_url("login") ?>" class="btn btn-outline-brand btn-lg">
                    <i class="fa fa-sign-in me-1"></i> Fazer login
                </a>
            </div>

            <!-- Formulário -->
            <div class="col-12 col-lg-7">
                <div class="form-card">
                    <h5 class="mb-4">Crie sua nova conta</h5>

                    <?= mensagem() ?>

                    <?= form_open("gravarNovaConta", ["class" => "row g-3", "id" => "registerForm"]) ?>

                        <div class="col-12">
                            <label for="nome" class="form-label">Nome completo</label>
                            <input type="text" class="form-control <?= !empty($errors['nome']) ? 'is-invalid' : '' ?>"
                                name="nome" id="nome" autofocus value="<?= setValue('nome', $data ?? []) ?>" placeholder="Seu nome completo">
                            <?= setMsgErrorCampo('nome', $errors ?? []) ?>
                        </div>

                        <div class="col-4 col-md-3">
                            <label for="ddd1" class="form-label">DDD</label>
                            <input type="text" class="form-control <?= !empty($errors['ddd1']) ? 'is-invalid' : '' ?>"
                                name="ddd1" id="ddd1" value="<?= setValue('ddd1', $data ?? []) ?>" placeholder="00">
                            <?= setMsgErrorCampo('ddd1', $errors ?? []) ?>
                        </div>

                        <div class="col-8 col-md-9">
                            <label for="celular1" class="form-label">Celular para contato</label>
                            <input type="text" class="form-control <?= !empty($errors['celular1']) ? 'is-invalid' : '' ?>"
                                name="celular1" id="celular1" value="<?= setValue('celular1', $data ?? []) ?>" placeholder="00000-0000">
                            <?= setMsgErrorCampo('celular1', $errors ?? []) ?>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>"
                                name="email" id="email" value="<?= setValue('email', $data ?? []) ?>" placeholder="voce@email.com">
                            <?= setMsgErrorCampo('email', $errors ?? []) ?>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control <?= !empty($errors['senha']) ? 'is-invalid' : '' ?>"
                                name="senha" id="senha" placeholder="Crie uma senha">
                            <?= setMsgErrorCampo('senha', $errors ?? []) ?>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="confirmaSenha" class="form-label">Confirme a senha</label>
                            <input type="password" class="form-control <?= !empty($errors['confirmaSenha']) ? 'is-invalid' : '' ?>"
                                name="confirmaSenha" id="confirmaSenha" placeholder="Repita a senha">
                            <?= setMsgErrorCampo('confirmaSenha', $errors ?? []) ?>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-brand btn-lg w-100">Criar conta</button>
                        </div>

                    <?= form_close() ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>
