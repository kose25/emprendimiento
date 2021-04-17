<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChangePassword extends Component
{
    public $currentPassword, $newPassword, $newPassword_confirmation;

    protected $rules = [
        'newPassword' => 'required|min:8|string|confirmed',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function changePassword()
    {
        $this->validate(); 
        if (Hash::check($this->currentPassword, Auth::User()->password)) {
            User::where('id', Auth::user()->id)->update(['password' => Hash::make($this->newPassword)]);
            $this->emit('pass updated');
            $this->reset();
        } else {
            $this->emit('error');
            $this->reset();
        }
    }

    public function render()
    {
        return view('livewire.change-password');
    }
}
