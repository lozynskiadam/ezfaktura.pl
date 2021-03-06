<?php

namespace Database\Seeders;

use App\Dictionaries\ModuleDictionary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insertOrIgnore([
            [
                'id' => ModuleDictionary::TEMPLATES,
                'name' => 'translations.modules.templates',
                'description' => '',
                'icon' => 'fas fa-file-invoice',
            ],
            [
                'id' => ModuleDictionary::SIGNATURES,
                'name' => 'translations.modules.signatures',
                'description' => '',
                'icon' => 'fa fa-tag',
            ],
            [
                'id' => ModuleDictionary::REPORTS,
                'name' => 'translations.modules.reports',
                'description' => '',
                'icon' => 'fas fa-chart-line',
            ],
            [
                'id' => ModuleDictionary::API,
                'name' => 'translations.modules.api',
                'description' => '',
                'icon' => 'fab fa-cloudversify',
            ],
        ]);
    }
}
