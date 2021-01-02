<?php

namespace App\Http\Controllers;

use App\Http\Helpers\InvoicesHelper;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.invoices.index', [
          'dataTable' => InvoicesHelper::getDataTable()
        ]);
    }
}
