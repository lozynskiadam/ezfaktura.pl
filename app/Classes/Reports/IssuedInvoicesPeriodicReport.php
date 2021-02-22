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
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class IssuedInvoicesPeriodicReport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize, WithMapping, WithEvents, WithColumnFormatting
{
    public function title(): string
    {
        return 'Raport';
    }

    public function headings(): array
    {
        return [
            'Data Wystawienia',
            'Wartość Netto',
            'Wartość Brutto',
            'Waluta',
            'Metoda Płatności',
        ];
    }

    public function collection()
    {
        return Auth::user()->invoices()->get([
            'issue_date',
            'net_total',
            'gross_total',
            'currency',
            'payment_method',
        ]);
    }

    public function map($row): array
    {
        return [
            $row->issue_date,
            $row->net_total,
            $row->gross_total,
            $row->currency,
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
//                    'fill' => [
//                        'fillType' => Fill::FILL_SOLID,
//                        'color' => ['rgb' => 'ffffff']
//                    ],
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