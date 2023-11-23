<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\transfer;
use App\Models\Stock;
use App\Models\User;
use App\Models\Retail;
use App\Models\Subwarehouse;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use AuthenticatesUsers;
use Illuminate\Http\Request;


class TransferController extends Controller
{
    public function index()
    {
        $transfers = Transfer::all();
        $items = Item::all();
        $stocks = Stock::all();
        $users = User::all();
        $retails = Retail::all();
        $subwarehouses = Subwarehouse::all();
        return view('transfers.index', ['transfers' => $transfers], ['items' => $items], ['stocks' => $stocks], ['users' => $users], ['retails' => $retails], ['subwarehouses' => $subwarehouses],);
    }

    public function create()
    {
        $transfers = Transfer::all();
        $items = Item::all();
        $stocks = Stock::all();
        $users = User::all();
        $retails = Retail::all();
        $subwarehouses = Subwarehouse::all();
        return view('transfers.create', ['transfers' => $transfers], ['items' => $items], ['stocks' => $stocks], ['users' => $users], ['retails' => $retails], ['subwarehouses' => $subwarehouses],);
    }

    public function store(Request $request)
    {
        // Validate the request data as needed
        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'weight' => 'nullable|numeric',
            'qty' => 'nullable|integer',
            'subwarehouse_id' => 'nullable|exists:subwarehouses,id',
            'retail_id' => 'nullable|exists:retails,id',
            'customer_id' => 'nullable|exists:users,id',
                     
            // Add other validation rules for your fields
        ]);

        // Create a new stock record
        $transfer = Transfer::create($validatedData);

        // Redirect to the index page or show the created stock details
        return redirect()->route('transfers.index')->with('success', 'Stock transfered successfully');
    }
}
