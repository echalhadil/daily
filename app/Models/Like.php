<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'post_id',
        'user_id',
    ];

    // the liker
    public function user(){return $this->BelongsTo('App\Models\User');}

    // the post
    public function post(){return $this->BelongsTo('App\Models\Post');}

}
