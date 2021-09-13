<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/establishments', [App\Http\Controllers\ApiController::class, 'index'])->name('establishments.index');
Route::get('/establishments/{establishment}', [App\Http\Controllers\ApiController::class, 'show'])->name('establishments.show');

Route::get('/categories', [App\Http\Controllers\ApiController::class, 'categories'])->name('categories');
Route::get('/categories/{category}', [App\Http\Controllers\ApiController::class, 'category'])->name('category');
Route::get('/{category}', [App\Http\Controllers\ApiController::class, 'establishmentscategory'])->name('establishmentscategory');

