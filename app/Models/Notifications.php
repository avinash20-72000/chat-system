<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $guarded  = 'id';
    protected $table    = 'notifications';
    protected $appends  = ['time'];

    function getTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
