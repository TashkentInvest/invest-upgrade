<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;



class Client extends Model
{
    use HasFactory, SoftDeletes, RevisionableTrait;

    protected $casts = [
        'birth_date' => 'date',
    ];
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
        'category_id',
        'is_qonuniy',
        'created_by_client',
        'confirmed_for_client',
        'birth_date'
    ];
    protected $revisionCreationsEnabled = true; // Enable revision creation
    protected $revisionFormattedFields = [
        'deleted_at' => 'isEmpty:is present',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function confirmations()
    {
        return $this->hasMany(Confirm::class);
    }


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

    public function passportHistories()
    {
        return $this->hasMany(PassportHistory::class);
    }

    public function fileHistories()
    {
        return $this->hasMany(FileHistory::class);
    }

    public function companyHistories()
    {
        return $this->hasMany(CompanyHistory::class);
    }

    public function branchHistories()
    {
        return $this->hasMany(BranchHistory::class, 'client_id');
    }

    public function addressHistories()
    {
        return $this->hasMany(AddressHistory::class);
    }

    public function clientHistories()
    {
        return $this->hasMany(ClientHistory::class);
    }

    // public static function deepFilters()
    // {
    //     $obj = new self();
    //     $request = request();
    
    //     $query = self::where('id', '!=', 0); // Assuming 'id' is the primary key of your model
    
    //     foreach ($obj->fillable as $item) {
    //         // Determine operator and value based on request input
    //         $operator = $item . '_operator';
    //         $value = $request->input($item);
    
    //         if ($request->filled($operator)) {
    //             $operatorValue = $request->input($operator);
    
    //             if (strtolower($operatorValue) == 'between' && $request->filled($item . '_pair')) {
    //                 // Handle 'between' operator
    //                 $value = [
    //                     $value,
    //                     $request->input($item . '_pair')
    //                 ];
    //                 $query->whereBetween($item, $value);
    //             } elseif (strtolower($operatorValue) == 'wherein') {
    //                 // Handle 'wherein' operator
    //                 $value = explode(',', str_replace(' ', '', $value));
    //                 $query->whereIn($item, $value);
    //             } elseif (strtolower($operatorValue) == 'like') {
    //                 // Handle 'like' operator
    //                 $query->where($item, 'like', '%' . $value . '%');
    //             } else {
    //                 // Default case for other operators (e.g., '=', '>', '<', etc.)
    //                 $query->where($item, $operatorValue, $value);
    //             }
    //         } elseif ($request->filled($item)) {
    //             // No operator specified, use default '=' operator
    //             $query->where($item, $value);
    //         }
    //     }
    
    //     // Special handling for 'company_name'
    //     if ($request->filled('company_name')) {
    //         $operator = $request->input('company_operator', 'like');
    //         $value = '%' . $request->input('company_name') . '%';
    
    //         $query->whereHas('company', function ($query) use ($operator, $value) {
    //             $query->where('company_name', $operator, $value);
    //         });
    //     }
    
    //     // Special handling for 'stir'
    //     if ($request->filled('stir')) {
    //         $operator = $request->input('stir_operator', 'like');
    //         $value = '%' . $request->input('stir') . '%';
    
    //         $query->whereHas('company', function ($query) use ($operator, $value) {
    //             $query->where('stir', $operator, $value);
    //         });
    //     }

    //     // Passport serial
    //     if ($request->filled('passport_serial')) {
    //         $operator = $request->input('passport_operator', 'like');
    //         $value = '%' . $request->input('passport_serial') . '%';
    
    //         $query->whereHas('passport', function ($query) use ($operator, $value) {
    //             $query->where('passport_serial', $operator, $value);
    //         });
    //     }

        
    //     // Passport pinfl
    //     if ($request->filled('passport_pinfl')) {
    //         $operator = $request->input('passport_operator', 'like');
    //         $value = '%' . $request->input('passport_pinfl') . '%';
    
    //         $query->whereHas('passport', function ($query) use ($operator, $value) {
    //             $query->where('passport_pinfl', $operator, $value);
    //         });
    //     }
    
    //     return $query;
    // }
    

    public static function deepFilters()
    {
        $obj = new self();
        $request = request();
        $query = self::query();
    
        foreach ($obj->fillable as $item) {
            if ($request->filled($item)) {
                $operator = $request->input($item . '_operator', 'like');
                $value = $request->input($item);
    
                if ($operator == 'like') {
                    $value = '%' . $value . '%';
                }
    
                $query->where($item, $operator, $value);
            }
    
            $operator = $item . '_operator';
    
            // Additional filters for related models
            // Search related contract
            if ($request->filled('contract_apt')) {
                $operator = $request->input('contract_operator', 'like');
                $value = '%' . $request->input('contract_apt') . '%';
    
                $query->whereHas('branches', function ($query) use ($operator, $value) {
                    $query->where('contract_apt', $operator, $value);
                });
            }
    
            // Search related company
            if ($request->filled('company_name')) {
                $operator = $request->input('company_operator', 'like');
                $value = '%' . $request->input('company_name') . '%';
    
                $query->whereHas('company', function ($query) use ($operator, $value) {
                    $query->where('company_name', $operator, $value);
                });
            }
    
            // Search related category
            if ($request->filled('stir')) {
                $operator = $request->input('stir_operator', 'like');
                $value = '%' . $request->input('stir') . '%';
    
                $query->whereHas('company', function ($q) use ($operator, $value) {
                    $q->where('stir', $operator, $value);
                });
            }
    
            // Passport serial
            if ($request->filled('passport_serial')) {
                $operator = $request->input('passport_operator', 'like');
                $value = '%' . $request->input('passport_serial') . '%';
    
                $query->whereHas('passport', function ($query) use ($operator, $value) {
                    $query->where('passport_serial', $operator, $value);
                });
            }
    
            // Passport pinfl
            if ($request->filled('passport_pinfl')) {
                $operator = $request->input('passport_operator', 'like');
                $value = '%' . $request->input('passport_pinfl') . '%';
    
                $query->whereHas('passport', function ($query) use ($operator, $value) {
                    $query->where('passport_pinfl', $operator, $value);
                });
            }
        }
    
        // Search related last_name
        if ($request->filled('last_name')) {
            $operator = $request->input('last_operator', 'like');
            $value = '%' . $request->input('last_name') . '%';
            $query->where('last_name', $operator, $value)->orWhere('first_name', $operator, $value)->orWhere('father_name', $operator, $value);
        }
    
        return $query;
    }
    
    

    public function creditTransactions()
    {
        return $this->hasMany(CreditTransaction::class, 'payer_inn', 'stir');
    }

}
