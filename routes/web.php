<?php

use App\Http\Controllers\MarcaController;
use App\Models\Marca;
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
    return view('dashboard', [
        'totalMarcas' => Marca::count(),
        'marcasActivas' => Marca::where('estado', 1)->count(),
        'marcasInactivas' => Marca::where('estado', 0)->count(),
        'ultimaMarca' => Marca::latest()->first(),
        'marcasRecientes' => Marca::latest()->limit(5)->get(),
    ]);
});

Route::resource('marcas', MarcaController::class);
