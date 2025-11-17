<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Chauffeur - BETRO</title>
    @include('compagnie.all_element.header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
        --primary: #3498db;
        --light: #f8f9fa;
        --dark: #2c3e50;
        --border: #e9ecef;
    }
    
    body {
        background: #f8f9fa;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    .page-header {
        background: #ffffff;
        border-bottom: 1px solid var(--border);
    }

    .page-body {
        background: #f8f9fa;
        padding: 20px 0;
    }

    .form-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }

    .form-card .card-body {
        padding: 25px;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 10px 12px;
        font-size: 14px;
        width: 100%;
        margin-bottom: 15px;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        outline: none;
    }

    .btn {
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: #2980b9;
    }

    /* Aperçu de la photo */
    .photo-upload-container {
        margin: 15px 0;
    }

    .photo-preview {
        width: 100%;
        min-height: 200px;
        border: 2px dashed var(--border);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f8f9fa;
        margin: 0 auto;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
        max-width: 400px;
    }
    
    .photo-preview:hover {
        border-color: var(--primary);
        background: rgba(52, 152, 219, 0.05);
    }

    .photo-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .photo-upload-text {
        display: block;
        text-align: center;
        color: #6c757d;
        font-size: 0.9rem;
    }

    /* Validation */
    .is-invalid {
        border-color: #e74c3c;
    }

    .invalid-feedback {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 4px;
        display: block;
    }

    .form-text {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 4px;
    }

    /* Sections du formulaire */
    .form-section {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border);
    }

    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 1rem;
        padding-bottom: 0;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-card .card-body {
            padding: 15px;
        }
    }
    </style>
</head>

