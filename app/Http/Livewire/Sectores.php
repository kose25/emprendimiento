<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sector;
use App\Models\Emprendimiento;

class Sectores extends Component
{
    public $sectores;
    public $nombre;
    public $selected;

    public function save()
    {
        Sector::create(['nombre' => $this->nombre]);
        $this->emit('sector creado');
        $this->reset('nombre');
    }

    public function destroy($id)
    {
        $emp = Emprendimiento::whereHas('sectores', function ($q) use ($id) {
            $q->where('sector_id', $id);
        })->get();
        Sector::destroy($id);
        foreach ($emp as $e) {
            if ($e->sectores->count() == 0) {
                $e->sectores()->sync(1);
            }
        }
        $this->emit('sector borrado');
    }

    public function edit($id)
    {
        $this->nombre = Sector::find($id)->nombre;
        $this->selected = $id;
    }

    public function update()
    {
        //$this->nombre = Sector::find($this->selected)->nombre;
        Sector::find($this->selected)->update(['nombre' => $this->nombre]);
        $this->reset(['nombre', 'selected']);
        $this->emit('sector editado');
    }

    public function render()
    {
        $this->sectores = Sector::whereNotIn('id', [1])->get();
        return view('livewire.sectores');
    }
}
