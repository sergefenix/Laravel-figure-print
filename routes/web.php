<?php

use App\Http\Controllers\FigureController;
use Illuminate\Support\Facades\Route;

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

Route::group(
    ['prefix' => 'figures', 'as' => 'figures.'],
    static function () {
        Route::post('/', [FigureController::class, 'getImage'])->name('getImage');
    }
);
