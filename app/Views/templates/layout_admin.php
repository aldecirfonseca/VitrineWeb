<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Title  -->
        <title>VitrineWeb - Painel Administrativo</title>

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

    <body class="admin-body">

        <!-- ##### Navbar ##### -->
        <nav class="navbar navbar-expand-lg admin-navbar" data-bs-theme="dark">
            <div class="container">

                <a class="navbar-brand" href="#">VitrineWeb <span class="fw-normal opacity-75">Admin</span></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminMenu" aria-controls="adminMenu" aria-label="Abrir menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="adminMenu">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="#">Início</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastros</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url("Categoria") ?>">Categoria</a></li>
                                <li><a class="dropdown-item" href="#">Produto</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user-circle me-1"></i> Aldecir Fonseca
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Trocar a senha</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
        <!-- ##### /Navbar ##### -->

        <main class="py-4">
            <?= $this->renderSection("main") ?>
        </main>

        <footer class="text-center text-muted small py-4">
            &copy; <?= date("Y") ?> VitrineWeb — Painel Administrativo
        </footer>

        <!-- Bootstrap 5 (inclui Popper) -->
        <script src="<?= base_url() ?>assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
        <!-- Theme -->
        <script src="<?= base_url() ?>assets/js/theme.js"></script>

    </body>

</html>
