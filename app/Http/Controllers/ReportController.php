<?php

namespace App\Http\Controllers;

use App\Classes\DataTables\ReportsTableBuilder;
use App\Http\Requests\GenerateReportRequest;
use App\Models\Report;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(ReportsTableBuilder $dataTable)
    {
        return view('pages.reports.index', [
            'dataTable' => $dataTable->make()
        ]);
    }

    public function show(Report $report)
    {
        return view('pages.reports.dialogs.generate', [
            'date_from' => Carbon::now()->firstOfMonth()->format('Y-m-d'),
            'date_to' => Carbon::now()->addMonth()->firstOfMonth()->format('Y-m-d'),
        ]);
    }

    public function generate(GenerateReportRequest $request, Report $report)
    {
        $file_name = $report->code. '-' .Carbon::now()->format('Y-m-d'). '.xlsx';
        return Excel::download(new $report->class_name($request->validated()), $file_name);
    }
}
