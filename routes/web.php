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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])->name('items.index');
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);
    Route::put('/update/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('items.update');
    Route::delete('/delete/{id}', [App\Http\Controllers\ItemController::class, 'delete'])->name('items.delete');
});

Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::put('users/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::delete('users/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');