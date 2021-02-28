<?php

namespace App\Classes\Reports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MonthlyTurnoverReport extends BaseReport implements FromArray, WithTitle, WithHeadings, ShouldAutoSize, WithEvents, WithColumnFormatting, WithStyles
{
    public function title(): string
    {
        return __('translations.reports.monthly_turnover_report');
    }

    public function headings(): array
    {
        return [
            __('translations.reports.monthly_turnover_report.month'),
            __('translations.reports.monthly_turnover_report.issued_net_amount'),
            __('translations.reports.monthly_turnover_report.issued_gross_amount'),
            __('translations.reports.monthly_turnover_report.paid_net_amount'),
            __('translations.reports.monthly_turnover_report.paid_gross_amount'),
        ];
    }

    public function array() : array
    {
        return DB::select("
            SELECT
              DATE_FORMAT(issue_date, '%Y-%m') AS 'month',
              SUM(net_total) AS 'net',
              SUM(gross_total) AS 'gross',
              SUM(IF(is_paid = '1', net_total, 0)) AS 'paid_net',
              SUM(IF(is_paid = '1', gross_total, 0)) AS 'paid_gross'
            FROM invoices
            WHERE user_id = :user_id AND
                  issue_date >= :date_from AND
                  issue_date <= :date_to
            GROUP BY DATE_FORMAT(issue_date, '%Y-%m')
            ORDER BY DATE_FORMAT(issue_date, '%Y-%m') ASC
        ", [
            'user_id' => Auth::id(),
            'date_from' => $this->params['date_from'],
            'date_to' => $this->params['date_to'],
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER_00,
            'C' => NumberFormat::FORMAT_NUMBER_00,
            'D' => NumberFormat::FORMAT_NUMBER_00,
            'E' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('E')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    }
}