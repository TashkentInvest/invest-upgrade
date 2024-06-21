<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressHistory extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','user_id', 'yuridik_address', 'home_address', 'company_location','event'];

}
