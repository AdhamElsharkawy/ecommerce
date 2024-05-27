<?php

namespace App\Models;

use App\Models\Store;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['price_avg'];

    public function getPriceAvgAttribute()
    {
       $this->avg('price');
    }



    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id');
    }


    protected static function booted()
    {
        static::addGlobalScope("store", function (Builder $builder) {
            $user = auth('admin')->user();
            if($user->store_id){
                $builder->where('store_id', $user->store_id);
            }
        });
    }



    public function scopeFilter(Builder $builder, $filters): Builder
    {

        $builder->when($filters['search'] ?? null,function($builder, $value){
            return $builder->where('name','like','%'.$value.'%');
        });

        $builder->when($filters['price'] ?? null,function($builder,$value){
            return $builder->where('price',$value);
        });



        return $builder;
    }



}
