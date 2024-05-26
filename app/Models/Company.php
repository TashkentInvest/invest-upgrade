<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'region_id',
        'company_name',
        'raxbar',
        'company_location',
        'company_type',
        'company_kubmetr',
        'contract_apt',
        'contract_date'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function region()
    {
        return $this->hasOne(Regions::class,'id', 'region_id');
    }
    
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
