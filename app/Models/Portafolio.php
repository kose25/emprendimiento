<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portafolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'ruta',
    ];

    public function emprendedor()
    {
        return $this->belongsTo(User::class);
    }
}
