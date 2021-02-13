<?php

namespace App\Http\Controllers;

use App\Helpers\GUSHelper;
use App\Http\Requests\GUSRequest;

class GUSController extends Controller
{
    public function search(GUSRequest $request)
    {
        if ($report = GUSHelper::find($request->get('nip'))) {
            return response()->json([
                'success' => true,
                'name' => $report->getName(),
                'address' => $report->getStreet() . ' ' . $report->getPropertyNumber() . '/' . $report->getApartmentNumber(),
                'postcode' => $report->getZipCode(),
                'city' => $report->getCity(),
            ]);
        }
        return response()->json(['success' => false]);
    }
}
