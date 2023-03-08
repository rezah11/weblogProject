<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    const TYPE_ADMIN = 'admin';
    const TYPE_USER = 'user';
    const TYPE_MANAGER = 'manager';
    const TYPES = [self::TYPE_ADMIN, self::TYPE_MANAGER, self::TYPE_USER];
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
    const GENDER = [self::GENDER_MALE, self::GENDER_FEMALE];

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'image_profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function following()
    {
        return $this->belongsToMany(self::class, 'follows', 'followers_user_id', 'following_user_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'following_user_id', 'followers_user_id')->withTimestamps();
    }

    public function post_likes()
    {
        return $this->belongsToMany(Post::class, 'likes')->withPivot('like')->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function isAdmin()
    {
        return $this->type === self::TYPE_ADMIN;
    }

    public function isManager()
    {
        return $this->type === self::TYPE_MANAGER;
    }

    public function isUser()
    {
        return $this->type === self::TYPE_USER;
    }

    public function likes()
    {
        return $this->hasMany(Likeable::class, 'user_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function generateToken()
    {
        $token = Str::random(50);
        $this->remember_token=$token;
        $this->save();
        return $token;
    }

}
