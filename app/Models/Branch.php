<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
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
        'shaxarsozlik_umumiy_xajmi',
        'qavatlar_soni_xajmi',
        'avtoturargoh_xajmi',
        'qavat_xona_xajmi',
        'umumiy_foydalanishdagi_xajmi',
        'qurilish_turi',
        'coefficient',
        'zona',
        'created_by_client',
        'confirmed_for_client'
    ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function views(){
        return $this->hasMany(View::class);
    }

}