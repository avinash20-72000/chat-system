<?php

namespace App\Models;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Messages extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $guarded  =   'id';

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getDateAttribute()
    {
        return $this->created_at->format('d-m-Y h:i');
    }
}
