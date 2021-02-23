<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home.index');
    }

    public function contact(ContactRequest $request)
    {
        Mail::send('emails.contact_form', $request->all(), function ($message) {
            $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $message->to(env('APP_ADMIN_MAIL_ADDRESS'))->subject(__('translations.email.contact_panel.title'));
        });
        return response()->json(['success' => true]);
    }
}
