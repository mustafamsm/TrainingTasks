<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Silder extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'status',
        'description',
        'start_date',
        'end_date',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
    

    public function getStatusAttribute($value)
    {
       if($value == 1){
           return __('site.active');    
         }else{
            return __('site.inactive');    
         }
    }
}
