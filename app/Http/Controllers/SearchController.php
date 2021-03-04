<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = '%' .$request->get('q') . '%';

        $invoices = Auth::user()
            ->invoices()
            ->where(function($query) use ($q) {
                $query->whereRaw('LOWER(`signature`) LIKE LOWER(?) ', $q);
                $query->orWhereRaw('LOWER(`buyer`) LIKE LOWER(?) ', $q);
                $query->orWhereRaw('LOWER(`positions`) LIKE LOWER(?) ', $q);
            })
            ->with('invoice_type')
            ->get();

        $signatures = Auth::user()
            ->signatures()
            ->where(function($query) use ($q) {
                $query->whereRaw('LOWER(`name`) LIKE LOWER(?) ', $q);
                $query->orWhereRaw('LOWER(`syntax`) LIKE LOWER(?) ', $q);
                $query->orWhereRaw('LOWER(`description`) LIKE LOWER(?) ', $q);
            })
            ->get();

        return view('pages.search.index', [
            'invoices' => $invoices,
            'signatures' => $signatures,
            'results' => count($invoices) + count($signatures)
        ]);
    }
}
