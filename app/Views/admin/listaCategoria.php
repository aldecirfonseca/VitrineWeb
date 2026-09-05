<?= $this->extend("Layouts/default") ?>

<?= $this->section("content") ?>

    <h2>Lista Categoria</h2>
    <p>
        <?php
            var_dump($this->data);
        ?>
    </p>

<?=  $this->endSection() ?>