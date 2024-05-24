<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';

    public function public_path():string
    {
        return public_path()."/images/";
    }

    public function path():string
    {
        return "/images/".$this->photo;
    }

    public function absolute_path():string
    {
        return public_path().'/images/'.$this->photo;
    }

    public function remove()
    {
        # Delete all releated thins to product

        \Illuminate\Support\Facades\File::delete($this->absolute_path());
        return $this->delete();
    }

    public function region()
    {
        return $this->hasOne(Regions::class,'id', 'region_id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
