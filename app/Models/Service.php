<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class)->select('id','name','icon','slug');
    }

    public function provider(){
        return $this->belongsTo(User::class)->select('id','name','email','phone','image','created_at','user_name','kyc_status');
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function activeReviews(){
        return $this->hasMany(Review::class,'service_id')->where('status', 1);
    }

    protected $appends = ['averageRating','totalReview','totalOrder'];


    public function getAverageRatingAttribute()
    {
        return $this->activeReviews()->avg('rating') ? : '0';
    }

    public function getTotalReviewAttribute()
    {
        return $this->activeReviews()->count();
    }

    public function getTotalOrderAttribute()
    {
        return $this->orders()->count();
    }


    public function serviceAreas(){
        return $this->hasMany(ServiceArea::class,'provider_id','provider_id');
    }





}
