<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'firstname',
        'lastname',
        'gender',
        'picture',
        'status',
    ];

    // 'username', 'email','firstname','lastname','gender','picture','status', 'password',


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    // returs all User's Posts
    public function posts()         { return $this->hasMany('App\Models\Post');}

    // returs all User's Comments
    public function comments()      { return $this->hasMany('App\Models\Comment');}

    // returs all User's Messages
    public function messages()      { return $this->hasMany('App\Models\Message');}
    
    // return all user Conversations
    public function conversationsFrom() { return $this->hasMany('App\Models\Conversation','from_id');}
    public function conversationsTo() { return $this->hasMany('App\Models\Conversation','to_id');}


    // returs all notifications that's targeting this user
    public function notifications() { return $this->hasMany('App\Models\Notification');}
  
    // returs all notifications that's targeting this user
    public function friendshipsFromUserId()       { return $this->hasMany('App\Models\Friendship');}
    public function friendshipsFromFriendId()       { return $this->hasMany('App\Models\Friendship','friend_id');}


    public function friendshipsRequestFrom()       { return $this->hasMany('App\Models\FriendshipRequest','from_id');}
    public function friendshipsRequestTo()       { return $this->hasMany('App\Models\FriendshipRequest','to_id');}


}
