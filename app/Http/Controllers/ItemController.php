<?php

// app\Http\Controllers\ItemController.php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\ProductVariation;
class ItemController extends Controller
{
    // Display a listing of the items.
    public function index()
    {
        $items = Item::all();
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        $variations = ProductVariation::all();
        return view('items.index', compact('items', 'categories', 'subcategories', 'variations'));
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
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        $variations = ProductVariation::all();
        return view('items.create', compact('categories', 'subcategories', 'variations'));
    }

    // Store a newly created item in storage.
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'prod_cat' => 'required|exists:product_categories,id',
        'type' => 'required|string|max:255',
        'gst' => 'required|numeric|max:255',
        'prod_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'subcategory_id' => 'nullable|exists:product_subcategories,id',
        'variation_id' => 'nullable|exists:product_variations,id',
    ]);

    if ($request->hasFile('prod_pic')) {
        $image = $request->file('prod_pic');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $validatedData['prod_pic'] = 'images/'.$imageName;
    }

    $item = Item::create($validatedData);

    // Associate with subcategory if provided
    if ($request->has('subcategory_id')) {
        $item->subcategory()->associate(ProductSubcategory::find($request->subcategory_id));
    }

    // Associate with variation if provided
    if ($request->has('variation_id')) {
        $item->variation()->associate(ProductVariation::find($request->variation_id));
    }

    $item->save();

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
    
    
    public function categories()
    {
        $categories = ProductCategory::all();
        return view('items.categories', compact('categories'));
    }

    public function search_category(Request $request)
{   
    $searchTerm = $request->term;

    $categories = ProductCategory::where('name', 'like', '%' . $searchTerm . '%')
        ->pluck('name', 'id');

    return response()->json($categories);
}

    public function search_subcategory(Request $request)
{
    $searchTerm = $request->term;

    $subcategories = ProductSubcategory::where('name', 'like', '%' . $searchTerm . '%')
        ->pluck('name', 'id');

    return response()->json($subcategories);
}

    public function search_variation(Request $request)

{
    $searchTerm = $request->term;

    $variations = ProductVariation::where('name', 'like', '%' . $searchTerm . '%')
        ->pluck('name', 'id');

    return response()->json($variations);
}

    public function categoryStore(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category = ProductCategory::create($validatedData);

    return redirect()->route('items.categories')->with('success', 'Category created successfully.');
}

    public function subcategoryStore(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:product_categories,id',
    ]);

    $subcategory = ProductSubcategory::create($validatedData);

    // Associate with category
    $subcategory->category()->associate(ProductCategory::find($request->category_id));
    $subcategory->save();
    
    return redirect()->route('items.subcategories')->with('success', 'Subcategory created successfully.');
}

    public function variationStore(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'subcategory_id' => 'required|exists:product_subcategories,id',
    ]);

    $variation = ProductVariation::create($validatedData);

    // Associate with subcategory

    $variation->subcategory()->associate(ProductSubcategory::find($request->subcategory_id));
    $variation->save();

    return redirect()->route('items.variations')->with('success', 'Variation created successfully.');
}


    public function subcategories()
    {
        $subcategories = ProductSubcategory::with('category')->get();
        $categories = ProductCategory::all();
        return view('items.subcategories', compact('subcategories', 'categories'));
    }

    public function variations()
    {
        $variations = ProductVariation::with('subcategory')->get();
        $subcategories = ProductSubcategory::with('category')->get();
        $items = Item::all();
        
        return view('items.variations', compact('variations', 'subcategories', 'items'));
    }

    public function categoryDestroy($id)
{
    $category = ProductCategory::findOrFail($id);
    $category->delete();

    return redirect()->route('items.categories')->with('success', 'Category deleted successfully.');
}

    public function subcategoryDestroy($id)
{
    $subcategory = ProductSubcategory::findOrFail($id);
    $subcategory->delete();

    return redirect()->route('items.subcategories')->with('success', 'Subcategory deleted successfully.');
}

    public function variationDestroy($id)
{
    $variation = ProductVariation::findOrFail($id);
    $variation->delete();

    return redirect()->route('items.variations')->with('success', 'Variation deleted successfully.');
}



}