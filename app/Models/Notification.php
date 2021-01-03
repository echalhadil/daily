<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 
        'maker_id', 
        'user_id',
        'post_id',
    ];

    public function user()      {return $this->belongsTo('App\Models\User');}

    public function maker()      {return $this->belongsTo('App\Models\User','maker_id');}

}
