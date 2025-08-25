<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le mot de passe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
            min-height: 100vh;
        }
        .card {
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(44,62,80,0.12), 0 1.5px 6px rgba(44,62,80,0.08);
            border: none;
        }
        .card-header {
            background: linear-gradient(90deg, #007bff 60%, #0056b3 100%);
            color: #fff;
            border-radius: 18px 18px 0 0;
        }
        .form-label {
            font-weight: 500;
            color: #007bff;
        }
        .btn-primary {
            background: linear-gradient(90deg, #28a745 60%, #218838 100%);
            border: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(44,62,80,0.08);
            transition: background 0.2s, transform 0.2s;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #218838 60%, #28a745 100%);
            transform: translateY(-2px) scale(1.03);
        }
        .welcome {
            font-size: 1.1rem;
            color: #555;
            margin-top: 18px;
            font-weight: 500;
        }
        .icon-lock {
            font-size: 2.2rem;
            color: #28a745;
            margin-bottom: 10px;
        }
        .card-body {
            padding-bottom: 2rem;
        }
        .fa-check-circle {
            color: #28a745;
        }
        .fa-times-circle {
            color: #dc3545;
        }
        .password-match {
            font-size: 1rem;
            margin-top: 5px;
        }
    </style>
</head>
<body class="py-5">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">

                <div class="card shadow">
                    <div class="card-header text-center">
                        <span class="icon-lock"><i class="fas fa-lock"></i></span>
                        <h4 class="mb-0">Définir un mot de passe</h4>
                        {{-- <small class="d-block mt-1"><i class="fas fa-user"></i> Utilisateur #{{ $users->id }}</small> --}}
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-1"></i> {{ session('error') }}</div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success"><i class="fas fa-check-circle me-1"></i> {{ session('success') }}</div>
                        @endif

                        <form id="passwordForm" action="{{ route('acces.update.password', $users->id) }}" method="POST" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="password" class="form-label"><i class="fas fa-key me-1"></i> Nouveau mot de passe</label>
                                <input type="password" name="password" id="password" class="form-control" required placeholder="Entrez le nouveau mot de passe">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label"><i class="fas fa-key me-1"></i> Confirmer le mot de passe</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Confirmez le mot de passe">
                                <div id="matchMessage" class="password-match"></div>
                                @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sync-alt me-1"></i> Mettre à jour le mot de passe
                            </button>
                        </form>
                    </div>
                </div>

                <div class="welcome text-center">
                    <i class="fas fa-user-circle me-1"></i>
                    Bienvenue, <span class="fw-bold">{{ $users->prenom }} {{ $users->nom }}</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Vérification JS de la concordance des mots de passe
        const password = document.getElementById('password');
        const password_confirmation = document.getElementById('password_confirmation');
        const matchMessage = document.getElementById('matchMessage');
        const form = document.getElementById('passwordForm');

        function checkMatch() {
            if (password.value && password_confirmation.value) {
                if (password.value === password_confirmation.value) {
                    matchMessage.innerHTML = "<i class='fas fa-check-circle'></i> Les mots de passe concordent.";
                    matchMessage.classList.remove('text-danger');
                    matchMessage.classList.add('text-success');
                    return true;
                } else {
                    matchMessage.innerHTML = "<i class='fas fa-times-circle'></i> Les mots de passe ne concordent pas.";
                    matchMessage.classList.remove('text-success');
                    matchMessage.classList.add('text-danger');
                    return false;
                }
            } else {
                matchMessage.innerHTML = "";
                matchMessage.classList.remove('text-success', 'text-danger');
                return false;
            }
        }

        password.addEventListener('input', checkMatch);
        password_confirmation.addEventListener('input', checkMatch);

        form.addEventListener('submit', function(e) {
            if (!checkMatch()) {
                e.preventDefault();
                matchMessage.innerHTML = "<i class='fas fa-times-circle'></i> Les mots de passe ne concordent pas.";
                matchMessage.classList.remove('text-success');
                matchMessage.classList.add('text-danger');
            }
        });
    </script>
</body>
</html>
