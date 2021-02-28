<?php

namespace App\Classes\Reports;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IssuedInvoicesReport extends BaseReport implements FromCollection, WithTitle, WithMapping, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithStyles
{
    public function title(): string
    {
        return __('translations.reports.issued_invoices_report');
    }

    public function headings(): array
    {
        return [
            __('translations.reports.issued_invoices_report.issue_date'),
            __('translations.reports.issued_invoices_report.contractor'),
            __('translations.reports.issued_invoices_report.signature'),
            __('translations.reports.issued_invoices_report.net_amount'),
            __('translations.reports.issued_invoices_report.gross_amount'),
            __('translations.reports.issued_invoices_report.tax_amount'),
            __('translations.reports.issued_invoices_report.payment_method'),
            __('translations.reports.issued_invoices_report.payment_due_date'),
            __('translations.reports.issued_invoices_report.is_paid'),
            __('translations.reports.issued_invoices_report.is_sent'),
        ];
    }

    public function collection()
    {
        return Auth::user()
            ->invoices()
            ->where('issue_date', '>=', $this->params['date_from'])
            ->where('issue_date', '<=', $this->params['date_to'])
            ->orderBy('issue_date')
            ->get();
    }

    public function map($row): array
    {
        return [
            $row->issue_date,
            $row->buyer['name'],
            $row->signature,
            $row->net_total . ' ' . $row->currency,
            $row->gross_total . ' ' . $row->currency,
            $row->tax_total . ' ' . $row->currency,
            $row->payment_method,
            $row->payment_due_date,
            $row->is_paid ? __('translations.common.yes') : __('translations.common.no'),
            $row->is_sent ? __('translations.common.yes') : __('translations.common.no'),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER_00,
            'E' => NumberFormat::FORMAT_NUMBER_00,
            'F' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('E')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('F')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('G')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('H')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('I')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('J')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

}