<?php

// app\Http\Controllers\ItemController.php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ItemController extends Controller
{
    // Display a listing of the items.
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function search(Request $request)
{
    $searchTerm = $request->term;

    $items = Item::where('name', 'like', '%' . $searchTerm . '%')
        ->pluck('name', 'id', 'gst', 'type');

    return response()->json($items);
}


    // Show the form for creating a new item.
    public function create()
    {
        return view('items.create');
    }

    // Store a newly created item in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'prod_cat' => 'required|string',
            'type' => 'required|string|max:255',
            'gst' => 'required|numeric|max:255',
            'prod_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('prod_pic')) {
            $image = $request->file('prod_pic');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['prod_pic'] = 'images/'.$imageName;
        }

        Item::create($validatedData);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);

        return view('items.edit', compact('item'));
    }

    public function update(Request $request, $id)
{
    $item = Item::findOrFail($id);

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'prod_cat' => 'required|string',
        'type' => 'required|string|max:255',
        'gst' => 'required|numeric|max:255',
        'prod_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('prod_pic')) {
        $image = $request->file('prod_pic');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $validatedData['prod_pic'] = 'images/'.$imageName;
    }

    // Update all fields using validated data
    $item->update($validatedData);

    return redirect()->route('items.index')->with('success', 'Item updated successfully');
}

    
    
    // Remove the specified item from storage.
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}

