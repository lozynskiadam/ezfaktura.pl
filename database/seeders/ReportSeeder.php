<?php

namespace Database\Seeders;


use App\Classes\Reports\IssuedInvoicesReport;
use App\Classes\Reports\MonthlyTurnoverReport;
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
          ['id' => 1, 'is_active' => 1, 'name' => 'raport wystawionych faktur', 'code' => 'R001', 'class_name' => IssuedInvoicesReport::class],
          ['id' => 2, 'is_active' => 1, 'name' => 'miesięczne zestawienie kwot', 'code' => 'R002', 'class_name' => MonthlyTurnoverReport::class],
        ]);
    }
}
