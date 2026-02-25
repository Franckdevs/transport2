<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation de votre mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            padding: 10px 20px;
            background-color: #f8f9fa;
            border-radius: 4px;
            display: inline-block;
            margin: 15px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ffd000;
            color: #000;
            text-decoration: none;
            border-radius: 4px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- <img src="{{ asset('log.png') }}" alt="Logo" style="width: 100px; height: 100px;"> --}}
        <h1>Betro</h1>

        <h2>Demande de réinitialisation de mot de passe</h2>
        
        <p>Bonjour, {{ $user->nom }} {{ $user->prenom }}</p>
        
        <p>Vous avez demandé à réinitialiser votre mot de passe. Voici votre code de vérification :</p>
        
        <div class="otp-code">{{ $otp }}</div>
        
        <p>Ce code est valable pendant 30 minutes. Ne le partagez avec personne.</p>
        
        <p>Si vous n'avez pas demandé cette réinitialisation, vous pouvez ignorer cet email.</p>
        
        <p>Cordialement,<br>L'équipe Transport</p>
    </div>
</body>
</html>