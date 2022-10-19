<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailConstruct extends Mailable
{
    use Queueable, SerializesModels; 

    public $objMail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($objMail)
    {
        $this->objMail = $objMail;
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ramon@webalmeria.com')->view('mail.contacto')->subject('Enviado desde localhost Laravel9 web');
    }
}
