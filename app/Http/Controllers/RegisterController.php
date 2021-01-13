<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ApiHelper;
use App\Http\Helpers\GUS;
use App\Http\Requests\RegisterRequest;
use App\Models\Notification;
use App\Models\User;
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
        $user->api_key = ApiHelper::generateKey();
        $user->save();

        Auth::attempt($request->only('email', 'password'));

        if ($report = GUS::find($request->get('nip'))) {
            $user->name = $report->getName();
            $user->address = $report->getStreet() . ' ' . $report->getPropertyNumber() . '/' . $report->getApartmentNumber();
            $user->postcode = $report->getZipCode();
            $user->city = $report->getCity();
            $user->save();
        }

        $notification = new Notification();
        $notification->user_id = Auth::id();
        $notification->title = __('Witaj w serwisie ') . env('APP_NAME') . '!';
        $notification->message = __('Gratulacje! Twoje konto zostało utworzone pomyślnie.');
        $notification->date = date('Y-m-d H:i:s');
        $notification->icon = 'fa fa-hands-helping';
        $notification->class = 'primary';
        $notification->save();

        return redirect()->route('home');
    }
}
