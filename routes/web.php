<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;

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
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});





Route::get('/users', [UserController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::prefix('admin')->middleware(['auth','isAdmin'])->group (function (){

    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admindashboard');
    

// Display a listing of the items.
Route::get('/items', [ItemController::class, 'index'])->name('items.index');

// Show the form for creating a new item.
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');

// Store a newly created item in storage.
Route::post('/items', [ItemController::class, 'store'])->name('items.store');

// Show the form for editing the specified item.
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');

// Update the specified item in storage.
Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');

// Remove the specified item from storage.
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');


});

