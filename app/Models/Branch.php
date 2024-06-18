<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'contract_apt',
        'contract_date',
        'apz_raqami',
        'apz_sanasi',
        'kengash',
        'generate_price',
        'payment_type',
        'percentage_input',
        'installment_quarterly',
        'branch_kubmetr',
        'branch_location',
        'branch_type',
        'branch_name',
        'notification_num',
        'notification_date',
        'insurance_policy',
        'bank_guarantee',
        'application_number',
        'payed_sum',
        'payed_date',
        'first_payment_percent',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function view(){
        return $this->hasOne(View::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($branch) {
            AuditLog::create([
                'user_id' => auth()->user()->id ?? 1,
                'client_id' => $branch->client_id,
                'event' => 'branch_created',
                'new_values' => $branch->toJson(),
            ]);
        });

        static::updating(function ($branch) {
            $original = $branch->getOriginal();
            $changes = $branch->getChanges();

            AuditLog::create([
                'user_id' => auth()->user()->id ?? 1,
                'client_id' => $branch->client_id,
                'event' => 'branch_updated',
                'old_values' => json_encode($original),
                'new_values' => json_encode($changes),
            ]);
        });

        static::deleted(function ($branch) {
            AuditLog::create([
                'user_id' => auth()->user()->id ?? 1,
                'client_id' => $branch->client_id,
                'event' => 'branch_deleted',
                'old_values' => $branch->toJson(),
            ]);
        });
    }
}
