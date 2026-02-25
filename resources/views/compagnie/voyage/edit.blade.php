
@include('compagnie.all_element.header')

        {{-- @include('compagnie.all_element.color_global') --}}

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

        @include('compagnie.all_element.cadre')

        <!-- start: page body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <!-- En-tête avec bouton de retour -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="page-title mb-0">
                    </h1>
                    <a href="{{ route('voyage.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                </div>

                <div class="col-md-12">
                    <div class="card shadow-sm border-0">
                        
                        <div class="card-body p-4">

                            <!-- Affichage des erreurs -->
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>Veuillez corriger les erreurs suivantes :</strong>
                                    </div>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- Formulaire de modification -->
                            <form action="{{ route('voyage.update', $voyage->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                 <!-- Zone pour afficher les infos de l'itinéraire -->
                                <div id="itineraire-info" class="mt-4 mb-5"></div>

                                <div class="row">
                                    <!-- Itinéraire -->
                                    <div class="col-md-6 mb-4">
                                        <label for="itineraire_id" class="form-label fw-semibold">
                                            <i class="fas fa-route me-2 text-primary"></i>Itinéraire
                                        </label>
                                        <select name="itineraire_id" id="itineraire_id" class="form-select form-select-lg shadow-sm" required>
                                            <option value="">Sélectionner un itinéraire</option>
                                            @foreach ($itineraires as $itineraire)
                                                <option value="{{ $itineraire->id }}" 
                                                    {{ $voyage->itineraire_id == $itineraire->id ? 'selected' : '' }}>
                                                    {{ $itineraire->titre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-text text-muted">
                                            <i class="fas fa-info-circle me-1"></i>Choisissez l'itinéraire pour ce voyage
                                        </div>
                                    </div>

                                    <!-- Date de départ -->
                                    <div class="col-md-6 mb-4">
                                        <label for="date_depart" class="form-label fw-semibold">
                                            <i class="fas fa-calendar-alt me-2 text-primary"></i>Date du départ
                                        </label>
                                        <input type="date" name="date_depart" id="date_depart" class="form-control form-control-lg shadow-sm" 
                                            value="{{ old('date_depart', $voyage->date_depart) }}" required>
                                        <div class="form-text text-muted">
                                            <i class="fas fa-info-circle me-1"></i>Date prévue du départ
                                        </div>
                                        
                                        <!-- Disponibilité -->
                                        <div class="mt-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="disponible_toujours" id="disponible_toujours" value="1" {{ $voyage->disponible_toujours ? 'checked' : '' }}>
                                                <label class="form-check-label fw-semibold" for="disponible_toujours">
                                                    <i class="fas fa-check-circle me-2 text-success"></i>Voyage toujours disponible
                                                </label>
                                            </div>
                                            <div class="form-text text-muted">
                                                <i class="fas fa-info-circle me-1"></i>Cochez si le voyage doit rester disponible
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Heure de départ -->
                                    <div class="col-md-6 mb-4">
                                        <label for="heure_depart" class="form-label fw-semibold">
                                            <i class="fas fa-clock me-2 text-primary"></i>Heure de départ
                                        </label>
                                        <input type="time" name="heure_depart" id="heure_depart" class="form-control form-control-lg shadow-sm" 
                                            value="{{ old('heure_depart', $voyage->heure_depart) }}" required>
                                        <div class="form-text text-muted">
                                            <i class="fas fa-info-circle me-1"></i>Heure prévue du départ
                                        </div>
                                    </div>

                                    <!-- Bus -->
                                    <div class="col-md-6 mb-4">
                                        <label for="bus_id" class="form-label fw-semibold">
                                            <i class="fas fa-bus me-2 text-primary"></i>Bus
                                        </label>
                                        <select name="bus_id" id="bus_id" class="form-select form-select-lg shadow-sm" required>
                                            <option value="">Sélectionner un bus</option>
                                            @foreach ($buses as $bus)
                                                <option value="{{ $bus->id }}" 
                                                    {{ $voyage->bus_id == $bus->id ? 'selected' : '' }}
                                                    data-nom="{{ $bus->nom_bus }}"
                                                    data-immatriculation="{{ $bus->immatriculation }}"
                                                    data-marque="{{ $bus->marque }}"
                                                    data-modele="{{ $bus->modele }}"
                                                    data-capacite="{{ $bus->capacite }}"
                                                    data-statut="{{ $bus->statut }}"
                                                    data-photo="{{ $bus->photo_bus ? asset('buses/' . $bus->photo_bus) : asset('all_image/bus.png') }}">
                                                    {{ $bus->nom_bus }}  {{ $bus->immatriculation }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-text text-muted">
                                            <i class="fas fa-info-circle me-1"></i>Véhicule assigné au voyage
                                        </div>
                                    </div>

                                    <!-- Conteneur pour les détails du bus (pleine largeur) -->
                                    <div id="bus-details" class="mt-4">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">
                                                    <i class="fas fa-bus me-2"></i>Détails du bus sélectionné
                                                </h5>
                                            </div>
                                            <div class="card-body text-center text-muted py-4">
                                                <i class="fas fa-bus fa-3x mb-3"></i>
                                                <p class="mb-0">Sélectionnez un bus pour afficher ses détails</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Chauffeur -->
                                    <div class="col-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="chauffeur_id" class="form-label fw-semibold">
                                                    <i class="fas fa-user-tie me-2 text-primary"></i>Chauffeur
                                                </label>
                                                <select name="chauffeur_id" id="chauffeur_id" class="form-select form-select-lg shadow-sm" required>
                                                    <option value="">Sélectionner un chauffeur</option>
                                                    @foreach ($chauffeurs as $chauffeur)
                                                        <option value="{{ $chauffeur->id }}" 
                                                            {{ $voyage->chauffeur_id == $chauffeur->id ? 'selected' : '' }}
                                                            data-nom="{{ $chauffeur->nom }}"
                                                            data-prenom="{{ $chauffeur->prenom }}"
                                                            data-telephone="{{ $chauffeur->telephone }}"
                                                            data-adresse="{{ $chauffeur->adresse }}"
                                                            data-numeros_permis="{{ $chauffeur->numeros_permis }}"
                                                            data-date_naissance="{{ $chauffeur->date_naissance }}"
                                                            data-status="{{ $chauffeur->status }}"
                                                            data-photo="{{ $chauffeur->photo ? (Str::startsWith($chauffeur->photo, 'http') ? $chauffeur->photo : 'chauffeurs/' . $chauffeur->photo) : 'chauffeurs/default.png' }}">
                                                            {{ $chauffeur->nom }} {{ $chauffeur->prenom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="form-text text-muted mb-2">
                                                    <i class="fas fa-info-circle me-1"></i>Chauffeur assigné au voyage
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Conteneur pour les détails du chauffeur (pleine largeur) -->
                                        <div id="chauffeur-details" class="mt-4" style="display: none;">
                                            <!-- Les détails du chauffeur seront chargés ici via JavaScript -->
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end mt-4 pt-3 border-top">
                                   
                                    <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                        <i class="fas fa-save me-2"></i>
                                        <span id="btnText">Modifier le voyage</span>
                                        <span id="btnLoader" class="spinner-border spinner-border-sm ms-2" style="display: none;" role="status">
                                            <span class="visually-hidden">Chargement...</span>
                                        </span>
                                    </button>
                                </div>
                            </form>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectItineraire = document.getElementById('itineraire_id');
            const infoDiv = document.getElementById('itineraire-info');

            if (!selectItineraire) return;

            // Récupérer les montants existants
            const arretVoyages = @json($arretVoyages->mapWithKeys(fn($item) => [$item->arret_id => $item->montant]));

            const loadItineraire = (itineraireId) => {
                if (!itineraireId) {
                    infoDiv.innerHTML = "";
                    return;
                }

                // Loading state
                infoDiv.innerHTML = `
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="visually-hidden">Chargement...</span>
                        </div>
                        <p class="text-muted">Chargement des informations de l'itinéraire...</p>
                    </div>
                `;

                fetch(`/itineraire/${itineraireId}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Itinéraire non trouvé');
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            infoDiv.innerHTML = `
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>${data.error}
                                </div>
                            `;
                            return;
                        }

                        let arretsHtml = '';
                        if (data.arrets && data.arrets.length > 0) {
                            arretsHtml = `
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title text-primary mb-3">
                                            <i class="fas fa-map-marker-alt me-2"></i>Arrêts et tarifs
                                        </h6>
                                        <div class="arrets-list">
                                            ${data.arrets.map((arret, index) => `
                                                <div class="arret-item d-flex justify-content-between align-items-center p-3 border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <div class="arret-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                            ${index + 1}
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold">${arret.gare ? arret.gare.nom : 'N/A'}</div>
                                                            <small class="text-muted">
                                                                <i class="fas fa-city me-1"></i>
                                                                ${arret.gare && arret.gare.ville ? arret.gare.ville : 'N/A'}
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        ${arret.montant ? `
                                                            <span class="badge bg-success me-2">
                                                                ${parseFloat(arret.montant).toLocaleString('fr-FR')} FCFA
                                                            </span>
                                                        ` : ''}
                                                        <div class="tarif-input position-relative">
                                                            <input type="number" class="form-control form-control-sm bg-light" 
                                                                placeholder="Montant (FCFA)" name="montant[${arret.id}]" 
                                                                value="${arret.montant || ''}" min="0" step="0.01" 
                                                                style="width: 120px;" readonly>
                                                            <div class="position-absolute top-0 end-0 bottom-0 d-flex align-items-center pe-2 text-muted">
                                                                <i class="fas fa-lock"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `).join('')}
                                        </div>
                                    </div>
                                </div>
                            `;
                        } else {
                            arretsHtml = `
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>Aucun arrêt configuré pour cet itinéraire.
                                </div>
                            `;
                        }

                        // Affichage des informations dans une carte
                        infoDiv.innerHTML = `
                            <div class="card shadow-sm border-primary border-2">
                                <div class="card-header bg-primary text-white py-3">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-route me-2"></i>${data.titre}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <i class="fas fa-clock text-success me-2"></i>
                                                <strong>Durée estimée:</strong> ${data.estimation}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                <strong>Départ:</strong> ${data.ville_depart_gare} (${data.nom_gare})
                                            </div>
                                        </div>
                                    </div>
                                    ${arretsHtml}
                                </div>
                            </div>
                        `;
                    })
                    .catch(error => {
                        infoDiv.innerHTML = `
                            <div class="alert alert-danger">
                                <i class="fas fa-times-circle me-2"></i>
                                Impossible de récupérer les informations de l'itinéraire.
                            </div>
                        `;
                        console.error(error);
                    });
            };

            selectItineraire.addEventListener('change', function() {
                loadItineraire(this.value);
            });

            // Charger l'itinéraire au démarrage si déjà sélectionné
            if (selectItineraire.value) {
                loadItineraire(selectItineraire.value);
            }

            // Focus sur le premier champ
            document.getElementById('itineraire_id').focus();
        });

        // Validation du formulaire
        document.querySelector('form').addEventListener('submit', function(e) {
            const itineraireId = document.getElementById('itineraire_id').value;
            
            if (!itineraireId) {
                e.preventDefault();
                alert('Veuillez sélectionner un itinéraire avant de soumettre le formulaire.');
                return;
            }
            
            // Vérifier si des montants sont requis mais non remplis
            const montantInputs = document.querySelectorAll('input[name^="montant"]');
            let montantsValides = true;
            
            montantInputs.forEach(input => {
                if (!input.value || input.value <= 0) {
                    montantsValides = false;
                    input.style.borderColor = 'red';
                } else {
                    input.style.borderColor = '';
                }
            });
            
            if (!montantsValides) {
                e.preventDefault();
                alert('Veuillez remplir tous les montants pour les arrêts.');
            }
        });

        // Gestionnaire d'événement pour le changement de bus
        document.getElementById('bus_id').addEventListener('change', function() {
            const busId = this.value;
            const busDetails = document.getElementById('bus-details');
            
            if (!busId) {
                busDetails.innerHTML = `
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-bus me-2"></i>Détails du bus sélectionné
                            </h5>
                        </div>
                        <div class="card-body text-center text-muted py-4">
                            <i class="fas fa-bus fa-3x mb-3"></i>
                            <p class="mb-0">Sélectionnez un bus pour afficher ses détails</p>
                        </div>
                    </div>`;
                return;
            }
            
            // Afficher un indicateur de chargement
            busDetails.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                    <p class="mt-2">Chargement des détails du bus...</p>
                </div>`;
            
            // Récupérer les détails du bus via l'API
            fetch(`/api/bus/${busId}/details`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const bus = data.data.bus;
                        const config = data.data.configuration || {};
                        const places = data.data.places || [];
                        
                        // Générer le HTML pour les détails du bus
                        busDetails.innerHTML = `
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="fas fa-bus me-2"></i>Détails du bus
                                        <button type="button" class="btn btn-sm btn-outline-secondary float-end" onclick="document.getElementById('bus-details').style.display='none'">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 text-center mb-3">
                                            ${bus.photo_bus ? `
                                            <img src="${bus.photo_bus}" 
                                                 alt="Photo du bus" 
                                                 class="img-fluid rounded-circle shadow-sm"
                                                 style="width: 120px; height: 120px; object-fit: cover; 
                                                        border: 3px solid #4e73df;
                                                        padding: 2px;
                                                        transition: all 0.3s ease-in-out;
                                                        background: #fff;">
                                            ` : `
                                                <div class="bg-light d-flex align-items-center justify-content-center mx-auto rounded-circle" 
                                                     style="width: 120px; height: 120px; 
                                                            border: 3px solid #e3e6f0;
                                                            background: #f8f9fc;">
                                                    <span class="text-muted fs-3">Chauffeur</span>
                                                </div>
                                            `}
                                            <div class="mt-2">
                                                <span class="badge bg-light text-primary px-2 py-1 fs-7 fw-normal border">
                                                    Chauffeur
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Nom:</strong> ${bus.nom_bus || 'Non spécifié'}</p>
                                                    <p><strong>Marque:</strong> ${bus.marque_bus || 'Non spécifiée'}</p>
                                                    <p><strong>Modèle:</strong> ${bus.modele_bus || 'Non spécifié'}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Immatriculation:</strong> ${bus.immatriculation_bus || 'Non spécifiée'}</p>
                                                    <p><strong>Configuration:</strong> ${config ? config.nom : 'Non configuré'}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    ${Object.keys(config).length > 0 ? `
                                    <div class="mt-4">
                                        <h6 class="border-bottom pb-2">
                                            <i class="fas fa-users me-2"></i>Capacité du bus
                                            <small class="text-muted ms-2">${config.colonne} colonnes × ${config.ranger} rangées</small>
                                        </h6>
                                        <div class="text-center py-3">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <div class="card border-0 bg-light">
                                                        <div class="card-body">
                                                            <h3 class="text-primary mb-1">${places ? places.length : '0'}</h3>
                                                            <p class="text-muted mb-0">Places totales</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card border-0 bg-light">
                                                        <div class="card-body">
                                                            <h3 class="text-success mb-1">${config.colonne || '0'}</h3>
                                                            <p class="text-muted mb-0">Colonnes</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card border-0 bg-light">
                                                        <div class="card-body">
                                                            <h3 class="text-info mb-1">${config.ranger || '0'}</h3>
                                                            <p class="text-muted mb-0">Rangées</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ` : ''}
                                </div>
                            </div>
                        `;
                    } else {
                        busDetails.innerHTML = `
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                ${data.message || 'Impossible de charger les détails du bus. Veuillez réessayer.'}
                            </div>`;
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    busDetails.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <i class="fas fa-times-circle me-2"></i>
                            Une erreur est survenue lors du chargement des détails du bus.
                        </div>
                    `;
                });
        });
        
        // Gestionnaire d'événement pour le changement de chauffeur
        document.getElementById('chauffeur_id').addEventListener('change', function() {
            const chauffeurId = this.value;
            const chauffeurDetails = document.getElementById('chauffeur-details');
            
            if (!chauffeurId) {
                chauffeurDetails.style.display = 'none';
                return;
            }
            
            // Afficher un indicateur de chargement
            chauffeurDetails.style.display = 'block';
            chauffeurDetails.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                    <p class="mt-2">Chargement des détails du chauffeur...</p>
                </div>`;
            
            // Récupérer les données du chauffeur depuis l'option sélectionnée
            const selectedOption = this.options[this.selectedIndex];
            
            // Récupérer les données depuis les attributs data
            const chauffeur = {
                nom: selectedOption.dataset.nom || 'Non',
                prenom: selectedOption.dataset.prenom || 'spécifié',
                telephone: selectedOption.dataset.telephone || 'Non spécifié',
                adresse: selectedOption.dataset.adresse || 'Non spécifiée',
                numero_permis: selectedOption.dataset.numeros_permis || 'N/A',
                date_naissance: selectedOption.dataset.date_naissance,
                status: selectedOption.dataset.status,
                photo: selectedOption.dataset.photo ? 
                    (selectedOption.dataset.photo.startsWith('http') || selectedOption.dataset.photo.startsWith('/') ? 
                        selectedOption.dataset.photo : 
                        '/chauffeurs/' + selectedOption.dataset.photo) : 
                    null
            };
            
            // Afficher les détails du chauffeur
            chauffeurDetails.innerHTML = `
               <div class="card shadow-sm border-primary border-2 mt-3">
                            <div class="card-header bg-primary text-white py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">
                                        Détails du chauffeur sélectionné
                                    </h5>
                                    
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-lg-2 text-center mb-3">
                                        ${chauffeur.photo ? `
                                            <img src="${chauffeur.photo}" 
                                                 alt="Photo du chauffeur" 
                                                 class="img-fluid rounded-circle shadow-sm"
                                                 style="width: 120px; height: 120px; object-fit: cover; 
                                                        border: 3px solid #4e73df;
                                                        padding: 2px;
                                                        transition: all 0.3s ease-in-out;
                                                        background: #fff;">
                                            <div class="position-absolute bottom-0 end-0 bg-success rounded-circle p-1 border border-2 border-white">
                                            </div>
                                        ` : `
                                            <div class="bg-light d-flex align-items-center justify-content-center mx-auto rounded-circle" 
                                                 style="width: 120px; height: 120px; 
                                                        border: 3px solid #e3e6f0;
                                                        background: #f8f9fc;">
                                                <span class="text-muted fs-3">Chauffeur</span>
                                            </div>
                                        `}
                                        <div class="mt-2">
                                            <span class="badge bg-light text-primary px-2 py-1 fs-7 fw-normal border">
                                                Chauffeur
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="mb-3">${chauffeur.prenom} ${chauffeur.nom}</h2>
                                                <div class="d-flex flex-wrap gap-4 mb-4">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <div class="text-muted small">N° Permis</div>
                                                            <div class="fw-semibold fs-5">${chauffeur.numero_permis || 'Non renseigné'}</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <div class="text-muted small">Téléphone</div>
                                                            <div class="fw-semibold fs-5">${chauffeur.telephone || 'Non renseigné'}</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <div class="text-muted small">Date de naissance</div>
                                                            <div class="fw-semibold fs-5">${chauffeur.date_naissance ? new Date(chauffeur.date_naissance).toLocaleDateString('fr-FR') : 'Non renseignée'}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
        });
        
        // Déclencher l'événement change si une valeur est déjà sélectionnée
        const selectChauffeur = document.getElementById('chauffeur_id');
        if (selectChauffeur && selectChauffeur.value) {
            selectChauffeur.dispatchEvent(new Event('change'));
        }
        
        // Fonction pour générer la disposition des places du bus
        function generateBusLayout(places, colonnes, rangees) {
            // Si pas de configuration de places, afficher un message
            if (!places || places.length === 0) {
                return '<div class="alert alert-info">Aucune configuration de places disponible pour ce bus.</div>';
            }
            
            // Séparer les sièges par type
            const chauffeurSeat = places.find(p => p.type === 'chauffeur');
            const procheChauffeurSeats = places.filter(p => p.type === 'proche_chauffeur');
            
            // Préparer le conteneur principal
            let layout = `
                <div class="bus-layout">
                    <div class="bus-header text-center mb-3">
                        <h5 class="mb-1">
                            <i class="fas fa-bus me-2"></i>Disposition des sièges
                        </h5>
                        <small class="text-muted">${colonnes} colonnes × ${rangees} rangées • ${places.length} sièges</small>
                    </div>
                    <div class="seats-container">
                        <!-- Zone du conducteur -->
                        <div class="driver-section mb-4">
                            <h6 class="text-center mb-3"><i class="fas fa-steering-wheel me-2"></i>Zone conducteur</h6>
                            <div class="d-flex justify-content-center align-items-center">
            `;
            
            // Afficher le siège du chauffeur
            if (chauffeurSeat) {
                layout += `
                    <div class="seat-item chauffeur active mx-2">
                        <div class="seat-id">${chauffeurSeat.nom || 'CH'}</div>
                        <div class="seat-num">#${chauffeurSeat.numero || '0'}</div>
                        <i class="fas fa-user-tie"></i>
                        <span class="badge bg-warning mt-1">Chauffeur</span>
                    </div>
                `;
            } else {
                layout += `
                    <div class="seat-item chauffeur inactive mx-2">
                        <div class="seat-id">CH</div>
                        <div class="seat-num">#0</div>
                        <i class="fas fa-user-tie"></i>
                        <span class="badge bg-warning mt-1">Chauffeur</span>
                    </div>
                `;
            }
            
            // Afficher les sièges proches du chauffeur
            if (procheChauffeurSeats.length > 0) {
                procheChauffeurSeats.forEach(seat => {
                    layout += `
                        <div class="seat-item proche-chauffeur ${seat.disponible !== false ? 'active' : 'inactive'} mx-1">
                            <div class="seat-id">${seat.nom || 'PC' + seat.numero}</div>
                            <div class="seat-num">#${seat.numero}</div>
                            <i class="fas fa-user"></i>
                            <span class="badge bg-info mt-1">Proche Chauffeur</span>
                        </div>
                    `;
                });
            } else {
                // Si pas de sièges proches du chauffeur définis, en afficher un par défaut
                layout += `
                    <div class="seat-item proche-chauffeur active mx-1">
                        <div class="seat-id">PC1</div>
                        <div class="seat-num">#1</div>
                        <i class="fas fa-user"></i>
                        <span class="badge bg-info mt-1">Proche Chauffeur</span>
                    </div>
                `;
            }
            
            // Fermer la section conducteur et commencer la section passagers
            layout += `
                            </div>
                        </div>
                        <div class="passenger-section">
                            <p class="text-muted small">Chauffeur</p>assagers</h6>
            `;
            
            // Créer un tableau 2D pour représenter les places
            let seats = [];
            for (let i = 0; i < rangees; i++) {
                seats[i] = [];
                for (let j = 0; j < colonnes; j++) {
                    seats[i][j] = null;
                }
            }
            
            // Remplir le tableau avec les places existantes
            let placeIndex = 0;
            for (let i = 0; i < rangees; i++) {
                for (let j = 0; j < colonnes; j++) {
                    if (placeIndex < places.length) {
                        seats[i][j] = places[placeIndex];
                        placeIndex++;
                    }
                }
            }
            
            // Générer le HTML pour la disposition des places
            for (let i = 0; i < rangees; i++) {
                layout += '<div class="seats-row d-flex justify-content-center mb-2">';
                
                for (let j = 0; j < colonnes; j++) {
                    const place = seats[i][j];
                    
                    if (place) {
                        const placeNum = place.numero || (i * colonnes + j + 1);
                        const placeType = place.type || 'client';
                        const isAvailable = place.disponible !== false;
                        
                        // Déterminer la classe CSS en fonction du type de siège
                        let seatClass = 'client';
                        let seatLabel = 'Client';
                        let seatIcon = 'fa-user';
                        let seatBadgeClass = isAvailable ? 'bg-success' : 'bg-danger';
                        
                        if (placeType === 'chauffeur') {
                            seatClass = 'chauffeur';
                            seatLabel = 'Chauffeur';
                            seatIcon = 'fa-user-seat';
                            seatBadgeClass = 'bg-warning';
                        } else if (placeType === 'proche_chauffeur') {
                            seatClass = 'proche-chauffeur';
                            seatLabel = 'Proche Chauffeur';
                            seatIcon = 'fa-user';
                            seatBadgeClass = 'bg-info';
                        }
                        
                        layout += `
                            <div class="seat-item ${seatClass} ${isAvailable ? 'active' : 'inactive'} mx-1">
                                <div class="seat-id">${place.nom || seatLabel.charAt(0) + placeNum}</div>
                                <div class="seat-num">#${placeNum}</div>
                                <i class="fas ${seatIcon}"></i>
                                <span class="badge ${seatBadgeClass} mt-1">${seatLabel}</span>
                            </div>
                        `;
                    } else {
                        // Espace vide
                        layout += '<div class="seat-space"></div>';
                    }
                }
                
                layout += '</div>';
            }
            
            // Fermer la section passagers et ajouter la légende
            layout += `
                        </div> <!-- Fin de .passenger-section -->
                    </div> <!-- Fin de .seats-container -->
                    
                    <div class="seat-legend text-center mt-4">
                        <h6 class="mb-2">Légende :</h6>
                        <div class="d-flex justify-content-center flex-wrap">
                            <span class="badge bg-success me-2 mb-2"><i class="fas fa-check"></i> Disponible</span>
                            <span class="badge bg-warning me-2 mb-2"><i class="fas fa-user-tie"></i> Chauffeur</span>
                            <span class="badge bg-info me-2 mb-2"><i class="fas fa-user"></i> Proche Chauffeur</span>
                        </div>
                    </div>
                </div> <!-- Fin de .bus-layout -->
            `;
            
            return layout;
        }
        
        // Initialiser les événements pour les champs déjà sélectionnés
        document.addEventListener('DOMContentLoaded', function() {
            const busSelect = document.getElementById('bus_id');
            
            // Déclencher l'événement change pour le bus s'il est déjà sélectionné
            if (busSelect && busSelect.value) {
                busSelect.dispatchEvent(new Event('change'));
            }
            
            // Initialiser les tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Gestionnaire d'événement pour disponible_toujours
            const disponibleToujours = document.getElementById('disponible_toujours');
            const dateDepartField = document.getElementById('date_depart').closest('.col-md-6');
            const dateDepartLabel = dateDepartField.querySelector('.form-label');
            const dateDepartInput = document.getElementById('date_depart');
            const dateDepartHelp = dateDepartField.querySelector('.form-text');

            function toggleDateDepart() {
                if (disponibleToujours.checked) {
                    // Masquer le champ date de départ
                    dateDepartLabel.style.display = 'none';
                    dateDepartInput.style.display = 'none';
                    dateDepartHelp.style.display = 'none';
                    dateDepartInput.removeAttribute('required');
                } else {
                    // Afficher le champ date de départ
                    dateDepartLabel.style.display = 'block';
                    dateDepartInput.style.display = 'block';
                    dateDepartHelp.style.display = 'block';
                    dateDepartInput.setAttribute('required', 'required');
                }
            }

            function toggleDisponibleToujours() {
                if (dateDepartInput.value) {
                    // Si une date est saisie, masquer disponible_toujours
                    disponibleToujours.closest('.mt-3').style.display = 'none';
                    disponibleToujours.checked = false;
                } else {
                    // Si pas de date, afficher disponible_toujours
                    disponibleToujours.closest('.mt-3').style.display = 'block';
                }
            }

            // Écouter les changements sur disponible_toujours
            if (disponibleToujours) {
                disponibleToujours.addEventListener('change', toggleDateDepart);
            }

            // Écouter les changements sur le champ date de départ
            if (dateDepartInput) {
                dateDepartInput.addEventListener('input', toggleDisponibleToujours);
                dateDepartInput.addEventListener('change', toggleDisponibleToujours);
            }

            // État initial
            toggleDateDepart();
            toggleDisponibleToujours();

            // Gestionnaire d'événement pour la soumission du formulaire
            const form = document.querySelector('form[action="{{ route('voyage.update', $voyage->id) }}"]');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnLoader = document.getElementById('btnLoader');

            if (form && submitBtn) {
                form.addEventListener('submit', function(e) {
                    // Désactiver le bouton et montrer le loader
                    submitBtn.disabled = true;
                    btnText.textContent = 'Modification en cours...';
                    btnLoader.style.display = 'inline-block';
                });
            }
        });
    </script>

    <style>
        /* Client cards styling */
        .client-cards {
            display: flex;
            gap: 15px;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        
        .client-card {
            background-color: #e8f5e9;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            width: 150px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .client-card .client-number {
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 5px;
        }
        
        .client-card .seat-number {
            color: #2e7d32;
            font-weight: 500;
            margin-bottom: 10px;
        }
        
        .client-card .client-icon {
            font-size: 2em;
            margin: 10px 0;
        }
        
        .client-card .client-button {
            background-color: #2e7d32;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 15px;
            cursor: pointer;
            width: 100%;
            font-weight: 500;
        }
        
        .btn-hover {
            transition: all 0.3s ease;
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        .card {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #1976d2;
            box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
            transform: translateY(-1px);
        }

        .arret-item {
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .arret-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        .arret-number {
            font-weight: bold;
        }

        .info-item {
            padding: 0.5rem;
            border-radius: 6px;
            background-color: #f8f9fa;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        /* Styles pour la disposition des sièges du bus */
        .bus-layout {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .bus-layout-inner {
            max-width: 100%;
            overflow-x: auto;
        }

        .bus-seats {
            min-width: 600px;
        }

        .bus-rows {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .bus-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .row-number {
            font-weight: bold;
            min-width: 30px;
            text-align: center;
            color: #6c757d;
        }

        .seats {
            display: flex;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .seat {
            width: 40px;
            height: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background-color: #f8f9fa;
            color: #6c757d;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            border: 2px solid #dee2e6;
        }

        .seat i {
            font-size: 1.1rem;
            margin-bottom: 2px;
        }

        .seat.available {
            background-color: #e8f5e9;
            border-color: #66bb6a;
            color: #2e7d32;
        }

        .seat.available:hover {
            background-color: #c8e6c9;
            transform: translateY(-2px);
        }

        .seat.occupied {
            background-color: #ffebee;
            border-color: #ef5350;
            color: #c62828;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .seat.selected {
            background-color: #e3f2fd;
            border-color: #42a5f5;
            color: #1565c0;
        }

        .seat.empty {
            visibility: hidden;
            border: none;
            background: none;
        }

        .seat-number {
            font-size: 0.6rem;
            font-weight: bold;
            margin-top: 2px;
        }

        .bus-legend {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .seat-legend .seat {
            width: 30px;
            height: 30px;
            font-size: 0.9rem;
        }

        .seat-legend .seat i {
            font-size: 0.9rem;
            margin: 0;
        }

        .seat-legend .seat .seat-number {
            display: none;
        }

        .bus-driver-seat {
            width: 60px;
            height: 60px;
            background-color: #e3f2fd;
            border: 2px solid #90caf9;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            position: relative;
        }

        .bus-driver-seat:after {
            content: 'Conducteur';
            position: absolute;
            bottom: -20px;
            font-size: 0.7rem;
            color: #666;
            white-space: nowrap;
        }

        .bus-driver-seat i {
            font-size: 1.5rem;
            color: #1976d2;
        }

        /* Styles pour les écrans plus petits */
        @media (max-width: 768px) {
            .bus-seats {
                min-width: 100%;
            }

            .seat {
                width: 35px;
                height: 35px;
                font-size: 0.7rem;
            }

            .seat i {
                font-size: 0.9rem;
            }
        }
    </style>

</body>
</html>