<?php

namespace App\Classes\DataTables;

abstract class DataTableBuilder implements DataTableBuilderInterface
{
    public function setDom(): ?string
    {
        return 'Bfrt<"row"<"col-md-6"l><"col-md-6"p>>';
    }

    public function setColumns(): array
    {
        return [];
    }

    public function setButtons(): array
    {
        return [];
    }

    public function setData(): array
    {
        return [];
    }

    public function setDrawCallback(): ?string
    {
        return null;
    }

    public function setCreatedRowCallback(): ?string
    {
        return null;
    }

    public function setLanguage(): array
    {
        $language = [];
        $language['emptyTable'] = __("Brak danych w tabeli");
        $language['search'] = __("Szukaj:");
        $language['info'] = __("_START_ - _END_ z _TOTAL_ wyników");
        $language['infoEmpty'] = __("0 - 0 z 0 wyników");
        $language['infoFiltered'] = "";
        $language['zeroRecords'] = __("Nie znaleziono pasujących wyników");
        $language['lengthMenu'] = __("_MENU_ wieszy na stronie");
        $language['paginate']['first'] = __("Pierwsza");
        $language['paginate']['last'] = __("Ostatnia");
        $language['paginate']['next'] = __("Następna");
        $language['paginate']['previous'] = __("Poprzednia");
        return $language;
    }

    public function make(): DataTable
    {
        $dataTable = new DataTable();
        $dataTable->dom = $this->setDom();
        $dataTable->columns = $this->setColumns();
        $dataTable->buttons = $this->setButtons();
        $dataTable->data = $this->setData();
        $dataTable->drawCallback = $this->setDrawCallback();
        $dataTable->createdRow = $this->setCreatedRowCallback();
        $dataTable->language = $this->setLanguage();
        return $dataTable;
    }
}