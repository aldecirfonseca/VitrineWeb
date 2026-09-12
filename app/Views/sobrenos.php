<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<!-- ##### Cabeçalho da página ##### -->
<section class="page-hero" style="background-image: url('<?= base_url() ?>assets/img/bg-img/breadcumb.jpg');">
    <div class="container">
        <span class="section-eyebrow">A VitrineWeb</span>
        <h1>Nossa história</h1>
        <p>Conheça a jornada de quem transforma moda em experiência.</p>
    </div>
</section>

<!-- ##### Nossa história ##### -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-12 col-lg-6">
                <div class="about-photo">
                    <img src="<?= base_url() ?>assets/img/bg-img/blog2.jpg" alt="Moda vibrante VitrineWeb">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <span class="section-eyebrow">Desde o começo</span>
                <h2 class="mb-3">Moda acessível, com identidade</h2>
                <p class="text-muted">
                    A VitrineWeb nasceu da vontade de aproximar moda de qualidade das pessoas, sem
                    complicação e sem preços exagerados. Selecionamos peças femininas, masculinas e
                    infantis pensando em quem quer se vestir bem no dia a dia — do casual ao especial.
                </p>
                <p class="text-muted">
                    Hoje seguimos crescendo com o mesmo propósito: oferecer uma vitrine online bonita,
                    fácil de navegar e cheia de opções para todos os estilos.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ##### Nossos valores ##### -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-heading text-center">
            <span class="section-eyebrow">O que nos move</span>
            <h2>Nossos valores</h2>
        </div>

        <div class="row g-4">
            <div class="col-12 col-md-4">
                <div class="value-card text-center">
                    <i class="fa fa-heart-o"></i>
                    <h5>Feito com cuidado</h5>
                    <p class="text-muted mb-0">Cada coleção é escolhida a dedo, pensando em conforto e qualidade.</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="value-card text-center">
                    <i class="fa fa-tags"></i>
                    <h5>Preço justo</h5>
                    <p class="text-muted mb-0">Moda de qualidade não precisa custar caro para chegar até você.</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="value-card text-center">
                    <i class="fa fa-users"></i>
                    <h5>Para toda a família</h5>
                    <p class="text-muted mb-0">Coleções femininas, masculinas e infantis em um só lugar.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