<body class="layout-1" data-luno="theme-blue">
  @include('compagnie.all_element.sidebar')

  <div class="wrapper">
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
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0"></h5>
          <a href="{{ route('chauffeur.index') }}" class="btn">
            <i class="fas fa-arrow-left me-2"></i>
            Retour à la liste
          </a>
        </div>

        <!-- Carte du formulaire prenant toute la largeur -->
        <div class="card form-card">
          {{-- <div class="card-header"> --}}
            {{-- <span><i class="fas fa-user-edit me-2"></i>Modifier le chauffeur</span> --}}
          {{-- </div> --}}
   
          <div class="card-body">
            <form action="{{ route('modifier.update', $chauffeur->id) }}" method="POST" enctype="multipart/form-data" id="chauffeurForm">
              @csrf
              <div class="form-section">
                <h6 class="section-title"><i class="fas fa-id-card"></i> Informations personnelles</h6>
                <div class="form-grid">
                              
                  <div class="row">

                  <!-- Nom -->
 <div class="col-md-6 col-lg-4 mb-3">
                      <label for="nom" class="form-label"><i class="fas fa-user"></i> Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control"
                           value="{{ old('nom', $chauffeur->nom) }}" placeholder="Entrez le nom" required>
                    @error('nom')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <!-- Prénom -->
 <div class="col-md-6 col-lg-4 mb-3">
                      <label for="prenom" class="form-label"><i class="fas fa-user"></i> Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control"
                           value="{{ old('prenom', $chauffeur->prenom) }}" placeholder="Entrez le prénom" required>
                    @error('prenom')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <!-- Date de naissance -->
 <div class="col-md-6 col-lg-4 mb-3">
                      <label for="date_naissance" class="form-label"><i class="fas fa-calendar-alt"></i> Date de naissance</label>
                    <input type="date" name="date_naissance" id="date_naissance" class="form-control"
                           value="{{ old('date_naissance', $chauffeur->date_naissance) }}">
                    @error('date_naissance')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                   </div>
                
                   <div class="row">
                  <!-- Téléphone -->
 <div class="col-md-6 col-lg-4 mb-3">
                      <label for="telephone" class="form-label"><i class="fas fa-phone"></i> Téléphone</label>
                    <input type="text" name="telephone" id="telephone" class="form-control"
                           value="{{ old('telephone', $chauffeur->telephone) }}" placeholder="Ex: +225 07 00 00 00 00" required>
                    @error('telephone')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>


                   <div class="col-md-6 col-lg-4 mb-3">
                      <label for="numeros_permis" class="form-label"><i class="fas fa-id-card"></i> Numéro de permis</label>
                    <input type="text" name="numeros_permis" id="numeros_permis" class="form-control"
                           value="{{ old('numeros_permis', $chauffeur->numeros_permis) }}" placeholder="Entrez le numéro de permis">
                    @error('numeros_permis')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  
                </div>

                <!-- Adresse (pleine largeur) -->
                {{-- <div class="mb-3 form-full-width">
                  <label for="adresse" class="form-label"><i class="fas fa-map-marker-alt"></i> Adresse</label>
                  <input type="text" name="adresse" id="adresse" class="form-control"
                         value="{{ old('adresse', $chauffeur->adresse) }}" placeholder="Entrez l'adresse complète" required>
                  @error('adresse')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div> --}}

              <div class="form-section">
                <div class="form-grid">
                  <!-- Numéro de permis -->


                  <!-- Photo -->
                  <div class="mb-3">
                    <label for="photo" class="form-label"><i class="fas fa-camera"></i> Photo du chauffeur</label>
                    <input type="file" name="photo" id="photo" class="form-control d-none" accept="image/*">
                    
                    <div class="photo-upload-container">
                      <div class="photo-preview" id="photoPreview" onclick="document.getElementById('photo').click()">
                        @if (!empty($chauffeur->photo))
                          <img src="{{ url($chauffeur->photo) }}" alt="Photo actuelle du chauffeur" id="currentPhoto">
                        @else
                          <div class="photo-placeholder">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div>Cliquez pour changer la photo</div>
                            <small class="photo-upload-text">PNG, JPG jusqu'à 100MB</small>
                          </div>
                        @endif
                      </div>
                    </div>
                                    </div>

                                    
                    @error('photo')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <!-- Affichage de la photo actuelle -->
                    {{-- @if (!empty($chauffeur->photo))
                      <div class="current-photo">
                        <small class="text-muted">Photo actuelle :</small>
                        <div>
                          <img src="{{ url($chauffeur->photo) }}" alt="Photo actuelle du chauffeur" class="mt-2">
                        </div>
                      </div>
                    @else
                      <div class="current-photo">
                        <small class="text-muted"><i class="fas fa-exclamation-triangle me-1"></i>Aucune photo disponible</small>
                      </div>
                    @endif --}}
                  </div>
                </div>
              </div>

              <div class="form-actions">
                {{-- <a href="{{ route('chauffeur.index') }}" class="btn btn-light">
                  <i class="fas fa-times me-2"></i>Annuler
                </a> --}}
                <button type="submit" class="btn btn-primary" id="submitBtn">
                  <i class="fas fa-save me-2"></i>Mettre à jour
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    @include('compagnie.all_element.footer')
  </div>

  <!-- Jquery Page Js -->
  <script src="../assets/js/theme.js"></script>

  <script>
    // Aperçu de la photo
    document.getElementById('photo').addEventListener('change', function(e) {
      const preview = document.getElementById('photoPreview');
      const file = e.target.files[0];
      
      if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          preview.innerHTML = `<img src="${e.target.result}" alt="Nouvelle photo du chauffeur">`;
        }
        
        reader.readAsDataURL(file);
      } else {
        // Revenir à l'affichage initial
        @if (!empty($chauffeur->photo))
          preview.innerHTML = '<img src="{{ url($chauffeur->photo) }}" alt="Photo actuelle du chauffeur" id="currentPhoto">';
        @else
          preview.innerHTML = `
            <div class="photo-placeholder">
              <i class="fas fa-cloud-upload-alt"></i>
              <div>Cliquez pour changer la photo</div>
              <small class="photo-upload-text">PNG, JPG jusqu'à 100MB</small>
            </div>
          `;
        @endif
      }
    });

    // Validation du formulaire
    document.getElementById('chauffeurForm').addEventListener('submit', function(e) {
      const submitBtn = document.getElementById('submitBtn');
      const requiredFields = this.querySelectorAll('[required]');
      let isValid = true;
      
      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          field.classList.add('is-invalid');
          isValid = false;
        }
      });
      
      if (isValid) {
        // Animation de chargement
        submitBtn.innerHTML = '<div class="loading"></div> Mise à jour...';
        submitBtn.disabled = true;
      } else {
        e.preventDefault();
        alert('Veuillez remplir tous les champs obligatoires');
      }
    });

    // Retirer la validation quand l'utilisateur commence à taper
    document.querySelectorAll('input, select').forEach(field => {
      field.addEventListener('input', function() {
        this.classList.remove('is-invalid');
      });
    });

    // Validation du numéro de téléphone
    document.getElementById('telephone').addEventListener('blur', function() {
      const phoneRegex = /^(\+225|225)?\s?[0-9]{2}\s?[0-9]{2}\s?[0-9]{2}\s?[0-9]{2}\s?[0-9]{2}$/;
      if (this.value && !phoneRegex.test(this.value)) {
        this.classList.add('is-invalid');
        const errorElement = document.createElement('small');
        errorElement.className = 'text-danger';
        errorElement.textContent = 'Format de téléphone invalide. Ex: +225 07 00 00 00 00';
        
        // Supprimer les messages d'erreur existants
        const existingError = this.parentNode.querySelector('.text-danger');
        if (existingError && existingError !== this.nextElementSibling) {
          existingError.remove();
        }
        
        if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('text-danger')) {
          this.parentNode.insertBefore(errorElement, this.nextElementSibling);
        }
      }
    });
  </script>
</body>
</html>





