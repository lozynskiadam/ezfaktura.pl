<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class ApiService
{
    public static function generateApiToken()
    {
        while (true) {
            $token = Str::random(60);
            if (!User::where('api_token', $token)->exists()) {
                break;
            }
        }
        return $token;
    }
}