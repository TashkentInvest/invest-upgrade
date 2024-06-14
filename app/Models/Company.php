<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'client_id',
        'company_name',
        'raxbar',
        'bank_code',
        'bank_service',
        'bank_account',
        'stir',
        'oked',
        'minimum_wage',
    ];

    // Relationship with Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
