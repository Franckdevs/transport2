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

                                @if($compagnies->status == 1)
                                <span class="badge bg-success">Validé en activité</span>
                                @elseif($compagnies->status == 2)
                                <span class="badge bg-warning text-dark">En attente</span>
                                @elseif($compagnies->status == 3)
                                <span class="badge bg-danger">Désactivation</span>
                                @elseif($compagnies->status == 'demande_refuse')
                                <span class="badge bg-danger">Demande refusée</span>
                                @else
                                <span class="badge bg-secondary">Inconnu</span>
                                @endif
                                
                                <div class="d-flex justify-content-center gap-2 mb-3">
                                     {{-- @if ($compagnies->status != 'demande_refuse' && $compagnies->status != 2)
                                    <a href="{{ route('compagnies.edit', $compagnies->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit me-1"></i> Modifier
                                    </a>
                                    @endif --}}

                                    
                                     @if ($compagnies->status != 'demande_refuse' && $compagnies->status != 2)
                                    <a href="{{ route('compagnies.edit', $compagnies->id) }}" class="btn btn-outline-secondary btn-sm mt-4">
                                        <i class="fas fa-envelope me-1"></i> Modifier
                                    </a>
                                    @endif
                                </div>
                                
                                <!-- Boutons de gestion de statut -->
                                <div class="d-flex justify-content-center gap-2 mb-3">
                                    @if ($compagnies->status != 'demande_refuse')
                                    @if($compagnies->status == 2)
                                        <!-- Actions validation / refus -->
                                        <form action="{{ route('compagnies.approve', $compagnies->id) }}" method="POST" style="display:inline;" class="approve-form">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" title="Valider la demande">
                                                <i class="fa fa-check"></i> Valider
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#refuseModal{{ $compagnies->id }}" title="Refuser la demande">
                                            <i class="fa fa-times"></i> Refuser
                                        </button>
                                    @else
                                        <!-- Bouton de suppression / réactivation -->
                                        @if($compagnies->status == 1)
                                            <form id="deleteForm{{ $compagnies->id }}" action="{{ route('compagnies.destroy', $compagnies->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-warning btn-sm" onclick="confirmDelete({{ $compagnies->id }}, '{{ addslashes($compagnies->nom_complet_compagnies) }}')" title="Bloquer cette compagnie">
                                                    <i class="fas fa-ban"></i> Bloquer
                                                </button>
                                            </form>
                                        @else
                                            <form id="reactivateForm{{ $compagnies->id }}" action="{{ route('compagnies.reactivate', $compagnies->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="button" class="btn btn-success btn-sm" onclick="confirmReactivate({{ $compagnies->id }}, '{{ addslashes($compagnies->nom_complet_compagnies) }}')">
                                                    <i class="fa fa-refresh"></i> Réactiver
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                    @endif
                                </div>
                                
                                
                                {{-- <div class="mt-3 pt-3 border-top">
                                    <h6 class="text-uppercase text-muted mb-3">Réseaux sociaux</h6>
                                    <div class="d-flex justify-content-center gap-3">
                                        <a href="#" class="text-primary"><i class="fab fa-facebook-f"></i></a>
                                    </div>
                                </div> --}}
                                
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

                        <!-- Onglets pour Gares et Localisation -->
                        <div class="card">
                            <div class="card-header bg-transparent">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="gares-tab" data-bs-toggle="tab" data-bs-target="#gares" type="button" role="tab" aria-controls="gares" aria-selected="true">
                                            <i class="fas fa-train me-2"></i>Gares de la compagnie
                                            @if(isset($gares) && $gares->count() > 0)
                                                <span class="badge bg-primary ms-1">{{ $gares->count() }}</span>
                                            @endif
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="localisation-tab" data-bs-toggle="tab" data-bs-target="#localisation" type="button" role="tab" aria-controls="localisation" aria-selected="false">
                                            <i class="fas fa-map-marked-alt me-2"></i>Localisation
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content" id="myTabContent">
                                    <!-- Onglet Gares -->
                                    <div class="tab-pane fade show active" id="gares" role="tabpanel" aria-labelledby="gares-tab">
                                        @if(isset($gares) && $gares->count() > 0)
                                            <div class="table-responsive">
                                                <table id="garesTable" class="table display dataTable table-hover" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Nom de la gare</th>
                                                            <th>Ville</th>
                                                            <th>Adresse</th>
                                                            <th>Téléphone</th>
                                                            <th>Email</th>
                                                            <th>Heures d'ouverture</th>
                                                            <th>Services</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($gares as $gare)
                                                            <tr>
                                                                <td>
                                                                    <strong>{{ $gare->nom_gare ?? 'Non renseigné' }}</strong>
                                                                </td>
                                                                <td>{{ $gare->ville?->nom_ville ?? 'Non renseignée' }}</td>
                                                                <td>{{ \Illuminate\Support\Str::limit($gare->adresse_gare ?? 'Non renseignée', 30) }}</td>
                                                                <td>{{ $gare->telephone_gare ?? 'Non renseigné' }}</td>
                                                                <td>{{ \Illuminate\Support\Str::limit($gare->email ?? 'Non renseigné', 20) }}</td>
                                                                <td>
                                                                    @if($gare->heure_ouverture && $gare->heure_fermeture)
                                                                        <span class="badge bg-success">
                                                                            {{ $gare->heure_ouverture }} - {{ $gare->heure_fermeture }}
                                                                        </span>
                                                                    @else
                                                                        <span class="badge bg-secondary">Non défini</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex gap-1">
                                                                        @if($gare->parking_disponible)
                                                                            <span class="badge bg-info" title="Parking disponible">P</span>
                                                                        @endif
                                                                        @if($gare->wifi_disponible)
                                                                            <span class="badge bg-primary" title="WiFi disponible">WiFi</span>
                                                                        @endif
                                                                        @if($gare->nombre_quais)
                                                                            <span class="badge bg-warning" title="{{ $gare->nombre_quais }} quais">{{ $gare->nombre_quais }}Q</span>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="text-center py-5">
                                                <div class="mb-3">
                                                    <i class="fas fa-train fa-4x text-muted"></i>
                                                </div>
                                                <h5 class="text-muted">Aucune gare enregistrée</h5>
                                                <p class="text-muted">Cette compagnie ne possède pas encore de gares dans le système.</p>
                                                {{-- <button class="btn btn-primary">
                                                    <i class="fas fa-plus me-2"></i>Ajouter une gare
                                                </button> --}}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Onglet Localisation -->
                                    <div class="tab-pane fade" id="localisation" role="tabpanel" aria-labelledby="localisation-tab">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="mb-0"><i class="fas fa-map-marked-alt text-primary me-2"></i>Localisation de la compagnie</h5>
                                            <button class="btn btn-sm btn-outline-primary" id="refresh-map">
                                                <i class="fas fa-sync-alt me-1"></i> Actualiser
                                            </button>
                                        </div>
                                        <div id="map" style="width: 100%; height: 400px; border-radius: 8px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('betro.all_element.footer')
    </div>

    <!-- Modal de refus pour les compagnies en attente -->
    @if($compagnies->status == 2)
    <div class="modal fade" id="refuseModal{{ $compagnies->id }}" tabindex="-1" aria-labelledby="refuseLabel{{ $compagnies->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="refuseLabel{{ $compagnies->id }}">Refuser la demande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <form action="{{ route('compagnies.refuse', $compagnies->id) }}" method="POST" class="refuse-form">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Motif / Modifications demandées</label>
                            <textarea name="reason" class="form-control" rows="4" required placeholder="Expliquez le motif de refus ou les corrections à apporter..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Envoyer le refus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

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
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function() {
        // Gestionnaire pour le formulaire d'approbation
        $(document).on('submit', '.approve-form', function(e) {
            e.preventDefault();
            const form = this;
            
            Swal.fire({
                title: 'Confirmer la validation',
                text: 'Valider cette demande ? Un email de confirmation sera envoyé.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, valider',
                cancelButtonText: 'Annuler',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Initialisation de DataTable
        $('#garesTable').addClass('nowrap').dataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
            }
        });
    });

    // Fonction pour confirmer le blocage
    function confirmDelete(compagnieId, compagnieName) {
      Swal.fire({
        title: 'Confirmer le blocage',
        html: `
          <p>Attention ! En bloquant <strong>${compagnieName}</strong> :</p>
          <ul style="text-align: left; padding-left: 20px;">
            <li>Toutes les gares associées seront désactivées</li>
            <li>Les agents ne pourront plus se connecter</li>
            <li>La compagnie sera marquée comme inactive</li>
          </ul>
          <p>Voulez-vous continuer ?</p>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, bloquer',
        cancelButtonText: 'Annuler'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('deleteForm' + compagnieId).submit();
        }
      });
    }

    // Fonction pour confirmer la réactivation
    function confirmReactivate(compagnieId, compagnieName) {
      Swal.fire({
        title: 'Confirmer la réactivation',
        html: `
          <p>Voulez-vous réactiver la compagnie <strong>${compagnieName}</strong> ?</p>
          <p class="text-muted">Cela permettra à nouveau l'accès aux utilisateurs de cette compagnie.</p>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, réactiver',
        cancelButtonText: 'Annuler'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('reactivateForm' + compagnieId).submit();
        }
      });
    }
    </script>
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