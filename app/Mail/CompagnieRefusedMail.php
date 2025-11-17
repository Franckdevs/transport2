<?php

namespace App\Mail;

use App\Models\Compagnies;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompagnieRefusedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Compagnies $compagnie;
    public string $reason;

    /**
     * Crée une nouvelle instance du message.
     */
    public function __construct(Compagnies $compagnie, string $reason)
    {
        $this->compagnie = $compagnie;
        $this->reason = $reason;
    }

    /**
     * Construit le message.
     */
    public function build(): self
    {
        return $this->subject('Mise à jour de votre demande - BETRO')
            ->view('emails.compagnies.refused');
    }
}

