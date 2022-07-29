<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AMBController;
use App\Http\Controllers\GetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// GETS
Route::get('/categorias', [GetController::class, 'getCategorias']);
Route::post('/items', [GetController::class, 'getItems']);
Route::get('/image/{r}/{id}', [GetController::class, 'getImage']);


// ABM CATEGORIAS
Route::post('/alta-categoria', [AMBController::class, 'altaCategoria']);
Route::post('/modificar-categorias', [AMBController::class, 'modificarCategorias']);
Route::post('/eliminar-categoria', [AMBController::class, 'bajaCategoria']);

//ABM ITEMS
Route::post('/alta-item', [AMBController::class, 'altaItem']);
Route::post('/modificar-item', [AMBController::class, 'modificarItem']);
Route::post('/eliminar-item', [AMBController::class, 'bajaItem']);
Route::post('/reorganizar-item', [AMBController::class, 'changeOrder']);
