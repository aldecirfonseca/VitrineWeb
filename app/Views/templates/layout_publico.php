<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Title  -->
        <title>VitrineWeb - Moda Ecommerce</title>

        <!-- Favicon  -->
        <link rel="icon" href="<?= base_url() ?>assets/img/core-img/favicon.ico">

        <!-- Core Style CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/core-style.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/style.css">

    </head>

    <body>

        <!-- ##### Inicio Cabeçalho ##### -->
        <header class="header_area">
            <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
                <!-- Classy Menu -->
                <nav class="classy-navbar" id="essenceNav">
                    <!-- Logo -->
                    <a class="nav-brand" href="<?= base_url() ?>">VitrineWeb</a>
                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="#">Shop</a>
                                    <div class="megamenu">
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Coleção Feminina</li>
                                            <li><a href="index.php?view=home&categoria_id=1">Vestidos</a></li>
                                            <li><a href="index.php?view=home&categoria_id=2">Blusas &amp; Camisas</a></li>
                                            <li><a href="index.php?view=home&categoria_id=3">Camisetas</a></li>
                                            <li><a href="index.php?view=home&categoria_id=4">Macação</a></li>
                                            <li><a href="index.php?view=home&categoria_id=5">Sutiã &amp; Calcinha</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Coleção Masculina</li>
                                            <li><a href="index.php?view=home&categoria_id=6">Camisetas</a></li>
                                            <li><a href="index.php?view=home&categoria_id=7">Pólo</a></li>
                                            <li><a href="index.php?view=home&categoria_id=8">Camisas</a></li>
                                            <li><a href="index.php?view=home&categoria_id=9">Jaquetas</a></li>
                                            <li><a href="index.php?view=home&categoria_id=10">Shorts</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Coleção Infantil</li>
                                            <li><a href="index.php?view=home&categoria_id=11">Vestidos</a></li>
                                            <li><a href="index.php?view=home&categoria_id=12">Camisas</a></li>
                                            <li><a href="index.php?view=home&categoria_id=13">Camisetas</a></li>
                                            <li><a href="index.php?view=home&categoria_id=14">Jaquetas</a></li>
                                            <li><a href="index.php?view=home&categoria_id=15">Shorts</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li><a href="<?= base_url() ?>quemsomos">Quem somos</a></li>
                                <li><a href="<?= base_url() ?>contato">Contato</a></li>
                                <li><a href="<?= base_url() ?>login">Entre ou Cadastre-se</a></li>
                            </ul>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>

                <!-- Header Meta Data -->
                <div class="header-meta d-flex clearfix justify-content-end">
                    <!-- Search Area -->
                    <div class="search-area">
                        <form action="#" method="post">
                            <input type="search" name="search" id="headerSearch" placeholder="Digite para pesquisar">
                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                    <!-- Cart Area -->
                    <div class="cart-area">
                        <a href="<?= base_url() ?>carrinho-compras" id="essenceCartBtn"><img src="<?= base_url() ?>assets/img/core-img/bag.svg" alt=""> <span>3</span></a>
                    </div>
                </div>

            </div>
        </header>
        <!-- ##### fim do cabeçalho ##### -->

        <?= $this->renderSection("main") ?>

        <section class="new_arrivals_area clearfix">
            <div class="brands-area">
                <div class="row">
                    <h2 class="col-12">Alguns de nossos marcas parceiras</h2>
                </div>

                <div class="col-12 brands-area d-flex align-items-center justify-content-between">
                    <!-- Brand Logo -->
                    <div class="single-brands-logo">
                        <img src="<?= base_url() ?>assets/img/core-img/brand1.png" alt="">
                    </div>
                    <!-- Brand Logo -->
                    <div class="single-brands-logo">
                        <img src="<?= base_url() ?>assets/img/core-img/brand2.png" alt="">
                    </div>
                    <!-- Brand Logo -->
                    <div class="single-brands-logo">
                        <img src="<?= base_url() ?>assets/img/core-img/brand3.png" alt="">
                    </div>
                    <!-- Brand Logo -->
                    <div class="single-brands-logo">
                        <img src="<?= base_url() ?>assets/img/core-img/brand4.png" alt="">
                    </div>
                    <!-- Brand Logo -->
                    <div class="single-brands-logo">
                        <img src="<?= base_url() ?>assets/img/core-img/brand5.png" alt="">
                    </div>
                    <!-- Brand Logo -->
                    <div class="single-brands-logo">
                        <img src="<?= base_url() ?>assets/img/core-img/brand6.png" alt="">
                    </div>
                </div>

            </div>
        </section>

        <!-- ##### Inicio do Rodapé ##### -->
        <footer class="footer_area clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="single_widget_area d-flex mb-30">
                            <div class="footer-logo mr-50">
                                <a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/img/core-img/logo2.png" alt=""></a>
                            </div>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="<?= base_url() ?>">Shop</a></li>
                                    <li><a href="<?= base_url() ?>Home/quemsomos">Quem somos</a></li>
                                    <li><a href="<?= base_url() ?>Home/contato">Contato</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="single_widget_area mb-30">
                            <ul class="footer_widget_menu">
                                <li><a href="#">Status Pedido</a></li>
                                <li><a href="#">Opções de Pagamento</a></li>
                                <li><a href="#">Envio e Entrega</a></li>
                                <li><a href="#">Guias</a></li>
                                <li><a href="#">Políticas de Privacidade</a></li>
                                <li><a href="#">Termos de Uso</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row align-items-end text-center">
                    <div class="col-12">
                        <div class="single_widget_area">
                            <div class="footer_social_area">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <p>
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> Todos os direitos reservados | Desenvolvido por Aldecir Fonseca
                        </p>
                    </div>
                </div>

            </div>
        </footer>

        <!-- ##### Fim do Rodapé ##### -->

        <!-- jQuery (Necessary for All JavaScript Plugins) -->
        <script src="<?= base_url() ?>assets/js/jquery/jquery-2.2.4.min.js"></script>
        <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
        <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/js/plugins.js"></script>
        <script src="<?= base_url() ?>assets/js/classy-nav.min.js"></script>
        <script src="<?= base_url() ?>assets/js/active.js"></script>

    </body>

</html>