<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Emprendimiento;
use Illuminate\Support\Facades\DB;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class Search extends Component
{

    public $filter = 'emprendedor';
    public $search;

    public function latest()
    {
        switch ($this->filter) {
            case 'emprendedor':
                $latest = User::where('rol', 'emprendedor')->orderByDesc('id')->limit(10)->get();
                break;
            case 'funcionario':
                $latest = User::where('rol', 'funcionario')->orderByDesc('id')->limit(10)->get();
                break;
            case 'entidad':
                $latest = User::where('rol', 'entidad')->orderByDesc('id')->limit(10)->get();
                break;
            case 'emprendimieto':
                $latest = Emprendimiento::orderByDesc('id')->limit(10)->get();
                break;
        }
    }
    public function follow($userid)
    {
        if (Follow::where('user_id', Auth::user()->id)->where('follows', $userid)->count() > 0) {
            Follow::where('user_id', Auth::user()->id)->where('follows', $userid)->delete();
        } else {
            Follow::create(['user_id' => Auth::user()->id, 'follows' => $userid]);
        }
    }

    public function render()
    {
        //DB::enableQueryLog();
        $emprendimiento = null;
        $result = null;
        if ($this->search) {
            switch ($this->filter) {
                case 'emprendedor':
                    $result = User::where('rol', 'emprendedor')
                        ->where(function ($query) {
                            $query->where(DB::raw("CONCAT(name,' ',apellidos)"), 'LIKE', '%' . $this->search . '%')
                                ->orWhere('apellidos', 'like', '%' . $this->search);
                        })->get();
                    //dd(DB::getQueryLog());
                    break;
                case 'funcionario':
                    $result = User::where('rol', 'funcionario')
                        ->where('name', 'like', '%' . $this->search . '%')->get();
                    break;
                case 'entidad':
                    $result = User::where('rol', 'entidad')
                        ->where('name', 'like', '%' . $this->search . '%')->get();
                    break;
                case 'emprendimiento':
                    $emprendimiento = Emprendimiento::where('nombre', 'like', '%' . $this->search . '%')->get();
                    break;
                default:
                    $result = null;
                    $emprendimiento = null;
            }
        }
        return view('livewire.search', ['results' => $result, 'emprendimientos' => $emprendimiento]);
    }
}
