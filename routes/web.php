<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ItemController;

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

// Display a listing of the items.
Route::get('/items', [App\Http\Controllers\Admin\ItemController::class, 'index'])->name('items.index');

// Show the form for creating a new item.
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');

// Store a newly created item in storage.
Route::post('/items', [App\Http\Controllers\Admin\ItemController::class, 'store'])->name('items.store');

// Show the form for editing the specified item.
Route::get('/items/{item}/edit', [App\Http\Controllers\Admin\ItemController::class, 'edit'])->name('items.edit');

// Update the specified item in storage.
Route::put('/items/{item}', [App\Http\Controllers\Admin\ItemController::class, 'update'])->name('items.update');

// Remove the specified item from storage.
Route::delete('/items/{item}', [App\Http\Controllers\Admin\ItemController::class, 'destroy'])->name('items.destroy');






Route::get('/users', [UserController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');


Auth::routes();
Route::prefix('admin')->middleware(['auth','isAdmin'])->group (function (){

    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admindashboard');
    



});

