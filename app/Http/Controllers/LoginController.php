<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {
        // $request->validate(
        //     [
        //         'email' => 'required|email',
        //         'password' => 'required'
        //     ],
        //     [
        //         'email.required' => "Hãy nhập email",
        //         'email.email' => "Email k đúng định dạng",
        //         'password.required' => "Hãy nhập mật khẩu"
        //     ]
        // );
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password], $request->remember)) {
            return redirect(route('car.index'));
        }
        return back()->with('msg', 'Tài khoản/mật khẩu không chính xác');
    }
}