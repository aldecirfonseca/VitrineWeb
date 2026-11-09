<?= $this->extend('templates/layout_admin') ?>

<?= $this->section("main") ?>

<div class="container">

    <?= mensagem() ?>

    <div class="admin-panel">

        <div class="admin-panel-header">
            <h3>Produtos</h3>
            <?= btnCrud('insert') ?>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-md-4">
                <input type="search" class="form-control" placeholder="Buscar produto..." data-table-filter="#tbListaProduto">
            </div>
        </div>

        <div class="table-responsive">
            <table id="tbListaProduto" class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th class="text-end">Preço (R$)</th>
                        <th class="text-end">Estoque</th>
                        <th>Status</th>
                        <th class="text-end">Opções</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (empty($lista)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Nenhum produto cadastrado.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($lista as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td>
                                <img src="<?= imagemProduto($row['imagem']) ?>" alt="<?= esc($row['nome']) ?>"
                                     width="56" height="56" class="rounded object-fit-cover">
                            </td>
                            <td><?= esc($row['nome']) ?></td>
                            <td><?= esc($row['categoria'] ?? '—') ?></td>
                            <td class="text-end"><?= formatValor($row['preco']) ?></td>
                            <td class="text-end <?= $row['estoque'] == 0 ? 'text-danger fw-semibold' : '' ?>"><?= $row['estoque'] ?></td>
                            <td>
                                <span class="status-badge <?= $row['statusRegistro'] == 1 ? 'status-ativo' : 'status-inativo' ?>">
                                    <?= getStatusRegistro($row['statusRegistro']) ?>
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
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
