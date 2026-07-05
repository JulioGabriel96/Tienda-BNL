<?php

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubCategoriaController;
use App\Http\Controllers\TipoClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::resource('marcas', MarcaController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('subcategorias', SubCategoriaController::class);
Route::get('categorias/{categoria}/subcategorias/create', [SubCategoriaController::class, 'create'])
    ->name('subcategorias.create');
Route::get('categorias/{categoria}/subcategorias', [SubCategoriaController::class, 'index'])
    ->name('subcategorias.index');  
Route::post('categorias/{categoria}/subcategorias', [SubCategoriaController::class, 'store'])
    ->name('subcategorias.store');
Route::resource('productos', ProductoController::class);
Route::resource('tipo-clientes', TipoClienteController::class)
    ->parameters(['tipo-clientes' => 'tipoCliente']);

Route::resource('clientes', ClienteController::class);

