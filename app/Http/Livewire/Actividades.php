<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Emprendimiento;
use App\Models\Actividad;
use Livewire\WithPagination;


class Actividades extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    //public $actividades;
    public $nombre;
    public $selected;

    public function save()
    {
        Actividad::create(['nombre' => $this->nombre]);
        $this->emit('actividad creada');
        $this->reset('nombre');
    }

    public function destroy($id)
    {
        $emp = Emprendimiento::whereHas('actividades', function ($q) use ($id) {
            $q->where('actividad_id', $id);
        })->get();
        Actividad::destroy($id);
        foreach ($emp as $e) {
            if ($e->actividades->count() == 0) {
                $e->actividades()->sync(1);
            }
        }
        $this->emit('actividad borrada');
    }

    public function edit($id)
    {
        $this->nombre = Actividad::find($id)->nombre;
        $this->selected = $id;
    }

    public function update()
    {
        //$this->nombre = Sector::find($this->selected)->nombre;
        Actividad::find($this->selected)->update(['nombre' => $this->nombre]);
        $this->reset(['nombre', 'selected']);
        $this->emit('actividad editada');
    }
    public function render()
    {
        $actividades = Actividad::whereNotIn('id', [1])->paginate(10);
        return view('livewire.actividades',['actividades' => $actividades]);
    }
}
