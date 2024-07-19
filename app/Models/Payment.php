<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id', 'amount', 'payment_date','comment'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
