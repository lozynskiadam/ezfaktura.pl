<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoice_types')->insertOrIgnore([
          ['id' => 1, 'name' => 'Faktura VAT', 'short_name' => 'VAT', 'initials' => 'FV'],
          ['id' => 2, 'name' => 'Faktura proforma', 'short_name' => 'Proforma', 'initials' => 'PROF'],
          ['id' => 3, 'name' => 'Faktura zaliczkowa', 'short_name' => 'Zaliczkowa', 'initials' => 'FZAL'],
          ['id' => 4, 'name' => 'Faktura końcowa', 'short_name' => 'Końcowa', 'initials' => 'FAS'],
          ['id' => 5, 'name' => 'Faktura korygująca', 'short_name' => 'Korygująca', 'initials' => 'FK'],
        ]);
    }
}
