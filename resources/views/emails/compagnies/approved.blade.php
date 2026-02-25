@php
    $compagnie = $compagnie ?? null;
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Validation de votre inscription - BETRO</title>
    <style>
        body {
            background-color: #f6f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            width: 100%;
            padding: 32px 0;
        }
        .container {
            max-width: 640px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 35px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #FFD700, #FFC000);
            color: #000000;
            padding: 40px 0;
            border-radius: 0 0 24px 24px;
            margin-bottom: 32px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            color: #000000;
        }
        .content {
            padding: 40px;
        }
        .badge {
            display: inline-block;
            background: linear-gradient(135deg, #FFD700, #FFC000);
            color: #000000;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
        }
        .card {
            background: #FFF9C4;
            border-radius: 16px;
            padding: 24px;
            margin: 24px 0;
            box-shadow: 0 4px 20px rgba(255, 200, 0, 0.1);
            border: 1px solid #FFE082;
        }
        .card-title {
            font-size: 15px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .card-title span {
            background: #FFC107;
            color: #000000;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 14px;
        }
        ul {
            padding-left: 20px;
            margin: 0;
            color: #4b5563;
            line-height: 1.7;
        }
        .cta {
            display: block;
            text-align: center;
            text-decoration: none;
            margin: 36px 0 8px;
            background: linear-gradient(135deg, #FFD700, #FFC000);
            color: #000000;
            padding: 14px 20px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 15px 30px rgba(255, 215, 0, 0.35);
        }
        .cta span {
            margin-left: 8px;
            font-size: 14px;
        }
        .cta:focus,
        .cta:hover {
            opacity: 0.9;
        }
        .footer {
            padding: 0 40px 36px;
            font-size: 13px;
            color: #000000;
            line-height: 1.6;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="header">
            <h1>Bienvenue sur BETRO</h1>
            <p style="margin: 10px 0 0; font-size: 18px; font-weight: 500;">{{ $compagnie->nom_complet_compagnies }}</p>

        </div>
        <div class="content">
            <div class="badge">Votre compte a été validé</div>
            <p>Nous sommes ravis de vous informer que la demande d'inscription de votre compagnie
                <strong>{{ $compagnie->nom_complet_compagnies }}</strong> a été validée avec succès.</p>

            @if($user)
            <div class="card" style="margin-top: 20px;">
                <div>
                    <span><i class="fas fa-user"></i></span>
                    Informations de l'administrateur
                </div>
                <p>
                    <strong>Email :</strong> {{ $user->email }}<br>
                    <strong>Nom :</strong> {{ $user->nom ?? 'Non spécifié' }}<br>
                    <strong>Prénom :</strong> {{ $user->prenom ?? 'Non spécifié' }}<br>
                </p>
            </div>
            @endif

            <div class="card">
                <div><span><i class="fas fa-building"></i></span>Informations de la compagnie</div>
                <ul>
                    <li><strong>Email</strong> : {{ $compagnie->email_compagnies }}</li>
                    <li><strong>Téléphone</strong> : {{ $compagnie->telephone_compagnies }}</li>
                    <li><strong>Adresse</strong> : {{ $compagnie->adresse_compagnies }}</li>
                  <li><strong>Ville</strong> :  @if(is_array($ville))
                        {{ $ville['nom_ville'] ?? 'Ville non spécifiée' }}
                    @else
                        {{ $ville ?? 'Ville non spécifiée' }}
                    @endif</li>
                </ul>
            </div>

            <div class="card">
                <div><span><i class="fas fa-key"></i></span>Création de votre compte</div>
                <p style="margin: 0; color: #4b5563;">
                    Créez maintenant les accès sécurisés pour vos administrateurs en suivant le lien ci-dessous :
                </p>
                <a href="{{ $createAccessUrl }}" class="cta" style="color: #000000 !important;">
                    Configurer les accès
                    <span style="color: #000000 !important;">→</span>
                </a>
                <p style="margin-top: 8px; text-align: center; font-size: 12px; color: #9ca3af;">
                    Ce lien est personnel et ne doit pas être partagé publiquement.
                </p>
            </div>

            <p>Nous restons disponibles pour vous accompagner lors de votre arrivée sur la plateforme.</p>
        </div>
        <div class="footer">
            Cordialement,<br>
            L’équipe BETRO<br>
            —<br>
            Ce message est généré automatiquement, merci de ne pas y répondre.
        </div>
    </div>
</div>
</body>
</html>

