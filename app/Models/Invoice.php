<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'buyer' => 'array',
        'seller' => 'array',
        'payer' => 'array',
        'recipient' => 'array',
        'positions' => 'array',
        'tax_summary' => 'array',
        'additional' => 'array',
    ];

    protected $fillable = [
        'signature',
        'issue_date',
        'sale_date',
        'delivery_date',
        'payment_due_date',
        'payment_method',
        'invoicing_mode',
        'currency',
        'discount_type',
        'language',
        'buyer',
        'seller',
        'payer',
        'recipient',
        'positions',
        'tax_summary',
        'tax_total',
        'tax_total_in_words',
        'net_total',
        'net_total_in_words',
        'gross_total',
        'gross_total_in_words',
        'annotation',
        'additional',
    ];
    
    protected $with = ['signature', 'invoice_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function signature()
    {
        return $this->belongsTo(Signature::class);
    }

    public function invoice_type()
    {
        return $this->belongsTo(InvoiceType::class);
    }
}
