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
        //return $request;

        $validate = $request->validate([
            'username' => ['string', 'max:100', 'required'],
            'password' => ['string', 'max:255', 'required'],
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed...
            //return redirect()->intended('/home');
            return response()->json([
                'status' => 'success'
            ], 200);
        }else{
            return response()->json([
                'errors' => ['username' => [0 => 'Username and password error.']]
            ], 422);
        }
    }


}
