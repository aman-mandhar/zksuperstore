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
    /**
     * Display a listing of the items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Need to fetch some additional data for the form, e.g., a list of items
        $items = Item::pluck('name', 'id');
        $itemTypes = Item::pluck('type', 'id');
    
        return view('stocks.add', compact('items', 'itemTypes'));
        
            }

    /**
     * Store a newly created item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'item_id' => 'required|exists:items,id',
            'measure', 
            'qrcode',
            'pur_value',
            'tot_no_of_items',
            'mrp',
            'pur_bill_no',
            'merchant',
            'sale_price',
            'tot_points',
            'wh_id',
            // Add other validation rules for other fields
        ]);
        $validatedData['wh_id'] = auth()->user()->id;

        // Create a new stock instance
        Stock::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('stocks.index')->with('success', 'Stock added successfully!');
    }

    /**
     * Show the form for editing the specified item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the stock by ID
        $stock = Stock::findOrFail($id);

        // You might need to fetch some additional data for the form, e.g., a list of items
        $items = Item::all();
        return view('stocks.edit', compact('stock', 'items'));

        
    }

    /**
     * Update the specified item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'item_id' => 'required|exists:items,id',
            'measure', 
            'qrcode',
            'pur_value',
            'tot_no_of_items',
            'mrp',
            'pur_bill_no',
            'merchant',
            'sale_price',
            'tot_points',
            'wh_id',
            // Add other validation rules for other fields
        ]);

        // Find the stock by ID and update it
        $stock = Stock::findOrFail($id);
        $stock->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully!');
    }

    /**
     * Remove the specified item from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        // Delete the stock
        $stock->delete();

        // Redirect to the index page with a success message
        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully!');
    }
}


