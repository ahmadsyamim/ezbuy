<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', 'min:10' , 'max:13'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'gender' => ['required'],
            // 'postcode' => ['numeric','required'],
            // 'address' => ['required'],
            'saname' => ['required', 'string', 'max:255'],
            'saphone_number' => ['required', 'regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', 'min:10'],
            'saaddress1' => ['required', 'string', 'max:255'],
            'sapostcode' => ['required', 'numeric', 'min:5'],
            'sacity' => ['required', 'string', 'max:255'],
            'sastate' => ['required', 'string', 'max:255'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // $id = $this->create($data)->id;
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // 'gender' => $data['gender'],
            'phone_number' => $data['phone_number'],
            // 'postcode' => $data['postcode'],
            // 'address' => $data['address'],
        ]);

        DB::table('address')
        ->updateOrInsert(
            [
                'name' => $data['saname'],
                'phone_number' => $data['saphone_number'],
                'address1' => $data['saaddress1'],
                'address2' => $data['saaddress2'],
                'postcode' => $data['sapostcode'],
                'city' => $data['sacity'],
                'state' => $data['sastate'],
            ],
            ['userid' => $user->id]
        );        

        return $user;
    }

    /**

     * Show the application registration form.

     *

     * @return \Illuminate\View\View

     */

    public function showRegistrationForm()

    {
        return view('voyager-frontend::auth.register');
    }
}
