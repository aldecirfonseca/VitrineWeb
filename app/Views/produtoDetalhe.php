<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<section class="py-5">
    <div class="container">

        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Loja</a></li>
                <li class="breadcrumb-item">
                    <a href="<?= base_url("?categoria=" . $produto['categoria_id']) ?>#produtos"><?= esc($produto['categoria']) ?></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($produto['nome']) ?></li>
            </ol>
        </nav>

        <?= mensagem() ?>

        <div class="row g-4 g-lg-5">

            <div class="col-12 col-md-6">
                <img src="<?= imagemProduto($produto['imagem'], false) ?>" alt="<?= esc($produto['nome']) ?>" class="img-fluid rounded w-100">
            </div>

            <div class="col-12 col-md-6">
                <span class="section-eyebrow"><?= esc($produto['categoria']) ?></span>
                <h1 class="h2 mb-3"><?= esc($produto['nome']) ?></h1>

                <p class="fs-3 fw-semibold mb-1">R$ <?= formatValor($produto['preco']) ?></p>

                <?php if ($produto['estoque'] > 0): ?>
                    <p class="text-muted mb-4">
                        <?= $produto['estoque'] <= 3 ? "Últimas {$produto['estoque']} unidade(s)!" : "Em estoque" ?>
                    </p>

                    <?= form_open("Carrinho/adicionar", ["class" => "row g-2 align-items-end mb-4"]) ?>
                        <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">

                        <div class="col-4 col-lg-3">
                            <label for="quantidade" class="form-label">Quantidade</label>
                            <input type="number" class="form-control" name="quantidade" id="quantidade"
                                   value="1" min="1" max="<?= $produto['estoque'] ?>">
                        </div>

                        <div class="col-8 col-lg-6">
                            <button type="submit" class="btn btn-brand btn-lg w-100">
                                <i class="fa fa-shopping-bag me-1"></i> Adicionar ao carrinho
                            </button>
                        </div>
                    <?= form_close() ?>
                <?php else: ?>
                    <p class="text-danger fw-semibold mb-4">Produto esgotado.</p>
                <?php endif; ?>

                <?php // A descrição é HTML do CKEditor: sanitizarHtml() remove scripts e atributos perigosos ?>
                <div class="produto-descricao"><?= sanitizarHtml($produto['descricao']) ?></div>
            </div>

        </div>

    </div>
</section>

<?= $this->endSection() ?>
