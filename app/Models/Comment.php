<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'post_id', 
        'user_id',
    ];

    // Returns Comment user
    public function user(){return $this->BelongsTo('App\Models\User');}

    // Returns Comment Post
    public function post(){return $this->BelongsTo('App\Models\Post');}

}
