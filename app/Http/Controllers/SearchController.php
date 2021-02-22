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
            'invoices' => Auth::user()
                ->invoices()
                ->whereRaw('LOWER(`signature`) LIKE LOWER(?) ', $q)
                ->orWhereRaw('LOWER(`buyer`) LIKE LOWER(?) ', $q)
                ->orWhereRaw('LOWER(`positions`) LIKE LOWER(?) ', $q)
                ->with('invoice_type')
                ->get(),
            'signatures' => Auth::user()
                ->signatures()
                ->whereRaw('LOWER(`name`) LIKE LOWER(?) ', $q)
                ->orWhereRaw('LOWER(`syntax`) LIKE LOWER(?) ', $q)
                ->orWhereRaw('LOWER(`description`) LIKE LOWER(?) ', $q)
                ->get()
        ]);
    }
}
