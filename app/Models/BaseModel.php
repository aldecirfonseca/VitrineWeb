<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    public function lista(string $orderby = "descricao"): array
    {
        return $this->orderBy($orderby)->findAll();
    }

    public function getById(int $id): array
    {
        return $this->where(["id" => $id])->first();
    }
}