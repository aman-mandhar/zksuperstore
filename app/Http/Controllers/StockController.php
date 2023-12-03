<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Models\User;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use AuthenticatesUsers;

class StockController extends Controller
{
    public function index()
{
    // Assuming you want to get all users with user_role = 6 as merchants
    $merchants = User::where('user_role', '=', '6')->get();

    // Fetch all stocks
    $stocks = Stock::all();

    // Pass the fetched data to the view
    return view('stocks.index', [
        'stocks' => $stocks,
        'merchants' => $merchants,
    ]);
}

    public function add($itemId)
    {
        // Retrieve the item details
        $item = Item::findOrFail($itemId);

        // Retrieve the merchants
        $merchants = User::where('user_role', '=', '6')->get();

        return view('stocks.add', [
            'item' => $item,
            'merchants' => $merchants,
        ]);
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'prod_pic' => 'required|string', // Adjust the validation rules accordingly
            'name' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string',
            'prod_cat' => 'required|string',
            'merchant' => 'required',
            'measure' => 'nullable|numeric', // Add validation rules for other fields as needed
            'tot_no_of_items' => 'nullable|integer',
            'pur_value' => 'required|numeric',
            'gst' => 'required|numeric',
            'mrp' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'tot_points' => 'nullable|numeric',
            'cash_discount' => 'nullable|numeric',
            'pur_bill_no' => 'nullable|numeric',
        ]);

        // Add the current logged-in user_id to the validated data
        $validatedData['user_id'] = Auth::id();

        // Create a new stock entry
        $stock = new Stock($validatedData);

        // Save the stock entry
        $stock->save();

        // Redirect or return a response as needed
        return redirect()->route('items.index')->with('success', 'Stock added successfully');
    }
    
    public function show(Stock $stock)
    {
        
        return view('stocks.show', ['stock' => $stock]);
    }

    public function edit(Stock $stock)
    {
        // You might need to pass some data to the view, e.g., a list of items
        $items = Item::all(); // Assuming you have an Item model
        return view('stocks.edit', ['stock' => $stock, 'items' => $items]);
    }

    public function update(Request $request, Stock $stock)
    {
        // Validate the request data as needed
        $validatedData = $request->validate([
        'selected_items.*' => 'required|exists:items,id',
        'prod_pics.*' => 'required|string',
        'name' => 'required',
        'description' => 'required',
        'type' => 'required',
        'prod_cat' => 'required',
        'measure' => 'nullable|numeric',
        'tot_no_of_items' => 'nullable|integer',
        'pur_value' => 'required|numeric',
        'cgst' => 'nullable|numeric',
        'sgst' => 'nullable|numeric',
        'mrp' => 'required|numeric',
        'sale_price' => 'required|numeric',
        'gst' => 'required',
        'tot_points' => 'required|numeric',
        'pur_bill_no' => 'required|string',
        'merchant' => 'required|string',
        'user_id' => 'required|exists:users,id',
        'qrcode' => 'nullable|string',
            // Add other validation rules for your fields
        ]);

        // Update the stock record
        foreach ($validatedData['selected_items'] as $key => $selectedItemId) {
        $stock->update([
            'item_id' => $selectedItemId,
            'prod_pic' => $validatedData['prod_pics'][$key],
            'name' => 'required',
            'description' => $validatedData['description'][$key],
            'type' => $validatedData['types'][$key],
            'prod_cat' => $validatedData['prod_cat'][$key],
            'measure' => 'nullable|numeric',
            'tot_no_of_items' => 'nullable|integer',
            'pur_value' => 'required|numeric',
            'cgst' => 'nullable|numeric',
            'sgst' => 'nullable|numeric',
            'mrp' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'gst' => $validatedData['gst'][$key],
            'tot_points' => 'required|numeric',
            'pur_bill_no' => 'required|string',
            'merchant' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'qrcode' => 'nullable|string',
            // Add other fields as needed
        ]);}
        

        // Redirect to the index page or show the updated stock details
        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully');
    }

    public function transfer($stockId)
    {
        // Retrieve the item details
        $stock = Stock::findOrFail($stockId);

        // Retrieve the merchants
        $subwarehouse = User::where('user_role', '=', '4')->get();
        $store = User::where('user_role', '=', '2')->get();

        return view('stocks.transfer', [
            'stock' => $stock,
            'subwarehouse' => $subwarehouse,
            'store' => $store
        ]);
    }

    public function destroy(Stock $stock)
    {
        // Delete the stock record
        $stock->delete();

        // Redirect to the index page or show a success message
        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully');
    }

}
