<?php

namespace App\Http\Livewire;

use App\Models\Emprendimiento;
use Livewire\Component;
use App\Models\User;
use App\Models\Portafolio;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserPortafolios extends Component
{
    use WithFileUploads;
    public $user;
    public $portafolios;
    public $nombre;
    public $pdf;

    public function save()
    {
        $this->pdf = $this->pdf->store('uploads', 'public');
        Portafolio::create(['user_id' => $this->user->id, 'nombre' => trim($this->nombre), 'ruta' => $this->pdf]);

        $this->emit('portafolio saved');
    }

    public function delete($id)
    {
        $port = Portafolio::find($id);
        Portafolio::destroy($id);
        Storage::delete('public/' . $port->ruta);

        $this->emit('portafolio deleted');
    }

    public function render()
    {
        $usersito = User::findOrFail($this->user->id);
        if ($usersito->protafolios->count()) {
            $this->portafolios = Portafolio::where('user_id', $this->user->id)->latest()->get();
        } else {
            $this->portafolios = null;
        }
        return view('livewire.user-portafolios');
    }
}
