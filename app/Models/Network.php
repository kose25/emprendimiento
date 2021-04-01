<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'facebook',
        'instagram',
        'linkedin',
        'twitter',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
