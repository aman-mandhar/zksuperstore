<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Retrieve all users from the users table
        return view('users.index', ['users' => $users]); // Pass users data to the view
    }

    public function create()
    {
        $cities = [
            'Amritsar',
            'Ludhiana',
            'Jalandhar',
            'Patiala',
            'Bathinda',
            'Pathankot',
            'Mohali',
            'Hoshiarpur',
            'Moga',
            'Firozpur',
            'Sangrur',
            'Barnala',
            'Faridkot',
            'Fatehgarh Sahib',
            'Rupnagar',
            'Gurdaspur',
            // Add more cities as needed
        ];
        return view('users.create', ['cities' => $cities]);
    }

    public function store(Request $request)
    {
        {
            // Validate the form data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'mobile_number' => 'required|numeric|digits:10|unique:users',
                'ref_mobile_number' => 'required|numeric|digits:10',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'user_role' => 'required|integer|in:0,1,2,3,4,5,6,7,8,9', // Use the allowed integer values
                'city' => 'required|string|max:255',
                'gst_no' => 'nullable|string|max:255',
            ]);
    
            // Create the new user
            $user = User::create($validatedData);
    
            // You can redirect the user wherever you want after creation
            return redirect()->route('users.index')->with('success', 'User created successfully!');
        }
    }
}

