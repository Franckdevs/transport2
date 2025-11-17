<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Utilisateur</title>
    @include('compagnie.all_element.header')
    
    <!-- Styles additionnels pour l'amélioration visuelle -->
    <style>
        .card-form {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .card-form:hover {
            box-shadow: 0 6px 25px rgba(0,0,0,0.12);
        }
        
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #e0e6ed;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }
        
        .btn-light {
            border-radius: 8px;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }
        
        .btn-light:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
        }
        
        .flag-icon {
            width: 20px;
            height: 15px;
            margin-right: 8px;
            border-radius: 2px;
        }
        
        .photo-preview {
            border: 2px dashed #e0e6ed;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .photo-preview:hover {
            border-color: #3498db;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border-radius: 8px 0 0 8px;
        }
        
        .role-description {
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            padding: 12px 15px;
            border-radius: 0 8px 8px 0;
            font-size: 0.9rem;
        }
        
        .section-title {
            color: #2c3e50;
            font-weight: 700;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f5f9;
            margin-bottom: 20px;
        }
        
        .required-field::after {
            content: " *";
            color: #e74c3c;
        }
        
        /* Suppression de la limitation de largeur */
        .full-width-form {
            width: 100%;
            max-width: 100%;
        }
         .info-badge {
            background: rgba(52, 152, 219, 0.1);
            color: var(--primary);
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="layout-1" data-luno="theme-blue">
    <!-- start: sidebar -->
    @include('compagnie.all_element.sidebar')
    
    <!-- start: body area -->
    <div class="wrapper">
        <!-- start: page header -->
        <header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
            <div class="container-fluid">
                <nav class="navbar">
                    @include('compagnie.all_element.navbar')
                </nav>
            </div>
        </header>
        
        <!-- start: page toolbar -->
        @include('compagnie.all_element.cadre')
        
        <!-- start: page body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <!-- En-tête de page -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="section-title mb-0">
                      {{-- Créer un nouvel utilisateur --}}
                    </h4>
                    <a href="{{ route('personnel.index') }}" class="btn btn-light" title="Retour">
                        <i class="fa fa-arrow-left me-2"></i> Retour à la liste
                    </a>
                </div>
                
                <!-- Carte du formulaire - PREND TOUTE LA LARGEUR -->
                <div class="row">
                    <div class="col-12">  <!-- Changement ici : col-12 au lieu de col-lg-10 -->
                        <div class="card card-form full-width-form">
                          <div class="info-badge">
            <i class="fas fa-info-circle"></i>
            Creation d'un membre du personnel
          </div>
                            <div class="card-body p-4">
                                <form action="{{ route('personnel.store') }}" method="POST" enctype="multipart/form-data" id="user-form">
                                    @csrf
                                    
                                    <!-- Informations personnelles -->
                                    <div class="mb-4">
                                        {{-- <h5 class="mb-3 text-primary">
                                            <i class="fa fa-user me-2"></i>Informations personnelles
                                        </h5> --}}
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="nom" class="form-label required-field">Nom</label>
                                                <input type="text" name="nom" id="nom" class="form-control" 
                                                       value="{{ old('nom') }}" required>
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label for="prenom" class="form-label required-field">Prénoms</label>
                                                <input type="text" name="prenom" id="prenom" class="form-control" 
                                                       value="{{ old('prenom') }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="telephone" class="form-label required-field">Téléphone</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Flag_of_C%C3%B4te_d%27Ivoire.svg" 
                                                             alt="CI" class="flag-icon">
                                                        +225
                                                    </span>
                                                    <input type="text" name="telephone" id="telephone" class="form-control" 
                                                           value="{{ old('telephone') }}" placeholder="0123456789" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label required-field">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" 
                                                       value="{{ old('email') }}" placeholder="exemple@domaine.com" 
                                                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Photo et fonction -->
                                    <div class="mb-4">
                                   
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="photo" class="form-label">Photo de profil</label>
                                                
                                                <div id="photo-preview-container" class="mb-3 text-center">
                                                    <img id="photo-preview" 
                                                         class="img-thumbnail rounded-circle photo-preview d-none"
                                                         style="width: 150px; height: 150px; object-fit: cover;">
                                                    <div id="photo-placeholder" class="text-muted py-4">
                                                        <i class="fa fa-user-circle fa-3x mb-2"></i>
                                                        <p class="mb-0">Aucune photo sélectionnée</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-grid">
                                                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label for="role_utilisateurs_id" class="form-label required-field">Fonction</label>
                                                <select name="role_utilisateurs_id" id="role_utilisateurs_id" class="form-select" required>
                                                    <option value="">-- Sélectionnez une fonction --</option>
                                                    @foreach($rolepersonnels as $role)
                                                        <option value="{{ $role->id }}" 
                                                            data-description="{{ $role->description }}" 
                                                            {{ old('role_utilisateurs_id') == $role->id ? 'selected' : '' }}>
                                                            {{ $role->nom_role }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                
                                                <!-- Description du rôle -->
                                                <div id="role-description" class="role-description mt-3">
                                                    Sélectionnez un rôle pour voir sa description.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Bouton de soumission -->
                                    <div class="d-flex justify-content-end mt-4">
                                        {{-- <button type="reset" class="btn btn-light me-3">
                                            <i class="fa fa-undo me-2"></i>Réinitialiser
                                        </button> --}}
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save me-2"></i>Enregistrer l'utilisateur
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- start: page footer -->
        @include('compagnie.all_element.footer')
    </div>

    <!-- Scripts -->
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
    
    <!-- Scripts personnalisés -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Gestion de la prévisualisation de la photo
            const photoInput = document.getElementById('photo');
            const photoPreview = document.getElementById('photo-preview');
            const photoPlaceholder = document.getElementById('photo-placeholder');
            
            photoInput.addEventListener('change', function (event) {
                const input = event.target;
                
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        photoPreview.src = e.target.result;
                        photoPreview.classList.remove('d-none');
                        photoPlaceholder.classList.add('d-none');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    photoPreview.src = '';
                    photoPreview.classList.add('d-none');
                    photoPlaceholder.classList.remove('d-none');
                }
            });
            
            // Gestion de la description du rôle
            const roleSelect = document.getElementById("role_utilisateurs_id");
            const descriptionBox = document.getElementById("role-description");
            
            roleSelect.addEventListener("change", function () {
                const selectedOption = roleSelect.options[roleSelect.selectedIndex];
                const description = selectedOption.getAttribute("data-description");
                
                if (description) {
                    descriptionBox.innerHTML = `<strong>Description :</strong> ${description}`;
                } else {
                    descriptionBox.textContent = "Sélectionnez un rôle pour voir sa description.";
                }
            });
            
            // Afficher la description si une valeur est déjà sélectionnée
            if (roleSelect.value) {
                const selectedOption = roleSelect.options[roleSelect.selectedIndex];
                const description = selectedOption.getAttribute("data-description");
                if (description) {
                    descriptionBox.innerHTML = `<strong>Description :</strong> ${description}`;
                }
            }
            
            // Validation du formulaire
            const form = document.getElementById('user-form');
            form.addEventListener('submit', function(event) {
                let valid = true;
                
                // Validation basique des champs requis
                const requiredFields = form.querySelectorAll('[required]');
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        valid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });
                
                if (!valid) {
                    event.preventDefault();
                    alert('Veuillez remplir tous les champs obligatoires.');
                }
            });
        });
    </script>
</body>
</html>