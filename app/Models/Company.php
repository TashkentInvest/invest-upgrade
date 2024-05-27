<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'company_name',
        'raxbar',
        'company_location',
        'company_type',
        'branch_kubmetr',
        'bank_code',
        'bank_service',
        'stir',
        'oked',
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

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}
