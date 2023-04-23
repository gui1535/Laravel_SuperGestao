<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'nome' => 'Empresa Admin',
            'cnpj' => '123.12421.213',
            'telefone' => '11945221351',
            'email' => 'contato@empresaadmin.com.br'
        ]);

    }
}
