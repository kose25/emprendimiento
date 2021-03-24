<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'body',
        'usuario',
        'foto',
    ];

    //obtiene los comentarios del post
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //obtiene el autor del post
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
