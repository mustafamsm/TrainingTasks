<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use HasFactory;
     protected $fillable=[
        'firstname','lastname','username','email','password','phone','address','photo','status'
     ];
     protected $hidden=[
        'password','remember_token'
     ];
     
     public function setPasswordAttribute($value){
        $this->attributes['password']=bcrypt($value);
     }
}
