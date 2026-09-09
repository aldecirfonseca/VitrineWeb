<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    /**
     * Undocumented function
     *
     * @param string $orderby
     * @return array
     */
    public function lista(string $orderby = "descricao"): array
    {
        return $this->orderBy($orderby)->findAll();
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return array
     */
    public function getById(int $id): array
    {
        return $this->where(["id" => $id])->first();
    }
}