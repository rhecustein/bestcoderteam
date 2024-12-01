<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id','id')->select('id','name','user_name','image','designation');
    }

    public function provider(){
        return $this->belongsTo(User::class,'provider_id','id')->select('id','name','user_name','image','designation');
    }


    public function service(){
        return $this->belongsTo(Service::class,'service_id')->select('id','name','slug','image');
    }

}
