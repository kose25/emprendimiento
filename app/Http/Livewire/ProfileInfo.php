<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class ProfileInfo extends Component
{
    use WithFileUploads;
    public $user;
    public $foto, $apellidos, $date, $celular, $nombre, $sexo, $aboutme;

    public function resizePhoto($photopath)
    {
        $img = Image::make('storage/' . $photopath)->fit(400)->save('storage/' . $photopath, 80, 'jpg');
    }

    public function edit()
    {
        $user = User::find($this->user->id);
        $this->nombre = $user->name;
        $this->apellidos = $user->apellidos;
        $this->date = $user->fechanacimiento;
        $this->celular = $user->celular;
        $this->sexo = $user->sexo;
        $this->aboutme = $user->aboutme;
    }

    public function save()
    {

        if ($this->foto) {
            $fotico = $this->foto->store('uploads', 'public');
            $this->resizePhoto($fotico);
            User::where('id', $this->user->id)->update([
                'name' => $this->nombre, 'apellidos' => $this->apellidos,
                'fechanacimiento' => $this->date, 'celular' => $this->celular, 'sexo' => $this->sexo,
                'foto' => $fotico, 'aboutme' => $this->aboutme

            ]);
        } else {
            User::where('id', $this->user->id)->update([
                'name' => $this->nombre, 'apellidos' => $this->apellidos,
                'fechanacimiento' => $this->date, 'celular' => $this->celular, 'sexo' => $this->sexo,
                'aboutme' => $this->aboutme

            ]);
        }
        $this->emit('profile updated');
    }


    public function render()
    {
        $this->user = User::find($this->user->id);

        return view('livewire.profile-info');
    }
}
