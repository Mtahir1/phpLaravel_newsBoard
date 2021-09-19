<?php

use App\Http\Controllers\NewsController;
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

// News System
Route::get('news', [NewsController::class, 'index']);
Route::get('create-news', [NewsController::class, 'create']);
Route::post('create-news', [NewsController::class, 'save']);

Route::get('/news/{store}', [NewsController::class, 'newsDataByStore']);
Route::post('/news/{store}', [NewsController::class, 'newsDataByStore']);


