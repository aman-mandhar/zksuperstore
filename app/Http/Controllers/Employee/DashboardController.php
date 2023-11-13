<?php 
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

class DashboardController extends Controller
{
    protected function authenticated()
    {
        if(Auth::user()->user_role == 0)
        {
        return redirect('/')->with('status','Welcome to Dashboard');
        }
        if(Auth::user()->user_role == 1)
        {
        return redirect('admin/dashboard')->with('status','Welcome to Dashboard');
        }
        if(Auth::user()->user_role == 2)
        {
        return redirect('store/dashboard')->with('status','Welcome to Dashboard');
        }
        if(Auth::user()->user_role == 3)
        {
        return redirect('warehouse/dashboard')->with('status','Welcome to Dashboard');
        }
        if(Auth::user()->user_role == 4)
        {
        return redirect('sub-warehouse/dashboard')->with('status','Welcome to Dashboard');
        }
        if(Auth::user()->user_role == 5)
        {
        return redirect('employee/dashboard')->with('status','Welcome to Dashboard');
        }
        else
        {
        return redirect('welcome');
        }
    }

    
    public function index()
    {
        return view('employees.dashboard');
    }
}
