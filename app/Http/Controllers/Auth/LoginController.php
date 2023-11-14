<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //  protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated()
    {
        if(Auth::user()->user_role == 0)
        {
        return redirect('users/dashboard')->with('status','Welcome to Dashboard');
        }
        if(Auth::user()->user_role == 1)
        {
        return redirect('admin/dashboard')->with('status','Welcome to Dashboard');
        }
        if(Auth::user()->user_role == 2)
        {
        return redirect('stores/dashboard')->with('status','Welcome to Dashboard');
        }
        if(Auth::user()->user_role == 3)
        {
        return redirect('warehouses/dashboard')->with('status','Welcome to Dashboard');
        }
        if(Auth::user()->user_role == 4)
        {
        return redirect('subwarehouses/dashboard')->with('status','Welcome to Dashboard');
        }
        if(Auth::user()->user_role == 5)
        {
        return redirect('employees/dashboard')->with('status','Welcome to Dashboard');
        }
        else
        {
        return redirect('welcome');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
