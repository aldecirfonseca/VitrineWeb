<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<section class="py-5">
    <div class="container">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div>
                <h1 class="h3 mb-1">Pedido #<?= $pedido['id'] ?></h1>
                <span class="text-muted">Feito em <?= date("d/m/Y \à\s H:i", strtotime($pedido['created_at'])) ?></span>
            </div>
            <span class="status-badge <?= getClasseStatusPedido($pedido['statusPedido']) ?> fs-6">
                <?= getStatusPedido($pedido['statusPedido']) ?>
            </span>
        </div>

        <?= view("partials/itensPedido", ["itens" => $itens, "total" => $pedido['total']]) ?>

        <a href="<?= base_url("MeusPedidos") ?>" class="btn btn-outline-secondary mt-3">
            <i class="fa fa-arrow-left me-1"></i> Voltar
        </a>

    </div>
</section>

<?= $this->endSection() ?>
