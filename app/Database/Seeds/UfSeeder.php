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
                'codIBGE' => '15'
            ]
        ];

        $model->insertBatch($aUf);
    }
}