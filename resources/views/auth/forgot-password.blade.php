@php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Session;
@endphp

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - Transport</title>
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
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --info-color: #000000;
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

        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 208, 0, 0.25);
        }

        /* .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            width: 100%;
            border-radius: 8px;
            color: var(--dark-color);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            color: var(--dark-color);
        } */
         .btn-primary {
    background-color: var(--primary-color) !important;
    border: none;
    padding: 0.75rem 2rem;
    font-weight: 600;
    width: 100%;
    border-radius: 8px;
    color: var(--dark-color) !important;
    transition: all 0.3s ease;
}

.btn-primary:hover, 
.btn-primary:focus, 
.btn-primary:active {
    background-color: var(--accent-color) !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    color: var(--dark-color) !important;
    border-color: transparent !important;
    outline: none !important;
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

        /* Styles pour le bouton avec loader */
        #resetButton {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        #loader {
            position: absolute;
            display: none;
        }

        #loader.d-none {
            display: none;
        }

        #loader:not(.d-none) {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Mot de passe oublié</h2>
                        <p>Entrez votre adresse email pour réinitialiser votre mot de passe</p>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label">Adresse email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="votre@email.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary py-3" id="resetButton">
                                    <span id="buttonText">
                                        <i class="bi bi-send-fill me-2"></i> Envoyer le code de réinitialisation
                                    </span>
                                    <div id="loader" class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="visually-hidden">Chargement...</span>
                                    </div>
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                {{-- <a href="{{ route('login') }}" class="text-decoration-none">
                                    <i class="bi bi-arrow-left me-1"></i> Retour à la connexion
                                </a> --}}
                                <a href="{{ route('login') }}" class="text-decoration-none" style="color: var(--primary-color);">
    <i class="bi bi-arrow-left me-1"></i> Retour à la connexion
</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action="{{ route("password.email") }}"]');
            const button = document.getElementById('resetButton');
            const buttonText = document.getElementById('buttonText');
            const loader = document.getElementById('loader');

            if (form) {
                form.addEventListener('submit', function() {
                    // Désactiver le bouton
                    button.setAttribute('disabled', 'disabled');
                    // Masquer le texte et afficher le loader
                    buttonText.classList.add('d-none');
                    loader.classList.remove('d-none');
                });
            }
        });
    </script>
</body>
</html>