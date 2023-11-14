<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use Illuminate\Contracts\Cache\Store;

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



// Display a listing of the items.
Route::get('/stores', [App\Http\Controllers\Store\StoreController::class, 'index'])->name('store.index');

// Show the form for creating a new item.
Route::get('/stores/create', [App\Http\Controllers\Store\StoreController::class, 'create'])->name('store.create');

// Store a newly created item in storage.
Route::post('/stores', [App\Http\Controllers\Store\StoreController::class, 'store'])->name('store.store');

// Show the form for editing the specified item.
Route::get('/stores/{store}/edit', [App\Http\Controllers\Store\StoreController::class, 'edit'])->name('store.edit');

// Update the specified item in storage.
Route::put('/stores/{store}', [App\Http\Controllers\Store\StoreController::class, 'update'])->name('store.update');

// Remove the specified item from storage.
Route::delete('/stores/{store}', [App\Http\Controllers\Store\StoreController::class, 'destroy'])->name('store.destroy');






Route::get('/users', [UserController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/register', 'RegisterController@register')->name('register');



Auth::routes();

Route::prefix('admin')->middleware(['auth', 'isAdmins'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admindashboard');
});

Route::prefix('stores')->middleware(['auth', 'isStores'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Store\DashboardController::class, 'index'])->name('storedashboard');
});

Route::prefix('employees')->middleware(['auth', 'isEmployees'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Employee\DashboardController::class, 'index'])->name('employeedashboard');
});

Route::prefix('warehouses')->middleware(['auth', 'isWarehouses'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Warehouse\DashboardController::class, 'index'])->name('warehousedashboard');
});

Route::prefix('subwarehouses')->middleware(['auth', 'isSubwarehouses'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Subwarehouse\DashboardController::class, 'index'])->name('subwarehousedashboard');
});

Route::prefix('users')->middleware(['auth', 'isCustomers'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('customerdashboard');
});


