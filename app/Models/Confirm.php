<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirm extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'client_id', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class); 
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
