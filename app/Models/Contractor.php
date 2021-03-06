<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $fillable = [
        'nip',
        'name',
        'postcode',
        'address',
        'city',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
