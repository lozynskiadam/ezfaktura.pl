<?php

namespace App\Http\Controllers;

use App\Dictionaries\CoreDictionary;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\DeleteProfileRequest;
use App\Http\Requests\UpdateLogoRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.index', [
            'user' => Auth::user(),
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->fill($request->validated());
        $user->save();

        return redirect()->back()->with('message', __('translations.profile.update.success'));
    }

    public function change_password(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        return response()->json(['success' => true]);
    }

    public function update_logo(UpdateLogoRequest $request)
    {
        $user = Auth::user();

        if(($user->logo !== CoreDictionary::DEFAULT_LOGO_PATH) && file_exists(public_path($user->logo))) {
            unlink(public_path($user->logo));
        }

        $path = '/uploaded/' . time() . '_' . Str::random(10) . '.png';
        Image::make($request->file('logo'))->resize(200, 200, function (Constraint $constraint) {
            $constraint->aspectRatio();
        })->save(public_path($path));
        $user->logo = $path;
        $user->save();

        return response()->json(['logo' => $user->logo]);
    }

    public function delete_profile(DeleteProfileRequest $request)
    {
        Auth::user()->delete();

        return response()->json(['success' => true]);
    }
}
