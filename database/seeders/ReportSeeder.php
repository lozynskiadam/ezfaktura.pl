<?php

namespace Database\Seeders;

use App\Classes\Reports\IssuedInvoicesPeriodicReport;
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
          ['id' => 1, 'is_active' => 1, 'name' => 'okresowy raport wystawionych faktur', 'code' => 'R001', 'class_name' => IssuedInvoicesPeriodicReport::class],
        ]);
    }
}
