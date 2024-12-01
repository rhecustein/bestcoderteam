<?php

namespace Modules\JobPost\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPostTranslation extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\JobPost\Database\factories\JobPostTranslationFactory::new();
    }
}
