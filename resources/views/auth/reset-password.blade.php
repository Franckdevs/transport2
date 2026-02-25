<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe - Transport</title>
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

        .card-header p {
            color: #6c757d;
            margin-bottom: 0;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 208, 0, 0.25);
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
        
        /* Style pour le bouton au survol et au chargement */
        .btn-primary:hover, .btn-loading {
            background-color: var(--primary-color) !important;
            transform: none;
            box-shadow: none;
            color: var(--dark-color) !important;
        }

        .btn-primary:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            color: var(--dark-color);
        }

        /* Style pour le bouton avec chargement */
        .btn-loading {
            position: relative;
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-loading:after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            border: 3px solid transparent;
            border-top-color: #000;
            border-radius: 50%;
            animation: button-loading-spinner 0.8s ease infinite;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .btn-loading span {
            opacity: 0;
        }

        .btn-loading:after {
            opacity: 1;
        }

        @keyframes button-loading-spinner {
            from {
                transform: rotate(0turn);
            }
            to {
                transform: rotate(1turn);
            }
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

        .alert {
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: none;
        }

        .alert-success {
            background-color: rgba(76, 175, 80, 0.15);
            color: #2e7d32;
        }

        .invalid-feedback {
            color: #d32f2f;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-control.is-invalid {
            border-color: #d32f2f;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23d32f2f'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23d32f2f' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Réinitialisation du mot de passe</h2>
                        <p>Entrez votre nouveau mot de passe</p>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-4">
                                <label for="email" class="form-label">Adresse email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                                       placeholder="votre@email.com" >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                       <script>
document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const originalValue = emailInput.value;

    // Forcer readonly en permanence
    emailInput.setAttribute('readonly', true);

    // Bloquer toute saisie clavier
    emailInput.addEventListener('keydown', function (e) {
        e.preventDefault();
    });

    // Bloquer collage / couper
    emailInput.addEventListener('paste', e => e.preventDefault());
    emailInput.addEventListener('cut', e => e.preventDefault());

    // Réinitialiser la valeur si elle est modifiée via JS ou inspecteur
    setInterval(() => {
        if (emailInput.value !== originalValue) {
            emailInput.value = originalValue;
        }

        if (!emailInput.hasAttribute('readonly')) {
            emailInput.setAttribute('readonly', true);
        }
    }, 300);
});
</script>


                               
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Nouveau mot de passe</label>
                                <input id="password" type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="new-password"
                                       placeholder="Votre nouveau mot de passe">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password-confirm" class="form-label">Confirmer le mot de passe</label>
                                <input id="password-confirm" type="password" class="form-control" 
                                       name="password_confirmation" required autocomplete="new-password"
                                       placeholder="Confirmez votre nouveau mot de passe">
                            </div>

                            <button type="submit" class="btn btn-primary" id="resetPasswordBtn">
                                <span>{{ __('Réinitialiser le mot de passe') }}</span>
                            </button>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const form = document.querySelector('form[method="POST"]');
                                    const submitBtn = document.getElementById('resetPasswordBtn');

                                    form.addEventListener('submit', function() {
                                        submitBtn.classList.add('btn-loading');
                                        submitBtn.disabled = true;
                                    });
                                });
                            </script>

                            <a href="{{ route('login') }}" class="back-to-login">
                                <i class="bi bi-arrow-left"></i> Retour à la connexion
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
