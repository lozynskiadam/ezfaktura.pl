<?php

namespace App\Classes\Reports;

use App\Dictionaries\CoreDictionary;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

abstract class BaseReport implements WithDrawings, ShouldAutoSize, WithEvents
{
    public $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setPath(public_path(CoreDictionary::REPORTS_LOGO_PATH));
        $drawing->setHeight(32);
        $drawing->setOffsetX(7);
        $drawing->setOffsetY(6);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getRowDimension(1)->setRowHeight(45);
                $event->sheet->freezePane('A2');
                $event->sheet->getStyle('1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'ffffff']
                    ],
                    'fill' => array(
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '1161c7']
                    )
                ]);
                $event->sheet->getStyle('1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}