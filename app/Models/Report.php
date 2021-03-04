<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function getNameAttribute($attr)
    {
        return __($attr);
    }
}
