<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likeable extends Model
{
    use HasFactory;
    protected $table='likable';
protected $fillable=[
    'like','likeable_id','likeable_type','user_id'
    ];
    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
