<?php

namespace App\Http\Livewire;

use App\Models\Network;
use Livewire\Component;
use App\Models\User;

class ProfileNetwork extends Component
{
    public $user;

    public $facebook, $instagram, $linkedin, $twitter;

    public function saveNetwork()
    {
        if ($this->user->network) {
            Network::where('user_id', $this->user->id)->update([
                'user_id' => $this->user->id, 'facebook' => $this->facebook,
                'twitter' => $this->twitter, 'linkedin' => $this->linkedin, 'instagram' => $this->instagram
            ]);
        } else {
            Network::create([
                'user_id' => $this->user->id, 'facebook' => $this->facebook,
                'twitter' => $this->twitter, 'linkedin' => $this->linkedin, 'instagram' => $this->instagram
            ]);
        }

        $this->emit('alert');
    }

    public function render()
    {
        $this->user = User::find($this->user->id);
        if ($this->user->network) {
            $this->facebook = $this->user->network->facebook;
            $this->instagram = $this->user->network->instagram;
            $this->linkedin = $this->user->network->linkedin;
            $this->twitter = $this->user->network->twitter;
        }
        return view('livewire.profile-network');
    }
}
