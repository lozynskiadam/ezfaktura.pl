<?php

namespace App\Classes\DataTables;

interface DataTableBuilderInterface
{
    public function setColumns(): array;

    public function setButtons(): array;

    public function setData(): array;

    public function setDrawCallback(): ?string;

    public function setCreatedRowCallback(): ?string;

    public function setLanguage(): array;

    public function make(): DataTable;
}