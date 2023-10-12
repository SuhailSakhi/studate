<?php

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

Route::get('/profile',[App\Http\Controllers\ProfileController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create',[App\Http\Controllers\CreateController::class, 'create'])->name('create');

Route::post('/create', [App\Http\Controllers\CreateController::class, 'store'])->name('create');

Route::delete('/profiles/{id}',[App\Http\Controllers\ProfileController::class, 'destroy'])->name('delete.profile');

Route::get('/profiles/{id}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('edit.profile');

Route::put('/profiles/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('update.profile');

Route::get('/profiles/{id}',[App\Http\Controllers\ProfileController::class, 'show'])->name('show.profile');

