<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Title  -->
        <title>Essence - Moda Ecommerce</title>

        <!-- Favicon  -->
        <link rel="icon" href="<?= base_url() ?>assets/img/core-img/favicon.ico">

        <!-- Core Style CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/core-style.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/style.css">

        <script src="<?= base_url("assets/js/jquery/jquery-3.2.1.min.js") ?>"></script>
        <script src="<?= base_url("assets/js/jqueryMask.js") ?>" type="text/Javascript"></script>

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
                                <li><a href="<?= base_url() ?>Sistema/home">Home</a></li>

                                <li><a href="#">Cadastros</a>
                                    <ul class="dropdown">
                                        <li><a href="<?= base_url() ?>Categoria/lista">Categoria</a></li>
                                        <li><a href="<?= base_url() ?>Produto/lista">Produto</a></li>
                                    </ul>
                                </li>

                                <li><a href="#">Aldecir Fonseca</a>
                                    <ul class="dropdown">
                                        <li><a href="<?= base_url() ?>Login/signOut">Sair</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a href="#">Trocar a Senha</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>

            </div>
        </header>
        <!-- ##### fim do cabeçalho ##### -->

        <?= $this->renderSection("main") ?>

        <!-- ##### Inicio do Rodapé ##### -->
        <footer class="footer_area clearfix mt-5">
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

    </body>

    <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugins.js"></script>
    <script src="<?= base_url() ?>assets/js/classy-nav.min.js"></script>
    <script src="<?= base_url() ?>assets/js/active.js"></script>

</html>