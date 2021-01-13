<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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
        $user = Auth::user();
        $user->name = $request->get('name');
        $user->nip = $request->get('nip');
        $user->postcode = $request->get('postcode');
        $user->city = $request->get('city');
        $user->address = $request->get('address');
        $user->save();

        return redirect()->back()->with('message', __('Informacje zostały zaktualizowane pomyślnie.'));
    }

    public function update_logo(Request $request)
    {
        if($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $path = '/uploaded/' . time() . '.png';
            Image::make($logo)->resize(200,200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($path));

            $user = Auth::user();
            $user->logo = $path;
            $user->save();
        }

        return Auth::user()->logo;
    }
}
