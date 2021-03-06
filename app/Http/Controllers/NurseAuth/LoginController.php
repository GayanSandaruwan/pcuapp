<?php

namespace App\Http\Controllers\NurseAuth;

use App\Http\Controllers\Controller;
use App\Nurse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;
use Illuminate\Http\Request;

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

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/nurse/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('nurse.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('nurse.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('nurse');
    }

    /*
     * Overriding the default method authentication from email to username
     */
    public function username()
    {
        return 'username';
    }

    public function loginWithFilter(Request $request){
        $this->validateLogin($request);
        $nurse = Nurse::where("username",$request->username)->first();
        if($nurse != null){

            $status = $nurse->status;
            if(strcmp($status,"active")!=0){
                return view('nurse.auth.accountDeactive');
            }
            else{
                return $this->login($request);
            }
        }
//        var_dump($nurse);

        else{
            return $this->login($request);
        }

    }
}
