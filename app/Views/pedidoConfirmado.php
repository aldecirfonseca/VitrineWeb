<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<section class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <i class="fa fa-check-circle text-success" style="font-size: 4rem;"></i>
            <h1 class="h2 mt-3">Pedido #<?= $pedido['id'] ?> recebido!</h1>
            <p class="text-muted">Obrigado pela compra. Você acompanha o andamento em "Meus pedidos".</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <?= view("partials/itensPedido", ["itens" => $itens, "total" => $pedido['total']]) ?>

                <div class="d-flex flex-column flex-md-row gap-2 justify-content-center mt-4">
                    <a href="<?= base_url("MeusPedidos") ?>" class="btn btn-outline-brand">Meus pedidos</a>
                    <a href="<?= base_url() ?>" class="btn btn-brand">Continuar comprando</a>
                </div>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>
