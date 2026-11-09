<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<section class="page-hero" style="background-image: url('<?= base_url() ?>assets/img/bg-img/breadcumb.jpg');">
    <div class="container">
        <span class="section-eyebrow">Minha conta</span>
        <h1>Meus pedidos</h1>
    </div>
</section>

<section class="py-5">
    <div class="container">

        <?= mensagem() ?>

        <?php if (empty($lista)): ?>
            <div class="text-center py-5">
                <p class="fs-5 text-muted mb-4">Você ainda não fez nenhum pedido.</p>
                <a href="<?= base_url() ?>#produtos" class="btn btn-brand">Ver produtos</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Data</th>
                            <th class="text-end">Total (R$)</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista as $pedido): ?>
                            <tr>
                                <td>#<?= $pedido['id'] ?></td>
                                <td><?= date("d/m/Y H:i", strtotime($pedido['created_at'])) ?></td>
                                <td class="text-end"><?= formatValor($pedido['total']) ?></td>
                                <td>
                                    <span class="status-badge <?= getClasseStatusPedido($pedido['statusPedido']) ?>">
                                        <?= getStatusPedido($pedido['statusPedido']) ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="<?= base_url("MeusPedidos/" . $pedido['id']) ?>" class="btn btn-outline-brand btn-sm">Detalhes</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>
</section>

<?= $this->endSection() ?>
