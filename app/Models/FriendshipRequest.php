<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendshipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id',
        'to_id',
    ];

   
    public function userFrom(){return $this->BelongsTo('App\Models\User','from_id');}

    public function userTo(){return $this->BelongsTo('App\Models\User','to_id');}


}
