<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration de votre compte - BETRO Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .setup-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .setup-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        .setup-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .setup-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .setup-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        .setup-body {
            padding: 40px;
        }
        .welcome-message {
            text-align: center;
            margin-bottom: 30px;
        }
        .welcome-message h3 {
            color: #333;
            margin-bottom: 10px;
        }
        .welcome-message p {
            color: #666;
            margin-bottom: 0;
        }
        .form-floating {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 15px 50px 15px 15px;
            height: 60px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-setup {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            border-radius: 25px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            transition: transform 0.3s ease;
        }
        .btn-setup:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #218838, #1e7e34);
        }
        .password-requirements {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .password-requirements ul {
            margin: 0;
            padding-left: 20px;
        }
        .password-requirements li {
            margin-bottom: 5px;
            color: #666;
        }
        .user-info {
            background: #e3f2fd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
            text-align: center;
        }
        .user-info strong {
            color: #1976d2;
        }
        .password-input-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 20px;
            top: 20px;
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            z-index: 10;
            padding: 8px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .password-toggle:hover {
            color: #007bff;
        }
        .password-strength {
            margin-top: 10px;
        }
        .progress {
            height: 8px;
            border-radius: 4px;
        }
        .strength-text {
            font-size: 12px;
            margin-top: 5px;
        }
        .strength-weak { color: #dc3545; }
        .strength-medium { color: #ffc107; }
        .strength-strong { color: #28a745; }
    </style>
</head>
<body>
    <div class="setup-container">
        <div class="setup-card">
            <div class="setup-header">
                <h1><i class="fas fa-user-cog me-2"></i>Configuration de votre compte</h1>
                <p>Administrateur de Gare - {{ $gare->nom_gare ?? 'Gare Non Définie' }}</p>
            </div>
            
            <div class="setup-body">
                <div class="welcome-message">
                    <h3>Bienvenue {{ $user->name }} !</h3>
                    <p>Configurez votre mot de passe pour accéder à votre tableau de bord</p>
                </div>

                <div class="user-info">
                    <i class="fas fa-envelope me-2"></i>
                    <strong>{{ $user->email }}</strong>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.gare.setup-password.store', $user) }}" autocomplete="off">
                    @csrf
                    
                    <div class="password-requirements">
                        <strong><i class="fas fa-shield-alt me-2"></i>Exigences du mot de passe :</strong>
                        <ul>
                            <li>Au moins 8 caractères</li>
                            <li>Au moins une lettre majuscule</li>
                            <li>Au moins une lettre minuscule</li>
                            <li>Au moins un chiffre</li>
                            <li>Au moins un caractère spécial</li>
                        </ul>
                    </div>

                    <div class="form-floating password-input-container">
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               placeholder="Mot de passe"
                               autocomplete="new-password"
                               value=""
                               required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-eye"></i>
                        </button>
                        <label for="password">
                            <i class="fas fa-lock me-2"></i>Nouveau mot de passe
                        </label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="password-strength">
                            <div class="progress">
                                <div class="progress-bar" id="strength-bar" role="progressbar" style="width: 0%"></div>
                            </div>
                            <div class="strength-text" id="strength-text">Saisissez votre mot de passe</div>
                        </div>
                    </div>

                    <div class="form-floating password-input-container">
                        <input type="password" 
                               class="form-control @error('password_confirmation') is-invalid @enderror" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               placeholder="Confirmer le mot de passe"
                               autocomplete="new-password"
                               value=""
                               required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye" id="password_confirmation-eye"></i>
                        </button>
                        <label for="password_confirmation">
                            <i class="fas fa-lock me-2"></i>Confirmer le mot de passe
                        </label>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-setup">
                        <i class="fas fa-rocket me-2"></i>Configurer mon compte et me connecter
                    </button>
                </form>

                <div class="text-center mt-3">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Une fois configuré, vous serez automatiquement connecté
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eye = document.getElementById(fieldId + '-eye');
            
            if (field.type === 'password') {
                field.type = 'text';
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            }
        }

        function checkPasswordStrength(password) {
            let score = 0;
            let feedback = [];
            
            // Length check
            if (password.length >= 8) score += 20;
            else feedback.push('Au moins 8 caractères');
            
            // Uppercase check
            if (/[A-Z]/.test(password)) score += 20;
            else feedback.push('Une lettre majuscule');
            
            // Lowercase check
            if (/[a-z]/.test(password)) score += 20;
            else feedback.push('Une lettre minuscule');
            
            // Number check
            if (/[0-9]/.test(password)) score += 20;
            else feedback.push('Un chiffre');
            
            // Special character check
            if (/[^A-Za-z0-9]/.test(password)) score += 20;
            else feedback.push('Un caractère spécial');
            
            return { score, feedback };
        }

        function updatePasswordStrength() {
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');
            
            // Vérifier que les deux champs sont remplis
            if (password.length === 0 || passwordConfirmation.length === 0) {
                strengthBar.style.width = '0%';
                strengthBar.className = 'progress-bar';
                strengthText.textContent = 'Saisissez les deux mots de passe pour voir la force';
                strengthText.className = 'strength-text';
                return;
            }
            
            // Vérifier si les mots de passe correspondent
            if (password !== passwordConfirmation) {
                strengthBar.style.width = '0%';
                strengthBar.className = 'progress-bar bg-danger';
                strengthText.textContent = 'Les mots de passe ne correspondent pas';
                strengthText.className = 'strength-text strength-weak';
                return;
            }
            
            const { score, feedback } = checkPasswordStrength(password);
            
            // Update progress bar
            strengthBar.style.width = score + '%';
            
            // Update colors and text based on strength
            if (score < 40) {
                strengthBar.className = 'progress-bar bg-danger';
                strengthText.textContent = 'Faible - Manque: ' + feedback.join(', ');
                strengthText.className = 'strength-text strength-weak';
            } else if (score < 80) {
                strengthBar.className = 'progress-bar bg-warning';
                strengthText.textContent = 'Moyen - Manque: ' + feedback.join(', ');
                strengthText.className = 'strength-text strength-medium';
            } else {
                strengthBar.className = 'progress-bar bg-success';
                strengthText.textContent = 'Fort - Mot de passe sécurisé ✓';
                strengthText.className = 'strength-text strength-strong';
            }
        }

        // Vider les champs au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';
        });

        document.getElementById('password').addEventListener('input', updatePasswordStrength);
        document.getElementById('password_confirmation').addEventListener('input', updatePasswordStrength);
    </script>
</body>
</html>
