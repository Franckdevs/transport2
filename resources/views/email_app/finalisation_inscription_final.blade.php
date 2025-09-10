<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Code OTP</title>
    <style>
        /* Reset */
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
        }

        .container {
            background-color: #ffffff;
            width: 600px;
            max-width: 90%;
            margin: 50px auto;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            border-top: 8px solid #4CAF50;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            font-size: 24px;
        }

        .header p {
            color: #555;
            font-size: 16px;
            margin-top: 5px;
        }

        .otp-box {
            text-align: center;
            background-color: #f9f9f9;
            padding: 20px;
            margin: 25px 0;
            border-radius: 10px;
            border: 1px dashed #ff5722;
        }

        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #ff5722;
            letter-spacing: 6px;
        }

        .content p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            margin-top: 35px;
            font-size: 13px;
            color: #999;
        }

        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #45a049;
        }

        /* Responsive */
        @media only screen and (max-width: 600px) {
            .container {
                padding: 20px;
            }
            .otp-code {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bonjour {{ $utilisateur->nom ?? ' '}} {{ $utilisateur->prenom ?? ' ' }}</h1>
            <p>Nous sommes ravis de vous accueillir sur <strong>BETRO</strong></p>
        </div>

        <div class="content">
            <p>Merci pour votre inscription. Voici votre code OTP personnel pour finaliser votre compte :</p>

            <p>Ce code est valable uniquement pour une courte période. Ne le partagez avec personne.</p>

            <p>Si vous n'avez pas demandé ce code, vous pouvez ignorer cet email.</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} BETRO. Tous droits réservés.<br>
             COTE D'IVOIRE
        </div>
    </div>
</body>
</html>
