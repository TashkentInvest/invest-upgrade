<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'company_name',
        'raxbar',
        'company_location',
        'company_type',
        'bank_code',
        'bank_service',
        'stir',
        'oked',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function region()
    {
        return $this->hasOne(Regions::class,'id', 'region_id');
    }
    
    public function products()
    {
        return $this->hasMany(Products::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($company) {
            AuditLog::create([
                'user_id' => auth()->user()->id,
                'company_id' => $company->id,
                'event' => 'created',
                'new_values' => $company->toJson(),
            ]);
        });

        static::updating(function ($company) {
            $original = $company->getOriginal();
            $changes = $company->getChanges();

            AuditLog::create([
                'user_id' => auth()->user()->id,
                'company_id' => $company->id,
                'event' => 'updated',
                'old_values' => json_encode($original),
                'new_values' => json_encode($changes),
            ]);
        });

        static::deleted(function ($company) {
            AuditLog::create([
                'user_id' => auth()->user()->id,
                'company_id' => $company->id,
                'event' => 'deleted',
                'old_values' => $company->toJson(),
            ]);
        });
    }
}
