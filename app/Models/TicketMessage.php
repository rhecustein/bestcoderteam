<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function documents(){
        return $this->hasMany(MessageDocument::class);
    }
}
