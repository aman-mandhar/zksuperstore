<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransferController;
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







Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users/roles/{id}', [App\Http\Controllers\UserController::class, 'roles'])->name('users.roles');
Route::put('/users/roles/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::post('/register', 'RegisterController@register')->name('register');
Route::get('/users/show/{id}',[App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/users/delete-user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
Route::get('/getReferralName', [UserController::class, 'getReferralName'])->name('getReferralName');




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


use App\Http\Controllers\SubwarehouseController;

// Display a listing of subwarehouses
Route::get('/subwarehouses', [SubwarehouseController::class, 'index'])->name('subwarehouses.index');

// Show the form for creating a new subwarehouse
Route::get('/subwarehouses/create', [SubwarehouseController::class, 'create'])->name('subwarehouses.create');

// Store a newly created subwarehouse in the database
Route::post('/subwarehouses', [SubwarehouseController::class, 'store'])->name('subwarehouses.store');

// Display the specified subwarehouse
Route::get('/subwarehouses/{subwarehouse}', [SubwarehouseController::class, 'show'])->name('subwarehouses.show');

// Show the form for editing the specified subwarehouse
Route::get('/subwarehouses/{subwarehouse}/edit', [SubwarehouseController::class, 'edit'])->name('subwarehouses.edit');

// Update the specified subwarehouse in the database
Route::put('/subwarehouses/{subwarehouse}', [SubwarehouseController::class, 'update'])->name('subwarehouses.update');

// Remove the specified subwarehouse from the database
Route::delete('/subwarehouses/{subwarehouse}', [SubwarehouseController::class, 'destroy'])->name('subwarehouses.destroy');



use App\Http\Controllers\RetailController;
use App\Models\Transfer;

// Display a listing of retail stores
Route::get('/retails', [RetailController::class, 'index'])->name('retails.index');

// Show the form for creating a new retail store
Route::get('/retails/create', [RetailController::class, 'create'])->name('retails.create');

// Store a newly created retail store in the database
Route::post('/retails', [RetailController::class, 'store'])->name('retails.store');

// Display the specified retail store
Route::get('/retails/{retail}', [RetailController::class, 'show'])->name('retails.show');

// Show the form for editing the specified retail store
Route::get('/retails/{retail}/edit', [RetailController::class, 'edit'])->name('retails.edit');

// Update the specified retail store in the database
Route::put('/retails/{retail}', [RetailController::class, 'update'])->name('retails.update');

// Remove the specified retail store from the database
Route::delete('/retails/{retail}', [RetailController::class, 'destroy'])->name('retails.destroy');



Route::get('/items/categories', [App\Http\Controllers\ItemController::class, 'categories'])->name('items.categories');
Route::get('/items/subcategories', [App\Http\Controllers\ItemController::class, 'subcategories'])->name('items.subcategories');
Route::get('/items/variations', [App\Http\Controllers\ItemController::class, 'variations'])->name('items.variations');



Route::get('/items', [App\Http\Controllers\ItemController::class, 'index'])->name('items.index');
Route::get('/items/create', [App\Http\Controllers\ItemController::class, 'create'])->name('items.create');
Route::post('/items', [App\Http\Controllers\ItemController::class, 'store'])->name('items.store');
Route::get('/items/{item}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('items.edit');
Route::put('/items/{item}', [App\Http\Controllers\ItemController::class, 'update'])->name('items.update');
Route::delete('/items/{item}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('items.destroy');
Route::get('/items/search', 'ItemController@search');
Route::get('/items/search_category', 'ItemController@search_category');
Route::get('/items/search_subcategory', 'ItemController@search_subcategory');
Route::get('/items/search_variation', 'ItemController@search_variation');
Route::post('/categories', [App\Http\Controllers\ItemController::class, 'categoryStore'])->name('categories.store');
Route::post('/subcategories', [App\Http\Controllers\ItemController::class, 'subcategoryStore'])->name('subcategories.store');
Route::post('/variations', [App\Http\Controllers\ItemController::class, 'variationStore'])->name('variations.store');

Route::delete('/categories/{category}', [App\Http\Controllers\ItemController::class, 'categoryDestroy'])->name('categories.destroy');

Route::delete('/subcategories/{subcategory}', [App\Http\Controllers\ItemController::class, 'subcategoryDestroy'])->name('subcategories.destroy');

Route::delete('/variations/{variation}', [App\Http\Controllers\ItemController::class, 'variationDestroy'])->name('variations.destroy');




Route::post('/cart/add/{stockId}', [TransferController::class, 'addToCart'])->name('cart.addToCart');





Route::get('/stocks', [App\Http\Controllers\StockController::class, 'index'])->name('stocks.index');
Route::get('/stocks/bill', [App\Http\Controllers\StockController::class, 'bill'])->name('stocks.bill');
Route::get('/stocks/transfer/{stockId}', [App\Http\Controllers\StockController::class, 'transfer'])->name('stocks.transfer');
Route::get('/stocks/add/{itemId}', [App\Http\Controllers\StockController::class, 'add'])->name('stocks.add');
Route::post('/stocks', [App\Http\Controllers\StockController::class, 'store'])->name('stocks.store');
Route::get('/stocks/{stock}', [App\Http\Controllers\StockController::class, 'show'])->name('stocks.show');
Route::get('/stocks/{stock}/edit', [App\Http\Controllers\StockController::class, 'edit'])->name('stocks.edit');
Route::put('/stocks/{stock}', [App\Http\Controllers\StockController::class, 'update'])->name('stocks.update');
Route::delete('/stocks/{stock}', [App\Http\Controllers\StockController::class, 'destroy'])->name('stocks.destroy');
Route::get('/stocks/search', 'StockController@search');
// Route::get('/stocks/transfer', [App\Http\Controllers\StockController::class, 'transfer'])->name('stocks.transfer');
Route::post('/transfers', [App\Http\Controllers\StockController::class, 'transferStore'])->name('transfers.store');

use App\Http\Controllers\SaleController;
Route::get('/sales/new', [App\Http\Controllers\SaleController::class, 'new'])->name('sales.new');

Route::get('/sales/new_user', [App\Http\Controllers\SaleController::class, 'new_user'])->name('sales.new_user');
Route::get('/sales/create/{user}', [App\Http\Controllers\SaleController::class, 'create'])->name('sales.create');

Route::get('/sales/kit', [App\Http\Controllers\SaleController::class, 'kit'])->name('sales.kit');
Route::get('/sales/bill/{stockId}{userId}', [App\Http\Controllers\SaleController::class, 'bill'])->name('sales.bill');
Route::get('/sales/bizpro', [App\Http\Controllers\SaleController::class, 'bizpro'])->name('sales.bizpro');


Route::get('/sales/search', 'SaleController@search');
Route::get('/sales/search_user', 'SaleController@search_user');

Route::get('/sales/newrefsale', [App\Http\Controllers\SaleController::class, 'newrefsale'])->name('sales.newrefsale');


