<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = '%' .$request->get('q') . '%';

        return view('pages.search.index', [
            'invoices' => [],
            'signatures' => Auth::user()
                ->signatures()
                ->where('name','LIKE', $q)
                ->orWhere('syntax','LIKE', $q)
                ->orWhere('description','LIKE', $q)
                ->get()
        ]);
    }
}
