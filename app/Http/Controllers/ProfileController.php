<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateLogoRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.index', [
            'user' => Auth::user(),
            'BooleanList' => [__('Nie'), __('Tak')],
            'CurrencyList' => ['PLN', 'GBP', 'USD'],
            'PaymentMethodList' => ['Przelew', 'Gotówka', 'Karta', 'Barter'],
            'DiscountTypeList' => ['Od ceny', 'Od wartości'],
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->fill($request->validated());
        $user->save();

        return redirect()->back()->with('message', __('Informacje zostały zaktualizowane pomyślnie.'));
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
        $logo = $request->file('logo');
        $path = '/uploaded/' . time() . '.png';
        Image::make($logo)->resize(200, 200, function (Constraint $constraint) {
            $constraint->aspectRatio();
        })->save(public_path($path));
        $user->logo = $path;
        $user->save();

        return response()->json(['logo' => $user->logo]);
    }
}
