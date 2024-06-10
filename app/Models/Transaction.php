<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'debet_transaction_id',
        'credit_transaction_id',
    ];

    public function debetTransaction()
    {
        return $this->belongsTo(DebetTransaction::class, 'debet_transaction_id');
    }

    public function creditTransaction()
    {
        return $this->belongsTo(CreditTransaction::class, 'credit_transaction_id');
    }
}
