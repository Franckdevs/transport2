<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Transport</title>
    <link rel="icon" href="{{ asset('log.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #ffffff;
            --text-color: #333333;
            --border-color: #e0e0e0;
            --error-color: #e74c3c;
        }

        * {
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--text-color);
            overflow-x: hidden;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .login-page {
            display: flex;
            flex: 1;
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

        .login-image {
            flex: 1 0 50%;
            background: url('{{ $imageConnexionWeb ?? 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80' }}') no-repeat center center;
            background-size: cover;
            min-height: 300px;
        }

        .login-content {
            flex: 1 0 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            overflow-y: auto;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
        }

        
    </style>
</head>
<body>
 
    <div class="login-page">
        <div class="login-image">
            <!-- L'image est définie en arrière-plan -->
        </div>
        <div class="login-content">
            <div class="login-container">
        <div class="login-header text-center mb-4">
            <h2 class="mb-0">Se connecter</h2>
            <p class="text-muted mt-2">Entrez vos identifiants pour accéder à votre espace</p>
        </div>

           @if (session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2" role="alert">
                {{-- <i class="bi bi-check-circle-fill"></i> --}}
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if (session('password_pending'))
            <div class="alert alert-warning d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-info-circle-fill"></i>
                <div>{{ session('password_pending') }}</div>
            </div>
        @endif

        <form method="POST" action="{{ route('login_connexion') }}" id="loginForm">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-envelope text-muted"></i>
                    </span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Votre adresse email" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-lock text-muted"></i>
                    </span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Se souvenir de moi
                    </label>
                </div>
                <a href="{{ route('password.request') }}" class="forgot-password-link">
                    <i class="bi bi-question-circle"></i> Mot de passe oublié ?
                </a>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3" id="loginButton" onclick="showLoader()">
                <span id="buttonText">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Se connecter
                </span>
                <div id="loader" class="spinner-border spinner-border-sm d-none" role="status">
                    <span class="visually-hidden">Chargement...</span>
                </div>
            </button>

            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="back-to-home">
                    <i class="bi bi-arrow-left"></i> Retour à l'accueil
                </a>
                {{-- <p class="mb-0 text-muted mt-3">Vous n'avez pas de compte ? <a href="#" class="text-decoration-none">S'inscrire</a></p> --}}
            </div>
            </form>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showLoader() {
            document.getElementById('buttonText').classList.add('d-none');
            document.getElementById('loader').classList.remove('d-none');
            document.getElementById('loginButton').setAttribute('disabled', 'disabled');
            
            // Soumettre le formulaire après un court délai pour permettre l'animation
            setTimeout(() => {
                document.getElementById('loginForm').submit();
            }, 100);
        }
    </script>
    <style>
        /* Styles pour les tablettes */
        @media (max-width: 991.98px) {
            .login-page {
                flex-direction: column;
                min-height: 100vh;
            }

            .login-image {
                flex: 0 0 35vh;
                min-height: 35vh;
                width: 100%;
            }

            .login-content {
                flex: 1;
                padding: 2rem 1.5rem;
                min-height: 65vh;
            }

            .login-container {
                max-width: 500px;
            }
        }

        /* Styles pour les mobiles */
        @media (max-width: 575.98px) {
            .login-content {
                padding: 1.5rem 1rem;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }

            .form-label {
                font-size: 0.95rem;
            }

            .btn {
                padding: 0.5rem 1rem;
            }
        }

        /* Très petits écrans */
        @media (max-width: 360px) {
            .login-content {
                padding: 1rem 0.75rem;
            }

            .login-header h2 {
                font-size: 1.35rem;
            }

            .form-control, .input-group-text {
                padding: 0.5rem 0.75rem;
            }
        }

        /* Styles des boutons et liens */
        .btn-primary {
            background-color: #ffc107 !important;
            border-color: #ffc107 !important;
            color: #000 !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: #ffc107 !important;
            border-color: #ffc107 !important;
            color: #000 !important;
            transform: none;
            box-shadow: none;
        }

        /* Styles de survol et d'état actif désactivés pour maintenir la couleur jaune */

        .forgot-password-link {
            color: #6c757d;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .forgot-password-link:hover {
            color: #ffc107;
            text-decoration: underline;
        }

        .back-to-home {
            display: inline-flex;
            align-items: center;
            color: #6c757d;
            text-decoration: none;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .back-to-home:hover {
            color: #ffc107;
            transform: translateX(-3px);
        }

        .back-to-home i {
            margin-right: 5px;
            transition: transform 0.3s ease;
        }

        .back-to-home:hover i {
            transform: translateX(-3px);
        }

        /* Correction pour les champs de formulaire */
        .form-control, .input-group-text {
            height: auto;
            min-height: 45px;
        }

        /* Amélioration de la lisibilité sur mobile */
        @media (hover: none) {
            .form-control, .btn {
                font-size: 16px; /* Désactive le zoom automatique sur iOS */
            }
        }

        /* Désactive le défilement sur tous les éléments sauf .login-content */
        *:not(.login-content) {
            overflow: hidden !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.querySelector('.toggle-password');
            const password = document.querySelector('#password');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.querySelector('i').classList.toggle('bi-eye');
                    this.querySelector('i').classList.toggle('bi-eye-slash');
                });
            }

            // Add focus styles to form controls
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach(control => {
                control.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                control.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });
        });
    </script>
</body>
</html>
