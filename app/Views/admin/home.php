<?= $this->extend('templates/layout_admin') ?>

<?= $this->section("main") ?>

<div class="container">

    <?= mensagem() ?>

    <div class="admin-panel">

        <div class="admin-panel-header">
            <h3>Início</h3>
        </div>

        <p class="mb-0">
            Bem-vindo(a), <strong><?= esc(session()->get('userNome')) ?></strong>! Use o menu acima para acessar os cadastros do sistema.
        </p>

    </div>

</div>

<?= $this->endSection() ?>
