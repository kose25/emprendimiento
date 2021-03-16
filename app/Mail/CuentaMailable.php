<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CuentaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Contraseña de su cuenta de ';
    public $email;
    public $password;
    public $rol;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password, $email, $rol)
    {
        //
        $this->password = $password;
        $this->email = $email;
        $this->rol = $rol;
        $this->subject=$this->subject.$rol;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.cuenta');
    }
}
