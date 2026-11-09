<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    /**
     * Lista todos os registros (não excluídos) ordenados pelo campo informado.
     *
     * @param string $orderby
     * @return array
     */
    public function lista(string $orderby = "descricao"): array
    {
        return $this->orderBy($orderby)->findAll();
    }

    /**
     * Busca um registro pela chave primária.
     *
     * O retorno é ?array porque first()/find() devolvem null quando o id não existe.
     * Com o tipo "array" o PHP lançava TypeError em vez de deixar o controller tratar o 404.
     *
     * @param integer $id
     * @return array|null
     */
    public function getById(int $id): ?array
    {
        return $this->find($id);
    }
}