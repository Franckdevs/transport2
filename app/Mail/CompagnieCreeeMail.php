<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompagnieCreeeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $infoUser;
    Public $compagnies;
    /**
     * Create a new message instance.
     */
    public function __construct( $infoUser , $compagnies)
    {
        $this->infoUser = $infoUser;
        $this->compagnies = $compagnies;
    }

    /**
     * Get the message envelope.
     */

    public function build()
    {
        return $this->subject('Création de votre compte administrateur')
                    ->view('betro.compagnie.emails.compagnie_creee');
    }
}
