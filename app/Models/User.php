<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'nip',
        'name',
        'postcode',
        'city',
        'address',
        'logo',
    ];

    protected $hidden = [
        'password',
        'api_token',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function signatures()
    {
        return $this->hasMany(Signature::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function contractors()
    {
        return $this->hasMany(Contractor::class);
    }

}
