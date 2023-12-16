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

    $user = Auth::user();

    return view('sales.kit', ['stocks' => $stocks, 'user' => $user]);
}

}
