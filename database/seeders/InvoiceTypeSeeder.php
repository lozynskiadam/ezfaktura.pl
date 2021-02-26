<?php

namespace Database\Seeders;

use App\Dictionaries\InvoiceTypeDictionary;
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
          [
              'id' => InvoiceTypeDictionary::BASIC,
              'name' => 'translations.invoices.invoice_type.basic.name',
              'short_name' => 'translations.invoices.invoice_type.basic.short_name',
              'initials' => 'translations.invoices.invoice_type.basic.initials'
          ],
          [
              'id' => InvoiceTypeDictionary::PROFORMA,
              'name' => 'translations.invoices.invoice_type.proforma.name',
              'short_name' => 'translations.invoices.invoice_type.proforma.short_name',
              'initials' => 'translations.invoices.invoice_type.proforma.initials'
          ],
          [
              'id' => InvoiceTypeDictionary::ADVANCE,
              'name' => 'translations.invoices.invoice_type.advance.name',
              'short_name' => 'translations.invoices.invoice_type.advance.short_name',
              'initials' => 'translations.invoices.invoice_type.advance.initials'
          ],
          [
              'id' => InvoiceTypeDictionary::FINAL,
              'name' => 'translations.invoices.invoice_type.final.name',
              'short_name' => 'translations.invoices.invoice_type.final.short_name',
              'initials' => 'translations.invoices.invoice_type.final.initials'
          ],
          [
              'id' => InvoiceTypeDictionary::CORRECTIVE,
              'name' => 'translations.invoices.invoice_type.corrective.name',
              'short_name' => 'translations.invoices.invoice_type.corrective.short_name',
              'initials' => 'translations.invoices.invoice_type.corrective.initials'
          ],
        ]);
    }
}
