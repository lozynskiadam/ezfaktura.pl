<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'user_id',
      'name',
      'syntax',
      'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoice_types()
    {
        return $this->belongsToMany(InvoiceType::class, 'signature_invoice_type');
    }

}