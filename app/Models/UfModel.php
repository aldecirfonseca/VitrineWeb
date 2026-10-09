<?php

namespace App\Models;

class UfModel extends BaseModel
{
    protected $table = 'uf';
    protected $primaryKey = 'id';

    protected $allowedFields = ['sigla', 'descricao', 'regiao', 'codIBGE'];

    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        "sigla"  => [
            "label" => 'UF',
            "rules" => 'required'
        ],
        "descricao"  => [
            "label" => 'Nome da UF',
            "rules" => 'required|min_length[3]|max_length[60]'
        ],
        "regiao"  => [
            "label" => 'Região',
            "rules" => 'required|integer'
        ],
        "codIBGE"  => [
            "label" => 'Código do IBGE da UF',
            "rules" => 'required|min_length[2]|max_length[2]'
        ]
    ];

    /**
     * getUf
     *
     * @param string $sigla 
     * @return array|null
     */
    public function getUf($sigla)
    {
        return $this->where("sigla", $sigla)->first();
    }
}