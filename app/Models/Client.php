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

    public static function deepFilters()
    {

        $tiyin = [];

        $obj = new self();
        $request = request();

        $query = self::where('id', '!=', '0');

        foreach ($obj->fillable as $item) {
            //request operator key
            $operator = $item . '_operator';

            if ($request->has($item) && $request->$item != '') {
                if (isset($tiyin[$item])) {
                    $select = $request->$item * 100;
                    $select_pair = $request->{$item . '_pair'} * 100;
                } else {
                    $select = $request->$item;
                    $select_pair = $request->{$item . '_pair'};
                }
                //set value for query
                if ($request->has($operator) && $request->$operator != '') {
                    if (strtolower($request->$operator) == 'between' && $request->has($item . '_pair') && $request->{$item . '_pair'} != '') {
                        $value = [
                            $select,
                            $select_pair
                        ];

                        $query->whereBetween($item, $value);
                    } elseif (strtolower($request->$operator) == 'wherein') {
                        $value = explode(',', str_replace(' ', '', $select));
                        $query->whereIn($item, $value);
                    } elseif (strtolower($request->$operator) == 'like') {
                        if (strpos($select, '%') === false)
                            $query->where($item, 'like', '%' . $select . '%');
                        else
                            $query->where($item, 'like', $select);
                    } else {
                        $query->where($item, $request->$operator, $select);
                    }
                } else {
                    $query->where($item, $select);
                }
            }
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
