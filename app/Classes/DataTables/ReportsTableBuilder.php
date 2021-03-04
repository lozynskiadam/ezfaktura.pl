<?php

namespace App\Classes\DataTables;

use App\Models\Report;

class ReportsTableBuilder extends DataTableBuilder
{
    public function __construct()
    {
        parent::__construct();

        $this->setColumns([
            [
                'data' => 'code',
                'title' => __('translations.reports.list.column.code'),
                'width' => 100
            ],
            [
                'data' => 'name',
                'title' => __('translations.reports.list.column.name')
            ],
        ]);

        $this->setCreatedRowCallback('Pages_Reports.onRowCreate');

        $this->setData(Report::all()->toArray());
    }
}