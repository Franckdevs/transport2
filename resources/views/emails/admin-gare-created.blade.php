<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue - Administrateur de Gare</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #007bff;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 24px;
        }
        .welcome-section {
            margin-bottom: 25px;
        }
        .gare-info {
            background: #f8f9fa;
            border-left: 4px solid #28a745;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .gare-info h3 {
            color: #28a745;
            margin-top: 0;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
        .info-label {
            font-weight: bold;
            color: #666;
        }
        .info-value {
            color: #333;
        }
        .cta-section {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            border-radius: 10px;
            color: white;
        }
        .btn-connect {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            font-size: 16px;
            margin-top: 15px;
            transition: background 0.3s ease;
        }
        .btn-connect:hover {
            background: #218838;
            color: white;
        }
        .instructions {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }
        .security-note {
            background: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
            color: #0c5460;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🚉 Bienvenue dans l'équipe BETRO Transport</h1>
            <p>Vous êtes maintenant administrateur de gare</p>
        </div>

        <div class="welcome-section">
            <h2>Bonjour {{ $user->name }},</h2>
            <p>Félicitations ! Vous avez été désigné(e) comme <strong>administrateur</strong> de la gare suivante :</p>
        </div>

        <div class="gare-info">
            <h3>📍 Informations de votre gare</h3>
            <div class="info-row">
                <span class="info-label">Nom de la gare :</span>
                <span class="info-value">{{ $gare->nom_gare ?? 'Non spécifié' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Adresse :</span>
                <span class="info-value">{{ $gare->adresse_gare ?? 'Non spécifiée' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Téléphone :</span>
                <span class="info-value">{{ $gare->telephone_gare ?? 'Non spécifié' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Nombre de quais :</span>
                <span class="info-value">{{ $gare->nombre_quais ?? 'Non spécifié' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Horaires :</span>
                <span class="info-value">
                    {{ $gare->heure_ouverture ?? '---' }} - {{ $gare->heure_fermeture ?? '---' }}
                </span>
            </div>
        </div>

        <div class="cta-section">
            <h3>🔐 Configurez votre accès</h3>
            <p>Pour accéder à votre tableau de bord administrateur, vous devez d'abord créer votre mot de passe sécurisé.</p>
            <a href="{{ $loginUrl }}" class="btn-connect">
                🚀 Me connecter et créer mon mot de passe
            </a>
        </div>

        <div class="instructions">
            <h4>📋 Prochaines étapes :</h4>
            <ol>
                <li>Cliquez sur le bouton "Me connecter" ci-dessus</li>
                <li>Créez un mot de passe sécurisé pour votre compte</li>
                <li>Accédez à votre tableau de bord administrateur</li>
                <li>Configurez les paramètres de votre gare</li>
                <li>Gérez les horaires, les bus et le personnel</li>
            </ol>
        </div>

        <div class="security-note">
            <strong>🔒 Note de sécurité :</strong> Ce lien est valide pendant 7 jours. Si vous ne configurez pas votre compte dans ce délai, contactez l'administrateur système pour obtenir un nouveau lien.
        </div>

        <div class="footer">
            <p><strong>BETRO Transport</strong> - Système de gestion de transport</p>
            <p>Email : {{ $user->email }}</p>
            <p>Si vous avez des questions, contactez notre support technique.</p>
        </div>
    </div>
</body>
</html>
