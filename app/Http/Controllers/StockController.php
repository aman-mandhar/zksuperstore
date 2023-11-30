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

    public function create()
    {
        $items = Item::all();
        $merchants = User::where('user_role', '=', '6')->get(); // Retrieve the merchants
        return view('stocks.create', [
            'items' => $items,
            'merchants' => $merchants,
        ]);
    }
    

    public function store(Request $request)
{
    $userId = Auth::id();

    // Validation rules
    $rules = [
        'selected_items.*' => 'required|exists:items,id',
        'prod_pic.*' => 'required|string',
        'name.*' => 'required',
        'description.*' => 'required',
        'type.*' => 'required',
        'prod_cat.*' => 'required',
        'measure.*' => 'nullable|numeric',
        'tot_no_of_items.*' => 'nullable|integer',
        'pur_value.*' => 'required|numeric',
        'cgst.*' => 'nullable|numeric',
        'sgst.*' => 'nullable|numeric',
        'mrp.*' => 'required|numeric',
        'sale_price.*' => 'required|numeric',
        'gst.*' => 'required',
        'tot_points.*' => 'required|numeric',
        'pur_bill_no.*' => 'required|string',
        'merchant.*' => 'required|exists:users,id',
        'qrcode.*' => 'nullable|string',
    ];

    return view('/stocks');

    // Validate the request data
    $validatedData = $request->validate($rules);

    // Loop through the submitted items and create a stock record for each
    foreach ($validatedData['selected_items'] as $key => $selectedItemId) {
        Stock::create([
            'item_id' => $selectedItemId,
            'prod_pic' => $validatedData['prod_pic'][$key],
            'name' => $validatedData['name'][$key],
            'description' => $validatedData['description'][$key],
            'type' => $validatedData['type'][$key],
            'prod_cat' => $validatedData['prod_cat'][$key],
            'measure' => $validatedData['measure'][$key],
            'tot_no_of_items' => $validatedData['tot_no_of_items'][$key],
            'pur_value' => $validatedData['pur_value'][$key],
            'cgst' => $validatedData['cgst'][$key],
            'sgst' => $validatedData['sgst'][$key],
            'mrp' => $validatedData['mrp'][$key],
            'sale_price' => $validatedData['sale_price'][$key],
            'gst' => $validatedData['gst'][$key],
            'tot_points' => $validatedData['tot_points'][$key],
            'pur_bill_no' => $validatedData['pur_bill_no'][$key],
            'merchant' => $validatedData['merchant'][$key],
            'user_id' => $userId,
            'qrcode' => $validatedData['qrcode'][$key],
            // Add other fields as needed
        ]);
    }

    // return redirect()->route('stocks.create')->with('success', 'Stock created successfully');
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

    public function destroy(Stock $stock)
    {
        // Delete the stock record
        $stock->delete();

        // Redirect to the index page or show a success message
        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully');
    }
}
