<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Subscription\Database\factories\SubscriptionPlanFactory::new();
    }

    public function SubscriptionPlan(){
        return $this->hasMany(PurchaseHistory::class,'plan_id','id');
    }
}
