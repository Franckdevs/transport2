<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création de compte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            color: #333;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2c3e50;
        }
        .btn {
            display: inline-block;
            margin: 10px 10px 0 0;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
        }
        .btn-primary {
            background-color: #28a745;
        }
        .btn-secondary {
            background-color: #007bff;
        }
        p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bonjour {{ $infoUser->nom }} {{ $infoUser->prenom }},</h2>

        <p>La compagnie <strong>{{ $compagnies->nom_complet_compagnies }}</strong> a été créée avec succès dans notre système.</p>

        <p>Nous vous invitons à vous connecter pour la première fois et à modifier votre mot de passe dès que possible pour sécuriser votre compte.</p>

        <p>
            Vous pouvez :
        </p>
@php
    use Illuminate\Support\Facades\Crypt;
@endphp

        <!-- Bouton pour créer les accès -->
<a href="{{ url('/creer-acces/' . Crypt::encryptString($compagnies->id)) }}" class="btn btn-primary">Créer les accès utilisateur</a>

        <!-- Bouton pour réinitialiser les accès -->

        <p style="margin-top: 30px;">Merci,<br>L’équipe de gestion</p>
    </div>
</body>
</html>
