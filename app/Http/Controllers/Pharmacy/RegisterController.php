<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Pharmacy;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function showRegistrationForm()
    {   
        return view('register');
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected function guard()
    {
       return Auth::guard('pharmacy');
    }
    public function __construct()
    {
        //dd("hello");
        $this->middleware('guest:pharmacy');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'Oname' => ['required', 'string', 'max:255'],
            'phone' => ['min:11|numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:Pharmacy'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
            ['name.required' => 'The Pharmacy Name is Required',
            'Oname.required' => 'The Pharmacy Owner Name is Required',
            'phone.numeric' => 'Phone Number Format is Wrong ',
            'password.min' => 'Password Must be 8 charchters or more',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Pharmacy::create([
            'Ph_Name' => $data['name'],
            'Ph_Owner' => $data['Oname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
        ]);
    }
}
