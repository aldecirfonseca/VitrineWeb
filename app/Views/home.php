<?= $this->extend('templates/layout_publico') ?>

<?= $this->section("main") ?>

<!-- ##### Hero ##### -->
<section class="hero" style="background-image: url('<?= base_url() ?>assets/img/bg-img/bg-1.jpg');">
    <div class="container">
        <div class="hero-content">
            <span class="section-eyebrow">Nova coleção</span>
            <h1>Moda com atitude para cada estação</h1>
            <p>Peças selecionadas para toda a família, com qualidade e preço que cabem no seu estilo de vida.</p>
            <a href="#produtos" class="btn btn-brand btn-lg">Ver coleção</a>
        </div>
    </div>
</section>

<!-- ##### Vitrine (produtos do banco) ##### -->
<section id="produtos" class="py-5 bg-light">
    <div class="container">

        <div class="section-heading text-center">
            <span class="section-eyebrow">Catálogo completo</span>
            <h2>Nossos produtos</h2>
        </div>

        <?= mensagem() ?>

        <!-- Filtros: formulário GET (não precisa de CSRF, só lê dados) -->
        <form method="get" action="<?= base_url() ?>#produtos" class="row g-2 justify-content-center mb-4">
            <div class="col-12 col-md-5">
                <input type="search" name="busca" class="form-control" placeholder="Buscar pelo nome..."
                       value="<?= esc($busca ?? '') ?>" aria-label="Buscar produto">
            </div>
            <div class="col-8 col-md-3">
                <select name="categoria" class="form-select" aria-label="Categoria">
                    <option value="">Todas as categorias</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id'] ?>" <?= $categoriaId == $categoria['id'] ? 'selected' : '' ?>>
                            <?= esc($categoria['descricao']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-4 col-md-auto">
                <button type="submit" class="btn btn-brand w-100"><i class="fa fa-search me-1"></i> Filtrar</button>
            </div>
            <?php if ($busca || $categoriaId): ?>
                <div class="col-12 text-center">
                    <a href="<?= base_url() ?>#produtos" class="small">Limpar filtros</a>
                </div>
            <?php endif; ?>
        </form>

        <?php if (empty($produtos)): ?>
            <p class="text-center text-muted py-5">Nenhum produto encontrado.</p>
        <?php endif; ?>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">

            <?php foreach ($produtos as $produto): ?>
                <div class="col">
                    <div class="product-card">
                        <div class="product-thumb">
                            <?php if ($produto['estoque'] == 0): ?>
                                <span class="product-badge">Esgotado</span>
                            <?php endif; ?>
                            <a href="<?= base_url("produto/" . $produto['id']) ?>">
                                <img src="<?= imagemProduto($produto['imagem']) ?>" alt="<?= esc($produto['nome']) ?>">
                            </a>
                            <?php if ($produto['estoque'] > 0): ?>
                                <div class="add-to-cart">
                                    <?= form_open("Carrinho/adicionar") ?>
                                        <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
                                        <input type="hidden" name="quantidade" value="1">
                                        <button type="submit" class="btn btn-brand btn-sm w-100">Adicionar ao carrinho</button>
                                    <?= form_close() ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="product-body">
                            <span class="product-category"><?= esc($produto['categoria']) ?></span>
                            <a href="<?= base_url("produto/" . $produto['id']) ?>" class="product-title"><?= esc($produto['nome']) ?></a>
                            <div class="product-price">
                                <span class="price-current">R$ <?= formatValor($produto['preco']) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="mt-5">
            <?php // only(): os links de página mantêm a busca e a categoria na URL ?>
            <?= $pager->only(['busca', 'categoria'])->links('default', 'bootstrap') ?>
        </div>

    </div>
</section>

<?= $this->endSection() ?>
