<?php

namespace Modules\Admin\Http\Controllers\VoyagerFrontend;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class AccountController extends BaseController
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $user = Auth::user();

        $rules = [
            // ^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$ /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/
            // 'name' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/|min:10',
            // 'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,

            'saname' => 'required|string|max:255',
            'saphone_number' => 'required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/|min:10',
            'saaddress1' => 'required|string|max:255',
            'sapostcode' => 'required|numeric|min:5',
            'sacity' => 'required|string|max:255',
            'sastate' => 'required|string|max:255',

        ];

        if ($data['password'] !== null) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        return Validator::make($data, $rules);
    }

    /**
     * Display a Account Information
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        $sa = DB::table('address')->where('userid',Auth::user()->id)->first();

        // dd($sa->name);

        return view('voyager-frontend::modules/auth/account', compact('user','sa'));
    }

    /**
     * Update User Account
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAccount(Request $request)
    {
        $this->validator($request->all())->validate();
        // print_r($request->saname);
        // dd($request->all());
        $user = Auth::user();
        // $user->name = $request->input('name');
        $user->phone_number = $request->input('phone_number');

        if ($request->input('password') !== null) {
            $user->password = bcrypt($request->input('password'));
            $user->password_update_at = \Carbon\Carbon::now()->addDays(180);
        }

        $user->save();

        DB::table('address')
        ->where('id', $request->said)
        ->update(
            [
                'name' => $request->saname,
                'phone_number' => $request->saphone_number,
                'address1' => $request->saaddress1,
                'address2' => $request->saaddress2,
                'postcode' => $request->sapostcode,
                'city' => $request->sacity,
                'state' => $request->sastate,
                'userid' => $user->id,
            ]
        );


        return redirect()
            ->route('voyager-frontend.account')
            ->with([
                'message' => __('Account Updated'),
                'alert-type' => 'success',
            ]);
    }

    /**
     * Impersonate a user as an administrator
     *
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function impersonateUser($userId)
    {
        if (Session::has('original_user.id') && $userId == Session::get('original_user.id')) {
            // Login as the original user and destroy session
            Session::forget('original_user.name');
            Auth::loginUsingId(Session::pull('original_user.id'));

            return redirect()->route('voyager.users.index');
        } else {
            // Store our current 'admin' id to switch back to
            Session::put('original_user.name', Auth::user()->name);
            Session::put('original_user.id', Auth::id());

            // Impersonate the requested user
            Auth::loginUsingId($userId);

            return redirect()->route('voyager-frontend.account');
        }
    }
}