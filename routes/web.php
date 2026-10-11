<?php

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubCategoriaController;
use App\Http\Controllers\TipoClienteController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaVehiculosController;
use App\Http\Controllers\ModeloVehiculosController;
use App\Http\Controllers\MarcaModeloVehiculosController;
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
Route::resource('marcas-vehiculos', MarcaVehiculosController::class)->parameters(['marcas-vehiculos' => 'marcaVehiculo']);
Route::resource('modelos-vehiculos', ModeloVehiculosController::class)->parameters(['modelos-vehiculos' => 'modeloVehiculo']);

Route::resource('marcas-modelos', MarcaModeloVehiculosController::class)->parameters(['marcas-modelos' => 'modeloMarcaVehiculo'])->except(['create', 'index', 'store']);

Route::get('marcas-vehiculos/{marcaVehiculo}/modelos/create', [MarcaModeloVehiculosController::class, 'create'])
->name('marcas-modelos.create');

Route::get('marcas-vehiculos/{marcaVehiculo}/modelos', [MarcaModeloVehiculosController::class, 'index'])
->name('marcas-modelos.index');  

Route::post('marcas-vehiculos/{marcaVehiculo}/modelos', [MarcaModeloVehiculosController::class, 'store'])
    ->name('marcas-modelos.store');

Route::resource('categorias', CategoriaController::class);
Route::resource('subcategorias', SubCategoriaController::class);
Route::get('categorias/{categoria}/subcategorias/create', [SubCategoriaController::class, 'create'])
    ->name('subcategorias.create');
Route::get('categorias/{categoria}/subcategorias', [SubCategoriaController::class, 'index'])
    ->name('subcategorias.index');  
Route::post('categorias/{categoria}/subcategorias', [SubCategoriaController::class, 'store'])
    ->name('subcategorias.store');
Route::resource('productos', ProductoController::class);
Route::resource('tipo-clientes', TipoClienteController::class)->parameters(['tipo-clientes' => 'tipoCliente']);
Route::resource('generos', GeneroController::class);
Route::resource('clientes', ClienteController::class);