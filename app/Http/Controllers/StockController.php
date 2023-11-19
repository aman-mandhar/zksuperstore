<?php

// app\Http\Controllers\StockController.php
namespace App\Http\Controllers;

use App\Models\Stock;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class StockController extends Controller
{
    // Display a listing of the items.
    public function index()
    {
        $stocks = Stock::all();
        return view('Stocks.index', compact('Stocks'));
    }

    // Show the form for creating a new item.
    public function create()
    {
        return view('Stocks.add');
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
        'wh_id' => 'required',
        'sub_wh_id',
        'store_id',
        'customer_id',
        'ref_id',
        'order_id',
        'order_date',
        ]);

        Stock::create($validatedData);

        return redirect()->route('Stocks.index')->with('success', 'Stock created successfully.');
    }

    public function edit($id)
    {
        $stocks = Stock::findOrFail($id);

        return view('Stocks.edit', compact('stock'));
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
            'wh_id' => 'required',
            'sub_wh_id',
            'store_id',
            'customer_id',
            'ref_id',
            'order_id',
            'order_date',    
        ]);

        $stocks->update($request->all());

        return redirect()->route('Stocks.index')->with('success', 'Item updated successfully');
    }
    
    
    // Remove the specified item from storage.
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('Stocks.index')->with('success', 'Item deleted successfully.');
    }
}

