<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<section class="page-hero" style="background-image: url('<?= base_url() ?>assets/img/bg-img/breadcumb.jpg');">
    <div class="container">
        <span class="section-eyebrow">Suas compras</span>
        <h1>Carrinho</h1>
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

        <?php if (empty($itens)): ?>

            <div class="text-center py-5">
                <p class="fs-5 text-muted mb-4">Seu carrinho está vazio.</p>
                <a href="<?= base_url() ?>#produtos" class="btn btn-brand">Ver produtos</a>
            </div>

        <?php else: ?>

            <?php
                // Um formulário só: "Atualizar" envia as quantidades; os botões de remover e esvaziar
                // usam o atributo formaction para mandar o MESMO formulário para outra rota.
            ?>
            <?= form_open("Carrinho/atualizar") ?>

                <?php // Botão "padrão" invisível: o Enter num campo de quantidade atualiza, em vez de remover o 1º item ?>
                <button type="submit" style="position:absolute; left:-9999px;" tabindex="-1" aria-hidden="true"></button>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th class="text-end">Preço (R$)</th>
                                <th style="width: 120px;">Quantidade</th>
                                <th class="text-end">Subtotal (R$)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($itens as $produtoId => $item): ?>
                                <tr>
                                    <td>
                                        <a href="<?= base_url("produto/" . $produtoId) ?>" class="text-reset text-decoration-none">
                                            <img src="<?= imagemProduto($item['imagem']) ?>" alt="" width="64" height="64" class="rounded me-2 object-fit-cover">
                                            <?= esc($item['nome']) ?>
                                        </a>
                                    </td>
                                    <td class="text-end"><?= formatValor($item['preco']) ?></td>
                                    <td>
                                        <input type="number" class="form-control" min="0"
                                               name="quantidade[<?= $produtoId ?>]" value="<?= $item['quantidade'] ?>"
                                               aria-label="Quantidade de <?= esc($item['nome']) ?>">
                                    </td>
                                    <td class="text-end"><?= formatValor($item['preco'] * $item['quantidade']) ?></td>
                                    <td class="text-end">
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                formaction="<?= base_url("Carrinho/remover") ?>"
                                                name="produto_id" value="<?= $produtoId ?>" title="Remover">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th class="text-end fs-5">R$ <?= formatValor($total) ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex flex-column flex-md-row gap-2 justify-content-between">
                    <div class="d-flex gap-2">
                        <a href="<?= base_url() ?>#produtos" class="btn btn-outline-secondary">
                            <i class="fa fa-arrow-left me-1"></i> Continuar comprando
                        </a>
                        <button type="submit" class="btn btn-outline-secondary"
                                formaction="<?= base_url("Carrinho/limpar") ?>">Esvaziar</button>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-outline-brand">
                            <i class="fa fa-refresh me-1"></i> Atualizar quantidades
                        </button>
                        <a href="<?= base_url("Carrinho/checkout") ?>" class="btn btn-brand">
                            Finalizar compra <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

            <?= form_close() ?>

        <?php endif; ?>

    </div>
</section>

<?= $this->endSection() ?>
