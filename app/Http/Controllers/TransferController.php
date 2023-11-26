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
    $search = $request['search'] ?? "";

    if ($search != "") {
        $stocks = Stock::where('name', 'LIKE', $search)->get();
    } else {
        $stocks = Stock::all();
    }
    

    $transfers = Transfer::all();
    $items = Item::all();
    $users = User::all();
    $retails = Retail::all();
    $subwarehouses = Subwarehouse::all();

    return view('transfers.index', compact('transfers', 'items', 'stocks', 'users', 'retails', 'subwarehouses'));
}

    public function create(Request $request)
{
    $search = $request['search'] ?? "";
    if ($search != "") {
        // Where statement for search
        $stocks = Stock::where('name', 'LIKE', "%$search%")->get(); 
    } else {
        $stocks = Stock::all();
    }

    $transfers = Transfer::all();
    $items = Item::all();
    $users = User::all();
    $retails = Retail::all();
    $subwarehouses = Subwarehouse::all();

    return view('transfers.create', compact('transfers', 'items', 'stocks', 'users', 'retails', 'subwarehouses'));
    
    
    
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
    public function show(Transfer $transfer)
    {
        return view('transfers.show', ['transfer' => $transfer]);
    }
    public function edit(transfer $transfer)
    {
        // You might need to pass some data to the view, e.g., a list of items
        $transfers = Transfer::all();
        $items = Item::all();
        $stocks = Stock::all();
        $users = User::all();
        $retails = Retail::all();
        $subwarehouses = Subwarehouse::all();
        return view('transfers.edit', [
        'transfers' => $transfers,
        'items' => $items,
        'stocks' => $stocks,
        'users' => $users,
        'retails' => $retails,
        'subwarehouses' => $subwarehouses,]);
    }

    public function update(Request $request, transfer $transfer)
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

        // Update the stock record
        $transfer->update($validatedData);

        // Redirect to the index page or show the updated stock details
        return redirect()->route('transfers.index')->with('success', 'Stock transfer updated successfully');
    }
    public function destroy(transfer $transfer)
    {
        // Delete the stock record
        $transfer->delete();

        // Redirect to the index page or show a success message
        return redirect()->route('transfers.index')->with('success', 'Stock transfer deleted successfully');
    }

    public function addToCart(Request $request, $stockId)
    {
        // Find the stock by ID
        $stock = Stock::find($stockId);

        if (!$stock) {
            return redirect()->route('stocks.index')->with('error', 'Stock not found.');
        }

        // Add the stock to the cart
        $cartItem = [
            'stock_id' => $stock->id,
            'qty' => $request->input('qty', 1), // Assuming the quantity is provided in the request
            'weight' => $request->input('weight', 0.000), // Assuming the weight is provided in the request
            'points' => $stock->points, // Assuming points are associated with the stock
            'user_id' => Auth::id(), // Assuming the user is authenticated
        ];

        // Create a new Transfer record in the database
        Transfer::create($cartItem);

        return redirect()->route('transfer.create')->with('success', 'Stock added to cart.');
    }
}



