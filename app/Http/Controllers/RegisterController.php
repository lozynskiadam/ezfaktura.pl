<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\ApiService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('pages.login.index', []);
    }

    public function register(RegisterRequest $request)
    {
        $user = new User;
        $user->nip = $request->get('nip');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->api_token = ApiService::generateApiToken();
        $user->save();

        Auth::attempt($request->only('email', 'password'));

        return redirect()->route('home');
    }
}
