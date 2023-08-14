<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Silder extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar',
        'title_en',
        'image',
        'status',
        'description_ar',
        'description_en',
        'start_date',
        'end_date',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
        public function scopeDate($query){
        return $query->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'));

        }
    public function getStatusAttribute($value)
    {
       if($value == 1){
           return __('site.active');    
         }else{
            return __('site.inactive');    
         }
    }

    public function getTitleAttribute($value)
    {
        $locale =LaravelLocalization::getCurrentLocale();
        
        $column = "title_" . $locale;
        return $this->$column;
    }

    public function getDescriptionAttribute($value)
    {
        $locale =LaravelLocalization::getCurrentLocale();
        
        $column = "description_" . $locale;
        return $this->$column;
    }
    

}
