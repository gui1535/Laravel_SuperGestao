<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PrincipalController@principal')->name('site.index')->middleware('log.acesso');

Route::get('/sobre-nos', 'SobreNosController@sobreNos')->name('site.sobrenos');

Route::post('/contato', 'ContatoController@store')->name('site.contato');

Route::get('/login', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');

Route::get('/cadastrar-se', 'EmpresaController@indexCadastro')->name('site.cadastrar');
Route::post('/cadastrar-se', 'EmpresaController@cadastrar')->name('site.cadastrar');

Route::middleware('autenticacao')->prefix('/app')->group(function () {
    // Home
    Route::get('/home', 'HomeController@index')->name('app.home');

    // Sair
    Route::get('/sair', 'LoginController@sair')->name('app.sair');

    // Fornecedor
    Route::resource('fornecedor', 'FornecedorController');

    // Produtos
    Route::resource('produto', 'ProdutoController');

    // Clientes
    Route::resource('cliente', 'ClienteController');

    // Pedidos
    Route::resource('pedido', 'PedidoController');
});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('teste');

Route::fallback(function () {
    echo 'A rota acessada não existe. <a href="' . route('site.index') . '">clique aqui</a> para ir para página inicial';
});
