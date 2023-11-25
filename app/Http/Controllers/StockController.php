<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use AuthenticatesUsers;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', ['stocks' => $stocks]);
    }

    public function create()
    {
        // You might need to pass some data to the view, e.g., a list of items
        $items = Item::all(); // Assuming you have an Item model
        return view('stocks.create', ['items' => $items]);
    }

    public function store(Request $request)
    {
        // Validate the request data as needed
        $validatedData = $request->validate([
            'name' => 'required|string',
            'measure' => 'nullable|numeric',
            'tot_no_of_items' => 'nullable|integer',
            'qrcode' => 'nullable|string',
            'pur_value' => 'required|numeric',
            'mrp' => 'required|numeric',
            'pur_bill_no' => 'required|string',
            'merchant' => 'required|string',
            'sale_price' => 'required|numeric',
            'tot_points' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            // Add other validation rules for your fields
        ]);

        // Create a new stock record
        $stock = Stock::create($validatedData);

        // Redirect to the index page or show the created stock details
        return redirect()->route('stocks.index')->with('success', 'Stock created successfully');
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
            'name' => 'required',
            'measure' => 'nullable|numeric',
            'tot_no_of_items' => 'nullable|integer',
            'qrcode' => 'nullable|string',
            'pur_value' => 'required|numeric',
            'mrp' => 'required|numeric',
            'pur_bill_no' => 'required|string',
            'merchant' => 'required|string',
            'sale_price' => 'required|numeric',
            'tot_points' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            // Add other validation rules for your fields
        ]);

        // Update the stock record
        $stock->update($validatedData);

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
