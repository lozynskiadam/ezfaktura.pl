<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.index', [
          'user' => Auth::user()
        ]);
    }

    public function update(UpdateProfile $request)
    {
        $user = Auth::getUser();
        $user->name = $request->get('name');
        $user->nip = $request->get('nip');
        $user->postcode = $request->get('postcode');
        $user->city = $request->get('city');
        $user->address = $request->get('address');
        $user->save();

        return redirect()->back()->with('message', __('Informacje zostały zaktualizowane pomyślnie.'));
    }
}
