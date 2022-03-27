<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\FornecedorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PrincipalController::class, 'Principal'])->name('site.index'); // Pagina Principal

Route::get('/sobre-nos', [SobreNosController::class, 'SobreNos'])->name('site.sobrenos'); // Pagina Sobre-nos

Route::get('/contato', [ContatoController::class, 'Contato'])->name('site.contato'); // Pagina Contato

Route::post('/contato', [ContatoController::class, 'Contato'])->name('site.contato'); // Pagina Contato


Route::get('/login', function () {
    return 'Login';
})->name('site.login'); // Pagina Login

// Inicia grupo de rotas '/app'
route::prefix('/app')->group(function () {

    Route::get('/clientes', function () {
        return 'Clientes';
    })->name('app.clientes'); // Pagina cliente

    Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('app.fornecedores'); // Pagina Fornecedores

    Route::get('/produtos', function () {
        return 'Produtos';
    })->name('app.produtos'); // Pagina Produtos

}); // Fim grupo de rotas

Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('teste'); // Pagina teste

route::fallback(function () {
    echo 'A rota acessada nao existe. <a href="' . route('site.index') . '">Clique aqui</a> para ir para pagina inicial';
});

/*
--------------------------------------------------------------------------------
Route::get(
    '/contato/{nome}/{categoria_id}',
    function (
        string $nome = 'Desconhecido',
        int $categoria_id = 1 // Categoria 1 => Informação
    ) {
        echo 'Estamos aqui:  ' . $nome . ' - ' . $categoria_id;
    }
    // 
)->where(
    'categoria_id', // Primeiro parametro
    '[0-9]+' // categoria_id só vai receber numero de 0 a 9 ou maior
)->where(
    'nome', // Primeiro Parametro
    '[A-Z a-z]+' // nome só vai receber letra de A-Z a-z com mais de 0 caracter
);

--------------------------------------------------------------------------------

// Caso a variavel "a" não receba pararametro, aparecerá "erro"
Route::get('/pagina/{nome}/{a?}', function (string $nome, string $a = 'erro') {
    echo 'Ola ' . $nome . ' - ' . $a;
}); 

--------------------------------------------------------------------------------

//Redireciona '/rota1' para a '/rota2'
Route::get('/rota1', function () {
    return redirect()->route('site.rota2');
})->name('site.rota1');

Route::get('/rota2', function () {
    echo 'Rota 2';
})->name('site.rota2');

--------------------------------------------------------------------------------

// Envio de parametros pelas rotas:
Route::get('/contato/{nome}/{a}', function (string $nome, string $a) {
    echo 'Ola ' . $nome . ' - ' . $a;
}); 

--------------------------------------------------------------------------------

//Verbos HTTP:
get
post
put
patch
delete
options
--------------------------------------------------------------------------------
*/