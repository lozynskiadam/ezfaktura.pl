<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function getNameAttribute($attr)
    {
        return __($attr);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_module');
    }
}
