<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ApiHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function index()
    {
        return view('pages.api.index', [
            'key' => Auth::user()->api_key
        ]);
    }

    public function resetKey()
    {
        $user = User::findOrFail(Auth::id());
        $user->api_key = ApiHelper::generateKey();
        $user->save();

        return response()->json(['key' => $user->api_key]);
    }
}
