<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use AuthenticatesUsers;
use Livewire\Providers\LivewireServiceProvider;

class RegisterController extends Controller
{
    use RegistersUsers;

    

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
        return redirect('/');
        }
    }


    protected $redirectTo = RouteServiceProvider::HOME;



    public function __construct()
    {
        $this->middleware('guest');
    }

   

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile_number' => ['required', 'string', 'unique:users', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'gst_no' => ['nullable', 'string', 'max:255'],
        ]);
    }

    protected function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'mobile_number' => $data['mobile_number'],
        'ref_mobile_number' => $data['ref_mobile_number'],
        'password' => Hash::make($data['password']),
        'user_role' => $data['user_role'], // Use the value from the form
        'city' => $data['city'],
        'gst_no' => $data['gst_no'],
    ]);
    
}

public function showRegistrationForm()
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

        return view('auth.register', compact('cities'));
    }

}
