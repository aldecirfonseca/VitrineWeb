<?php

namespace App\Models;

class CidadeModel extends BaseModel
{
    protected $table = 'cidade';
    protected $primaryKey = 'id';

    protected $allowedFields = ['uf_id', 'nome', 'codIBGE'];

    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        "uf_id"  => [
            "label" => 'UF',
            "rules" => 'required'
        ],
        "nome"  => [
            "label" => 'Nome da Cidade',
            "rules" => 'required|min_length[3]|max_length[60]'
        ],
        "codIBGE"  => [
            "label" => 'Código do IBGE da Cidade',
            "rules" => 'required'
        ]
    ];

    /**
     * getCidade
     *
     * @param string $uf
     * @param string $cidade
     * @return array|null
     */
    public function getCidade($uf, $cidade)
    {
        // select explícito: sem ele o "id" da UF sobrescreve o "id" da cidade no join
        return $this->select("cidade.*")
                    ->join("uf", "uf.id = cidade.uf_id")
                    ->where(["uf.sigla" => $uf, "cidade.nome" => $cidade])
                    ->first();
    }
}