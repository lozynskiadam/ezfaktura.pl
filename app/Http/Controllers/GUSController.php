<?php

namespace App\Http\Controllers;

use App\Http\Helpers\GUS;
use App\Http\Requests\GUSRequest;

class GUSController extends Controller
{
    public function search(GUSRequest $request)
    {
        if ($report = GUS::find($request->get('nip'))) {
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
