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

<!-- ##### Promoções ##### -->
<section class="py-5">
    <div class="container">
        <div class="section-heading text-center">
            <span class="section-eyebrow">Ofertas da semana</span>
            <h2>Promoções</h2>
            <p class="mx-auto">Aproveite descontos especiais em peças selecionadas por tempo limitado.</p>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">

            <?php
                $promocoes = [
                    ["img" => "product-1.jpg", "categoria" => "Vestidos", "titulo" => "Vestido tecido azul", "de" => "150,00", "por" => "99,00", "id" => 1],
                    ["img" => "product-2.jpg", "categoria" => "Vestidos", "titulo" => "Vestido envelope popeline", "de" => "150,00", "por" => "99,00", "id" => 2],
                    ["img" => "product-3.jpg", "categoria" => "Vestidos", "titulo" => "Vestido envelope popeline", "de" => "150,00", "por" => "99,00", "id" => 3],
                    ["img" => "product-4.jpg", "categoria" => "Vestidos", "titulo" => "Vestido envelope popeline", "de" => "150,00", "por" => "99,00", "id" => 4],
                ];
            ?>

            <?php foreach ($promocoes as $produto): ?>
                <div class="col">
                    <div class="product-card">
                        <div class="product-thumb">
                            <span class="product-badge">Promoção</span>
                            <img src="<?= base_url() ?>assets/uploads/produtos/<?= $produto['img'] ?>" alt="<?= $produto['titulo'] ?>">
                            <div class="add-to-cart">
                                <a href="<?= base_url() ?>carrinho-compras" class="btn btn-brand btn-sm w-100">Adicionar ao carrinho</a>
                            </div>
                        </div>
                        <div class="product-body">
                            <span class="product-category"><?= $produto['categoria'] ?></span>
                            <a href="<?= base_url() ?>produtoDetalhes/<?= $produto['id'] ?>" class="product-title"><?= $produto['titulo'] ?></a>
                            <div class="product-price">
                                <span class="price-old">R$ <?= $produto['de'] ?></span>
                                <span class="price-current">R$ <?= $produto['por'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- ##### Nossos produtos ##### -->
<section id="produtos" class="py-5 bg-light">
    <div class="container">
        <div class="section-heading text-center">
            <span class="section-eyebrow">Catálogo completo</span>
            <h2>Nossos produtos</h2>
            <p class="mx-auto">Explore as últimas novidades das nossas coleções feminina, masculina e infantil.</p>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">

            <?php
                $produtos = [
                    ["img" => "product-1.jpg", "titulo" => "Vestido tecido azul", "preco" => "150,00", "id" => 5],
                    ["img" => "product-2.jpg", "titulo" => "Vestido envelope popeline", "preco" => "180,00", "id" => 6],
                    ["img" => "product-3.jpg", "titulo" => "Vestido envelope popeline", "preco" => "180,00", "id" => 7],
                    ["img" => "product-4.jpg", "titulo" => "Vestido envelope popeline", "preco" => "180,00", "id" => 8],
                    ["img" => "product-5.jpg", "titulo" => "Vestido envelope popeline", "preco" => "180,00", "id" => 9],
                    ["img" => "product-6.jpg", "titulo" => "Vestido envelope popeline", "preco" => "180,00", "id" => 10],
                    ["img" => "product-7.jpg", "titulo" => "Vestido envelope popeline", "preco" => "180,00", "id" => 11],
                    ["img" => "product-8.jpg", "titulo" => "Vestido envelope popeline", "preco" => "180,00", "id" => 12],
                ];
            ?>

            <?php foreach ($produtos as $produto): ?>
                <div class="col">
                    <div class="product-card">
                        <div class="product-thumb">
                            <img src="<?= base_url() ?>assets/uploads/produtos/<?= $produto['img'] ?>" alt="<?= $produto['titulo'] ?>">
                            <div class="add-to-cart">
                                <a href="<?= base_url() ?>carrinho-compras" class="btn btn-brand btn-sm w-100">Adicionar ao carrinho</a>
                            </div>
                        </div>
                        <div class="product-body">
                            <span class="product-category">Vestidos</span>
                            <a href="<?= base_url() ?>produtoDetalhes/<?= $produto['id'] ?>" class="product-title"><?= $produto['titulo'] ?></a>
                            <div class="product-price">
                                <span class="price-current">R$ <?= $produto['preco'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<?= $this->endSection() ?>
