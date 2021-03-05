<?php

namespace App\Http\Controllers;

class ModuleController extends Controller
{
    public function index()
    {
        return view('pages.modules.index', [
            'modules' => [
                (object)[
                    'id' => 1,
                    'name' => 'Fakturowanie',
                    'icon' => 'fa fa-file-pdf',
                    'description' => 'Free',
                    'basic' => true,
                    'active' => true,
                ],
                (object)[
                    'id' => 2,
                    'name' => 'Szablony faktur',
                    'icon' => 'fas fa-file-invoice',
                    'description' => 'Free',
                    'basic' => false,
                    'active' => false,
                ],
                (object)[
                    'id' => 3,
                    'name' => 'Sygnatury',
                    'icon' => 'fa fa-tag',
                    'description' => 'Free',
                    'basic' => false,
                    'active' => false,
                ],
                (object)[
                    'id' => 4,
                    'name' => 'Raporty',
                    'icon' => 'fas fa-chart-line',
                    'description' => 'Free',
                    'basic' => false,
                    'active' => false,
                ],
                (object)[
                    'id' => 5,
                    'name' => 'API',
                    'icon' => 'fab fa-cloudversify',
                    'description' => 'Free',
                    'basic' => false,
                    'active' => false,
                ],
            ]
        ]);
    }
}
