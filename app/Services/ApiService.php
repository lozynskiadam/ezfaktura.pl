<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class ApiService
{
    public function generateToken()
    {
        $token = null;
        while (!$token || User::where('api_token', $token)->exists()) {
            $token = Str::random(60);
        }
        return $token;
    }

    public function resetToken(User $user) : void
    {
        $user->api_token = $this->generateToken();
        $user->save();
    }
}