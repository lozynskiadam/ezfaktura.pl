<?php

namespace App\Classes\DataTables;

class DataTable
{
    /** https://datatables.net/reference/option/dom */
    public $dom;

    /** https://datatables.net/reference/option/columns */
    public $columns;

    /** https://datatables.net/reference/option/data */
    public $data;

    /** https://datatables.net/reference/option/drawCallback */
    public $drawCallback;

    /** https://datatables.net/reference/option/createdRow */
    public $createdRow;

    /** https://datatables.net/reference/option/buttons */
    public $buttons;

    /** https://datatables.net/reference/option/language */
    public $language;

    public function __construct()
    {
        $this->dom = 'Bfrt<"row"<"col-md-6"l><"col-md-6"p>>';
        $this->columns = [];
        $this->buttons = [];
        $this->data = [];
        $this->drawCallback = null;
        $this->createdRow = null;
        $this->language = [
            'emptyTable' =>  __("Brak danych w tabeli"),
            'search' =>  __("Szukaj:"),
            'info' =>  __("_START_ - _END_ z _TOTAL_ wyników"),
            'infoEmpty' =>  __("0 - 0 z 0 wyników"),
            'infoFiltered' =>  "",
            'zeroRecords' =>  __("Nie znaleziono pasujących wyników"),
            'lengthMenu' =>  __("_MENU_ wieszy na stronie"),
            'paginate' => [
                'first' => __("Pierwsza"),
                'last' => __("Ostatnia"),
                'next' => __("Następna"),
                'previous' => __("Poprzednia"),
            ]
        ];
    }

    public function getJSON(): string
    {
        $options = [];
        foreach ($this as $key => $value) if ($value !== null) {
            $options[$key] = $value;
        }
        return json_encode($options);
    }

}