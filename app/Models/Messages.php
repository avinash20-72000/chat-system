<?php

namespace App\Models;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Messages extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $guarded  =   'id';

    public function chats()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }
    
    public function getDateAttribute()
    {
        return $this->created_at->format('d-m-Y h:i');
    }
}
