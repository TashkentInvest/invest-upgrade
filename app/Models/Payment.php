<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;



class Payment extends Model
{
    use HasFactory, SoftDeletes, RevisionableTrait;

    protected $casts = [
        'payment_date' => 'date',
    ];
    protected $fillable = [
        'branch_id', 'amount', 'payment_date','comment'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
