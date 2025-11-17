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
            padding: 32px 40px 24px;
            background: linear-gradient(135deg, #4f46e5, #2563eb);
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 40px;
        }
        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.12);
            color: #1d4ed8;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            margin: 28px 0;
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
            display: inline-flex;
            width: 18px;
            height: 18px;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background: #eef2ff;
            color: #4f46e5;
            font-size: 12px;
            font-weight: 700;
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
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
            color: #ffffff;
            padding: 14px 20px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 15px 30px rgba(59, 130, 246, 0.35);
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
            color: #6b7280;
            line-height: 1.6;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="header">
            <h1>Bienvenue dans BETRO</h1>
            <p style="margin: 6px 0 0; opacity: 0.9;">Votre compagnie est désormais prête à rejoindre la plateforme.</p>
        </div>
        <div class="content">
            <div class="badge">Validation confirmée</div>
            <p>Bonjour,<br><br>
                Nous sommes ravis de vous informer que la demande d'inscription de votre compagnie
                <strong>{{ $compagnie->nom_complet_compagnies }}</strong> a été validée avec succès.</p>

            <div class="card">
                <div class="card-title"><span>1</span>Informations de la compagnie</div>
                <ul>
                    <li><strong>Email</strong> : {{ $compagnie->email_compagnies }}</li>
                    <li><strong>Téléphone</strong> : {{ $compagnie->telephone_compagnies }}</li>
                    <li><strong>Adresse</strong> : {{ $compagnie->adresse_compagnies }}</li>
                </ul>
            </div>

            <div class="card">
                <div class="card-title"><span>2</span>Étape suivante</div>
                <p style="margin: 0; color: #4b5563;">
                    Créez maintenant les accès sécurisés pour vos administrateurs en suivant le lien ci-dessous :
                </p>
                <a href="{{ $createAccessUrl }}" class="cta">
                    Configurer les accès
                    <span>→</span>
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

