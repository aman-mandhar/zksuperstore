<?php

// app\Http\Controllers\StockController.php
namespace App\Http\Controllers;
use App\Models\Item;

use App\Models\Stock;
use App\Http\Controllers\Controller;


use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use AuthenticatesUsers;

class StockController extends Controller
{
    // Display a listing of the items.
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('Stocks'));
    }

    // Show the form for creating a new item.
    public function create()
    {
        $items = Item::pluck('name', 'id'); // Assuming 'name' is the column in the items table you want to use
        return view('stocks.add', compact('items'));
    }

    // Store a newly created item in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'item_id' => 'required',
        'measure',
        'qrcode',
        'pur_value' => 'required',
        'tot_no_of_items' => 'required',
        'mrp' => 'required',
        'gst' => 'required',
        'cgst' => 'required',
        'transit_charges' => 'required',
        'tot_pur_value' => 'required',
        'pur_bill_no' => 'required',
        'merchant',
        'sale_price' => 'required',
        'tot_issued_points',
        'wh_id',
        ]);
        

        Stock::create($validatedData);
        $wh_id = Auth::id(); // Get the authenticated user's ID

        return redirect()->route('stocks.index')->with('success', 'Stock created successfully.');
    }

    public function edit($id)
    {
        $stocks = Stock::findOrFail($id);

        return view('stocks.edit', compact('stock'));
    }

    public function update(Request $request, $id)
    {
        $stocks = Stock::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'item_id' => 'required',
            'measure',
            'qrcode',
            'pur_value' => 'required',
            'tot_no_of_items' => 'required',
            'mrp' => 'required',
            'gst' => 'required',
            'cgst' => 'required',
            'transit_charges' => 'required',
            'tot_pur_value' => 'required',
            'pur_bill_no' => 'required',
            'merchant',
            'sale_price' => 'required',
            'tot_issued_points',            
        ]);

        $stocks->update($request->all());

        return redirect()->route('stocks.index')->with('success', 'Item updated successfully');
    }
    
    
    // Remove the specified item from storage.
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Item deleted successfully.');
    }
}

