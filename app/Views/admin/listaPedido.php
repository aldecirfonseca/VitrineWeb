<?= $this->extend('templates/layout_admin') ?>

<?= $this->section("main") ?>

<div class="container">

    <?= mensagem() ?>

    <div class="admin-panel">

        <div class="admin-panel-header">
            <h3>Pedidos</h3>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-md-4">
                <input type="search" class="form-control" placeholder="Buscar pedido ou cliente..." data-table-filter="#tbListaPedido">
            </div>
        </div>

        <div class="table-responsive">
            <table id="tbListaPedido" class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th class="text-end">Total (R$)</th>
                        <th>Status</th>
                        <th class="text-end">Opções</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (empty($lista)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Nenhum pedido até agora.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($lista as $row): ?>
                        <tr>
                            <td>#<?= $row['id'] ?></td>
                            <td><?= date("d/m/Y H:i", strtotime($row['created_at'])) ?></td>
                            <td>
                                <?= esc($row['cliente']) ?><br>
                                <small class="text-muted"><?= esc($row['email']) ?></small>
                            </td>
                            <td class="text-end"><?= formatValor($row['total']) ?></td>
                            <td>
                                <span class="status-badge <?= getClasseStatusPedido($row['statusPedido']) ?>">
                                    <?= getStatusPedido($row['statusPedido']) ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <?= btnCrud('view', $row['id']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>
