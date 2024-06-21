<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'event',
        'mijoz_turi',
        'first_name',
        'last_name',
        'father_name',
        'contact',
        'is_deleted',
        'status',
        'client_description'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
