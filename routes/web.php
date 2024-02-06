<?php

use App\Http\Controllers\DbModelEloquentController;
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
    return view('welcome');
});

Route::prefix('demo')->group(function () {
    Route::get('db-model-eloquent', [DbModelEloquentController::class, 'index']);
});
