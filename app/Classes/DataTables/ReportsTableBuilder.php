<?php

namespace App\Classes\DataTables;

class ReportsTableBuilder extends DataTableBuilder
{
    public function __construct()
    {
        parent::__construct();

        $this->setColumns([
            ['data' => 'name', 'title' => __('Nazwa')],
        ]);
    }
}