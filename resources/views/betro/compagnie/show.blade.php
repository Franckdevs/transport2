@php
use App\Helpers\GlobalHelper;
@endphp

@include('betro.all_element.header')

<body class="layout-1" data-luno="theme-black">
    @include('betro.all_element.sidebar')
    
    <div class="wrapper">
        @include('betro.all_element.navbar')
        
        <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
            @include('betro.all_element.cadre')
        </div>

        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-3 py-2 mt-0 mt-lg-3">
            <div class="container-fluid">
                <!-- En-tête avec bouton de retour -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                            </h4>
                            <a href="{{ route('compagnies') }}" class="btn btn-light-primary animated-btn">
                                    <i class="bi bi-arrow-left"></i> Retour
                                </a>
                        </div>
                        
                    </div>
                </div>

                <!-- Section administrateur -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-transparent">
                                <h5 class="mb-0"><i class="fas fa-user-shield text-success me-2"></i>Administrateur de la compagnie</h5>
                            </div>
                            <div class="card-body">
                                @if($users)
                                    <div class="row align-items-center">
                                        <div class="col-md-6 col-lg-4 mb-3 mb-lg-0">
                                            <div class="d-flex align-items-center">
                                              
                                                <div>
                                                    <h5 class="mb-1">{{ $users->prenom ?? '' }} {{ $users->nom ?? '' }}</h5>
                                                    <span class="badge bg-success">Administrateur</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="d-flex align-items-start mb-2">
                                                <i class="fas fa-envelope text-muted me-2 mt-1"></i>
                                                <div>
                                                    <p class="mb-0 text-muted small">Email</p>
                                                    <p class="mb-0">{{ $users->email ?? '---' }}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-start">
                                                <i class="fas fa-phone-alt text-muted me-2 mt-1"></i>
                                                <div>
                                                    <p class="mb-0 text-muted small">Téléphone</p>
                                                    <p class="mb-0">{{ $users->telephone ?? '---' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-5 text-lg-end mt-3 mt-lg-0">
                                            <a href="#" class="btn btn-primary me-2">
                                                <i class="fas fa-envelope me-1"></i> Envoyer un message
                                            </a>
                                            <a href="#" class="btn btn-outline-secondary">
                                                <i class="fas fa-phone me-1"></i> Appeler
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-3">
                                        <div class="mb-2">
                                            <i class="fas fa-user-slash fa-3x text-muted"></i>
                                        </div>
                                        <h5 class="text-muted">Aucun administrateur associé</h5>
                                        <p class="text-muted mb-0">Cette compagnie n'a pas d'administrateur désigné pour le moment.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <!-- Carte du profil de la compagnie -->
                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card-header bg-transparent">
                                <h5 class="mb-0"><i class="fas fa-building text-primary me-2"></i>Profil de la compagnie</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="position-relative d-inline-block mb-3">
                                    @if($compagnies->logo_compagnies)
                                        <img src="{{ asset($compagnies->logo_compagnies) }}" 
                                             alt="Logo {{ $compagnies->nom_complet_compagnies }}" 
                                             class="img-fluid rounded-circle border border-4 border-light shadow" 
                                             style="width: 120px; height: 120px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets/img/profile_av.png') }}" 
                                             alt="Logo par défaut" 
                                             class="img-fluid rounded-circle border border-4 border-light shadow" 
                                             style="width: 120px; height: 120px; object-fit: cover;">
                                    @endif
                                </div>
                                <h4 class="mb-1">{{ $compagnies->nom_complet_compagnies }}</h4>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-map-marker-alt me-1"></i> {{ $compagnies->ville?->nom_ville ?? 'Ville non spécifiée' }}
                                </p>
                                
                                <div class="d-flex justify-content-center gap-2 mb-3">
                                    <a href="{{ route('compagnies.edit', $compagnies->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit me-1"></i> Modifier
                                    </a>

                                    <a href="#" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-envelope me-1"></i> Contacter
                                    </a>
                                </div>
                                
                                <div class="mt-3 pt-3 border-top">
                                    <h6 class="text-uppercase text-muted mb-3">Réseaux sociaux</h6>
                                    <div class="d-flex justify-content-center gap-3">
                                        <a href="#" class="text-primary"><i class="fab fa-facebook-f"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations principales -->
                    <div class="col-lg-8">
                        <!-- Carte des informations générales -->
                        <div class="card mb-3">
                            <div class="card-header bg-transparent">
                                <h5 class="mb-0"><i class="fas fa-info-circle text-primary me-2"></i>Informations générales de la compagnie</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="bg-light rounded p-2 me-3">
                                                <i class="fas fa-envelope text-primary"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-muted small">Email</p>
                                                <p class="mb-0">{{ $compagnies->email_compagnies ?? 'Non renseigné' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="bg-light rounded p-2 me-3">
                                                <i class="fas fa-phone-alt text-primary"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-muted small">Téléphone</p>
                                                <p class="mb-0">{{ $compagnies->telephone_compagnies ?? 'Non renseigné' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="bg-light rounded p-2 me-3">
                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-muted small">Adresse</p>
                                                <p class="mb-0">{{ $compagnies->adresse_compagnies ?? 'Non renseignée' }}</p>
                                                <p class="mb-0">{{ $compagnies->ville?->nom_ville ?? '' }} {{ $compagnies->pays ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @if($compagnies->adresse)
                                    <div class="col-12">
                                        <div class="d-flex align-items-start">
                                            <div class="bg-light rounded p-2 me-3">
                                                <i class="fas fa-align-left text-primary"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-muted small">Description</p>
                                                <p class="mb-0">{{ $compagnies->adresse }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Carte de localisation -->
                        <div class="card">
                            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fas fa-map-marked-alt text-primary me-2"></i>Localisation</h5>
                                <button class="btn btn-sm btn-outline-primary" id="refresh-map">
                                    <i class="fas fa-sync-alt me-1"></i> Actualiser
                                </button>
                            </div>
                            <div class="card-body p-0">
                                <div id="map" style="width: 100%; height: 300px; border-radius: 0 0 8px 8px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('betro.all_element.footer')
    </div>

    @if(isset($compagnies) && $compagnies->latitude && $compagnies->longitude)
    <script>
        let map;
        let marker;
        
        function initMap() {
            const lat = parseFloat("{{ $compagnies->latitude ?? 0 }}");
            const lng = parseFloat("{{ $compagnies->longitude ?? 0 }}");
            const mapElement = document.getElementById("map");

            if (!lat || !lng) {
                mapElement.innerHTML = `
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-light">
                        <i class="fas fa-map-marker-alt fa-3x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Coordonnées non disponibles</p>
                    </div>`;
                return;
            }

            const location = { lat: lat, lng: lng };
            
            // Création de la carte
            map = new google.maps.Map(mapElement, {
                zoom: 14,
                center: location,
                mapTypeControl: true,
                streetViewControl: true,
                fullscreenControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.TOP_RIGHT
                },
                zoomControl: true,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_CENTER
                },
                styles: [
                    {
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [{ visibility: "off" }]
                    }
                ]
            });

            // Ajout d'un marqueur personnalisé
            marker = new google.maps.Marker({
                position: location,
                map: map,
                title: "{{ $compagnies->nom_complet_compagnies }}",
                animation: google.maps.Animation.DROP,
                icon: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
                    scaledSize: new google.maps.Size(40, 40)
                }
            });

            // Ajout d'une info-bulle
            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div class="p-2">
                        <h6 class="mb-1">{{ $compagnies->nom_complet_compagnies }}</h6>
                        <p class="mb-0 small">{{ $compagnies->adresse_compagnies ?? '' }}</p>
                        <p class="mb-0 small">{{ $compagnies->ville?->nom_ville ?? '' }}</p>
                    </div>
                `
            });

            // Affichage de l'info-bulle au clic sur le marqueur
            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });

            // Affichage automatique de l'info-bulle au chargement
            setTimeout(() => {
                infoWindow.open(map, marker);
            }, 1000);
        }

        // Gestion du bouton de rafraîchissement
        document.addEventListener('DOMContentLoaded', function() {
            const refreshButton = document.getElementById('refresh-map');
            if (refreshButton) {
                refreshButton.addEventListener('click', function() {
                    if (map) {
                        map.setZoom(14);
                        map.panTo(marker.getPosition());
                        
                        // Animation de rebond du marqueur
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                        setTimeout(() => {
                            marker.setAnimation(null);
                        }, 1500);
                    }
                });
            }
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&callback=initMap&libraries=places" async defer></script>
    @else
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mapElement = document.getElementById("map");
            if (mapElement) {
                mapElement.innerHTML = `
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-light">
                        <i class="fas fa-map-marker-alt fa-3x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Localisation non disponible</p>
                        <small class="text-muted">Les coordonnées GPS ne sont pas définies</small>
                    </div>`;
            }
        });
    </script>
    @endif
</body>