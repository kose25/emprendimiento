<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'follows',
    ];


    public function seguidor(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function seguido(){
        return $this->belongsTo(User::class,'follows');
    }



}
