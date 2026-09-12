<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<!-- ##### Cabeçalho da página ##### -->
<section class="page-hero" style="background-image: url('<?= base_url() ?>assets/img/bg-img/breadcumb2.jpg');">
    <div class="container">
        <span class="section-eyebrow">Estamos aqui para ajudar</span>
        <h1>Fale conosco</h1>
        <p>Dúvidas, sugestões ou parcerias — mande sua mensagem, respondemos rapidinho.</p>
    </div>
</section>

<!-- ##### Contato ##### -->
<section class="py-5">
    <div class="container">
        <div class="row g-4 g-lg-5">

            <!-- Informações de contato -->
            <div class="col-12 col-lg-5">
                <span class="section-eyebrow">Contato</span>
                <h2 class="mb-3">Vamos conversar</h2>
                <p class="text-muted mb-4">
                    Prefere outro canal? Escolha o que for mais fácil pra você — estamos disponíveis
                    de segunda a sexta.
                </p>

                <div class="contact-info-item">
                    <i class="fa fa-map-marker"></i>
                    <div>
                        <h6>Endereço</h6>
                        <p class="text-muted mb-0">Av. Paulista, 1000 — Bela Vista, São Paulo/SP</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <i class="fa fa-phone"></i>
                    <div>
                        <h6>Telefone</h6>
                        <p class="text-muted mb-0">(11) 4000-1234</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <i class="fa fa-envelope-o"></i>
                    <div>
                        <h6>E-mail</h6>
                        <p class="text-muted mb-0">contato@vitrineweb.com.br</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <i class="fa fa-clock-o"></i>
                    <div>
                        <h6>Horário de atendimento</h6>
                        <p class="text-muted mb-0">Seg. a sex., 9h às 18h</p>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="#" class="social-link" style="background:var(--brand-light); color:var(--brand);" title="Facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="social-link" style="background:var(--brand-light); color:var(--brand);" title="Instagram"><i class="fa fa-instagram"></i></a>
                    <a href="#" class="social-link" style="background:var(--brand-light); color:var(--brand);" title="Whatsapp"><i class="fa fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Formulário -->
            <div class="col-12 col-lg-7">
                <div class="form-card">

                    <?= mensagem() ?>

                    <?= form_open("faleconosco") ?>

                        <div class="row g-3">

                            <div class="col-12 col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control <?= !empty($erros['nome']) ? 'is-invalid' : '' ?>"
                                    name="nome" id="nome" value="<?= setValue("nome", $dados) ?>" placeholder="Seu nome completo">
                                <?= setMsgErrorCampo("nome", $erros) ?>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control <?= !empty($erros['email']) ? 'is-invalid' : '' ?>"
                                    name="email" id="email" value="<?= setValue("email", $dados) ?>" placeholder="voce@email.com">
                                <?= setMsgErrorCampo("email", $erros) ?>
                            </div>

                            <div class="col-12">
                                <label for="assunto" class="form-label">Assunto</label>
                                <input type="text" class="form-control <?= !empty($erros['assunto']) ? 'is-invalid' : '' ?>"
                                    name="assunto" id="assunto" value="<?= setValue("assunto", $dados) ?>" placeholder="Sobre o que você quer falar?">
                                <?= setMsgErrorCampo("assunto", $erros) ?>
                            </div>

                            <div class="col-12">
                                <label for="mensagem" class="form-label">Mensagem</label>
                                <textarea class="form-control <?= !empty($erros['mensagem']) ? 'is-invalid' : '' ?>"
                                    name="mensagem" id="mensagem" rows="5" placeholder="Escreva sua mensagem..."><?= setValue("mensagem", $dados) ?></textarea>
                                <?= setMsgErrorCampo("mensagem", $erros) ?>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-brand btn-lg">
                                    <i class="fa fa-paper-plane me-1"></i> Enviar mensagem
                                </button>
                            </div>

                        </div>

                    <?= form_close() ?>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ##### Mapa ##### -->
<section class="pb-5">
    <div class="container">
        <div class="map-embed">
            <iframe
                src="https://www.google.com/maps?q=-23.5613,-46.6565&output=embed"
                title="Localização da VitrineWeb"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
