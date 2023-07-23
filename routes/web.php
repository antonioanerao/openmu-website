<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CharacterPointsController;
use App\Http\Controllers\CharacterResetsController;
use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'character'], function() {
    Route::resource('character', CharacterController::class);
    Route::group(['prefix' => 'points'], function() {
        Route::get('{character}/edit', [CharacterPointsController::class, 'edit'])
            ->name('character-points.edit');
        Route::PATCH('{character}/update', [CharacterPointsController::class, 'update'])
            ->name('character-points.update');
    });
    Route::group(['resets'], function() {
        Route::get('{character}/update', [CharacterResetsController::class, 'update'])
            ->name('character-resets.update');
    });
});

