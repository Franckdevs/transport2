@include('compagnie.all_element.header')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

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
    <div class="page-body">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0"></h4>
            <a href="{{ route('chauffeur.index') }}" class="btn btn-light">
                Retour à la liste
            </a>
        </div>
        
        <div class="card form-card">
            <div class="card-header">
              <h5 class="card-title mb-0">Création d'un nouveau chauffeur</h5>
            </div>
          <div class="card-body">
            <form action="{{ route('chauffeur.store') }}" method="POST" enctype="multipart/form-data" id="chauffeurForm">
              @csrf

              <div class="form-section">
                <h6 class="section-title">Informations personnelles</h6>
                <div class="row">
                  <!-- Nom -->
                  <div class="col-md-6 col-lg-4 mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control"
                           value="{{ old('nom') }}" placeholder="Entrez le nom" required>
                    @error('nom')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <!-- Prénom -->
                  <div class="col-md-6 col-lg-4 mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control"
                           value="{{ old('prenom') }}" placeholder="Entrez le prénom" required>
                    @error('prenom')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <!-- Date de naissance -->
                  <div class="col-md-6 col-lg-4 mb-3">
                    <label for="date_naissance" class="form-label">Date de naissance</label>
                    <input type="date" name="date_naissance" id="date_naissance" class="form-control"
                           value="{{ old('date_naissance') }}">
                    @error('date_naissance')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                </div>
                <div class="row">
                  <!-- Téléphone -->
                  <div class="col-12 col-md-6 mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <div class="input-group">
                      <span class="input-group-text" style="background: #f8f9fa;height: 42px;">+225</span>
                      <input type="tel" name="telephone" id="telephone" class="form-control"
                            value="{{ old('telephone') }}" required maxlength="10">
                    </div>
                    <input type="hidden" name="telephone_full" id="telephone_full">
                    @error('telephone')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <!-- Numéro de permis -->
                  <div class="col-12 col-md-6 mb-3">
                    <label for="numeros_permis" class="form-label">Numéro de permis</label>
                    <input type="text" name="numeros_permis" id="numeros_permis" class="form-control"
                          value="{{ old('numeros_permis') }}" placeholder="Entrez le numéro de permis">
                    @error('numeros_permis')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                </div>
              </div>

              <!-- Section Photo -->
              <div class="form-section mt-4">
                <div class="row justify-content-center">
                  <div class="col-12 col-md-8 col-lg-6 text-center">
                    <h6 class="section-title mb-4">Photo du chauffeur</h6>
                    <div class="d-flex flex-column align-items-center">
                      <input type="file" name="photo" id="photo" class="form-control d-none" accept="image/*">
                      <div class="photo-upload-container w-100" style="max-width: 400px;">
                        <div class="photo-preview" id="photoPreview" onclick="document.getElementById('photo').click()" style="height: 200px;">
                          <div class="photo-placeholder d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                            <i class="fas fa-camera mb-3" style="font-size: 2.5rem; color: #6c757d;"></i>
                            <div class="text-center">
                              <div class="mb-1">Cliquez pour télécharger une photo</div>
                              <small class="text-muted">Formats acceptés : JPG, PNG (max 5MB)</small>
                            </div>
                          </div>
                        </div>
                      </div>
                      @error('photo')
                        <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>

              <!-- Bouton de soumission -->
              <div class="form-section mt-4 pt-3 border-top">
                <div class="row">
                  <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                      <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                  </div>
                </div>
              </div>
                </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <script>
    // Aperçu de la photo
    document.getElementById('photo').addEventListener('change', function(e) {
      const preview = document.getElementById('photoPreview');
      const file = e.target.files[0];
      
      if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          preview.innerHTML = `<img src="${e.target.result}" alt="Photo du chauffeur">`;
        }
        
        reader.readAsDataURL(file);
      } else {
        preview.innerHTML = `
          <div class="photo-placeholder">
            <i class="fas fa-cloud-upload-alt"></i>
            <div>Cliquez pour télécharger une photo</div>
            <small class="photo-upload-text">PNG, JPG jusqu'à 100MB</small>
          </div>
        `;
      }
    });

    // Gestion du champ téléphone
    const phoneInput = document.querySelector("#telephone");
    
    // Empêcher la saisie de caractères non numériques
    phoneInput.addEventListener('input', function(e) {
      this.value = this.value.replace(/\D/g, '');
      document.getElementById('telephone_full').value = '+225' + this.value;
    });
    
    // S'assurer que le numéro est correctement formaté avant la soumission
    document.getElementById('chauffeurForm').addEventListener('submit', function(e) {
      const phoneNumber = phoneInput.value;
      document.getElementById('telephone_full').value = '+225' + phoneNumber.replace(/\D/g, '');
      
      if (!phoneNumber) {
        e.preventDefault();
        alert('Veuillez entrer un numéro de téléphone valide');
        return false;
      }
    });

    // Mettre à jour la valeur avec le code pays avant la soumission
    document.getElementById('chauffeurForm').addEventListener('submit', function(e) {
      const submitBtn = document.getElementById('submitBtn');
      const phoneNumber = iti.getNumber();
      phoneInput.value = phoneNumber;
      
      if (!phoneNumber) {
        e.preventDefault();
        alert('Veuillez entrer un numéro de téléphone valide');
        return false;
      }
      
      submitBtn.disabled = true;
      submitBtn.textContent = 'Enregistrement...';
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