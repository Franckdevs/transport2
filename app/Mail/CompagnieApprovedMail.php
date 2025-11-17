<?php

namespace App\Mail;

use App\Models\Compagnies;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompagnieApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Compagnies $compagnie;
    public string $createAccessUrl;

    /**
     * Crée une nouvelle instance du message.
     */
    public function __construct(Compagnies $compagnie, string $createAccessUrl)
    {
        $this->compagnie = $compagnie;
        $this->createAccessUrl = $createAccessUrl;
    }

    /**
     * Construit le message.
     */
    public function build(): self
    {
        return $this->subject('Validation de votre inscription - BETRO')
            ->view('emails.compagnies.approved');
    }
}

