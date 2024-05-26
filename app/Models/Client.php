<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = [
        'mijoz_turi',
        'first_name',
        'last_name',
        'father_name',
        'user_birht',
        'serial_serial',
        'serial_pinfl',
        'yuridik_address',
        'yuridik_rekvizid',
        'passport_serial',
        'passport_pinfl',
        'jamgarma_rekvizitlari',
        'contact',
        'passport_serial',
        'passport_pinfl',
        'passport_date',
        'passport_location',

        'id_passport_serial',
        'id_passport_pinfl',
        'id_passport_date',
        'id_passport_location'
    ];

    public function users(){
        return $this->belongsTo(User::class,'id', 'user_id');
    }

    
    public function companies(){
        return $this->hasMany(Company::class);
    }
}
