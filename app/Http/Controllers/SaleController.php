<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Stock;
use App\Models\Transfer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class SaleController extends Controller
{
    public function kit()
{
    $stocks = Stock::with(['item' => function ($query) {
            $query->where('prod_cat', '=', 'Service');
        }])
        ->get();

    $items = Item::all();

    return view('sales.kit', ['stocks' => $stocks, 'items' => $items]);
}

    public function bizpro()
{
    $users = user::where ('user_role' , '=' , '9')->get();

    return view('sales.bizpro', ['users' => $users]);
}

    public function bill($stockId)
{
    $stock = Stock::find($stockId);
    $users = User::all();
    $items = Item::all();

    return view('sales.bill', ['stock' => $stock, 'users' => $users, 'items' => $items]);

}

    public function search(Request $request)
{
    $request->validate([
        'mobile_number' => 'required|numeric',
    ]);

    $user = User::where('mobile_number', $request->mobile_number)->first();

    return view('sales.bill', ['user' => $user]);
}
    
}