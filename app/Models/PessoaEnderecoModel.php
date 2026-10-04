<?php

namespace App\Models;

class PessoaEnderecoModel extends BaseModel
{
    protected $table = 'pessoaendereco';
    protected $primaryKey = 'id';

    protected $allowedFields = ['pessoa_id', 'tipoEndereco', 'logradouro', 'numero', 'complemento'
                                , 'bairro', 'cep', 'cidade_id'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        'pessoa_id' => [
            "label" => 'Pessoa',
            'rules' => 'required|integer'
        ],
        'tipoEndereco' => [
            "label" => 'Tipo do Endereço',
            'rules' => 'required|integer'
        ],
        'logradouro' => [
            "label" => 'Logradouro',
            'rules' => 'required|min_length[3]|max_length[60]'
        ],
        'numero' => [
            "label" => 'Número',
            'rules' => 'required|max_length[10]'
        ],
        'complemento' => [
            'label' => 'Complemento',
            'rules' => 'required|min_length[3]|max_length[40]'
        ],
        'bairro' => [
            'label' => 'Bairro',
            'rules' => 'required|min_length[3]|max_length[40]'
        ],
        'cep' => [
            'label' => 'CEP',
            'rules' => 'required|max_length[8]'
        ],
        'cidade_id' => [
            'label' => 'Cidade',
            'rules' => 'required|integer'
        ]
    ];

    /**
     * getByPessoaEndereco
     *
     * @return array
     */
    public function getByPessoaEndereco($id)
    {
        return $this
                    ->select("pessoaendereco.*, uf.id as uf_id")
                    ->join("cidade", "cidade.id = pessoaendereco.cidade_id", "left")
                    ->join("uf", "uf.id = cidade.uf_id", "left")
                    ->where("pessoaendereco.id", $id)
                    ->first();
    }

    /**
     * getListaEndereco
     *
     * @return array
     */
    public function getListaEndereco()
    {
        return $this
                    ->select("pessoaendereco.*, cidade.nome as cidade, uf.sigla as uf")
                    ->join("cidade", "cidade.id = pessoaendereco.cidade_id", "left")
                    ->join("uf", "uf.id = cidade.uf_id", "left")
                    ->where(['pessoaendereco.pessoa_id'=> session()->get('userPessoa_id')])
                    ->orderBy("pessoaendereco.created_at")
                    ->findAll();

    }
}