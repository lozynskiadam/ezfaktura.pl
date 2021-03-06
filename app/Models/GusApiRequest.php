<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GusApiRequest extends Model
{
    protected $fillable = [
      'request',
      'response',
    ];
}
