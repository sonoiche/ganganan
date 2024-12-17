<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
                'fname'             => ['required', 'string', 'max:255'],
                'lname'             => ['required', 'string', 'max:255'],
                'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'          => ['required', 'string', 'min:8', 'confirmed'],
                'contact_number'    => ['required', 'string', 'max:255'],
                'privacy'           => ['required']
            ],
            [
                'fname.required'    => 'The first name field is required.',
                'lname.required'    => 'The last name field is required.',
                'privacy.required'  => 'The privacy policy field is required.'
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'fname'             => $data['fname'],
            'lname'             => $data['lname'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'contact_number'    => $data['contact_number'],
            'role'              => 'User',
            'status'            => 'Inactive',
            'otp_password'      => mt_rand(100000, 999999),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        Mail::to($user->email)->send(new SendOtpMail($user));
        return redirect()->to('otp-password');
    }
}
