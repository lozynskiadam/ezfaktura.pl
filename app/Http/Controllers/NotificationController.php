<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function list()
    {
        $list = Auth::user()->notifications()->get();
        Auth::user()->notifications()->update(['is_confirmed' => true]);
        return $list;
    }
}
