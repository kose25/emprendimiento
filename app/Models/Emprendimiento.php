<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprendimiento extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'email',
        'nit',
        'ciudad',
        'foto',
        'celular',
        'fechaconstitucion',
        'sector',
        'lider',
        'entidad',
        'sector_id',
    ];

    public function emprendedor()
    {
        return $this->belongsTo(User::class, 'lider');
    }

    public function integrantes()
    {
        return $this->hasMany(Integrante::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function sectores()
    {
        return $this->belongsToMany(Sector::class)->withTimestamps();
    }
}
