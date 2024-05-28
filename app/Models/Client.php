<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = [
        'mijoz_turi',
        'first_name',
        'last_name',
        'father_name',
        'user_birht',
        'serial_serial',
        'serial_pinfl',
        'yuridik_address',
        'yuridik_rekvizid',
        'passport_serial',
        'passport_pinfl',
        'contact',
        'passport_serial',
        'passport_pinfl',
        'passport_date',
        'passport_location',
        'passport_type',
        'is_deleted'
        

    ];

    public function users(){
        return $this->belongsTo(User::class,'id', 'user_id');
    }

    
    public function companies(){
        return $this->hasMany(Company::class);
    }

    public function products(){
        return $this->hasMany(Products::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
   
    public static function boot()
    {
        parent::boot();

        static::created(function ($client) {
            AuditLog::create([
                'client_id' => $client->id,
                'event' => 'created',
                'new_values' => $client->toJson(),
            ]);
        });

        static::updating(function ($client) {
            $original = $client->getOriginal();
            $changes = $client->getChanges();

            if($client->is_deleted == 0){
                AuditLog::create([
                    'client_id' => $client->id,
                    'event' => 'updated',
                    'old_values' => json_encode($original),
                    'new_values' => json_encode($changes),
                ]);
            }
            else{
                AuditLog::create([
                    'client_id' => $client->id,
                    'event' => 'deleted',
                    'old_values' => $client->toJson(),
                ]);
            }
        });

        static::deleted(function ($client) {
            AuditLog::create([
                'client_id' => $client->id,
                'event' => 'deleted',
                'old_values' => $client->toJson(),
            ]);
        });
    }
}
