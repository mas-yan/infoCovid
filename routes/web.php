<?php

use App\Http\Controllers\covidController;
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

Route::get('/', [covidController::class, 'index'])->name('global');
Route::get('/indonesia', [covidController::class, 'indonesia']);
Route::get('/jateng', [covidController::class, 'jateng']);
Route::get('/kendal', [covidController::class, 'kendal']);
