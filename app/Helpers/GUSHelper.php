<?php

namespace App\Helpers;

use App\Models\GusApiRequest;
use GusApi\GusApi;
use Illuminate\Support\Facades\Auth;

class GUSHelper
{
    public static function find($nip)
    {
        if(!(env('GUS_API_ENABLED', 0))) {
            return false;
        }

        $gusApiRequest = new GusApiRequest;
        $gusApiRequest->user_id = Auth::id();
        $gusApiRequest->request = $nip;

        try {
            $gus = new GusApi(env('GUS_API_KEY', ''), env('GUS_API_ENVIRONMENT', 'prod'));
            $gus->login();
            $response = $gus->getByNip($nip)[0] ?? false;
            $gusApiRequest->response = json_encode($response);
            $gusApiRequest->save();
            return $response;
        } catch (\Exception $e) {
            $gusApiRequest->response = $e->getMessage();
            $gusApiRequest->save();
            return false;
        }
    }
}