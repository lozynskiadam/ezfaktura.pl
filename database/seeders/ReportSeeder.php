<?php

namespace Database\Seeders;


use App\Classes\Reports\IssuedInvoicesReport;
use App\Classes\Reports\MonthlyTurnoverReport;
use App\Dictionaries\ReportDictionary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->insertOrIgnore([
          [
              'id' => ReportDictionary::ISSUED_INVOICES,
              'is_active' => 1,
              'name' => 'translations.reports.issued_invoices_report',
              'code' => 'R001',
              'class_name' => IssuedInvoicesReport::class
          ],
          [
              'id' => ReportDictionary::MONTHLY_TURNOVER,
              'is_active' => 1,
              'name' => 'translations.reports.monthly_turnover_report',
              'code' => 'R002',
              'class_name' => MonthlyTurnoverReport::class
          ],
        ]);
    }
}
