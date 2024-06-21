<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportHistory extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'passport_serial', 'passport_pinfl', 'passport_date', 'passport_location', 'passport_type','event'];

}
