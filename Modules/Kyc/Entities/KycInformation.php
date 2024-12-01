<?php

namespace Modules\Kyc\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Modules\Kyc\Entities\KycType;

class KycInformation extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Kyc\Database\factories\KycInformationFactory::new();
    }


    public function influncer(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function kyc_type(){
        return $this->belongsTo(KycType::class,'kyc_id','id');
    }
}
