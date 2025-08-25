<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #2ec4b6;
            --light: #f8f9fa;
            --dark: #2c3e50;
            --gray: #6c757d;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --gradient: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            --border-radius: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            background-image:
                radial-gradient(#4361ee15 1px, transparent 2px),
                radial-gradient(#3a0ca310 1px, transparent 2px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
            padding: 20px;
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background-color: var(--white);
            border-radius: var(--border-radius);
            padding: 40px;
            max-width: 700px;
            width: 100%;
            margin: 20px auto;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: var(--gradient);
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 70px;
            height: 70px;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .logo i {
            font-size: 32px;
            color: var(--white);
        }

        h2 {
            color: var(--dark);
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .welcome-text {
            color: var(--gray);
            font-weight: 500;
            font-size: 18px;
        }

        .highlight {
            color: var(--primary);
            font-weight: 600;
        }

        .content {
            margin: 25px 0;
        }

        p {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .success-card {
            background-color: #f0f9ff;
            border-left: 4px solid var(--success);
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
            display: flex;
            align-items: center;
        }

        .success-card i {
            color: var(--success);
            font-size: 24px;
            margin-right: 15px;
        }

        .btn-container {
            display: flex;
            gap: 15px;
            margin: 30px 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 28px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .btn-primary {
            background: var(--gradient);
            color: var(--white);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
        }

        .btn-secondary {
            background-color: var(--light);
            color: var(--dark);
        }

        .btn-secondary:hover {
            background-color: #e9ecef;
            transform: translateY(-3px);
        }

        .btn i {
            margin-right: 10px;
            font-size: 18px;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            text-align: center;
            color: var(--gray);
        }

        .footer p {
            margin-bottom: 5px;
        }

        .team-name {
            color: var(--primary);
            font-weight: 600;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }

            .header {
                flex-direction: column;
                text-align: center;
            }

            .logo {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .btn-container {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <i class="fas fa-building"></i>
            </div>
            <div>
                <h2>Bonjour <span class="highlight">{{ $infoUser->nom }} {{ $infoUser->prenom }}</span>,</h2>
                <p class="welcome-text">Bienvenue dans notre écosystème</p>
            </div>
        </div>

        <div class="content">
            <p>Nous sommes ravis de vous annoncer que la compagnie <strong class="highlight">{{ $compagnies->nom_complet_compagnies }}</strong> a été créée avec succès dans notre système.</p>

            <div class="success-card">
                <i class="fas fa-check-circle"></i>
                <div>
                    <strong>Votre compte est maintenant actif</strong>
                    <p style="margin-bottom: 0;">Vous pouvez dès à présent accéder à toutes les fonctionnalités de notre plateforme.</p>
                </div>
            </div>

            <p>Pour garantir la sécurité de votre compte, nous vous recommandons de modifier votre mot de passe lors de votre première connexion.</p>
        </div>

        <p><strong>Prochaines étapes :</strong></p>

        @php
            use Illuminate\Support\Facades\Crypt;
        @endphp

        <div class="btn-container">
            <!-- Bouton pour créer les accès -->
            <a href="{{ url('/creer-acces/' . Crypt::encryptString($compagnies->id)) }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Créer les accès utilisateur
            </a>
        </div>

        <div class="footer">
            <p>Besoin d'aide ? Contactez notre support à <a href="mailto:support@votreentreprise.com" style="color: var(--primary);">support@votreentreprise.com</a></p>
            <p>Merci,<br><span class="team-name">L'équipe de gestion</span></p>
        </div>
    </div>
</body>
</html>
