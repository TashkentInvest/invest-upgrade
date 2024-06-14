<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'yuridik_address', 'home_address', 'company_location'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
