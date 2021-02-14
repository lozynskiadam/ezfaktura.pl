<?php

namespace App\Http\Controllers;

use App\Classes\ApiKey;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function index()
    {
        return view('pages.api.index', [
            'key' => Auth::user()->api_key
        ]);
    }

    public function reset_key()
    {
        $user = Auth::user();
        $user->api_key = ApiKey::generate();
        $user->save();

        return response()->json(['key' => $user->api_key]);
    }
}
