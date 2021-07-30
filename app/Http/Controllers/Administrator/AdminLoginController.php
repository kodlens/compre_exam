<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    //
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
    }

//    public function index(){
//        return view('student.login');
//    }

    public function index()
    {
        return view('auth.admin-login');
    }

    // public function guard()
    // {
    //     return Auth::guard('student');
    // 

    public function authenticate(Request $request)
    {
        return $request;

        $validate = $request->validate([
            'StudID' => ['string', 'max:100', 'required'],
            'password' => ['string', 'max:255', 'required'],
        ]);
        $credentials = $request->only('StudID', 'password');

        if (Auth::guard('student')->attempt($credentials)) {
            // Authentication passed...
            //return redirect()->intended('/home');
            return 'success';
        }
    }


}
