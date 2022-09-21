<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendedoresController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/avisos', function() {
    //comandos XPTO
    $avisos = ['avisos' => [0 => ['data' => '06/09/2022',
                                  'aviso' => 'Amanhã será o bicentenário da independência do Brasil',
                                  'exibir' => true],
                            1 => ['data' => '05/09/2022',
                                  'aviso' => 'Depois de amanhã será o bicentenário da independência do Brasil',
                                  'exibir' => true],
                            2 => ['data' => '04/09/2022',
                                  'aviso' => 'Depois de depois de amanhã será o bicentenário da independência do Brasil',
                                  'exibir' => true]]];
    return view('avisos', $avisos);
});

//resource = rota que funciona como CRUD
Route::resource('/clientes', App\Http\Controllers\ClienteController::class);
Route::resource('/vendedores', App\Http\Controllers\VendedoresController::class);
Route::resource('/produtos', App\Http\Controllers\ProdutosController::class);
