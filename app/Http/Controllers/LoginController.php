<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('app.home');
        }
        return view('pages.login.index', []);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            return redirect()->route('app.home');
        }

        return redirect()->route('app.login')
            ->withErrors((new MessageBag())->add('LoginError', 'Email or password is incorrect'))
            ->withInput();
    }
}
