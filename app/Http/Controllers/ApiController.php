<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function index()
    {
        return view('pages.api.index', [
            'token' => Auth::user()->api_token
        ]);
    }

    public function reset_token(ApiService $apiService)
    {
        $user = Auth::user();
        $apiService->resetToken($user);

        return response()->json(['key' => $user->api_token]);
    }
}
