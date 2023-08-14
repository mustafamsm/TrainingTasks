<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'name_ar','name_en','author','category_id','publication','description_ar','description_en','price','image'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
