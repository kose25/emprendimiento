<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Emprendimiento;
use App\Models\Integrante;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\CuentaMailable;

class EmpManagement extends Component
{
    public $emprendimientos;
    public $showEmprendimiento;
    public $selectedEmp;
    public $search;
    public $results;
    public $nombre, $apellidos, $email;

    protected $rules = [
        'nombre' => 'required|min:5',
        'apellidos' => 'required|min:4',
        'email' => 'required|email|unique:users,email',
    ];




    public function showEmprendimiento($id)
    {
        $this->showEmprendimiento = Emprendimiento::findOrFail($id);
    }

    public function team($id)
    {
        $this->selectedEmp = Emprendimiento::findOrFail($id);
    }

    public function setEmp()
    {
        $this->selectedEmp = null;
    }

    public function add($id)
    {
        if (Integrante::where('user_id', $id)->where('emprendimiento_id', $this->selectedEmp->id)->count() > 0) {
            Integrante::where('user_id', $id)->where('emprendimiento_id', $this->selectedEmp->id)->delete();
        } else {
            Integrante::create(['user_id' => $id, 'emprendimiento_id' => $this->selectedEmp->id]);
        }

        $this->team($this->selectedEmp->id);
    }

    public function create()
    {
        $this->validate();
        $random = Str::random(8);
        $pass = Hash::make($random);
        $newEmp = User::create([
            'name' => trim($this->nombre),
            'apellidos' => trim($this->apellidos),
            'email' => trim($this->email),
            'password' => $pass,
        ]);
        $correo = new CuentaMailable($random, $this->email, 'emprendedor');
        Mail::to($this->email)->send($correo);
        Integrante::create(['user_id' => $newEmp->id, 'emprendimiento_id' => $this->selectedEmp->id]);
        $this->team($this->selectedEmp->id);

        $this->emit('emp created');
    }

    public function render()
    {
        $usersito = User::findOrFail(Auth::user()->id);
        if ($usersito->emprendimientos->count() > 0) {
            $this->emprendimientos = Emprendimiento::where('lider', $usersito->id)->latest()->get();
        } else {
            $this->emprendimientos = null;
        }
        if ($this->search && $this->search != '') {
            $this->results = User::where('rol', 'emprendedor')
                ->where(function ($query) {
                    $query->where(DB::raw("CONCAT(name,' ',apellidos)"), 'LIKE', '%' . $this->search . '%')
                        ->orWhere('apellidos', 'like', '%' . $this->search);
                })->get();
        }
        return view('livewire.emp-management');
    }
}
