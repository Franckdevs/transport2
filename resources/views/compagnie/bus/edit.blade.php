{{-- @include('compagnie.all_element.header')

<body class="layout-1" data-luno="theme-blue">
    <!-- start: sidebar -->
    @include('compagnie.all_element.sidebar')
    <!-- start: body area -->
    <div class="wrapper">
        <!-- start: page header -->
        <header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
            <div class="container-fluid">
                <nav class="navbar">
                    <!-- start: toggle btn -->
                    <!-- start: search area -->
                    @include('compagnie.all_element.navbar')
                    <!-- start: link -->
                </nav>
            </div>
        </header>
        <!-- start: page body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <!-- En-tête amélioré -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1 text-dark fw-bold">Modifier le bus</h4>
                                <p class="text-muted mb-0">Mettez à jour les informations du bus</p>
                            </div>
                            <a href="{{ route('liste.bus') }}" class="btn btn-light border" title="Retour à la liste">
                                <i class="fa fa-arrow-left me-2"></i>Retour
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-5">
                                <form action="{{ route('bus.update', $bus->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <!-- Colonne gauche -->
                                        <div class="col-md-6">
                                            <!-- Libellé du bus -->
                                            <div class="mb-4">
                                                <label for="nom_bus" class="form-label fw-semibold text-dark mb-2">
                                                    Libellé du bus <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="nom_bus" id="nom_bus" 
                                                       class="form-control form-control-lg @error('nom_bus') is-invalid @enderror"
                                                       value="{{ old('nom_bus', $bus->nom_bus) }}" 
                                                       placeholder="Ex: Bus VIP 001" required>
                                                @error('nom_bus')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Modèle du bus -->
                                            <div class="mb-4">
                                                <label for="modele_bus" class="form-label fw-semibold text-dark mb-2">
                                                    Modèle du bus <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="modele_bus" id="modele_bus" 
                                                       class="form-control form-control-lg @error('modele_bus') is-invalid @enderror"
                                                       value="{{ old('modele_bus', $bus->modele_bus) }}" 
                                                       placeholder="Ex: Sprinter, Coaster..." required>
                                                @error('modele_bus')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Photo du bus -->
                                            <div class="mb-4">
                                                <label for="photo_bus" class="form-label fw-semibold text-dark mb-2">
                                                    Photo du bus
                                                </label>
                                                <input type="file" name="photo_bus" id="photo_bus" 
                                                       class="form-control @error('photo_bus') is-invalid @enderror"
                                                       accept="image/*">
                                                @error('photo_bus')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                
                                                <!-- Aperçu de l'image actuelle -->
                                                @if($bus->photo_bus)
                                                    <div class="mt-3">
                                                        <label class="form-label small text-muted mb-2">Aperçu de l'image actuelle :</label>
                                                        <div class="border rounded p-2 bg-light">
                                                            <img src="{{ asset('storage/' . $bus->photo_bus) }}" 
                                                                 alt="Photo du bus" 
                                                                 class="img-fluid rounded"
                                                                 style="max-height: 150px;">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Localisation -->
                                            <div class="mb-4">
                                                <label for="localisation_bus" class="form-label fw-semibold text-dark mb-2">
                                                    Localisation <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="localisation_bus" id="localisation_bus"
                                                       class="form-control form-control-lg @error('localisation_bus') is-invalid @enderror"
                                                       value="{{ old('localisation_bus', $bus->localisation_bus) }}"
                                                       placeholder="Ex: Garage principal, Dépôt..." required>
                                                @error('localisation_bus')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Colonne droite -->
                                        <div class="col-md-6">
                                            <!-- Marque du bus -->
                                            <div class="mb-4">
                                                <label for="marque_bus" class="form-label fw-semibold text-dark mb-2">
                                                    Marque du bus <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="marque_bus" id="marque_bus" 
                                                       class="form-control form-control-lg @error('marque_bus') is-invalid @enderror"
                                                       value="{{ old('marque_bus', $bus->marque_bus) }}" 
                                                       placeholder="Ex: Mercedes, Toyota..." required>
                                                @error('marque_bus')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Immatriculation -->
                                            <div class="mb-4">
                                                <label for="immatriculation_bus" class="form-label fw-semibold text-dark mb-2">
                                                    Immatriculation <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="immatriculation_bus" id="immatriculation_bus"
                                                       class="form-control form-control-lg @error('immatriculation_bus') is-invalid @enderror" 
                                                       value="{{ old('immatriculation_bus', $bus->immatriculation_bus) }}"
                                                       placeholder="Ex: AB-123-CD" required>
                                                @error('immatriculation_bus')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Description -->
                                            <div class="mb-4">
                                                <label for="description_bus" class="form-label fw-semibold text-dark mb-2">
                                                    Description
                                                </label>
                                                <textarea name="description_bus" id="description_bus" 
                                                          class="form-control @error('description_bus') is-invalid @enderror"
                                                          rows="4" 
                                                          placeholder="Description optionnelle du bus...">{{ old('description_bus', $bus->description_bus) }}</textarea>
                                                @error('description_bus')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Configuration -->
                                            <div class="mb-4">
                                                <label for="configuration_place_id" class="form-label fw-semibold text-dark mb-2">
                                                    Configuration <span class="text-danger">*</span>
                                                </label>
                                                <select name="configuration_place_id" id="configuration_place_id" 
                                                        class="form-select form-select-lg @error('configuration_place_id') is-invalid @enderror" required>
                                                    <option value="">Choisir une configuration</option>
                                                    @foreach($configuration as $config)
                                                        <option value="{{ $config->id }}" 
                                                            {{ old('configuration_place_id', $bus->configuration_place_buses_id) == $config->id ? 'selected' : '' }}>
                                                            {{ $config->disposition }} ({{ $config->nom_complet }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('configuration_place_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Champ caché -->
                                    <input type="hidden" name="compagnies_id" id="compagnies_id" value="{{ old('compagnies_id', $bus->compagnies_id) }}">

                                    <!-- Bouton de soumission -->
                                    <div class="row mt-5">
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-lg px-5 py-3 fw-semibold">
                                                <i class="fa fa-save me-2"></i>Mettre à jour le bus
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('compagnie.all_element.footer')
    </div>

    <!-- Jquery Page Js -->
    <script src="../assets/js/theme.js"></script>
    <!-- Plugin Js -->
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <!-- Script pour la validation et l'aperçu d'image -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validation Bootstrap
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });

            // Aperçu de la nouvelle image sélectionnée
            const photoInput = document.getElementById('photo_bus');
            if (photoInput) {
                photoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        // Vérifier la taille du fichier (max 5MB)
                        if (file.size > 5 * 1024 * 1024) {
                            alert('Le fichier est trop volumineux. Taille maximum: 5MB');
                            this.value = '';
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            // Supprimer l'ancien aperçu s'il existe
                            const oldPreview = document.getElementById('new-image-preview');
                            if (oldPreview) {
                                oldPreview.remove();
                            }

                            // Créer le nouvel aperçu
                            const previewContainer = document.createElement('div');
                            previewContainer.id = 'new-image-preview';
                            previewContainer.className = 'mt-3';
                            previewContainer.innerHTML = `
                                <label class="form-label small text-muted mb-2">Nouvel aperçu :</label>
                                <div class="border rounded p-2 bg-light">
                                    <img src="${e.target.result}" alt="Nouvelle photo" class="img-fluid rounded" style="max-height: 150px;">
                                </div>
                            `;
                            photoInput.parentNode.appendChild(previewContainer);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>

    <style>
        .card {
            border-radius: 12px;
            border: 1px solid #e0e0e0;
        }

        .card-body {
            padding: 2.5rem !important;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
        }

        .form-control-lg {
            padding: 0.875rem 1rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
        }

        .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            border: none;
            padding: 0.875rem 2.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }

        .btn-light {
            border: 1px solid #dee2e6;
            padding: 0.5rem 1rem;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .invalid-feedback {
            font-weight: 500;
            font-size: 0.875rem;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .border {
            border-color: #e9ecef !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        h4 {
            color: #333;
            font-weight: 700;
        }

        .text-muted {
            color: #6c757d !important;
        }
    </style>
</body>
</html> --}}















<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Bus - BETRO</title>
    @include('compagnie.all_element.header')
    
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', system-ui, sans-serif;
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

    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <!-- En-tête simple -->
        <div class="page-header-custom">
          <h1 class="page-title">Modifier</h1>
          <a href="{{ route('liste.bus') }}" class="btn btn-light">
            ← Retour à la liste
          </a>
        </div>

        <!-- Carte du formulaire -->
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card form-card">
              <div class="card-header">
                <h5>Informations du bus</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('bus.store') }}" method="POST" enctype="multipart/form-data" id="busForm">
                  @csrf

                  <div class="row">
                    <!-- Libellé du bus -->
                    <div class="col-md-6 mb-3">
                      <label for="nom_bus" class="form-label">Libellé du bus *</label>
                      <input type="text" name="nom_bus" id="nom_bus" class="form-control" 
                             value="{{ old('nom_bus' , $bus) }}" placeholder="Ex: Bus VIP 001" required>
                      @error('nom_bus')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Marque du bus -->
                    <div class="col-md-6 mb-3">
                      <label for="marque_bus" class="form-label">Marque du bus *</label>
                      <input type="text" name="marque_bus" id="marque_bus" class="form-control" 
                             value="{{ old('marque_bus' , $bus) }}" placeholder="Ex: Mercedes, Toyota..." required>
                      @error('marque_bus')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <!-- Modèle du bus -->
                    <div class="col-md-6 mb-3">
                      <label for="modele_bus" class="form-label">Modèle du bus *</label>
                      <input type="text" name="modele_bus" id="modele_bus" class="form-control" 
                             value="{{ old('modele_bus' ,$bus) }}" placeholder="Ex: Sprinter, Coaster..." required>
                      @error('modele_bus')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Immatriculation -->
                    <div class="col-md-6 mb-3">
                      <label for="immatriculation_bus" class="form-label">Immatriculation *</label>
                      <input type="text" name="immatriculation_bus" id="immatriculation_bus" class="form-control" 
                             value="{{ old('immatriculation_bus' , $bus) }}" placeholder="Ex: AB-123-CD" required>
                      @error('immatriculation_bus')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <!-- Photo du bus -->
                    <div class="col-md-6 mb-3">
                      <label for="photo_bus" class="form-label">Photo du bus</label>
                      <input type="file" name="photo_bus" id="photo_bus" class="form-control" value="{{ old('photo_bus' , $bus) }}" 
                             accept="image/*" onchange="previewImage(this)">
                      <div class="image-preview" id="imagePreview">
                        <div class="image-preview-placeholder">
                          Aperçu de l'image

                          <img src="{{ asset($bus->photo_bus) }}" 
                             alt="Photo du bus {{ $bus->nom_bus }}"
                             class="bus-photo img-fluid rounded">
                        <div class="photo-overlay">

                            
                        </div>
                      </div>
                      @error('photo_bus')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    </div>

                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                      <label for="description_bus" class="form-label">Description</label>
                      <textarea name="description_bus" id="description_bus" class="form-control" 
                                rows="3" placeholder="Description optionnelle du bus...">{{ old('description_bus' ,$bus) }}</textarea>
                      @error('description_bus')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <!-- Localisation -->
                    <div class="col-md-6 mb-3">
                      <label for="localisation_bus" class="form-label">Localisation *</label>
                      <input type="text" name="localisation_bus" id="localisation_bus" class="form-control" 
                             value="{{ old('localisation_bus' , $bus) }}" placeholder="Ex: Garage principal, Dépôt..." required>
                      @error('localisation_bus')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>

                    <!-- Nombre de places -->
                    <div class="col-md-3 mb-3">
                      <label for="nombre_places" class="form-label">Nombre de places *</label>
                      <input type="number" name="nombre_places" id="nombre_places" class="form-control" 
                             min="1" value="{{ old('nombre_places', $bus) }}" placeholder="Ex: 30" required>
                      @error('nombre_places')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>






                    
                    <!-- Configuration -->
                    <div class="col-md-3 mb-3">
                      <label for="configuration_place_id" class="form-label">Configuration *</label>
                      <select name="configuration_place_id" id="configuration_place_id" class="form-select" required>
                        <option value="">Choisir une configuration</option>
                        @foreach($configuration as $config)
                                                        <option value="{{ $config->id }}" 
                                                            {{ old('configuration_place_id', $bus->configuration_place_buses_id) == $config->id ? 'selected' : '' }}>
                                                            {{ $config->disposition }} ({{ $config->nom_complet }})
                                                        </option>
                                                    @endforeach
                      </select>
                      @error('configuration_place_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <!-- Bouton de soumission -->
                  <div class="row mt-4">
                    <div class="col-12 text-end">
                      <button type="submit" class="btn btn-primary">
                        Enregistrer le bus
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('compagnie.all_element.footer')
  </div>

  <script src="../assets/js/theme.js"></script>

  <script>
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
</body>
</html>