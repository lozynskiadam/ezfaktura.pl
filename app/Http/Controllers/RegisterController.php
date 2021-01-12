<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ApiHelper;
use App\Http\Helpers\GUS;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('pages.login.index', []);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|digits:10',
            'email' => 'unique:users|required|email',
            'password' => 'required|confirmed|min:6',
            'agree' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator->errors())->withInput();
        }

        $user = new User([
            'nip' => $request->get('nip'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'api_key' => ApiHelper::generateKey(),
        ]);
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
