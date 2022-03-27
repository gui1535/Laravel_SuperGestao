<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = [
            0 => [
                'nome' => 'Fornecedor 1',
                'status' => 'N',
                'cnpj' => '0',
                'ddd' => '11', // São Paulo (SP)
                'telefone' => '0000-0000'
            ],
            1 => [
                'nome' => 'Fornecedor 2',
                'status' => 'S',
                'cnpj' => null,
                'ddd' => '85', // Fortaleza (CE)
                'telefone' => '0000-0000'
            ],
            2 => [
                'nome' => 'Fornecedor 3',
                'status' => 'S',
                'cnpj' => null,
                'ddd' => '32', // Juiz de Fora (MG)
                'telefone' => '0000-0000'
            ],
        ];

        return view('app.fornecedor.index', compact('fornecedores'));
    }
}


/* Verifica se possui $fornecedores[1]['cnpj'], se possuir execute 'CNPJ informado', senão 'CNPJ nao informado'
        $msg = isset($fornecedores[1]['cnpj']) ? 'CNPJ informado' : 'CNPJ nao informado';
        echo $msg;
*/