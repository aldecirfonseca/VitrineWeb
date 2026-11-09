<?php

namespace App\Models;

class CategoriaModel extends BaseModel
{
    protected $table = "categoria";
    protected $primaryKey = 'id';
    protected $allowedFields = [
        "descricao", 
        "statusRegistro"
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        "descricao" => [
            "label" => "Descrição",
            "rules" => "required|min_length[3]|max_length[50]"
        ] ,
        "statusRegistro" => [
            "label" => "Status",
            "rules" => "required|in_list[1,2]"
        ]
    ];

    /**
     * Categorias ativas (combobox do produto, filtros e menu da vitrine).
     *
     * @return array
     */
    public function listaAtivas(): array
    {
        return $this->where("statusRegistro", 1)->orderBy("descricao")->findAll();
    }
}