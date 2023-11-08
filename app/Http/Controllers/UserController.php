<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Retrieve all users from the users table
        return view('users.index', ['users' => $users]); // Pass users data to the view
    }
}
