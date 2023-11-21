<?php

// app\Http\Controllers\ItemController.php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        ->pluck('name', 'id');

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

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'prod_cat' => 'required|string',
            'prod_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust validation as needed
        ]);

        $item->update($request->all());

        // Handle image upload if a new image is provided
        if ($request->hasFile('prod_pic')) {
            $imagePath = $request->file('prod_pic')->store('public/images');
            $item->prod_pic = $imagePath;
            $item->save();
        }

        return redirect()->route('items.index')->with('success', 'Item updated successfully');
    }
    
    
    // Remove the specified item from storage.
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}

