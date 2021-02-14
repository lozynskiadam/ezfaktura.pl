<?php

namespace App\Http\Controllers;

use App\Classes\DataTables\ReportsTableBuilder;

class ReportController extends Controller
{
    public function index(ReportsTableBuilder $dataTable)
    {
        return view('pages.reports.index', [
            'dataTable' => $dataTable->make()
        ]);
    }
}
