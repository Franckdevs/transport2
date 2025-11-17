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

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: hidden; /* Désactive le défilement global */
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            margin: 0;
            color: #333;
            display: flex;
            overflow: hidden; /* Désactive le défilement du body */
        }

        .login-page {
            display: flex;
            width: 100vw;
            height: 100vh;
            max-height: 100%;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            -webkit-overflow-scrolling: auto !important;
        }

        .login-image {
            flex: 1;
            min-width: 0; /* Permet à l'image de se réduire correctement */
            background: url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-content {
            flex: 1;
            min-width: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: white;
            overflow-y: auto;
            -webkit-overflow-scrolling: auto !important;
            overscroll-behavior: contain; /* Empêche le défilement de la page parente */
            max-height: 100vh;
        }

        .login-container {
            width: 100%;
            max-width: 500px;
            border-radius: 12px;
            padding: 2rem;
            margin: 0 auto;
            position: relative;
            overflow: visible;
        }

        .login-header {
            margin-bottom: 3rem; /* Plus d'espace en dessous du titre */
            padding: 0 1rem;
            text-align: center;
        }

        .login-header h2 {
            color: #333;
            font-weight: 700;
            font-size: 2.25rem; /* Taille de titre augmentée */
            margin-bottom: 1rem; /* Plus d'espace sous le titre */
            letter-spacing: -0.5px; /* Ajustement de l'espacement des lettres */
        }

        .login-header p {
            color: #6c757d;
            font-size: 1.15rem; /* Taille de police augmentée */
            margin: 0;
            line-height: 1.6; /* Meilleure lisibilité */
        }

        .login-title {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(30deg);
            pointer-events: none;
        }

        .login-header h1 {
            position: relative;
            z-index: 1;
        }

        .login-header h1 {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 600;
        }

        .login-form {
            padding: 0;
            width: 100%;
            overflow: visible;
        }

        @media (max-width: 576px) {
            .login-container {
                margin: 10px;
                max-width: 100%;
            }

            .login-form {
                padding: 1.5rem;
            }

            .btn-login {
                width: 80%;
            }
        }

        .form-floating {
            margin-bottom: 1.25rem;
        }

        .form-floating label {
            color: #6c757d;
        }

        .form-control {
            height: 52px;
            padding: 0.65rem 1.25rem;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.2s;
            width: 100%;
            margin-bottom: 1.25rem;
            line-height: 1.5;
            box-sizing: border-box; /* Assure que le padding est inclus dans la hauteur */
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        .input-group-text {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            padding: 0 1rem;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 50px;
            height: 52px; /* Hauteur fixe pour correspondre aux champs */
            box-sizing: border-box;
        }

        .input-group .form-control {
            border-left: none;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .input-group .toggle-password {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-left: none;
            color: #6c757d;
            padding: 0 1rem;
            font-size: 1.1rem;
            min-width: 50px;
            height: 52px; /* Hauteur fixe pour correspondre aux champs */
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-group .toggle-password:hover {
            background: #e9ecef;
        }

        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: #86b7fe;
        }

        .form-check-label {
            color: #495057;
            font-size: 0.95rem;
            user-select: none;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            padding: 0.75rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 1rem;
            height: 50px;
            width: 100%;
            margin: 1rem 0;
            overflow: hidden; /* Empêche le défilement */
            position: relative; /* Pour le positionnement des éléments enfants */
            html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden; /* Empêche tout défilement sur la page */
            position: fixed; /* Verrouille la position */
            width: 100%;
            -webkit-overflow-scrolling: auto !important; /* Désactive le défilement élastique sur iOS */
        }
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            transform: none; /* Supprime l'effet de translation qui pouvait causer le défilement */
        }

        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #6c757d;
        }

        .form-footer a {
            color: #666666;
            text-decoration: none;
            font-weight: 500;
        }

        /* Style du lien de retour */
        .back-to-home {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #000; /* Couleur noire au lieu de bleu */
            text-decoration: none;
            margin: 0.5rem 0;
            font-weight: 500;
            transition: background-color 0.2s, color 0.2s;
            background-color: var(--primary-color);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            border: none;
        }

        .back-to-home i {
            margin-right: 0.5rem;
            font-size: 1.1em;
            color: var(--primary-color);
        }

        .back-to-home:hover {
            color: #000; /* Couleur noire plus foncée au survol */
            background-color: #e6c000;
            text-decoration: none; /* Pas de soulignement pour un bouton */
        }

        .form-footer a:hover {
            text-decoration: underline;
            color: #333333;
        }
        /* Icons in inputs and toggle button in yellow */
        .input-group-text i, .toggle-password i {
            color: var(--primary-color) !important;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .remember-forgot {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        /* Color palette overrides: jaune (#ffd000), blanc (#ffffff), noir (#000000) */
        :root {
            --primary-color: #ffd000;
            --secondary-color: #000000;
            --accent-color: #ffeb3b;
            --light-color: #ffffff;
            --dark-color: #000000;
            --info-color: #000000;
            --text-color: #333333;
            --border-color: #e0e0e0;
            --error-color: #e74c3c;
        }

        /* Replace Bootstrap blues with white visuals and black text */
        .text-primary, .text-info { color: #ffffff !important; }
        .bg-primary, .bg-info { background-color: #ffffff !important; color: #000000 !important; }
        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: #000000 !important;
        }
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: #e6c000 !important;
            border-color: #e6c000 !important;
            color: #000000 !important;
        }

        /* Inputs and controls using the new palette */
        .form-control:focus {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 0.25rem rgba(255, 208, 0, 0.25) !important;
        }
        .form-check-input:checked {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }
        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 208, 0, 0.25) !important;
            border-color: var(--primary-color) !important;
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

        @if (session('password_pending'))
            <div class="alert alert-warning d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-info-circle-fill"></i>
                <div>{{ session('password_pending') }}</div>
            </div>
        @endif

        <form class="login-form" method="POST" action="{{ route('login_connexion') }}">
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
                <a href="#" class="text-decoration-none small">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                Se connecter
            </button>

            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="back-to-home">
                    <i class="bi bi-arrow-left"></i> Retour à l'accueil
                </a>
                <p class="mb-0 text-muted mt-3">Vous n'avez pas de compte ? <a href="#" class="text-decoration-none">S'inscrire</a></p>
            </div>
            </form>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @media (max-width: 992px) {
            .login-page {
                flex-direction: column;
                height: 100%;
                overflow-y: auto; /* Permet le défilement uniquement si nécessaire sur mobile */
            }

            .login-image {
                height: 40vh;
                min-height: 40vh;
                order: 1;
                width: 100%;
            }

            .login-content {
                order: 2;
                padding: 2.5rem 1.5rem;
                width: 100%;
                height: 60vh;
                min-height: 60vh;
                overflow-y: auto; /* Permet le défilement du contenu si nécessaire */
            }

            .login-container {
                max-width: 100%;
                padding: 0;
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            .login-form {
                flex: 1;
                display: flex;
                flex-direction: column;
            }
        }

        /* Désactive le défilement horizontal sur tous les éléments */
        * {
            max-width: 100%;
            overflow: visible !important;
            -webkit-tap-highlight-color: transparent;
            box-sizing: border-box;
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
