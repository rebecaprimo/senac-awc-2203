<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutosController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('/clientes', App\Http\Controllers\ClienteController::class)->middleware(['auth']); //rota da página inicial
Route::resource('/produtos', App\Http\Controllers\ProdutosController::class)->middleware(['auth']);
Route::resource('/vendedores', App\Http\Controllers\VendedoresController::class)->middleware(['auth']);
