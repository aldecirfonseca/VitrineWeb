<?= $this->extend('templates/layout_admin') ?>

<?= $this->section("main") ?>

<div class="container">

    <?= mensagem() ?>

    <div class="admin-panel">

        <div class="admin-panel-header">
            <h3>Usuários</h3>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-md-4">
                <input type="search" class="form-control" placeholder="Buscar usuário..." data-table-filter="#tbListaUsuario">
            </div>
        </div>

        <div class="table-responsive">
            <table id="tbListaUsuario" class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Nível</th>
                        <th>Status</th>
                        <th class="text-end">Opções</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($lista as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td>
                                <?= esc($row['nome']) ?>
                                <?php if ((int) $row['id'] === (int) session()->get('userId')): ?>
                                    <small class="text-muted">(você)</small>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($row['email']) ?></td>
                            <td><?= getNivel($row['nivel']) ?></td>
                            <td>
                                <span class="status-badge <?= $row['statusRegistro'] == 1 ? 'status-ativo' : 'status-inativo' ?>">
                                    <?= getStatusRegistro($row['statusRegistro']) ?>
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <?= btnCrud('view', $row['id']) ?>
                                <?= btnCrud('update', $row['id']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>
