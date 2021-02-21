<?php

namespace App\Classes\DataTables;

interface DataTableBuilderInterface
{
    public function setDom(string $dom): DataTableBuilderInterface;

    public function setColumns(array $columns): DataTableBuilderInterface;

    public function setButtons(array $buttons): DataTableBuilderInterface;

    public function setData(array $data): DataTableBuilderInterface;

    public function setDrawCallback(string $callback): DataTableBuilderInterface;

    public function setCreatedRowCallback(string $callback): DataTableBuilderInterface;

    public function setLanguage(array $language): DataTableBuilderInterface;

    public function make(): DataTable;
}