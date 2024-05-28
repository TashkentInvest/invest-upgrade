<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    
    protected $table = 'files'; // Specify the table name if different from the default
    protected $fillable = ['client_id', 'path'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
