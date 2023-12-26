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
                'mobile_number' => 'required|string|regex:/^[0-9]{10}$/|unique:users,mobile_number',
                'ref_mobile_number' => 'required|string|regex:/^[0-9]{10}$/',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'user_role' => 'required|integer|in:0,1,2,3,4,5,6,7,8,9', // Use the allowed integer values
                'city' => 'required|string|max:255',
                'gst_no' => 'nullable|string|max:255',
            ]);
    
            // Create the new user
            $user = User::create($validatedData);
    
            // You can redirect the user wherever you want after creation
            return redirect()->route('users.create')->with('success', 'User created successfully!');
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id); // Find user of id = $id
        $users = User::all();
        $Refname = User::where('mobile_number', $user->ref_mobile_number)->get();
        return view('users.show', ['user' => $user, 'users' => $users, 'Refname' => $Refname]);
    }

    public function getReferralName(Request $request)
{
    $referralMobileNumber = $request->input('referralMobileNumber');
    $referralUser = User::where('mobile_number', $referralMobileNumber)->first();

    return response()->json(['name' => $referralUser ? $referralUser->name : null]);

}
    

    public function edit($id)
    {
        $user = User::findOrFail($id); // Find user of id = $id
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
        return view('users.edit', ['user' => $user, 'cities' => $cities]);
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'mobile_number' => 'required|string|regex:/^[0-9]{10}$/|unique:users,mobile_number,'.$id,
            'user_role' => 'required|integer|in:0,1,2,3,4,5,6,7,8,9', // Use the allowed integer values
            'city' => 'required|string|max:255',
            'gst_no' => 'nullable|string|max:255',
        ]);

        // Update the user
        $user = User::findOrFail($id); // Find user of id = $id
        $user->update($validatedData);

        // You can redirect the user wherever you want after updation
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Find user of id = $id
        $user->delete();

        // You can redirect the user wherever you want after deletion
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }   

    public function roles($id)
    {
        $users = User::all(); // Retrieve all users from the users table
        $user = User::findOrFail($id); // Find user of id = $id
        return view('users.roles', ['users' => $users, 'user' => $user]); // Pass users data to the view
    }

    public function roleUpdate(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'user_role' => 'required|integer|in:0,1,2,3,4,5,6,7,8,9', // Use the allowed integer values
        ]);

        // Update the user
        $user = User::findOrFail($id); // Find user of id = $id
        $user->update($validatedData);

        // You can redirect the user wherever you want after updation
        return redirect()->route('users.roles')->with('success', 'User role updated successfully!');
    }
}

