<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceType extends Model
{
    use HasFactory;

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function signatures()
    {
        return $this->belongsToMany(Signature::class, 'signature_invoice_type');
    }

}
