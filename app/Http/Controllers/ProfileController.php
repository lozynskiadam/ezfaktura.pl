<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
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
            'BooleanList' => ['Nie', 'Tak'],
            'CurrencyList' => ['PLN', 'GBP', 'USD'],
            'PaymentMethodList' => ['Przelew', 'Gotówka', 'Karta', 'Barter'],
            'DiscountTypeList' => ['Od ceny', 'Od wartości'],
        ]);
    }

    public function update(UpdateProfileRequest $request)
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

    public function change_password(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        return response()->json(['success' => true]);
    }

    public function update_logo(Request $request)
    {
        $user = Auth::user();
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $path = '/uploaded/' . time() . '.png';
            Image::make($logo)->resize(200, 200, function (Constraint $constraint) {
                $constraint->aspectRatio();
            })->save(public_path($path));
            $user->logo = $path;
            $user->save();
        }

        return response()->json(['logo' => $user->logo]);
    }
}
