<?php

use App\Http\Controllers\FrontendController;
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
})->name('home');

Route::get('/primary-parameters', [FrontendController::class, 'primaryParameters'])->name('frontend.primaryParameters');
Route::get('/growth-stocks', [FrontendController::class, 'growthStocks'])->name('frontend.growthStocks');
Route::get('/dividend-stocks', [FrontendController::class, 'dividendStocks'])->name('frontend.dividendStocks');
Route::get('/multiplicators', [FrontendController::class, 'multiplicators'])->name('frontend.multiplicators');
