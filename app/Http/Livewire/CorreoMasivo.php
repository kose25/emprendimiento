<?php


namespace App\Http\Livewire;

ini_set('max_execution_time', 600);

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\CorreoMasivo as CM;
use App\Models\User;


class CorreoMasivo extends Component
{
    public $body, $subject;


    public function send()
    {
        //$this->emit('enviando correos');
        $users = User::latest()->limit(10)->get();
        $correo = new CM($this->subject, $this->body);
        //Mail::to($this->email)->send($correo);

        foreach ($users as $user) {
            Mail::to($user->email)->send(new CM($this->subject, $this->body));
        }
        $this->reset(['body', 'subject']);
        $this->emit('correos enviados');
        $this->emit('finished');

    }


    public function render()
    {
        return view('livewire.correo-masivo');
    }
}
