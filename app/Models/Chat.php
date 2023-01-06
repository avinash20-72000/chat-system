<?php

namespace App\Models;

use App\Models\Messages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;
    protected $table    =   'chats';
    protected $guarded  =   'id';

    public function messages()
    {
        return $this->hasMany(Messages::class, 'chat_id');
    }
}
