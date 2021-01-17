<?php

/**
 * DataTable Manager - A PHP Manager for JS DataTables library (https://datatables.net/)
 */

namespace App\Classes;

class DataTable
{
    /** https://datatables.net/reference/option/dom */
    public $dom = 'Bfrt<"row"<"col-md-6"l><"col-md-6"p>>';

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
        $this->language['search'] = __("Szukaj:");
        $this->language['info'] = __("_START_ - _END_ z _TOTAL_ wyników");
        $this->language['infoEmpty'] = __("0 - 0 z 0 wyników");
        $this->language['infoFiltered'] = "";
        $this->language['zeroRecords'] = __("Nie znaleziono pasujących wyników");
        $this->language['lengthMenu'] = __("_MENU_ wieszy na stronie");
        $this->language['paginate']['first'] = __("Pierwsza");
        $this->language['paginate']['last'] = __("Ostatnia");
        $this->language['paginate']['next'] = __("Następna");
        $this->language['paginate']['previous'] = __("Poprzednia");
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