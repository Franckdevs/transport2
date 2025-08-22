<?php

namespace App\Mail;

use App\Models\Gare;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class AdminGareCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $gare;
    public $loginUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Gare $gare)
    {
        $this->user = $user;
        $this->gare = $gare;
        
        // Créer un lien sécurisé temporaire pour la création du mot de passe
        $this->loginUrl = URL::temporarySignedRoute(
            'admin.gare.setup-password',
            now()->addDays(7), // Valide pendant 7 jours
            ['user' => $user->id]
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue - Vous êtes administrateur de la gare ' . $this->gare->nom_gare,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-gare-created',
            with: [
                'user' => $this->user,
                'gare' => $this->gare,
                'loginUrl' => $this->loginUrl,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
