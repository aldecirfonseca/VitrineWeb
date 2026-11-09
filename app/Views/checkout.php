<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<section class="page-hero" style="background-image: url('<?= base_url() ?>assets/img/bg-img/breadcumb.jpg');">
    <div class="container">
        <span class="section-eyebrow">Quase lá</span>
        <h1>Revise seu pedido</h1>
    </div>
</section>

<section class="py-5">
    <div class="container">

        <?= mensagem() ?>

        <?php if (! empty($avisos)): ?>
            <div class="alert alert-warning">
                <?php foreach ($avisos as $aviso): ?>
                    <div><?= esc($aviso) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="row g-4">

            <div class="col-12 col-lg-8">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th class="text-end">Preço (R$)</th>
                                <th class="text-end">Qtd.</th>
                                <th class="text-end">Subtotal (R$)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($itens as $item): ?>
                                <tr>
                                    <td>
                                        <img src="<?= imagemProduto($item['imagem']) ?>" alt="" width="48" height="48" class="rounded me-2 object-fit-cover">
                                        <?= esc($item['nome']) ?>
                                    </td>
                                    <td class="text-end"><?= formatValor($item['preco']) ?></td>
                                    <td class="text-end"><?= $item['quantidade'] ?></td>
                                    <td class="text-end"><?= formatValor($item['preco'] * $item['quantidade']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a href="<?= base_url("Carrinho") ?>" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> Voltar ao carrinho
                </a>
            </div>

            <div class="col-12 col-lg-4">
                <div class="form-card">
                    <h5 class="mb-3">Resumo</h5>
                    <p class="mb-1 text-muted">Cliente</p>
                    <p class="fw-semibold mb-3"><?= esc(session()->get('userNome')) ?><br>
                        <small class="text-muted fw-normal"><?= esc(session()->get('userEmail')) ?></small>
                    </p>
                    <div class="d-flex justify-content-between fs-5 mb-4">
                        <span>Total</span>
                        <strong>R$ <?= formatValor($total) ?></strong>
                    </div>

                    <?= form_open("Carrinho/finalizar") ?>
                        <button type="submit" class="btn btn-brand btn-lg w-100">
                            <i class="fa fa-check me-1"></i> Confirmar pedido
                        </button>
                    <?= form_close() ?>

                    <p class="small text-muted mt-3 mb-0">O estoque é conferido de novo na hora de confirmar.</p>
                </div>
            </div>

        </div>

    </div>
</section>

<?= $this->endSection() ?>
