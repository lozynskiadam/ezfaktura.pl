<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function list(Request $request)
    {
        return view('pages.templates.index', []);
    }
}
