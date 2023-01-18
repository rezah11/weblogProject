<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
protected $fillable=[
    'user_id','title','summary','content'
];
    public function user()
    {
       return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function images()
    {
        return$this->hasMany(Image::class, 'post_id', 'id');
    }

    public function likes()
    {
        return $this->morphMany(Likeable::class,'likeable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id','id');
    }
}
