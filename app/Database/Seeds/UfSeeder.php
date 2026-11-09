<?php

namespace App\Database\Seeds;

use App\Models\UfModel;
use CodeIgniter\Database\Seeder;

class UfSeeder extends Seeder
{
    public function run()
    {
        $model = new UfModel();

        $aUf = [
            [
                'sigla' => "MG",
                'descricao' => 'Minas Gerais',
                'regiao' => '3',            // Sudeste
                'codIBGE' => '31'
            ],
            [
                'sigla' => "RS",
                'descricao' => 'Rio Grande do Sul',
                'regiao' => '1',            // Sul
                'codIBGE' => '43'           // 43 = RS no IBGE (15 é o Pará)
            ]
        ];

        // Só insere a UF que ainda não existe: a seed pode rodar mais de uma vez sem erro de chave única
        foreach ($aUf as $uf) {
            if (is_null($model->getUf($uf['sigla']))) {
                $model->insert($uf);
            }
        }
    }
}
