<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'event',
        'mijoz_turi',
        'first_name',
        'last_name',
        'father_name',
        'contact',
        'is_deleted',
        'status',
        'client_description'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function passportHistories()
    {
        return $this->hasMany(PassportHistory::class, 'client_id', 'client_id');
    }

    public function fileHistories()
    {
        return $this->hasMany(FileHistory::class, 'client_id', 'client_id');
    }

    public function companyHistories()
    {
        return $this->hasMany(CompanyHistory::class, 'client_id', 'client_id');
    }

    public function branchHistories()
    {
        return $this->hasMany(BranchHistory::class, 'client_id', 'client_id');
    }

    public function addressHistories()
    {
        return $this->hasMany(AddressHistory::class, 'client_id', 'client_id');
    }
}
