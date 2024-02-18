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

Route::prefix('db-model-eloquent')->group(function () {
    Route::get('clone', [DbModelEloquentController::class, 'cloneIntro']);
    Route::get('merge-collection', [DbModelEloquentController::class, 'mergeCollectionIntro']);
    Route::get('load-data-faster', [DbModelEloquentController::class, 'loadDataFaster']);
    Route::get('scope', [DbModelEloquentController::class, 'scope']);
    Route::get('hide-column', [DbModelEloquentController::class, 'hideColumn']);
    Route::get('copy-model', [DbModelEloquentController::class, 'copyModel']);
    Route::get('reduce-mem', [DbModelEloquentController::class, 'reduceMem']);
});
