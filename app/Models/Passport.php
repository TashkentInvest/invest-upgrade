<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;



class Passport extends Model
{
    use HasFactory, SoftDeletes, RevisionableTrait;
    protected $fillable = ['client_id', 'passport_serial', 'passport_pinfl', 'passport_date', 'passport_location', 'passport_type'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
