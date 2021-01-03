<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'user_id', 
        'conversation_id',
        'readed',
    ];

    public function conversation(){return $this->BelongsTo('App\Models\Conversation');}

}
