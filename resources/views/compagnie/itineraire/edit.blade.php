@include('compagnie.all_element.header')

<body class="layout-1" data-luno="theme-blue">
@include('compagnie.all_element.sidebar')
<style>
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="section-title mb-0">
                    {{-- Modifier l'itinéraire --}}
                </h4>
                <a href="{{ route('itineraire.index') }}" class="btn" title="Retour">
                    <i class="fa fa-arrow-left me-2"></i> Retour à la liste
                </a>
            </div>
            
            <div class="col-md-12 mt-4">
                <div class="card shadow-sm border-0">
                    <div class="info-badge">
                        <i class="fas fa-edit"></i>
                        Modification de l'itinéraire
                    </div>
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
                        <form action="{{ route('itineraire.update', $itineraire->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                @if ($villeId)
                                <input type="hidden" name="ville_id" value="{{ $villeId }}">
                                @else
                                <div class="col-12 mb-4">
                                    <div class="ps-3">
                                        <span class="badge bg-success bg-opacity-10 text-success fs-6 px-3 py-2">
                                            <i class="fas fa-user-shield me-2"></i>Profil Super admin
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="ville_id" class="form-label fw-semibold">
                                        <i class="fas fa-city me-2 text-primary"></i>Ville de départ
                                    </label>
                                    <select name="ville_id" id="ville_id" class="form-select form-select-lg shadow-sm">
                                        <option value="">-- Sélectionnez une ville --</option>
                                        @foreach($villes as $ville)
                                            <option value="{{ $ville->id }}" 
                                                {{ old('ville_id', $itineraire->ville_id) == $ville->id ? 'selected' : '' }}>
                                                {{ $ville->nom_ville }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Sélectionnez la ville de départ
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="gare_id" class="form-label fw-semibold">
                                        <i class="fas fa-train me-2 text-primary"></i>Gare de départ
                                    </label>
                                    <select name="gare_id" id="gare_id" class="form-select form-select-lg shadow-sm">
                                        <option value="">-- Sélectionnez une gare --</option>
                                        @foreach($gars as $gare)
                                            <option value="{{ $gare->id }}" 
                                                {{ old('gare_id', $itineraire->gare_id) == $gare->id ? 'selected' : '' }}>
                                                {{ $gare->nom_gare }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Sélectionnez la gare de départ du trajet
                                    </div>
                                    @error('gare_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                @endif

                                <!-- Estimation du voyage -->
                                <div class="col-md-6 mb-4">
                                    <label for="harriver" class="form-label fw-semibold">
                                        <i class="fas fa-clock me-2 text-primary"></i>Estimation du voyage
                                    </label>
                                    <input type="time" name="estimation" id="harriver" 
                                           class="form-control form-control-lg shadow-sm"
                                           value="{{ old('estimation', $itineraire->estimation) }}">
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Durée estimée du trajet
                                    </div>
                                </div>

                                <!-- Titre du trajet -->
                                <div class="col-md-6 mb-4">
                                    <label for="titre" class="form-label fw-semibold">
                                        <i class="fas fa-heading me-2 text-primary"></i>Titre du trajet
                                    </label>
                                    <textarea name="titre" id="titre" class="form-control shadow-sm" rows="3" 
                                              placeholder="Ex: Trajet Dakar - Thiès express">{{ old('titre', $itineraire->titre) }}</textarea>
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Donnez un titre descriptif à votre trajet
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Arrêts -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <label class="form-label fw-semibold mb-0">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>Arrêts (gares)
                                    </label>
                                    <span class="badge bg-warning bg-opacity-10 text-warning ms-2">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Important
                                    </span>
                                </div>
                                
                                <div class="alert alert-info bg-info bg-opacity-10 border-0 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle text-info me-2"></i>
                                        <small>
                                            Ajoutez les arrêts liés à chaque gare. Chaque arrêt est considéré comme une gare.
                                        </small>
                                    </div>
                                </div>

                                <div id="gares-container">
                                    @forelse ($itineraire->arrets as $i => $arret)
                                        <div class="row gare-item mb-3 align-items-center">
                                            <div class="col-md-6">
                                                <select name="gares[{{ $i }}][id]" class="form-select shadow-sm gare-select" required>
                                                    <option value="">-- Choisir une gare --</option>
                                                    @foreach($gares as $gare)
                                                        <option value="{{ $gare->id }}" 
                                                            {{ $arret->gares_id == $gare->id ? 'selected' : '' }}>
                                                            {{ $gare->nom_gare }} → {{ $gare->ville?->nom_ville }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 d-flex align-items-center gap-2">
                                                <button type="button" class="btn btn-outline-info btn-detail-gare">
                                                    <i class="fas fa-info-circle me-1"></i>Détails
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btn-remove-gare">
                                                    <i class="fas fa-trash me-1"></i>Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="row gare-item mb-3 align-items-center">
                                            <div class="col-md-6">
                                                <select name="gares[0][id]" class="form-select shadow-sm gare-select" required>
                                                    <option value="">-- Choisir une gare --</option>
                                                    @foreach($gares as $gare)
                                                        <option value="{{ $gare->id }}">
                                                            {{ $gare->nom_gare }} → {{ $gare->ville?->nom_ville }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 d-flex align-items-center gap-2">
                                                <button type="button" class="btn btn-outline-info btn-detail-gare">
                                                    <i class="fas fa-info-circle me-1"></i>Détails
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btn-remove-gare">
                                                    <i class="fas fa-trash me-1"></i>Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>

                                <button type="button" class="btn btn-primary d-inline-flex align-items-center mt-2" id="add-gare">
                                    <i class="fas fa-plus-circle me-2"></i>
                                    Ajouter une gare
                                </button>
                            </div>

                            <div class="text-end mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-2"></i>Modifier le voyage
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Détails Gare -->
    <div class="modal fade" id="gareDetailModal" tabindex="-1" aria-labelledby="gareDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body">
                    <div id="gare-details-content">
                        <div class="text-center py-3 text-muted">Chargement des détails...</div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    @include('compagnie.all_element.footer')
</div>

<!-- Scripts -->
<script src="../assets/js/theme.js"></script>
<script src="../assets/js/bundle/apexcharts.bundle.js"></script>

<script>
    let index = {{ $itineraire->arrets->count() ?? 1 }};

    // Ajouter une gare
    document.getElementById('add-gare').addEventListener('click', function () {
        const container = document.getElementById('gares-container');
        const html = `
            <div class="row gare-item mb-3 align-items-center">
                <div class="col-md-6">
                    <select name="gares[${index}][id]" class="form-select shadow-sm gare-select" required>
                        <option value="">-- Choisir une gare --</option>
                        @foreach($gares as $gare)
                            <option value="{{ $gare->id }}">
                                {{ $gare->nom_gare }} → {{ $gare->ville?->nom_ville }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-outline-info btn-detail-gare">
                        <i class="fas fa-info-circle me-1"></i>Détails
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-remove-gare">
                        <i class="fas fa-trash me-1"></i>Supprimer
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        index++;
    });

    // Supprimer une gare
    document.addEventListener('click', function (e) {
        if (e.target.closest('.btn-remove-gare')) {
            const item = e.target.closest('.gare-item');
            item.remove();
        }
    });

    // Bouton Détails Gare
    document.addEventListener("click", function (e) {
        if (e.target && e.target.classList.contains("btn-detail-gare")) {
            const parent = e.target.closest(".gare-item");
            const select = parent.querySelector(".gare-select");
            const gareId = select?.value;

            if (!gareId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sélection requise',
                    text: 'Veuillez d\'abord sélectionner une gare.',
                    confirmButtonColor: '#1976d2',
                    confirmButtonText: 'OK'
                });
                return;
            }

            const modal = new bootstrap.Modal(document.getElementById("gareDetailModal"));
            const modalBody = document.getElementById("gare-details-content");
            
            // Loading state
            modalBody.innerHTML = `
                <div class="loading-state text-center py-5">
                    <div class="spinner-border text-primary mb-3" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                    <h5 class="text-primary">Chargement des détails</h5>
                </div>
            `;
            
            modal.show();

            fetch(`/gares/${gareId}`)
                .then(res => res.json())
                .then(data => {
                    if (data && data.nom_gare) {
                        modalBody.innerHTML = `
                            <div class="gare-details-container">
                                <!-- En-tête -->
                                <div class="gare-header bg-primary text-white rounded-top p-4 mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h3 class="fw-bold mb-1">
                                                <i class="fas fa-train me-2"></i>${data.nom_gare}
                                            </h3>
                                            <p class="mb-0 opacity-75">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                ${data.ville?.nom_ville || 'Non spécifiée'}
                                            </p>
                                        </div>
                                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <!-- Informations générales -->
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary mb-3">
                                                    <i class="fas fa-info-circle me-2"></i>Informations générales
                                                </h5>
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <i class="fas fa-city text-muted mt-1 me-3"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Ville</small>
                                                                <strong>${data.ville?.nom_ville || 'Non spécifiée'}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <i class="fas fa-phone text-muted mt-1 me-3"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Téléphone</small>
                                                                <strong>${data.telephone_gare || data.telephone || 'Non disponible'}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Services -->
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary mb-3">
                                                    <i class="fas fa-concierge-bell me-2"></i>Services
                                                </h5>
                                                <div class="services-list">
                                                    <div class="service-item ${data.wifi_disponible ? 'available' : 'unavailable'}">
                                                        <i class="fas fa-wifi me-2"></i>
                                                        <span>Wi-Fi</span>
                                                        <span class="status-indicator ${data.wifi_disponible ? 'available' : 'unavailable'}"></span>
                                                    </div>
                                                    <div class="service-item ${data.parking_disponible ? 'available' : 'unavailable'}">
                                                        <i class="fas fa-parking me-2"></i>
                                                        <span>Parking</span>
                                                        <span class="status-indicator ${data.parking_disponible ? 'available' : 'unavailable'}"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Horaires d'ouverture -->
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary mb-3">
                                                    <i class="fas fa-clock me-2"></i>Horaires d'ouverture
                                                </h5>
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <div class="time-slot bg-success bg-opacity-10 p-3 rounded text-center mb-2">
                                                            <small class="text-muted d-block">Ouverture</small>
                                                            <strong class="text-success fs-5">${data.heure_ouverture || '--:--'}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="time-slot bg-danger bg-opacity-10 p-3 rounded text-center">
                                                            <small class="text-muted d-block">Fermeture</small>
                                                            <strong class="text-danger fs-5">${data.heure_fermeture || '--:--'}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary mb-3">
                                                    <i class="fas fa-file-alt me-2"></i>Description
                                                </h5>
                                                <p class="text-muted lh-lg mb-0">
                                                    ${data.description || 'Aucune description disponible.'}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Localisation sur la carte -->
                                    ${data.latitude && data.longitude ? `
                                        <div class="col-12">
                                            <div class="card border-0 shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="card-title text-primary mb-3">
                                                        <i class="fas fa-map me-2"></i>Localisation sur la carte
                                                    </h5>
                                                    <div id="map" class="gare-map rounded"></div>
                                                </div>
                                            </div>
                                        </div>
                                    ` : ''}
                                </div>
                            </div>
                        `;

                        // Initialiser la carte
                        if (data.latitude && data.longitude) {
                            setTimeout(() => {
                                initMap(parseFloat(data.latitude), parseFloat(data.longitude), data.nom_gare);
                            }, 100);
                        }
                    } else {
                        modalBody.innerHTML = `
                            <div class="error-state text-center py-5">
                                <i class="fas fa-exclamation-triangle text-warning mb-3" style="font-size: 3rem;"></i>
                                <h5 class="text-warning">Aucune donnée trouvée</h5>
                                <button class="btn btn-outline-primary mt-2" data-bs-dismiss="modal">
                                    Fermer
                                </button>
                            </div>
                        `;
                    }
                })
                .catch((error) => {
                    modalBody.innerHTML = `
                        <div class="error-state text-center py-5">
                            <i class="fas fa-times-circle text-danger mb-3" style="font-size: 3rem;"></i>
                            <h5 class="text-danger">Erreur de chargement</h5>
                            <button class="btn btn-outline-primary mt-2" data-bs-dismiss="modal">
                                Fermer
                            </button>
                        </div>
                    `;
                });
        }
    });

    // Fonction pour initialiser Google Maps
    function initMap(lat, lng, gareName) {
        const mapElement = document.getElementById("map");
        if (!mapElement) return;

        const map = new google.maps.Map(mapElement, {
            center: { lat: lat, lng: lng },
            zoom: 15,
            mapTypeControl: false,
            streetViewControl: false
        });

        new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map,
            title: gareName
        });

        setTimeout(() => {
            google.maps.event.trigger(map, 'resize');
            map.setCenter({ lat: lat, lng: lng });
        }, 300);
    }

    // Styles CSS
    const additionalStyles = `
    <style>
        .gare-details-container {
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        
        .gare-header {
            margin: -1rem -1rem 2rem -1rem;
        }
        
        .service-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .service-item:last-child {
            border-bottom: none;
        }
        
        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
        
        .status-indicator.available {
            background-color: #28a745;
        }
        
        .status-indicator.unavailable {
            background-color: #dc3545;
        }
        
        .time-slot {
            border: 1px solid #e0e0e0;
        }
        
        .gare-map {
            height: 300px;
            border: 1px solid #e0e0e0;
        }
        
        .card {
            border-radius: 10px;
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
        
        .btn {
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #1976d2, #0d47a1);
            border: none;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(25, 118, 210, 0.3);
        }
    </style>
    `;

    document.head.insertAdjacentHTML('beforeend', additionalStyles);
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&libraries=places" async defer></script>

<style>
    .modal-content {
        border-radius: 12px;
    }
    .modal-header {
        border-bottom: none;
    }
    .modal-footer {
        border-top: none;
    }
    #gare-details-content p {
        margin-bottom: 0.5rem;
    }
    #gare-details-content i {
        color: #1976d2;
    }

    .card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }
    
    .badge {
        border-radius: 6px;
        font-weight: 500;
    }
    
    .alert {
        border-radius: 10px;
    }
</style>

</body>
</html>