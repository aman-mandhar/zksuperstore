<?php

namespace App\Http\Controllers\store;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User; // Assuming you have a User model

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return view('stores.index', compact('stores'));
    }

    public function create()
    {
        $users = User::all(); // You might want to pass a list of users to select a manager
        return view('stores.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_add' => 'required|string',
            'manager_user_id' => 'required|exists:users,id',
            'manager' => 'required|string',
            'mobile_no' => 'required|string',
        ]);

        Store::create($request->all());

        return redirect()->route('stores.index')->with('success', 'Store created successfully.');
    }

    public function edit(Store $store)
    {
        $users = User::all();
        return view('stores.edit', compact('store', 'users'));
    }

    public function update(Request $request, Store $store)
    {
        $request->validate([
            'store_add' => 'required|string',
            'manager_user_id' => 'required|exists:users,id',
            'manager' => 'required|string',
            'mobile_no' => 'required|string',
        ]);

        $store->update($request->all());

        return redirect()->route('stores.index')->with('success', 'Store updated successfully.');
    }

    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->route('stores.index')->with('success', 'Store deleted successfully.');
    }
}
