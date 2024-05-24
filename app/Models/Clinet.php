<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinet extends Model
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
        'yuridik_rekvizid'
    ];

    public function users(){
        return $this->belongsTo(User::class,'id', 'user_id');
    }
}
