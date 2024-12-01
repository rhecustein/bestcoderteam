<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $appends = ['totalService'];

    public function getTotalServiceAttribute()
    {
        return $this->service()->count();
    }

    public function service(){
        return $this->hasMany(Service::class);
    }

}
