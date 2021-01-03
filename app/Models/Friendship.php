<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'friend_id',
        'status',
    ];


    public function user()   {return $this->belongsTo('App\Models\User') ;}


    public function friend()   {return $this->belongsTo('App\Models\User','friend_id') ;}

}
