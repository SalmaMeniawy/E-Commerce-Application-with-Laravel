<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Buyer;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Seller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo(){
        if(auth()->user()->role == 'admin'){
            return '/admin/dashboard';
        }else{
            return '/home';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        $roles = ['buyer','seller','admin'];
        return view('auth.register',compact('roles'));
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'=>['required'],
            'fname' => ['required','string','max:255'],
            'lname' => ['required','string','max:255'],
          
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
        $user = User::make([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role'=>$data['role'],
        ]);
        $user->save();
        if($data['role'] == 'admin'){
            Admin::create([
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'date_of_birth' => $data['date_of_birth'],
                'user_id' => $user->id,
            ]);
       
            return $user;
        }elseif($data['role']== 'seller'){
            Seller::create([
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'date_of_birth' => $data['date_of_birth'],
                'user_id' => $user->id,
            ]);
            return $user;
        }else{
            Buyer::create([
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'date_of_birth' => $data['date_of_birth'],
                'user_id' => $user->id,
            ]);
            return $user;
        }
        
    }
}
