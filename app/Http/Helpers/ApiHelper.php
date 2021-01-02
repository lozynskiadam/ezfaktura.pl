<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\DB;

class ApiHelper
{
  public static function generateKey()
  {
    while(true) {
      $key = [];
      foreach(range(0,5) as $i) {
        $key[] = substr(str_shuffle(MD5(microtime() . $i)), 0, 5);
      }
      $key = implode('-', $key);
      if(!(DB::select('select 1 from users where api_key = :api_key', ['api_key' => $key]))) {
        break;
      }
    }
    return $key;
  }
}