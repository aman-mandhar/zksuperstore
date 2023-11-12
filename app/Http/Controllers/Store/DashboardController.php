<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use AuthenticatesUsers;

class DashboardController extends Controller

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

{
    protected function authenticated()
    {
        if(Auth::user()->user_role == 2)
        {
        return redirect('store/dashboard')->with('status','Welcome to Dashboard');
        }
    }

    
    public function index()
    {
       return view('stores.dashboard');
    }
}
