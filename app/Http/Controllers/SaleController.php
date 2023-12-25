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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function new(Request $request)
{
    $search = $request->get('search');
    if ($search != null) {
        $user = User::where('mobile_number', '=', $search)->get();
        if ($user->isEmpty()) {
            $cities = [
                'Amritsar',
                'Ludhiana',
                'Jalandhar',
                'Patiala',
                'Bathinda',
                'Pathankot',
                'Mohali',
                'Hoshiarpur',
                'Moga',
                'Firozpur',
                'Sangrur',
                'Barnala',
                'Faridkot',
                'Fatehgarh Sahib',
                'Rupnagar',
                'Gurdaspur',
                // Add more cities as needed
        ];
            return view('sales.new_user', ['search' => $search], ['cities' => $cities], ['search' => $search]);
        }
        else {
            $user = User::where('mobile_number', '=', $search)->first();
            $items = Item::all();
            $stocks = Stock::all();
            return view('sales.create', ['user' => $user, 'items' => $items, 'stocks' => $stocks]);
        }
        $items = Item::all();
        $stocks = Stock::all();
        return view('sales.create', ['users' => $user], ['items' => $items], ['stocks' => $stocks]);
    }
        elseif 
        
        ($search == null) {
        return view('sales.new');
    } 
        else {
        $cities = [
            'Amritsar',
            'Ludhiana',
            'Jalandhar',
            'Patiala',
            'Bathinda',
            'Pathankot',
            'Mohali',
            'Hoshiarpur',
            'Moga',
            'Firozpur',
            'Sangrur',
            'Barnala',
            'Faridkot',
            'Fatehgarh Sahib',
            'Rupnagar',
            'Gurdaspur',
            // Add more cities as needed
        ];
       
        return view('sales.new_user', ['cities' => $cities], ['search' => $search]);
    }
    
}
    public function create($userId)
{
    $user = User::find($userId);
    $items = Item::all();
    $stocks = Stock::all();
    
    return view('sales.create', ['user' => $user, 'items' => $items, 'stocks' => $stocks]);
}

    public function bill($stockId, $userId)
{
    $stock = Stock::find($stockId);
    $user = User::find($userId);
    $items = Item::all(); 

    return view('sales.bill', ['stock' => $stock, 'users' => $user, 'items' => $items]);

}

    public function search(Request $request)
{
    $request->validate([
        'mobile_number' => 'required|numeric',
    ]);

    $user = User::where('mobile_number', $request->mobile_number)->first();

    return view('sales.bill', ['user' => $user]);
}

public function newrefsale(Request $request)
{
    $search = $request->get('search');
    if ($search != null) {
        $user = User::where('mobile_number', '=', $search)->get();
        if ($user->isEmpty()) {
            $cities = [
                'Amritsar',
                'Ludhiana',
                'Jalandhar',
                'Patiala',
                'Bathinda',
                'Pathankot',
                'Mohali',
                'Hoshiarpur',
                'Moga',
                'Firozpur',
                'Sangrur',
                'Barnala',
                'Faridkot',
                'Fatehgarh Sahib',
                'Rupnagar',
                'Gurdaspur',
                // Add more cities as needed
        ];
            return view('sales.newrefsale', ['search' => $search], ['cities' => $cities], ['search' => $search]);
        }
        else {
            $user = User::where('mobile_number', '=', $search)->first();
            $items = Item::all();
            $stocks = Stock::all();
            return view('sales.create', ['user' => $user, 'items' => $items, 'stocks' => $stocks]);
        }
        $items = Item::all();
        $stocks = Stock::all();
        return view('sales.create', ['users' => $user], ['items' => $items], ['stocks' => $stocks]);
    }
        elseif 
        
        ($search == null) {
        return view('sales.newrefsale');
    } 
        else {
        $cities = [
            'Amritsar',
            'Ludhiana',
            'Jalandhar',
            'Patiala',
            'Bathinda',
            'Pathankot',
            'Mohali',
            'Hoshiarpur',
            'Moga',
            'Firozpur',
            'Sangrur',
            'Barnala',
            'Faridkot',
            'Fatehgarh Sahib',
            'Rupnagar',
            'Gurdaspur',
            // Add more cities as needed
        ];
       
        return view('sales.newrefsale', ['cities' => $cities], ['search' => $search]);
    }
    
}
    public function create_new_ref_sale($userId)
{
    $user = User::find($userId);
    $items = Item::all();
    $stocks = Stock::all();
    
    return view('sales.create_new_ref_sale', ['user' => $user, 'items' => $items, 'stocks' => $stocks]);
}

    public function bill_new_ref_sale($stockId, $userId)
{
    $stock = Stock::find($stockId);
    $user = User::find($userId);
    $items = Item::all(); 

    return view('sales.bill_new_ref_sale', ['stock' => $stock, 'users' => $user, 'items' => $items]);

}

    public function search_new_ref_sale(Request $request)
{
    $request->validate([
        'mobile_number' => 'required|numeric',
    ]);

    $user = User::where('mobile_number', $request->mobile_number)->first();

    return view('sales.bill_new_ref_sale', ['user' => $user]);
    
}
}