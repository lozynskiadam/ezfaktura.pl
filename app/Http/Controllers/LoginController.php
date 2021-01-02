<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('pages.login.index', []);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'email' => 'required|email',
          'password' => 'required|alphaNum'
        ]);
        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator->errors())->withInput();
        }

        if (Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            return redirect()->route('home');
        }

        return redirect()->route('login')->withErrors((new MessageBag())->add('LoginError', 'Email or password is incorrect'))->withInput();
    }
}
