<?= $this->extend('templates/layout_admin') ?>

<?= $this->section("main") ?>

<div class="container">

    <?= mensagem() ?>

    <div class="admin-panel">

        <div class="admin-panel-header">
            <h3>Categoria de Produtos</h3>
            <?= btnCrud('insert') ?>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-md-4">
                <input type="search" class="form-control" placeholder="Buscar categoria..." data-table-filter="#tbListaCategoria">
            </div>
        </div>

        <div class="table-responsive">
            <table id="tbListaCategoria" class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th class="text-end">Opções</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($this->data as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['descricao'] ?></td>
                            <td>
                                <?php
                                    $statusClasse = $row['statusRegistro'] == 1 ? 'status-ativo' : ($row['statusRegistro'] == 2 ? 'status-inativo' : 'status-indefinido');
                                ?>
                                <span class="status-badge <?= $statusClasse ?>"><?= getStatusRegistro($row['statusRegistro']) ?></span>
                            </td>
                            <td class="text-end">
                                <?= btnCrud('view', $row['id']) ?>
                                <?= btnCrud('update', $row['id']) ?>
                                <?= btnCrud('delete', $row['id']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>
