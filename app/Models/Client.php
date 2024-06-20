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
        'contact',
        'is_deleted',
        'status',
        'client_description',
    ];

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function passport()
    {
        return $this->hasOne(Passport::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function deepFilters($request)
    {
        $query = $this->where('is_deleted', '!=', 1)
            ->orderByDesc('id');

        foreach ($this->fillable as $item) {
            $operator = $item . '_operator';
            $value = $request->input($item);

            if ($request->filled($operator)) {
                $operatorValue = $request->input($operator);

                if (strtolower($operatorValue) == 'between' && $request->filled($item . '_pair')) {
                    $value = [
                        $value,
                        $request->input($item . '_pair')
                    ];
                    $query->whereBetween($item, $value);
                } elseif (strtolower($operatorValue) == 'wherein') {
                    $value = explode(',', str_replace(' ', '', $value));
                    $query->whereIn($item, $value);
                } elseif (strtolower($operatorValue) == 'like') {
                    $query->where($item, 'like', '%' . $value . '%');
                } else {
                    $query->where($item, $operatorValue, $value);
                }
            } elseif ($request->filled($item)) {
                $query->where($item, $value);
            }
        }

        if ($request->filled('company_name')) {
            $operator = $request->input('company_operator', 'like');
            $value =  $request->input('company_name') . '%';

            $query->whereHas('company', function ($query) use ($operator, $value) {
                $query->where('company_name', $operator, $value);
            });
        }

        if ($request->filled('stir')) {
            $operator = $request->input('stir_operator', 'like');
            $value = $request->input('stir') . '%';

            $query->whereHas('company', function ($query) use ($operator, $value) {
                $query->where('stir', $operator, $value);
            });
        }

        if ($request->filled('passport_serial')) {
            $operator = $request->input('passport_operator', 'like');
            $value = $request->input('passport_serial') . '%';

            $query->whereHas('passport', function ($query) use ($operator, $value) {
                $query->where('passport_serial', $operator, $value);
            });
        }

        if ($request->filled('passport_pinfl')) {
            $operator = $request->input('passport_operator', 'like');
            $value = $request->input('passport_pinfl') . '%';

            $query->whereHas('passport', function ($query) use ($operator, $value) {
                $query->where('passport_pinfl', $operator, $value);
            });
        }

        return $query;
    }
    public static function boot()
    {
        parent::boot();

        static::created(function ($client) {
            AuditLog::create([
                'user_id' => auth()->user()->id ?? 1,
                'client_id' => $client->id,
                'event' => 'created',
                'new_values' => $client->toJson(),
            ]);
        });

        static::updating(function ($client) {
            $original = $client->getOriginal();
            $changes = $client->getChanges();

            if ($client->is_deleted == 0) {
                AuditLog::create([
                    'user_id' => auth()->user()->id ?? 1,
                    'client_id' => $client->id,
                    'event' => 'updated',
                    'old_values' => json_encode($original),
                    'new_values' => json_encode($changes),
                ]);
            } else {
                AuditLog::create([
                    'user_id' => auth()->user()->id ?? 1,
                    'client_id' => $client->id,
                    'event' => 'deleted',
                    'old_values' => $client->toJson(),
                ]);
            }
        });

        static::deleted(function ($client) {
            AuditLog::create([
                'user_id' => auth()->user()->id ?? 1,
                'client_id' => $client->id,
                'event' => 'deleted',
                'old_values' => $client->toJson(),
            ]);
        });
    }

    public function creditTransactions()
    {
        return $this->hasMany(CreditTransaction::class, 'payer_inn', 'stir');
    }

}
