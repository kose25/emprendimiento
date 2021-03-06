<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
    ];


    public function emprendimientos()
    {
        return $this->belongsToMany(Emprendimiento::class);
    }
}
