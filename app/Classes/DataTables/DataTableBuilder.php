<?php

namespace App\Classes\DataTables;

class DataTableBuilder implements DataTableBuilderInterface
{
    protected $dataTable;

    public function __construct()
    {
        $this->dataTable = new DataTable();
    }

    public function setDom(string $dom): DataTableBuilderInterface
    {
        $this->dataTable->dom = $dom;
        return $this;
    }

    public function setColumns(array $columns): DataTableBuilderInterface
    {
        $this->dataTable->columns = $columns;
        return $this;
    }

    public function setButtons(array $buttons): DataTableBuilderInterface
    {
        $this->dataTable->buttons = $buttons;
        return $this;
    }

    public function setData(array $data): DataTableBuilderInterface
    {
        $this->dataTable->data = $data;
        return $this;
    }

    public function setDrawCallback(string $callback): DataTableBuilderInterface
    {
        $this->dataTable->drawCallback = $callback;
        return $this;
    }

    public function setCreatedRowCallback(string $callback): DataTableBuilderInterface
    {
        $this->dataTable->createdRow = $callback;
        return $this;
    }

    public function setLanguage(array $language): DataTableBuilderInterface
    {
        $this->dataTable->language = $language;
        return $this;
    }

    public function make(): DataTable
    {
        return $this->dataTable;
    }
}