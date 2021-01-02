<?php

/**
 * DataTable Manager - A PHP Manager for JS DataTables library (https://datatables.net/)
 */

namespace App\Http\Helpers;

class DataTable
{
    /** https://datatables.net/reference/option/dom */
    public $dom = 'Bfrtip';

    /** https://datatables.net/reference/option/columns */
    public $columns = [];

    /** https://datatables.net/reference/option/data */
    public $data = [];

    /** https://datatables.net/reference/option/drawCallback */
    public $drawCallback;

    /** https://datatables.net/reference/option/createdRow */
    public $createdRow;

    /** https://datatables.net/reference/option/buttons */
    public $buttons = [];

    /** https://datatables.net/reference/option/language */
    public $language;

    public function __construct()
    {
        $this->language['emptyTable'] = __("Brak danych w tabeli");
    }

    public function getJSON()
    {
        $options = [];
        foreach ($this as $key => $value) if ($value !== null) {
            $options[$key] = $value;
        }
        return json_encode($options);
    }

}