<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SignatureEntry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'value',
      'year',
      'month',
      'counter',
    ];

    public function signature()
    {
        return $this->belongsTo(Signature::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

}
