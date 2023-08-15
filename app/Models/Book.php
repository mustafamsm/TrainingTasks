<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Book extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'name_ar','name_en','author','category_id','publication','description_ar','description_en','price','image'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getNameAttribute(){
        $locale = LaravelLocalization::getCurrentLocale();
        $column = "name_" . $locale;
        return $this->$column;
    }
}
