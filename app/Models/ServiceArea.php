<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceArea extends Model
{
    use HasFactory;

    public function city(){
        return $this->belongsTo(City::class);
    }

    protected $fillable = [
        'provider_id', 'city_id'
    ];
}
