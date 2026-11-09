<?php

namespace App\Models;

class ProdutoModel extends BaseModel
{
    protected $table      = 'produto';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'categoria_id',
        'nome',
        'descricao',
        'preco',
        'estoque',
        'imagem',
        'statusRegistro',
    ];

    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        'categoria_id' => [
            'label' => 'Categoria',
            'rules' => 'required|is_natural_no_zero|is_not_unique[categoria.id]',
        ],
        'nome' => [
            'label' => 'Nome',
            'rules' => 'required|min_length[3]|max_length[100]',
        ],
        'preco' => [
            'label' => 'Preço',
            'rules' => 'required|decimal|greater_than[0]',
        ],
        'estoque' => [
            'label' => 'Estoque',
            'rules' => 'required|is_natural',
        ],
        'statusRegistro' => [
            'label' => 'Status',
            'rules' => 'required|in_list[1,2]',
        ],
    ];

    protected $validationMessages = [
        'categoria_id' => [
            'is_not_unique' => 'Selecione uma categoria válida.',
        ],
    ];

    /**
     * Lista do painel administrativo, com a descrição da categoria.
     */
    public function listaAdmin(): array
    {
        return $this->select('produto.*, categoria.descricao AS categoria')
                    ->join('categoria', 'categoria.id = produto.categoria_id', 'left')
                    ->orderBy('produto.nome')
                    ->findAll();
    }

    /**
     * Produtos da vitrine: só ativos, de categoria ativa, com filtro e paginação.
     *
     * @param int|null    $categoriaId filtra por categoria (null = todas)
     * @param string|null $busca       parte do nome do produto
     */
    public function vitrine(?int $categoriaId = null, ?string $busca = null, int $porPagina = 12): array
    {
        $this->select('produto.*, categoria.descricao AS categoria')
             ->join('categoria', 'categoria.id = produto.categoria_id')
             ->where('produto.statusRegistro', 1)
             ->where('categoria.statusRegistro', 1)
             ->where('categoria.deleted_at', null);

        if (! empty($categoriaId)) {
            $this->where('produto.categoria_id', $categoriaId);
        }

        if (! empty($busca)) {
            // like() escapa o valor: a busca nunca é concatenada na SQL
            $this->like('produto.nome', $busca);
        }

        return $this->orderBy('produto.created_at', 'DESC')
                    ->paginate($porPagina);
    }

    /**
     * Um produto para a página de detalhe (null se não existir ou estiver inativo).
     */
    public function getVitrine(int $id): ?array
    {
        return $this->select('produto.*, categoria.descricao AS categoria')
                    ->join('categoria', 'categoria.id = produto.categoria_id')
                    ->where('produto.id', $id)
                    ->where('produto.statusRegistro', 1)
                    ->where('categoria.statusRegistro', 1)
                    ->where('categoria.deleted_at', null)
                    ->first();
    }

    /**
     * Quantos produtos (não excluídos) usam a categoria.
     */
    public function totalPorCategoria(int $categoriaId): int
    {
        return $this->where('categoria_id', $categoriaId)->countAllResults();
    }
}
