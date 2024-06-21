<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'event',
        'contract_apt',
        'contract_date',
        'apz_raqami',
        'apz_sanasi',
        'kengash',
        'generate_price',
        'payment_type',
        'percentage_input',
        'installment_quarterly',
        'branch_kubmetr',
        'branch_location',
        'branch_type',
        'branch_name',
        'notification_num',
        'notification_date',
        'insurance_policy',
        'bank_guarantee',
        'application_number',
        'payed_sum',
        'payed_date',
        'first_payment_percent',
    ];
}
