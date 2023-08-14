<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name_ar', 'image', 'status', 'name_en'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function getNameAttribute()
    {
        $locale = LaravelLocalization::getCurrentLocale();
        $column = "name_" . $locale;
        return $this->$column;
    }
}
