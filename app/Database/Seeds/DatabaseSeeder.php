<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seed principal: monta os dados mínimos para o sistema funcionar.
 *
 *   php spark migrate
 *   php spark db:seed DatabaseSeeder
 *
 * Para ter produtos de exemplo na vitrine, rode também:
 *   php spark db:seed DemoSeeder
 */
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UfSeeder');
        $this->call('CidadeSeeder');
        $this->call('SuperUsuarioSeeder');
    }
}
