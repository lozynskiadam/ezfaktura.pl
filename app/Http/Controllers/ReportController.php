<?php

namespace App\Http\Controllers;

use App\Classes\DataTables\ReportsTableBuilder;
use App\Models\Report;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(ReportsTableBuilder $dataTable)
    {
        return view('pages.reports.index', [
            'dataTable' => $dataTable->make()
        ]);
    }

    public function generate(Request $request, Report $report)
    {
        $file_name = $report->code. '-' .date('Y-m-d'). '.xlsx';
        return Excel::download(new $report->class_name, $file_name);
    }
}
