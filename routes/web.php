<?php

use Illuminate\Support\Facades\Auth;
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




Auth::routes(['verify' => true]);

Route::get('/', App\Http\Controllers\BeginController::class)->name('begin');

Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('/establishments/create', [App\Http\Controllers\EstablishmentController::class, 'create'])->name('establishments.create')->middleware('check');
    Route::post('/establishments', [App\Http\Controllers\EstablishmentController::class, 'store'])->name('establishments.store');
    Route::get('/establishment/edit', [App\Http\Controllers\EstablishmentController::class, 'edit'])->name('establishments.edit');
    Route::put('/establishment/{establishment}', [App\Http\Controllers\EstablishmentController::class, 'update'])->name('establishment.update');


    Route::post('/images/store', [App\Http\Controllers\ImageController::class, 'store'])->name('images.store');
    Route::post('/images/destroy', [App\Http\Controllers\ImageController::class, 'destroy'])->name('images.destroy');
});


