<?php

namespace App\Database\Seeds;

use App\Libraries\ImagemProduto;
use App\Models\CategoriaModel;
use App\Models\ProdutoModel;
use CodeIgniter\Database\Seeder;

/**
 * Categorias e produtos de exemplo para demonstrar a vitrine.
 *
 *   php spark db:seed DemoSeeder
 *
 * As fotos são copiadas de public/assets/uploads/produtos/ para public/uploads/produto/.
 */
class DemoSeeder extends Seeder
{
    public function run()
    {
        $CategoriaModel = new CategoriaModel();
        $ProdutoModel   = new ProdutoModel();

        $aCategorias = ['Vestidos', 'Blusas & Camisas', 'Camisetas'];
        $idCategoria = [];

        foreach ($aCategorias as $descricao) {
            $existe = $CategoriaModel->where('descricao', $descricao)->first();

            $idCategoria[$descricao] = $existe['id']
                ?? $CategoriaModel->insert(['descricao' => $descricao, 'statusRegistro' => 1]);
        }

        $aProdutos = [
            ['Vestidos',         'Vestido tecido azul',          149.90, 10, 'product-1.jpg'],
            ['Vestidos',         'Vestido envelope popeline',    179.90,  8, 'product-2.jpg'],
            ['Vestidos',         'Vestido midi floral',          199.90,  5, 'product-3.jpg'],
            ['Blusas & Camisas', 'Camisa de linho off-white',    129.90, 12, 'product-4.jpg'],
            ['Blusas & Camisas', 'Blusa de seda estampada',      109.90,  6, 'product-5.jpg'],
            ['Blusas & Camisas', 'Camisa xadrez manga longa',     99.90,  3, 'product-6.jpg'],
            ['Camisetas',        'Camiseta básica algodão',       49.90, 30, 'product-7.jpg'],
            ['Camisetas',        'Camiseta estampada',            59.90, 20, 'product-8.jpg'],
            ['Camisetas',        'Camiseta oversized',            69.90,  1, 'product-9.jpg'],
        ];

        if (! is_dir(ImagemProduto::caminho())) {
            mkdir(ImagemProduto::caminho(), 0755, true);
        }

        foreach ($aProdutos as [$categoria, $nome, $preco, $estoque, $foto]) {

            if (! is_null($ProdutoModel->where('nome', $nome)->first())) {
                continue;   // já cadastrado
            }

            $imagem = null;
            $origem = FCPATH . 'assets/uploads/produtos/' . $foto;

            if (is_file($origem)) {
                $imagem = 'demo_' . $foto;
                copy($origem, ImagemProduto::caminho() . $imagem);
                ImagemProduto::gerarMiniatura($imagem);
            }

            $ProdutoModel->insert([
                'categoria_id'   => $idCategoria[$categoria],
                'nome'           => $nome,
                'descricao'      => '<p>' . $nome . ' da coleção VitrineWeb. Peça confortável, com acabamento de qualidade.</p>',
                'preco'          => $preco,
                'estoque'        => $estoque,
                'imagem'         => $imagem,
                'statusRegistro' => 1,
            ]);
        }
    }
}
