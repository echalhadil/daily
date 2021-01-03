<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'text', 
        'picture', 
        'user_id',
    ];


    // returs all post's comments
    public function comments()  {return $this->hasMany('App\Models\Comment','post_id');}

    // returs all post's likes
    public function likes()     {return $this->HasMany('App\Models\Like' );}

    // Returns the post owner
    public function user()      {return $this->belongsTo('App\Models\User');}

    public function shares()      {return $this->HasMany('App\Models\Share','post_id');}

}
