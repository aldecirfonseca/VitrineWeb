<?= $this->extend('templates/layout_admin') ?>

<?= $this->section("main") ?> 

<div class="container">

    <div class="row">

        <div class="col-10">
            <h3>Categoria de Produtos</h3>
        </div>
        <div class="col-2 text-right">
            <?= btnCrud('insert') ?>
        </div>

    </div>

    <?= mensagem() ?>

    <div class="row mt-3">

        <div class="col-12">
            
            <table id="tbListaCategoria" class="table table-bordered table-condensed table-hover table-sm">

                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Opções</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($this->data as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['descricao'] ?></td>
                            <td><?= getStatusRegistro($row['statusRegistro']) ?></td>
                            <td>
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

<?= getDataTables("tbListaCategoria") ?>

<?= $this->endSection() ?>