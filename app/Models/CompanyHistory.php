<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'user_id',
        'company_name',
        'raxbar',
        'bank_code',
        'bank_service',
        'bank_account',
        'stir',
        'oked',
        'minimum_wage',
        'event'
    ];
}
