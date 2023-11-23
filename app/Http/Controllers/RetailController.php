<?php

namespace App\Http\Controllers;

use App\Models\Retail;
use App\Models\User;
use Illuminate\Http\Request;

class RetailController extends Controller
{
    // Display a listing of the stores.
    public function index()
    {
        $retails = Retail::all();
        return view('retails.index', compact('retails'));
    }

    // Show the form for creating a new store.
    public function create()
    {
        $users = User::all();
        return view('retails.create', compact('users'));
    }

    // Store a newly created store in the database.
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'store_add' => 'required|string',
            'city' => 'required|string',
            'manager' => 'required|string',
            'mobile_no' => 'required|string|size:10',
        ]);

        Retail::create($request->all());

        return redirect()->route('retails.index')->with('success', 'Retail store created successfully!');
    }

    // Display the specified store.
    public function show(Retail $retail)
    {
        return view('retails.show', compact('retail'));
    }

    // Show the form for editing the specified store.
    public function edit(Retail $retail)
    {
        $users = User::all();
        return view('retails.edit', compact('retail', 'users'));
    }

    // Update the specified store in the database.
    public function update(Request $request, Retail $retail)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'store_add' => 'required|string',
            'city' => 'required|string',
            'manager' => 'required|string',
            'mobile_no' => 'required|string|size:10',
        ]);

        $retail->update($request->all());

        return redirect()->route('retails.index')->with('success', 'Retail store updated successfully!');
    }

    // Remove the specified store from the database.
    public function destroy(Retail $retail)
    {
        $retail->delete();

        return redirect()->route('retails.index')->with('success', 'Retail store deleted successfully!');
    }
}
