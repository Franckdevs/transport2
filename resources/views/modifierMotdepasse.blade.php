<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier mot de passe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="icon" href="../log.png" type="image/x-icon"> <!-- Favicon-->

    <style>
        body {
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 10px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border: none;
            max-width: 500px;
            width: 100%;
        }
        .card-header {
            background: #000000;
            color: #fff;
            border-radius: 12px 12px 0 0;
            padding: 1.2rem 1rem;
            text-align: center;
        }
        .card-body {
            padding: 1.5rem;
        }
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.85rem;
            margin-bottom: 0.3rem;
        }
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.6rem;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #4facfe;
            box-shadow: 0 0 0 0.2rem rgba(79, 172, 254, 0.25);
        }
        .btn-primary {
            background: #28a745;
            border: none;
            border-radius: 8px;
            padding: 0.8rem;
            font-weight: 600;
            font-size: 0.95rem;
            margin-top: 0.8rem;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-primary:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .btn-primary:disabled {
            background: #28a745;
            opacity: 0.8;
        }
        .spinner-border {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
            display: none;
        }
        .password-match {
            font-size: 0.8rem;
            margin-top: 0.2rem;
            padding: 0.4rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .alert {
            border-radius: 8px;
            border: none;
            padding: 0.6rem 0.8rem;
            font-size: 0.8rem;
            margin-bottom: 0.8rem;
            animation: fadeIn 0.5s ease;
        }
        .input-group {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            font-size: 0.8rem;
            transition: color 0.3s ease;
        }
        .password-toggle:hover {
            color: #4facfe;
        }
        .icon-lock {
            font-size: 1.5rem;
            margin-bottom: 0.3rem;
        }
        h5 {
            font-size: 1.1rem;
            margin-bottom: 0.2rem;
        }
        .user-email {
            font-size: 0.75rem;
            opacity: 0.9;
        }
        
        /* Styles pour la barre de progression */
        .password-strength {
            margin: 15px 0 10px 0;
            animation: slideDown 0.5s ease;
        }
        .progress {
            height: 8px;
            border-radius: 4px;
            margin-bottom: 8px;
            overflow: hidden;
            background-color: #e9ecef;
        }
        .progress-bar {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 4px;
        }
        .strength-text {
            font-size: 0.75rem;
            font-weight: 600;
            text-align: right;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }
        .strength-requirements {
            font-size: 0.75rem;
            margin-top: 10px;
            animation: fadeIn 0.6s ease;
        }
        .requirement {
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            transition: all 0.4s ease;
            transform-origin: left;
        }
        .requirement i {
            width: 16px;
            margin-right: 8px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .requirement.met {
            color: #28a745;
            transform: translateX(5px);
        }
        .requirement.unmet {
            color: #6c757d;
        }
        .requirement.met i {
            transform: scale(1.2);
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideDown {
            from { 
                opacity: 0;
                transform: translateY(-10px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: scale(1); }
            40% { transform: scale(1.3); }
            60% { transform: scale(1.1); }
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(40, 167, 69, 0); }
            100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
        }
        
        .valid-password {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <div class="d-flex flex-column align-items-center">
            @if($info_users->compagnie && $info_users->compagnie->logo_compagnies)
                <img src="{{ asset($info_users->compagnie->logo_compagnies) }}" 
                     alt="Logo {{ $info_users->compagnie->nom_complet_compagnies }}" 
                     class="mb-2" 
                     style="width: 80px; height: 80px; object-fit: contain; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <h5 class="mb-1 fw-bold">{{ $info_users->compagnie->nom_complet_compagnies }}</h5>
            @else
                <div class="mb-2 bg-light rounded-circle d-flex align-items-center justify-content-center" 
                     style="width: 80px; height: 80px; border: 2px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <i class="fas fa-building fa-2x text-secondary"></i>
                </div>
                <h5 class="mb-1 fw-bold">{{ $users->compagnie->nom_complet_compagnies ?? 'Compagnie' }}</h5>
            @endif
            <div class="icon-lock mt-2"><i class="fas fa-lock"></i></div>
            <h6 class="mb-0 fw-bold">Creer un mot de passe</h6>
            <div class="user-email">{{ $users->prenom }} {{ $users->nom }} - {{ $users->email }}</div>
        </div>
    </div>
    
    <div class="card-body">
        @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-1"></i>{{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-1"></i>{{ session('success') }}
        </div>
        @endif

        <form id="passwordForm" action="{{ route('acces.update.password', $users->id) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')
            
            <div class="mb-2">
                <label for="password" class="form-label"><i class="fas fa-key me-1"></i>Nouveau mot de passe</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required placeholder="Nouveau mot de passe">
                    <button type="button" class="password-toggle" onclick="togglePassword('password')"><i class="fas fa-eye"></i></button>
                </div>
                @error('password')<small class="text-danger"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label"><i class="fas fa-key me-1"></i>Confirmer mot de passe</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Confirmer mot de passe">
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')"><i class="fas fa-eye"></i></button>
                </div>
                <div id="matchMessage" class="password-match"></div>
                @error('password_confirmation')<small class="text-danger"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>@enderror
                
                <!-- Barre de progression de conformité -->
                <div class="password-strength" id="passwordStrengthSection" style="display: none;">
                    <div class="progress">
                        <div id="passwordStrengthBar" class="progress-bar" role="progressbar" style="width: 0%"></div>
                    </div>
                    <div id="passwordStrengthText" class="strength-text"></div>
                    
                    <div id="passwordRequirements" class="strength-requirements">
                        <div id="reqLength" class="requirement unmet">
                            <i class="fas fa-circle"></i>
                            <span>Au moins 8 caractères</span>
                        </div>
                        <div id="reqLowercase" class="requirement unmet">
                            <i class="fas fa-circle"></i>
                            <span>Une lettre minuscule</span>
                        </div>
                        <div id="reqUppercase" class="requirement unmet">
                            <i class="fas fa-circle"></i>
                            <span>Une lettre majuscule</span>
                        </div>
                        <div id="reqNumber" class="requirement unmet">
                            <i class="fas fa-circle"></i>
                            <span>Un chiffre</span>
                        </div>
                        <div id="reqSpecial" class="requirement unmet">
                            <i class="fas fa-circle"></i>
                            <span>Un caractère spécial</span>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100" id="submitButton" style="display: none;">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span id="buttonText">Mettre à jour</span>
            </button>
        </form>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.nextElementSibling.querySelector('i');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

function checkPasswordStrength(password) {
    let strength = 0;
    const requirements = {
        length: false,
        lowercase: false,
        uppercase: false,
        number: false,
        special: false
    };
    
    // Longueur minimale
    if (password.length >= 8) {
        strength += 20;
        requirements.length = true;
    }
    
    // Lettre minuscule
    if (/[a-z]/.test(password)) {
        strength += 20;
        requirements.lowercase = true;
    }
    
    // Lettre majuscule
    if (/[A-Z]/.test(password)) {
        strength += 20;
        requirements.uppercase = true;
    }
    
    // Chiffre
    if (/[0-9]/.test(password)) {
        strength += 20;
        requirements.number = true;
    }
    
    // Caractère spécial
    if (/[^A-Za-z0-9]/.test(password)) {
        strength += 20;
        requirements.special = true;
    }
    
    return { strength, requirements };
}

function updatePasswordStrength() {
    const password = document.getElementById('password').value;
    const strengthSection = document.getElementById('passwordStrengthSection');
    const submitButton = document.getElementById('submitButton');
    
    // Afficher/masquer la section de force
    if (password.length > 0) {
        strengthSection.style.display = 'block';
    } else {
        strengthSection.style.display = 'none';
        return;
    }
    
    const { strength, requirements } = checkPasswordStrength(password);
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthText = document.getElementById('passwordStrengthText');
    
    // Animation de la barre de progression
    strengthBar.style.width = strength + '%';
    
    // Mettre à jour la couleur et le texte
    if (strength < 40) {
        strengthBar.className = 'progress-bar bg-danger';
        strengthText.textContent = 'Faible';
        strengthText.className = 'strength-text text-danger';
        submitButton.disabled = true;
        submitButton.style.opacity = '0.6';
    } else if (strength < 80) {
        strengthBar.className = 'progress-bar bg-warning';
        strengthText.textContent = 'Moyen';
        strengthText.className = 'strength-text text-warning';
        submitButton.disabled = false;
        submitButton.style.opacity = '1';
    } else {
        strengthBar.className = 'progress-bar bg-success valid-password';
        strengthText.textContent = 'Fort ✓';
        strengthText.className = 'strength-text text-success';
        submitButton.disabled = false;
        submitButton.style.opacity = '1';
        
        // Animation de succès
        strengthText.style.animation = 'bounce 0.6s ease';
        setTimeout(() => {
            strengthText.style.animation = '';
        }, 600);
    }
    
    // Mettre à jour les exigences avec animations
    updateRequirement('reqLength', requirements.length);
    updateRequirement('reqLowercase', requirements.lowercase);
    updateRequirement('reqUppercase', requirements.uppercase);
    updateRequirement('reqNumber', requirements.number);
    updateRequirement('reqSpecial', requirements.special);
}

function updateRequirement(elementId, isMet) {
    const element = document.getElementById(elementId);
    const icon = element.querySelector('i');
    
    if (isMet) {
        if (!element.classList.contains('met')) {
            element.className = 'requirement met';
            icon.className = 'fas fa-check-circle text-success';
            icon.style.animation = 'bounce 0.6s ease';
            
            setTimeout(() => {
                icon.style.animation = '';
            }, 600);
        }
    } else {
        element.className = 'requirement unmet';
        icon.className = 'fas fa-circle';
        icon.style.animation = '';
    }
}

// Gestion du clic sur le bouton de soumission
document.getElementById('passwordForm').addEventListener('submit', function(e) {
    const button = document.getElementById('submitButton');
    const spinner = button.querySelector('.spinner-border');
    const buttonText = document.getElementById('buttonText');
    
    button.disabled = true;
    spinner.style.display = 'inline-block';
    buttonText.textContent = 'Traitement...';
    
    // Si le formulaire est valide, on laisse la soumission se faire
    if (!this.checkValidity()) {
        e.preventDefault();
        button.disabled = false;
        spinner.style.display = 'none';
        buttonText.textContent = 'Mettre à jour';
    }
});

function checkMatch() {
    const password = document.getElementById('password');
    const confirm = document.getElementById('password_confirmation');
    const submitButton = document.getElementById('submitButton');
    const message = document.getElementById('matchMessage');
    
    if (password.value && confirm.value) {
        if (password.value === confirm.value) {
            message.innerHTML = "<i class='fas fa-check-circle me-1'></i>Mots de passe identiques ✓";
            message.className = 'password-match text-success bg-success bg-opacity-10';
            submitButton.style.display = 'flex'; // Afficher le bouton
            
            // Animation de succès pour la correspondance
            message.style.animation = 'fadeIn 0.5s ease';
            submitButton.disabled = false;
            submitButton.style.opacity = '1';
            return true;
        } else {
            message.innerHTML = "<i class='fas fa-info-circle me-1'></i>Veuillez confirmer votre mot de passe";
            message.className = 'password-match text-info bg-info bg-opacity-10';
            submitButton.style.display = 'none'; // Cacher le bouton
            submitButton.disabled = true;
            submitButton.style.opacity = '0.6';
            return false;
        }
    } else {
        message.innerHTML = "";
        message.className = 'password-match';
        submitButton.disabled = true;
        submitButton.style.opacity = '0.6';
        return false;
    }
}

function validateForm() {
    const password = document.getElementById('password').value;
    const { strength } = checkPasswordStrength(password);
    const isMatch = checkMatch();
    
    return isMatch && strength >= 40; // Au moins force moyenne
}

// Événements
document.getElementById('password').addEventListener('input', function() {
    updatePasswordStrength();
    checkMatch();
});

document.getElementById('password_confirmation').addEventListener('input', function() {
    checkMatch();
    // Mettre à jour la force si le champ de confirmation est modifié
    updatePasswordStrength();
});

document.getElementById('passwordForm').addEventListener('submit', function(e) {
    if (!validateForm()) {
        e.preventDefault();
        document.getElementById('matchMessage').innerHTML = "<i class='fas fa-exclamation-triangle me-1'></i>Veuillez corriger les erreurs avant envoi";
        document.getElementById('matchMessage').className = 'password-match text-danger bg-danger bg-opacity-10';
        
        // Animation d'erreur
        document.getElementById('matchMessage').style.animation = 'fadeIn 0.5s ease';
        
        // Focus sur le champ mot de passe si faible
        const password = document.getElementById('password').value;
        const { strength } = checkPasswordStrength(password);
        if (strength < 40) {
            document.getElementById('password').focus();
        }
    }
});

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    // Désactiver le bouton au départ
    document.getElementById('submitButton').disabled = true;
    document.getElementById('submitButton').style.opacity = '0.6';
});
</script>

</body>
</html>