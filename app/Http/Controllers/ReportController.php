<?php

namespace App\Http\Controllers;

use App\Classes\DataTable;

class ReportController extends Controller
{
    public function index(DataTable $dataTable)
    {
        $dataTable->columns = [
            ['data' => 'name', 'title' => __('Nazwa')],
        ];

        return view('pages.reports.index', [
            'dataTable' => $dataTable
        ]);
    }
}
