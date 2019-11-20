<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLogin()
    {
        return view('front-end.auth.login');
    }


    public function postLogin(Request $req) {
//         dd( $req->all() );
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password])) {
            return redirect($this->redirectTo)->with([
                'type' => 'success',
                'message' => 'You have been successfully logged in.'
            ]);
        }

        return redirect()->back()->with([
            'type' => 'errorLogin',
            'message' => 'Something went wrong.'
        ]);
    }
}
