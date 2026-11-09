<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * Template de paginação no estilo do Bootstrap 5.
 * Registrado em app/Config/Pager.php com o apelido "bootstrap".
 *
 * Uso na view:  <?= $pager->links('default', 'bootstrap') ?>
 *
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<?php if ($pager->getPageCount() > 1) : ?>
<nav aria-label="Paginação">
    <ul class="pagination justify-content-center">

        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="Primeira">&laquo;</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Anterior">&lsaquo;</a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="Próxima">&rsaquo;</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Última">&raquo;</a>
            </li>
        <?php endif ?>

    </ul>
</nav>
<?php endif ?>
