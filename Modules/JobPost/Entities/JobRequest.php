<?php

namespace Modules\JobPost\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Listing\Entities\Listing;
use App\Models\User;

class JobRequest extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\JobPost\Database\factories\JobRequestFactory::new();
    }

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id')->select('id', 'image', 'email', 'name', 'designation', 'phone', 'address');
    }

     public function user(){
        return $this->belongsTo(User::class, 'user_id')->select('id', 'image', 'email', 'name', 'designation', 'phone', 'address', 'resume');
    }

    public function job_post(){
        return $this->belongsTo(JobPost::class)->select('id', 'thumb_image', 'slug', 'user_id', 'regular_price');
    }
}
