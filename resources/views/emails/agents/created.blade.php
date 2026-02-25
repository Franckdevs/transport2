<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de votre compte</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #007bff;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 28px;
        }
        .welcome-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }
        .info-box {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ffc107;
        }
        .info-box h3 {
            color: #495057;
            margin-top: 0;
        }
        .credentials {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .credentials h4 {
            color: #856404;
            margin-top: 0;
        }
        .credential-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .credential-item:last-child {
            border-bottom: none;
        }
        .credential-label {
            font-weight: bold;
            color: #495057;
        }
        .credential-value {
            font-family: 'Courier New', monospace;
            background-color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .security-notice {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #17a2b8;
        }
        .security-notice h4 {
            color: #0c5460;
            margin-top: 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #6c757d;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- <div class="header">
            <h1>Bienvenue sur betro</h1>
        </div> --}}

        <div class="welcome-section">
            <h2>Bienvenue {{ $agent->prenom ?? 'Prénom non fourni' }} {{ $agent->nom ?? 'Nom non fourni'}},</h2>
        </div>


        <div class="info-box" style="background-color: #e8f5e8; border-left-color: #28a745;">
            <h3>Informations de votre compagnie</h3>
            <div class="credential-item">
                <span class="credential-label">Nom de la compagnie :</span>
                <span class="credential-value">{{ $compagnie->nom_complet_compagnies ?? 'Non spécifiée' }}</span>
            </div>
            <div class="credential-item">
                <span class="credential-label">Votre rôle :</span>
                <span class="credential-value">{{ $agent->role_personnel ?? 'Non spécifié' }}</span>
            </div>
        </div>

        <div class="credentials">
            <h4>Identifiants de connexion</h4>
            <div class="credential-item">
                <span class="credential-label">Email :</span>
                <span class="credential-value">{{ $agent->email ?? 'Email non fourni' }}</span>
            </div>
            <div class="credential-item">
                <span class="credential-label">Mot de passe temporaire :</span>
                <span class="credential-value">{{ $password ?? 'Mot de passe non fourni' }}</span>
            </div>
        </div>

        <div class="security-notice">
            <h4>🛡️ Important : Sécurité de votre compte</h4>
            <p>Pour des raisons de sécurité, nous vous recommandons vivement de :</p>
            <ul>
                <li>Changer votre mot de passe dès votre première connexion</li>
                <li>Choisir un mot de passe robuste (8+ caractères, majuscules, chiffres)</li>
                <li>Ne jamais partager vos identifiants</li>
            </ul>
        </div>
    </div>
</body>
</html>
