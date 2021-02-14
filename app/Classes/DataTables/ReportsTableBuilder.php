<?php

namespace App\Classes\DataTables;

class ReportsTableBuilder extends DataTableBuilder
{
    public function setColumns(): array
    {
        return [
            ['data' => 'name', 'title' => __('Nazwa')],
        ];
    }
}