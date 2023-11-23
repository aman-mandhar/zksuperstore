<?php

namespace App\Http\Controllers;

use App\Models\Subwarehouse;
use App\Models\User;
use Illuminate\Http\Request;

class SubwarehouseController extends Controller
{
    public function index()
    {
        $subwarehouses = Subwarehouse::all();
        return view('subwarehouses.index', compact('subwarehouses'));
    }

    public function create()
    {
        $users = User::all();
        return view('subwarehouses.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'add' => 'required|string',
            'city' => 'required|string',
            'manager' => 'required|string',
            'mobile_no' => 'required|string|size:10',
        ]);

        Subwarehouse::create($request->all());

        return redirect()->route('subwarehouses.index')->with('success', 'Subwarehouse created successfully!');
    }

    public function show(Subwarehouse $subwarehouse)
    {
        return view('subwarehouses.show', compact('subwarehouse'));
    }

    public function edit(Subwarehouse $subwarehouse)
    {
        $users = User::all();
        return view('subwarehouses.edit', compact('subwarehouse', 'users'));
    }

    public function update(Request $request, Subwarehouse $subwarehouse)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'add' => 'required|string',
            'city' => 'required|string',
            'manager' => 'required|string',
            'mobile_no' => 'required|string|size:10',
        ]);

        $subwarehouse->update($request->all());

        return redirect()->route('subwarehouses.index')->with('success', 'Subwarehouse updated successfully!');
    }

    public function destroy(Subwarehouse $subwarehouse)
    {
        $subwarehouse->delete();

        return redirect()->route('subwarehouses.index')->with('success', 'Subwarehouse deleted successfully!');
    }
}
