
    @include('compagnie.all_element.header')
    <style>
        body {
            background: #f8f9fa;
            /* font-family: 'Segoe UI', system-ui, sans-serif; */
        }

        .page-header {
            background: #ffffff;
            border-bottom: 1px solid #e9ecef;
        }

        .page-body {
            background: #f8f9fa;
        }

        /* En-tête de page */
        .page-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1rem 0;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        /* Carte principale */
        .form-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            background: white;
        }

        .form-card .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            padding: 20px 25px;
        }

        .form-card .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: #2c3e50;
        }

        .form-card .card-body {
            padding: 25px;
        }

        /* Formulaires */
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border: 1px solid #ced4da;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.1);
        }

        /* Boutons */
        .btn {
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-1px);
        }

        .btn-light {
            background: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
        }

        .btn-light:hover {
            background: #e9ecef;
        }

        /* Aperçu de l'image */
        .image-preview {
            width: 100%;
            height: 150px;
            border: 1px dashed #dee2e6;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #f8f9fa;
            margin-top: 8px;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .image-preview-placeholder {
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Validation */
        .is-invalid {
            border-color: #e74c3c;
        }

        .invalid-feedback {
            display: block;
            color: #e74c3c;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-card .card-body {
                padding: 20px;
            }
            
            .page-header-custom {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .btn {
                width: 100%;
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
    @include('compagnie.all_element.cadre')

    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <!-- En-tête avec bouton à droite -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          {{-- <h1 class="page-title mb-0">
            <i class="fas fa-bus me-2"></i>Création d'un nouveau bus
          </h1> --}}
          <div class="ms-auto">
            <a href="{{ route('liste.bus') }}" class="btn btn-light">
              <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
          </div>
        </div>

        <!-- Carte du formulaire -->
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card form-card">
              <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                  <i class="fas fa-bus me-2"></i>Informations du bus
                </h5>
              </div>
        <div class="card-body">
            <form action="{{ route('bus.store') }}" method="POST" enctype="multipart/form-data" id="busForm" onsubmit="showButtonLoader(event)">
              @csrf

              <div class="form-section">
                <h6 class="section-title"><i class="fas fa-info-circle me-2"></i>Informations générales</h6>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="nom_bus" class="form-label">Nom du bus <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nom_bus') is-invalid @enderror" 
                           id="nom_bus" name="nom_bus" value="{{ old('nom_bus') }}" 
                           placeholder="Ex: Bus VIP 001" required>
                    @error('nom_bus')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="marque_bus" class="form-label">Marque <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('marque_bus') is-invalid @enderror" 
                           id="marque_bus" name="marque_bus" value="{{ old('marque_bus') }}" 
                           placeholder="Ex: Mercedes, Toyota..." required>
                    @error('marque_bus')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="modele_bus" class="form-label">Modèle <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('modele_bus') is-invalid @enderror" 
                           id="modele_bus" name="modele_bus" value="{{ old('modele_bus') }}" 
                           placeholder="Ex: Sprinter, Coaster..." required>
                    @error('modele_bus')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="immatriculation_bus" class="form-label">Immatriculation <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('immatriculation_bus') is-invalid @enderror" 
                           id="immatriculation_bus" name="immatriculation_bus" 
                           value="{{ old('immatriculation_bus') }}" 
                           placeholder="Ex: AB-123-CD" required>
                    @error('immatriculation_bus')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="form-section">
                <h6 class="section-title"><i class="fas fa-cog me-2"></i>Configuration</h6>
                <div class="row">
                  
                  <div class="col-md-6 mb-3">
                    {{-- <label for="configuration_place_buses_id" class="form-label">Configuration des places <span class="text-danger">*</span></label>
                    <select class="form-select @error('configuration_place_buses_id') is-invalid @enderror" 
                            id="configuration_place_buses_id" name="configuration_place_buses_id" required>
                      <option value="">Sélectionner une configuration</option>
                      @foreach($configurationPlaces as $config)
                        <option value="{{ $config->id }}" 
                                {{ old('configuration_place_buses_id') == $config->id ? 'selected' : '' }}>
                          {{ $config->nom }} ({{ $config->colonne }}x{{ $config->ranger }} - {{ $config->colonne * $config->ranger }} places)
                        </option>
                        <input type="hidden" name="nombre_places" value="{{ $config->colonne * $config->ranger }}">
                      @endforeach
                    </select>
                    @error('configuration_place_buses_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror --}}
                    {{-- <select class="form-select @error('configuration_place_buses_id') is-invalid @enderror"
        id="configuration_place_buses_id"
        name="configuration_place_buses_id"
        required>
    <option value="">Sélectionner une configuration</option>

    @foreach($configurationPlaces as $config)
        <option
            value="{{ $config->id }}"
            data-places="{{ $config->colonne * $config->ranger }}"
            {{ old('configuration_place_buses_id') == $config->id ? 'selected' : '' }}>
            {{ $config->nom }} ({{ $config->colonne }}x{{ $config->ranger }} - {{ $config->colonne * $config->ranger }} places)
        </option>
    @endforeach
</select> --}}
<select class="form-select @error('configuration_place_buses_id') is-invalid @enderror"
        id="configuration_place_buses_id"
        name="configuration_place_buses_id"
        required>
    <option value="">Sélectionner une configuration</option>

   @foreach($configurationPlaces as $config)
    <option
        value="{{ $config->id }}"
        data-places="{{ $config->colonne * $config->ranger }}"
        {{ old('configuration_place_buses_id') == $config->id ? 'selected' : '' }}>
        Titre: {{ $config->nom }}
        (Colonne: {{ $config->colonne }} x Ranger: {{ $config->ranger }} 
        - Total: {{ $config->colonne * $config->ranger }} places)
    </option>
@endforeach

</select>
<input type="hidden" name="nombre_places" id="nombre_places">
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectConfig = document.getElementById('configuration_place_buses_id');
    const inputPlaces = document.getElementById('nombre_places');

    selectConfig.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        inputPlaces.value = selectedOption.dataset.places || '';
    });

    // Cas de validation Laravel (old value)
    if (selectConfig.value) {
        const selectedOption = selectConfig.options[selectConfig.selectedIndex];
        inputPlaces.value = selectedOption.dataset.places || '';
    }
});
</script>


                  </div>

                  {{-- <div class="col-md-3 mb-3">
                    <label for="nombre_places" class="form-label">Nombre de places <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('nombre_places') is-invalid @enderror" 
                           id="nombre_places" name="nombre_places" 
                           value="{{ old('nombre_places') }}" 
                           min="1" placeholder="Ex: 30" required>
                    @error('nombre_places')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Doit correspondre à la configuration sélectionnée</small>
                  </div> --}}
                </div>
              </div>

              <div class="form-section">
                <h6 class="section-title"><i class="fas fa-image me-2"></i>Photo du bus</h6>
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="photo_bus" class="form-label">Photo du bus</label>
                      <input type="file" class="form-control @error('photo_bus') is-invalid @enderror" 
                             id="photo_bus" name="photo_bus" 
                             accept="image/jpeg,image/png,image/jpg,image/gif" 
                             onchange="previewImage(this)">
                      @error('photo_bus')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        <div class="form-text text-muted small">Formats acceptés: JPG, PNG, GIF. Taille max: 25MB</div>
                      
                      <div class="mt-3">
                        <div class="image-preview bg-light rounded border p-3 text-center" id="imagePreview" style="min-height: 150px;">
                          <div class="image-preview-placeholder text-muted">
                            <i class="fas fa-image fa-3x mb-2 d-block"></i>
                            <div>Aperçu de l'image</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3 h-100 d-flex flex-column">
                      <label for="description_bus" class="form-label">Description</label>
                      <textarea class="form-control flex-grow-1 @error('description_bus') is-invalid @enderror" 
                                id="description_bus" name="description_bus" 
                                rows="8" 
                                style="resize: none;"
                                placeholder="Description optionnelle du bus...">{{ old('description_bus') }}</textarea>
                      @error('description_bus')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-between pt-3 border-top">
                <a href="{{ route('liste.bus') }}" class="btn btn-light">
                  <i class="fas fa-times me-2"></i>Annuler
                </a>
                <button type="submit" class="btn btn-warning" id="submitButton">
                  <span id="buttonText">
                    <i class="fas fa-save me-2"></i>Enregistrer
                  </span>
                  <span id="buttonLoader" class="d-none">
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Enregistrement...
                  </span>
                </button>
              </div>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <style>
    #buttonLoader {
        display: none;
    }
    .btn-loading #buttonText {
        display: none;
    }
    .btn-loading #buttonLoader {
        display: inline-block;
    }
    </style>

    <script src="../assets/js/theme.js"></script>
    <script>
    function showButtonLoader(event) {
        const button = document.getElementById('submitButton');
        const buttonText = document.getElementById('buttonText');
        const buttonLoader = document.getElementById('buttonLoader');
        
        button.classList.add('btn-loading');
        buttonText.classList.add('d-none');
        buttonLoader.classList.remove('d-none');
        button.disabled = true;
    }
    
    // Aperçu de l'image
    function previewImage(input) {
      const preview = document.getElementById('imagePreview');
      const file = input.files[0];
      
      if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          preview.innerHTML = `<img src="${e.target.result}" alt="Aperçu du bus">`;
        }
        
        reader.readAsDataURL(file);
      } else {
        preview.innerHTML = '<div class="image-preview-placeholder">Aperçu de l\'image</div>';
      }
    }

    // Validation simple
    document.getElementById('busForm').addEventListener('submit', function(e) {
      const requiredFields = this.querySelectorAll('[required]');
      let isValid = true;
      
      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          field.classList.add('is-invalid');
          isValid = false;
        }
      });
      
      if (!isValid) {
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
    </script>

    @include('compagnie.all_element.footer')