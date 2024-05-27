<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'company_id',
        'contract_apt',
        'contract_date',
        'company_name',
        'company_type',
        'branch_kubmetr',
        'generate_price',
        'payment_type',
        'percentage_input',
        'installment_quarterly'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
