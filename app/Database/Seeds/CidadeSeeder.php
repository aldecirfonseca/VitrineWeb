<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CidadeSeeder extends Seeder
{
    public function run()
    {
        $aCidades = [
            ['uf' => 'MG', 'nome' => 'Muriaé', 'codIBGE' => '3143906']
        ];

        foreach ($aCidades as $cidade) {

            $created_at = date('Y-m-d H:i:s');
            
            // Buscar id da uf
            $aUf = $this->db
                    ->table('uf')
                    ->where('sigla', $cidade['uf'])
                    ->get()
                    ->getRowArray();

            if (is_null($aUf)) {
                throw new \RuntimeException("UF {$cidade['uf']} não encontrada. Execute o UfSeeder antes.");
            }

            $tbCidade = $this->db->table('cidade');

            if ($tbCidade->where([
                'uf_id' => $aUf['id'], 
                'nome' => $cidade['nome']
                ])->countAllResults() == 0) {

                $tbCidade->insert([
                    'uf_id'         => $aUf['id'],
                    'nome'          => $cidade['nome'],
                    'codIBGE'       => $cidade['codIBGE'],
                    'created_at'    => $created_at,
                    'updated_at'    => $created_at
                ]);
            }
        }
    }
}
