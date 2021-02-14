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

    public function getJSON(): string
    {
        $options = [];
        foreach ($this as $key => $value) if ($value !== null) {
            $options[$key] = $value;
        }
        return json_encode($options);
    }

}