<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Emprendimiento;

class UserEmprendimientos extends Component
{
    public $user;

    public $emprendimientos;

    public $showEmprendimiento;

    public $nombre, $descripcion, $email, $nit, $ciudad, $foto, $celular, $fechaconstitucion, $sector, $entidad;

    public $entidades;

    public function showEmprendimiento($id)
    {
        $this->showEmprendimiento = Emprendimiento::findOrfail($id);
    }

    public function save()
    {
        Emprendimiento::create([
            'lider' => $this->user->id, 'nombre' => trim($this->nombre),
            'descripcion' => $this->descripcion, 'email' => $this->email, 'nit' => $this->nit,
            'ciudad' => $this->ciudad, 'celular' => $this->celular, 'fechaconstitucion' => $this->fechaconstitucion,
            'sector' => $this->sector, 'entidad' => $this->entidad,
        ]);
        $this->emit('emprendimiento added');

        $this->reset(['nombre', 'descripcion', 'email', 'nit', 'ciudad', 'foto', 'celular', 'fechaconstitucion', 'sector', 'entidad']);
    }


    public function render()
    {
        if ($this->user->emprendimientos->count()) {
            $this->emprendimientos = Emprendimiento::where('lider', $this->user->id)->get();
        } else {
            $this->emprendimientos = null;
        }
        $this->entidades = User::where('rol', 'entidad')->get();
        return view('livewire.user-emprendimientos');
    }
}
