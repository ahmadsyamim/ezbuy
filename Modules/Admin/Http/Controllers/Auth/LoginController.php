<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Session;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;


    protected function authenticated($request, $user){

        if(!$user->email_verified_at){
            // Session::flush();
            // #fixlater , no need logout , add verified in middleware
            Auth::logout();
            return redirect('/login')->with('error',"Please verify your email !");
        }

        if($user->role_id == '1'){
            return redirect('/allorderlist')->with('info',"You are login as Admin !");
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

    /**

     * Show the application's login form.

     *

     * @return \Illuminate\View\View

     */

    public function showLoginForm()

    {

        return view('voyager-frontend::auth.login');

    }
}
