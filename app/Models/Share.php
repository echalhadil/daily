<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'post_id',
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
