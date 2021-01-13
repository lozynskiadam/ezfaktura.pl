<?php

namespace App\Http\Controllers;

class TemplateController extends Controller
{
    public function list()
    {
        return view('pages.templates.index', []);
    }
}
