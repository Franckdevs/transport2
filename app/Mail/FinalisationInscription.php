<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FinalisationInscription extends Mailable
{
    use Queueable, SerializesModels;
        public $otp;
        public $utilisateur;
    /**
     * Create a new message instance.
     */
    public function __construct($otp , $utilisateur)
    {
        $this->otp = $otp;
        $this->utilisateur = $utilisateur;
    }
    /**
     * Get the message envelope.
     */
    public function build()
    {
    return $this->subject('Votre code OTP')
    ->view('email_app.finalisation_inscription_final'); // crée la vue resources/views/emails/otp.blade.php
    }
}
