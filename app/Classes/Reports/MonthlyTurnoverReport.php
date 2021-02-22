<?php

namespace App\Classes\Reports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class MonthlyTurnoverReport implements FromArray, WithTitle, WithHeadings, ShouldAutoSize, WithEvents, WithColumnFormatting
{
    public function title(): string
    {
        return __('Miesięczne zestawienie kwot');
    }

    public function headings(): array
    {
        return [
            __('Miesiąc'),
            __('Netto'),
            __('Brutto'),
        ];
    }

    public function array() : array
    {
        return DB::select("
            SELECT
              DATE_FORMAT(issue_date, '%Y-%m') AS 'month',
              SUM(net_total) as 'net',
              SUM(gross_total) as 'gross'
            FROM invoices
            WHERE user_id = :user_id
            GROUP BY DATE_FORMAT(issue_date, '%Y-%m')
            ORDER BY DATE_FORMAT(issue_date, '%Y-%m') ASC
        ", [
            'user_id' => Auth::id()
        ]);
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