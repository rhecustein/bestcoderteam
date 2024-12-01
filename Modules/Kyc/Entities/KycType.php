<?php

namespace Modules\Kyc\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KycType extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Kyc\Database\factories\KycTypeFactory::new();
    }

    public function kycinformation(){
        return $this->hasMany(KycInformation::class,'kyc_id','id');
    }
}
