<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signature extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'name',
      'syntax',
      'description',
    ];

    protected $with = ['invoice_types'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoice_types()
    {
        return $this->belongsToMany(InvoiceType::class, 'signature_invoice_type');
    }

    public function signature_entries()
    {
        return $this->hasMany(SignatureEntry::class);
    }

}
