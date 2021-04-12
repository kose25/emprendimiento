<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'aboutme',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image()
    {
        //$foto=$this->foto;
        if (!$this->foto) {
            return asset('img/profilepic placeholder.jpg');
        } else {
            return asset('storage') . '/' . $this->foto;
        }
    }

    public function adminlte_desc()
    {
        return $this->rol;
    }

    public function adminlte_profile_url()
    {
        return 'usuario/' . $this->id;
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'usuario');
    }

    public function seguidores()
    {
        return $this->hasMany(Follow::class, 'follows');
    }

    public function seguidos()
    {
        return $this->hasMany(Follow::class);
    }

    public function network()
    {
        return $this->hasOne(Network::class);
    }

    public function emprendimientos()
    {
        return $this->hasMany(Emprendimiento::class, 'lider');
    }

    public function isFollowing($id)
    {
        if ($this->seguidos()->where('follow_id', $id)->count() > 0) {
            return 'Dejar de seguir';
        } else {
            return 'Seguir';
        }
    }

    public function protafolios()
    {
        return $this->hasMany(Portafolio::class);
    }
}
