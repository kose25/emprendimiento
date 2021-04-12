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
    ];

    public function emprendedor()
    {
        return $this->belongsTo(User::class, 'lider');
    }
}
