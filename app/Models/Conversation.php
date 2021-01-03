<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_message', 
        'from_id', 
        'to_id',
        'readed',
    ];

    // return all Conversation Messages
    public function messages()      { return $this->HasMany('App\Models\Message','conversation_id');}


}
