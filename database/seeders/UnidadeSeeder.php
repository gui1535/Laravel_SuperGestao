<?php

namespace Database\Seeders;

use App\Models\Unidade;
use Illuminate\Database\Seeder;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unidade::create([
            'unidade' => 'M',
            'descricao' => 'Metro',
        ]);

        Unidade::create([
            'unidade' => 'KG',
            'descricao' => 'Quilograma',
        ]);

        Unidade::create([
            'unidade' => 'L',
            'descricao' => 'Litro',
        ]);

        Unidade::create([
            'unidade' => 'U',
            'descricao' => 'Unidade',
        ]);

        Unidade::create([
            'unidade' => 'G',
            'descricao' => 'Grama',
        ]);
        
        Unidade::create([
            'unidade' => 'CM',
            'descricao' => 'Centímetro',
        ]);
        
        Unidade::create([
            'unidade' => 'PÇ',
            'descricao' => 'Peça',
        ]);
        
        Unidade::create([
            'unidade' => 'PC',
            'descricao' => 'Pacote',
        ]);
    }
}
