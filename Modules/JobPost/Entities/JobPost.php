<?php

namespace Modules\JobPost\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\JobPost\Entities\JobPostTranslation;
use App\Models\User;
use App\Models\Category;
use App\Models\City;
use Modules\JobPost\Entities\JobRequest;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $appends = ['total_job_application'];

    protected static function newFactory()
    {
        return \Modules\JobPost\Database\factories\JobPostFactory::new();
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }

    public function user(){
        return $this->belongsTo(User::class)->select('id', 'name', 'email', 'image');
    }

    public function job_applications(){
        return $this->hasMany(JobRequest::class);
    }

    public function getTotalJobApplicationAttribute(){
        return $this->job_applications()->count();
    }

    public function checkJobStatus($id){
        $approval_check = JobRequest::where('job_post_id', $id)->where('status', 'approved')->count();

        if($approval_check > 0){
            return "approved";
        }else{
            return "pending";
        }
    }


}
