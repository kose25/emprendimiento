<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Emprendimiento;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Sector;

class UserEmprendimientos extends Component
{
    use WithFileUploads;

    public $user;

    public $emprendimientos;

    public $showEmprendimiento;

    public $editEmprendimiento;

    public $newfoto;

    public $nombre, $descripcion, $email, $nit, $ciudad, $celular, $fechaconstitucion;

    public $entidades;

    public $sectorxd = [];

    public $sector = [];

    public $entidad = '';

    public $foto;

    public $sectores;


    public function resizePhoto($photopath)
    {
        $img = Image::make('storage/' . $photopath)->fit(500)->save('storage/' . $photopath, 80, 'jpg');
    }

    public function edit($id)
    {
        $this->editEmprendimiento = Emprendimiento::find($id);
        $this->nombre = $this->editEmprendimiento->nombre;
        $this->descripcion = $this->editEmprendimiento->descripcion;
        $this->email = $this->editEmprendimiento->email;
        $this->nit = $this->editEmprendimiento->nit;
        $this->ciudad = $this->editEmprendimiento->ciudad;
        $this->foto = $this->editEmprendimiento->foto;
        $this->celular = $this->editEmprendimiento->celular;
        $this->fechaconstitucion = $this->editEmprendimiento->fechaconstitucion;
        $this->sector = $this->editEmprendimiento->sectores->pluck('id')->toArray();
        $this->entidad = $this->editEmprendimiento->entidad;
        $this->emit('editvaino', $this->editEmprendimiento->sectores->pluck('id')->toArray());
    }

    public function update()
    {
        //dd($this->sector);
        if ($this->newfoto) {
            Storage::delete('public/' . $this->editEmprendimiento->foto);
            $this->newfoto = $this->newfoto->store('uploads', 'public');
            $this->resizePhoto($this->newfoto);
            Emprendimiento::where('id', $this->editEmprendimiento->id)->update([
                'nombre' => trim($this->nombre),
                'descripcion' => $this->descripcion, 'email' => $this->email, 'nit' => $this->nit,
                'ciudad' => $this->ciudad, 'celular' => $this->celular, 'fechaconstitucion' => $this->fechaconstitucion,
                //'sector_id' => $this->sector,
                'entidad' => $this->entidad, 'foto' => $this->newfoto,
            ]);
        } else {
            Emprendimiento::where('id', $this->editEmprendimiento->id)->update([
                'nombre' => trim($this->nombre),
                'descripcion' => $this->descripcion, 'email' => $this->email, 'nit' => $this->nit,
                'ciudad' => $this->ciudad, 'celular' => $this->celular, 'fechaconstitucion' => $this->fechaconstitucion,
                //'sector_id' => $this->sector,
                'entidad' => $this->entidad,
            ]);
        }

        $this->newfoto = null;        

        $this->editEmprendimiento->sectores()->sync($this->sector);

        $this->emit('empUpdated');
    }

    public function showEmprendimiento($id)
    {
        $this->showEmprendimiento = Emprendimiento::findOrfail($id);
    }

    public function delete($id)
    {
        $emp = Emprendimiento::findOrFail($id);
        Emprendimiento::destroy($id);

        if ($emp->foto) {
            Storage::delete('public/' . $emp->foto);
        }

        $this->emit('empDeleted');
    }

    public function save()
    {
        //dd($this->sectorxd);

        if ($this->foto) {
            $this->foto = $this->foto->store('uploads', 'public');
            $this->resizePhoto($this->foto);
        }
        $emp = Emprendimiento::create([
            'lider' => $this->user->id, 'nombre' => trim($this->nombre),
            'descripcion' => $this->descripcion, 'email' => $this->email, 'nit' => $this->nit,
            'ciudad' => $this->ciudad, 'celular' => $this->celular, 'fechaconstitucion' => $this->fechaconstitucion,
            //'sector_id' => $this->sector,
            'entidad' => $this->entidad,
            'foto' => $this->foto,
        ]);

        $emp->sectores()->sync($this->sectorxd);
        $this->emit('emprendimiento added');
        $this->emit('reset');

        $this->reset(['nombre', 'descripcion', 'email', 'nit', 'ciudad', 'foto', 'celular', 'fechaconstitucion', 'sector', 'entidad', 'sectorxd']);
    }

    public function cerrar()
    {
        $this->reset(['nombre', 'descripcion', 'email', 'nit', 'ciudad', 'foto', 'celular', 'fechaconstitucion', 'sector', 'entidad','sectorxd']);
        $this->emit('reset');
    }


    public function render()
    {
        $usersito = User::findOrFail($this->user->id);
        if ($usersito->emprendimientos->count()) {
            $this->emprendimientos = Emprendimiento::where('lider', $this->user->id)->latest()->get();
        } else {
            $this->emprendimientos = null;
        }
        $this->entidades = User::where('rol', 'entidad')->get();
        $this->sectores = Sector::all();
        return view('livewire.user-emprendimientos');
    }
}
