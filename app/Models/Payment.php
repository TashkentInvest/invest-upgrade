<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;


class Payment extends Model
{
    use HasFactory, RevisionableTrait;

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
