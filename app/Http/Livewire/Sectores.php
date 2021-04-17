<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sector;

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
        Sector::destroy($id);
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
        $this->sectores = Sector::whereNotIn('id', [17])->get();
        return view('livewire.sectores');
    }
}
