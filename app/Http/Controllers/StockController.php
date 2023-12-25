<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Models\Transfer;
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
    $stocks = Stock::with(['item' => function ($query) {
            $query->where('prod_cat', '!=', 'Service');
        }])
        ->get();

    $user = Auth::user();

    return view('stocks.index', ['stocks' => $stocks, 'user' => $user]);
}

public function bizpro()
{
    $stocks = Stock::with(['item' => function ($query) {
            $query->where('prod_cat', '=', 'Service');
        }])
        ->get();

    $user = Auth::user();

    return view('stocks.bizpro', ['stocks' => $stocks, 'user' => $user]);
}    
    

public function bill($stockId)
{    
    return redirect()->route('stocks.index');
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
        'merchant' => 'nullable',
        'measure' => 'nullable',
        'tot_no_of_items' => 'nullable',
        'pur_value' => 'required|numeric',
        'gst' => 'required|numeric',
        'mrp' => 'required|numeric',
        'sale_price' => 'required|numeric',
        'tot_points' => 'nullable|numeric',
        'pur_bill_no' => 'nullable|string',
        'pur_bill_date' => 'nullable|date_format:Y-m-d',
        'pur_bill_pic' => 'nullable|string',
        'qrcode' => 'nullable|string',
        'barcode' => 'nullable|string',
        'batch_no' => 'nullable|string',
        'mfg_date' => 'nullable|date_format:Y-m-d',
        'exp_date' => 'nullable|date_format:Y-m-d',
        'status' => 'nullable|string',
        'remarks' => 'nullable|string',
        'user_id' => Auth::check() ? 'nullable|numeric' : 'nullable', // Updated validation rule
    ]);

    // Add the current logged-in user_id to the validated data
    if (Auth::check()) {
        $validatedData['user_id'] = Auth::id();
    } else {
        // Log or debug message to check if this block is executed
        return "No";
    }

    // Create a new stock entry
    $stock = new Stock($validatedData);

    // Save the stock entry
    $stock->save();

    // Redirect to the desired route
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
        $subwarehouse = User::where('user_role', '=', '4')->get();
        $store = User::where('user_role', '=', '2')->get();
        $warehouse = User::where('user_role', '=', '3')->get();
        $user = Auth::user();
        return view('stocks.transfer', [
            'stock' => $stock,
            'subwarehouse' => $subwarehouse,
            'store' => $store,
            'warehouse' => $warehouse,
            'user' => $user,
        ]);
    }

    public function transferStore(Request $request, Stock $stock)
    {
        // Validate the request data as needed
        $validatedData = $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'item_id' => 'required|exists:items,id',
            'measure' => 'nullable|numeric',
            'tot_no_of_items' => 'nullable|integer',
            'points' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'status' => 'required|string',
            'user_id' => Auth::check() ? 'nullable|numeric' : 'nullable', // Updated validation rule
            // Add other validation rules for your fields
        ]);

        // Ensure that measure and tot_no_of_items are not negative
            if ($request->has('measure') && $validatedData['measure'] < 0) {
                return redirect()->route('stocks.index')->with('success', 'Stock transfered request not submitted');
            }

            if ($request->has('tot_no_of_items') && $validatedData['tot_no_of_items'] < 0) {
                return redirect()->route('stocks.index')->with('success', 'Stock transfered request not submitted');
            }

            if (Auth::check()) {
            $validatedData['user_id'] = Auth::id();
            } else {
            // Log or debug message to check if this block is executed
            return "No";
            }
    
        // Create a new stock entry
        $transfer = new Transfer($validatedData);
    
        // Save the stock entry
        $transfer->save();
    
        // Redirect to the desired route
        return redirect()->route('stocks.index')->with('success', 'Stock transfered request successfully submitted');
    }

    public function destroy(Stock $stock)
    {
        // Delete the stock record
        $stock->delete();

        // Redirect to the index page or show a success message
        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully');
    }

}
