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
    public $user;
    public $ville;

    /**
     * Crée une nouvelle instance du message.
     */
    public function __construct(Compagnies $compagnie, string $createAccessUrl , $user)
    {
        $this->compagnie = $compagnie;
        $this->createAccessUrl = $createAccessUrl;
        
        // Récupérer les informations de l'utilisateur
        $this->user = $user;
        
        // Récupérer le nom de la ville depuis le JSON
        $villeData = json_decode($compagnie->ville, true);
        $this->ville = $villeData['nom_ville'] ?? 'Ville non spécifiée';
        
        // Ajouter l'URL complète du logo si disponible
        if ($compagnie->logo_compagnies) {
            $this->compagnie->logo_url = asset('storage/' . $compagnie->logo_compagnies);
        } else {
            $this->compagnie->logo_url = asset('assets/images/default-logo.png'); // Logo par défaut
        }
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

