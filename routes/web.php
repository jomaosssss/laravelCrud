<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\CategoryController;
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
    // return view('welcome');
    return "Bienvenido al curso de laravel";
});
Route::get('/games', [GamesController::class, 'index'])->name('games');
Route::get('/games/create', [GamesController::class, 'create'])->name('gamesCreate');
Route::get('/games/{name_game}/{categoria?}', [GamesController::class, 'help']);
Route::post('/games/storeVideogame', [GamesController::class, 'storeVideogame'])->name('createVideogame');
Route::get('/view/{game_id}', [GamesController::class, 'view'])->name('viewGame');
Route::post('/games/updateVideogame', [GamesController::class, 'updateVideogame'])->name('updateVideogame');
Route::get('/delete/{game_id}', [GamesController::class, 'delete'])->name('deleteGame');

Route::resource('categories', CategoryController::class);
