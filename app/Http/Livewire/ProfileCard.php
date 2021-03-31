<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileCard extends Component
{
    public $user;

    public $button;

    public function follow()
    {
        if (Follow::where('user_id', Auth::user()->id)->where('follows', $this->user->id)->count() > 0) {
            Follow::where('user_id', Auth::user()->id)->where('follows', $this->user->id)->delete();
        } else {
            Follow::create(['user_id' => Auth::user()->id, 'follows' => $this->user->id]);
        }
    }

    public function render()
    {
        $this->user = User::find($this->user->id);
        if (Follow::where('user_id', Auth::user()->id)->where('follows', $this->user->id)->count() > 0) {
            $this->button = 'Deja de Seguir';
        } else {
            $this->button = 'Seguir';
        }
        return view('livewire.profile-card');
    }
}
