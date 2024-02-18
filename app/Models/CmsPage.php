<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'url', 'meta_title', 'meta_keywords', 'meta_description', 'status'];


    // public function getCreatedAtAttribute($value)
    // {
    //     return date('Y-m-d', strtotime($value));
    // }
}
