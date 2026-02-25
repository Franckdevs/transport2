<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification OTP - Transport</title>
    <link rel="icon" href="{{ asset('log.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #ffd000;
            --secondary-color: #000000;
            --accent-color: #ffeb3b;
            --light-color: #ffffff;
            --dark-color: #000000;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 2rem;
        }

        .card-header {
            background: transparent;
            border: none;
            text-align: center;
            padding: 1.5rem 0;
        }

        .card-header h2 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .otp-input {
            letter-spacing: 2px;
            font-size: 1.5rem;
            text-align: center;
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .otp-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 208, 0, 0.25);
            outline: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            width: 100%;
            border-radius: 8px;
            color: var(--dark-color);
            transition: all 0.3s ease;
        }

        .btn-primary:hover, .btn-primary:active, .btn-primary:focus, .btn-primary:disabled {
            background-color: var(--primary-color); /* Garde la couleur jaune */
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            color: var(--dark-color); /* Texte noir pour le contraste */
        }

        .back-to-login {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: var(--primary-color);
            text-decoration: none;
        }

        .back-to-login:hover {
            text-decoration: underline;
        }

        .resend-otp {
            text-align: center;
            margin-top: 1rem;
        }

        .resend-otp a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .resend-otp a:hover {
            text-decoration: underline;
        }

        /* Style pour le spinner de chargement */
        .spinner-border {
            display: none;
            width: 1rem;
            height: 1rem;
            border-width: 0.2em;
            margin-right: 0.5rem;
            vertical-align: text-top;
        }
        
        .btn-primary:disabled {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Vérification OTP</h2>
                        <p>Entrez le code à 6 chiffres envoyé à votre adresse email</p>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.verify.otp') }}">
                            @csrf

                            <div class="mb-4">
                                <input id="otp" type="text" class="form-control otp-input @error('otp') is-invalid @enderror" 
                                       name="otp" value="{{ old('otp') }}" required autofocus
                                       placeholder="000000" maxlength="6" pattern="\d{6}" inputmode="numeric">

                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary" id="verifyButton">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="btn-text">Vérifier le code</span>
                            </button>

                            <div class="resend-otp">
                                <p>Vous n'avez pas reçu de code ? <a href="{{ route('password.request') }}">Renvoyer le code</a></p>
                            </div>

                            <a href="{{ route('login') }}" class="back-to-login">
                                <i class="bi bi-arrow-left"></i> Retour à la connexion
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Formatage automatique de l'OTP
        document.getElementById('otp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 6);
        });

        // Gestion du chargement du formulaire
        document.querySelector('form').addEventListener('submit', function() {
            const button = document.getElementById('verifyButton');
            const spinner = button.querySelector('.spinner-border');
            const buttonText = button.querySelector('.btn-text');
            
            // Désactiver le bouton et afficher le spinner
            button.disabled = true;
            spinner.style.display = 'inline-block';
            buttonText.textContent = 'Vérification...';
        });
    </script>
</body>
</html>