<?= $this->extend('templates/layout_admin') ?>

<?= $this->section("main") ?>

<?php $cancelado = (int) $pedido['statusPedido'] === 9; ?>

<div class="container">

    <?= mensagem() ?>

    <div class="admin-panel">

        <div class="admin-panel-header">
            <h3>Pedido #<?= $pedido['id'] ?></h3>
            <?= btnCrud('voltarp') ?>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <div class="text-muted small">Cliente</div>
                <div class="fw-semibold"><?= esc($pedido['cliente']) ?></div>
                <div class="small"><?= esc($pedido['email']) ?></div>
            </div>
            <div class="col-6 col-md-4">
                <div class="text-muted small">Data</div>
                <div class="fw-semibold"><?= date("d/m/Y H:i", strtotime($pedido['created_at'])) ?></div>
            </div>
            <div class="col-6 col-md-4">
                <div class="text-muted small">Status atual</div>
                <span class="status-badge <?= getClasseStatusPedido($pedido['statusPedido']) ?>">
                    <?= getStatusPedido($pedido['statusPedido']) ?>
                </span>
            </div>
        </div>

        <?= view("partials/itensPedido", ["itens" => $itens, "total" => $pedido['total']]) ?>

        <div class="mt-4 pt-3 border-top">

            <?php if ($cancelado): ?>
                <p class="text-muted mb-0">Pedido cancelado: os itens já voltaram para o estoque e o status não muda mais.</p>
            <?php else: ?>
                <?= form_open("Pedido/status", ["class" => "row g-2 align-items-end"]) ?>

                    <input type="hidden" name="id" value="<?= $pedido['id'] ?>">

                    <div class="col-12 col-md-4">
                        <label for="statusPedido" class="form-label">Mudar status para</label>
                        <select name="statusPedido" id="statusPedido" class="form-select">
                            <?php foreach ([1, 2, 3, 4, 9] as $status): ?>
                                <option value="<?= $status ?>" <?= $status == $pedido['statusPedido'] ? 'selected' : '' ?>>
                                    <?= getStatusPedido($status) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12 col-md-auto">
                        <button type="submit" class="btn btn-brand"><i class="fa fa-check me-1"></i> Gravar status</button>
                    </div>

                    <div class="col-12">
                        <div class="form-text">Ao cancelar, as quantidades voltam para o estoque (na mesma transação).</div>
                    </div>

                <?= form_close() ?>
            <?php endif; ?>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
