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

Route::get('users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('edit.user');

Route::put('users/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('update.user');

Route::get('/manage', [App\Http\Controllers\ProfileController::class, 'manage'])->name('manage')->middleware('auth');

Route::put('/manage/{profile}/toggleProfileStatus', [App\Http\Controllers\ProfileController::class, 'toggleProfileStatus'])->name('toggleProfileStatus')->middleware('auth');

Route::post('/like/{profile}', [ProfileController::class, 'like'])->name('like.profile')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create',[App\Http\Controllers\CreateController::class, 'create'])->name('create')->middleware('auth');

Route::post('/create', [App\Http\Controllers\CreateController::class, 'store'])->name('create')-> middleware('auth');

Route::delete('/profiles/{profile}',[App\Http\Controllers\ProfileController::class, 'destroy'])->name('delete.profile')->middleware('auth');

Route::get('/profiles/{profile}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('edit.profile');

Route::put('/profiles/{profile}/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('update.profile');

Route::get('/profiles/{id}', [App\Http\Controllers\ProfileController::class, 'show'])->name('view.profile');

Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');



