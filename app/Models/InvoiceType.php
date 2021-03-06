<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceType extends Model
{
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function signatures()
    {
        return $this->belongsToMany(Signature::class, 'signature_invoice_type');
    }

    public function getInitialsAttribute($attr)
    {
        return __($attr);
    }

    public function getNameAttribute($attr)
    {
        return __($attr);
    }
}
