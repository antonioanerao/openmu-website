<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CharacterPointsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('character', CharacterController::class);

Route::group(['prefix' => 'character-points'], function() {
    Route::get('{character}/edit', [CharacterPointsController::class, 'edit'])
        ->name('character-points.edit');
});
