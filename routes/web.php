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

Route::get('/', function(){
    return view('welcome');
});

Auth::routes(['verify' => true]);


Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('/establishments/create', [App\Http\Controllers\EstablishmentController::class, 'create'])->name('establishments.create');
    Route::post('/establishments', [App\Http\Controllers\EstablishmentController::class, 'store'])->name('establishments.store');
    Route::get('/establishments/edit', [App\Http\Controllers\EstablishmentController::class, 'edit'])->name('establishments.edit');


    Route::post('/images/store', [App\Http\Controllers\ImageController::class, 'store'])->name('images.store');
    Route::post('/images/destroy', [App\Http\Controllers\ImageController::class, 'destroy'])->name('images.destroy');

});
