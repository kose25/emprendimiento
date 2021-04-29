<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
    ];

    public function emprendimientos()
    {
        return $this->hasMany(Emprendimiento::class);
    }

    public function emprendimientosxd()
    {
        return $this->belongsToMany(Emprendimiento::class)->withTimestamps();
    }
}
