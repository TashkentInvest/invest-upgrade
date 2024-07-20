<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    use HasFactory, SoftDeletes, RevisionableTrait;

    protected $table = 'companies'; 

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

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
