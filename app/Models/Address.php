<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;


class Address extends Model
{
    use HasFactory, RevisionableTrait;

    protected $fillable = ['client_id', 'yuridik_address', 'home_address', 'company_location'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
