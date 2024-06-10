<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditTransaction extends Model
{
    use HasFactory;

    protected $table = 'credit_transactions';

    protected $fillable = [
        'document_number',
        'operation_code',
        'recipient_name',
        'recipient_inn',
        'recipient_mfo',
        'recipient_account',
        'payment_date',
        'payment_description',
        'debit',
        'credit',
        'payer_name',
        'payer_inn',
        'payer_mfo',
        'payer_bank',
        'payer_account',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'debet_transaction_id');
    }
}
