<?php

// app\Http\Controllers\ItemController.php
namespace App\Http\Controllers\Admin;

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
            'Description' => 'required|string',
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

    // Show the form for editing the specified item.
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    // Update the specified item in storage.
    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'Description' => 'required|string',
            'prod_cat' => 'required|string',
            'prod_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('prod_pic')) {
            $image = $request->file('prod_pic');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['prod_pic'] = 'images/'.$imageName;
        }

        $item->update($validatedData);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    // Remove the specified item from storage.
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
