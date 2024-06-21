<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileHistory extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'user_id','path','event'];

}
