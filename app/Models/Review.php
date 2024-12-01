<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class,'user_id')->select('id','name','email','image','phone','designation','status','is_provider','country_id','state_id','city_id','address','created_at');
    }

    public function provider(){
        return $this->belongsTo(User::class,'provider_id')->select('id','name','email','image','phone','designation','status','is_provider','country_id','state_id','city_id','address','created_at');
    }

    public function service(){
        return $this->belongsTo(Service::class,'service_id')->select('id','name','slug','image');
    }




}
