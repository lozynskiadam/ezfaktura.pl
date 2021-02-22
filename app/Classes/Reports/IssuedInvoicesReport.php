<?php

namespace App\Classes\Reports;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class IssuedInvoicesReport implements FromCollection, WithTitle, WithMapping, WithHeadings, ShouldAutoSize, WithEvents, WithColumnFormatting
{
    public function title(): string
    {
        return __('Raport wystawionych faktur');
    }

    public function headings(): array
    {
        return [
            __('Data Wystawienia'),
            __('Kontrahent'),
            __('Wartość Netto'),
            __('Wartość Brutto'),
            __('Metoda Płatności'),
        ];
    }

    public function collection()
    {
        return Auth::user()->invoices()->orderBy('issue_date')->get([
            'issue_date',
            'buyer',
            'net_total',
            'gross_total',
            'payment_method',
        ]);
    }

    public function map($row): array
    {
        return [
            $row->issue_date,
            $row->buyer['name'],
            $row->net_total,
            $row->gross_total,
            $row->payment_method,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->freezePane('A2');
                $event->sheet->getStyle('1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => '1269db']
                    ],
                ]);
                $event->sheet->getStyle('A')->applyFromArray([
                    'alignment' => array(
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    )
                ]);
                $event->sheet->getStyle('A1')->applyFromArray([
                    'alignment' => array(
                        'horizontal' => Alignment::HORIZONTAL_LEFT,
                    )
                ]);
            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER_00,
            'C' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
}