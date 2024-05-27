<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'image', 'description', 'status', 'parent_id','status'];

    public function products()
    {
        return $this->hasMany(Product::class,'product_id','id');
    }

    public function scopeFilter(Builder $builder, $filters): Builder
    {

        $builder->when($filters['search'] ?? null,function($builder,$value){
            // dd($value);
            return $builder->where('name','like','%'.$value.'%');
        });

        $builder->when($filters['status'] ?? null,function($builder,$value){
            return $builder->where('status',$value);
        });



        return $builder;
    }


}
