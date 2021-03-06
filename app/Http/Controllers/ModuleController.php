<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToggleModuleRequest;
use App\Models\Module;
use Illuminate\Support\Facades\Session;

class ModuleController extends Controller
{
    public function index()
    {
        return view('pages.modules.index', [
            'modules' => Module::all(),
        ]);
    }

    public function toggle(ToggleModuleRequest $request, Module $module)
    {
        $user = \Auth::user();
        if($request->get('active')) {
            if(!$user->modules()->find($module)) {
                $user->modules()->attach($module);
            }
        }
        else {
            $user->modules()->detach($module);
        }
        Session::put('modules', $user->modules()->pluck('modules.id'));
        return response()->json(['success' => true]);
    }
}
