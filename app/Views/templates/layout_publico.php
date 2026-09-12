<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="VitrineWeb - moda com atitude, coleções para toda a família.">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Title  -->
        <title>VitrineWeb - Moda Ecommerce</title>

        <!-- Favicon  -->
        <link rel="icon" type="image/svg+xml" href="<?= base_url() ?>assets/img/core-img/favicon.svg">
        <link rel="alternate icon" href="<?= base_url() ?>assets/img/core-img/favicon.ico">

        <!-- Bootstrap 5 -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">
        <!-- Theme -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/theme.css">

    </head>

    <body>

        <!-- ##### Navbar ##### -->
        <header>
            <nav class="navbar navbar-expand-lg sticky-top site-navbar">
                <div class="container">

                    <a class="navbar-brand" href="<?= base_url() ?>">VitrineWeb</a>

                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#siteMenu" aria-controls="siteMenu" aria-label="Abrir menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="siteMenu" aria-labelledby="siteMenuLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="siteMenuLabel">Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav flex-grow-1 align-items-lg-center">

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">Coleções</a>
                                    <div class="dropdown-menu mega-menu">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <p class="mega-menu-title">Coleção Feminina</p>
                                                <ul>
                                                    <li><a href="#">Vestidos</a></li>
                                                    <li><a href="#">Blusas &amp; Camisas</a></li>
                                                    <li><a href="#">Camisetas</a></li>
                                                    <li><a href="#">Macacão</a></li>
                                                    <li><a href="#">Sutiã &amp; Calcinha</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p class="mega-menu-title">Coleção Masculina</p>
                                                <ul>
                                                    <li><a href="#">Camisetas</a></li>
                                                    <li><a href="#">Pólo</a></li>
                                                    <li><a href="#">Camisas</a></li>
                                                    <li><a href="#">Jaquetas</a></li>
                                                    <li><a href="#">Shorts</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p class="mega-menu-title">Coleção Infantil</p>
                                                <ul>
                                                    <li><a href="#">Vestidos</a></li>
                                                    <li><a href="#">Camisas</a></li>
                                                    <li><a href="#">Camisetas</a></li>
                                                    <li><a href="#">Jaquetas</a></li>
                                                    <li><a href="#">Shorts</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item"><a class="nav-link" href="<?= base_url("sobrenos") ?>">Quem somos</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url("faleconosco") ?>">Contato</a></li>

                                <li class="nav-item d-lg-none mt-2">
                                    <a class="nav-link" href="#">Entre ou Cadastre-se</a>
                                </li>
                            </ul>

                            <div class="d-none d-lg-flex align-items-center ms-3">
                                <a href="#" class="icon-link" title="Pesquisar"><i class="fa fa-search"></i></a>
                                <a href="#" class="icon-link" title="Minha conta"><i class="fa fa-user-o"></i></a>
                                <a href="#" class="icon-link" title="Carrinho">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span class="badge rounded-pill bg-dark">3</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </nav>
        </header>
        <!-- ##### /Navbar ##### -->

        <?= $this->renderSection("main") ?>

        <!-- ##### Marcas parceiras ##### -->
        <section class="brands-strip">
            <div class="container">
                <div class="row align-items-center justify-content-between g-4 text-center">
                    <div class="col-6 col-md-2"><img src="<?= base_url() ?>assets/img/core-img/brand1.png" alt="Marca parceira"></div>
                    <div class="col-6 col-md-2"><img src="<?= base_url() ?>assets/img/core-img/brand2.png" alt="Marca parceira"></div>
                    <div class="col-6 col-md-2"><img src="<?= base_url() ?>assets/img/core-img/brand3.png" alt="Marca parceira"></div>
                    <div class="col-6 col-md-2"><img src="<?= base_url() ?>assets/img/core-img/brand4.png" alt="Marca parceira"></div>
                    <div class="col-6 col-md-2"><img src="<?= base_url() ?>assets/img/core-img/brand5.png" alt="Marca parceira"></div>
                    <div class="col-6 col-md-2"><img src="<?= base_url() ?>assets/img/core-img/brand6.png" alt="Marca parceira"></div>
                </div>
            </div>
        </section>

        <!-- ##### Rodapé ##### -->
        <footer class="site-footer">
            <div class="container">
                <div class="row g-4">
                    <div class="col-12 col-md-4">
                        <a href="<?= base_url() ?>" class="footer-brand d-inline-block mb-3">VitrineWeb</a>
                        <p>Moda com atitude para todas as idades — coleções femininas, masculinas e infantis em um só lugar.</p>
                        <div class="mt-3">
                            <a href="#" class="social-link" title="Facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="social-link" title="Instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="social-link" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="social-link" title="Youtube"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <h6>Institucional</h6>
                        <ul>
                            <li><a href="<?= base_url() ?>">Loja</a></li>
                            <li><a href="<?= base_url("sobrenos") ?>">Quem somos</a></li>
                            <li><a href="<?= base_url("faleconosco") ?>">Fale conosco</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-md-4">
                        <h6>Ajuda</h6>
                        <ul>
                            <li><a href="#">Status do Pedido</a></li>
                            <li><a href="#">Opções de Pagamento</a></li>
                            <li><a href="#">Envio e Entrega</a></li>
                            <li><a href="#">Políticas de Privacidade</a></li>
                            <li><a href="#">Termos de Uso</a></li>
                        </ul>
                    </div>
                </div>

                <hr>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 footer-bottom">
                    <p class="mb-0">
                        &copy; <?= date("Y") ?> VitrineWeb. Todos os direitos reservados.
                    </p>
                    <p class="mb-0">Desenvolvido por Aldecir Fonseca</p>
                </div>
            </div>
        </footer>

        <a href="#" class="back-to-top" title="Voltar ao topo"><i class="fa fa-arrow-up"></i></a>

        <!-- Bootstrap 5 (inclui Popper) -->
        <script src="<?= base_url() ?>assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
        <!-- Theme -->
        <script src="<?= base_url() ?>assets/js/theme.js"></script>

    </body>

</html>
