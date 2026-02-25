@include('compagnie.all_element.header')
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

    <!-- Page Body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        
        <!-- En-tête avec bouton retour et titre -->
          <div class="d-flex justify-content-between align-items-center mb-4">
              @if($gare->status == 1)
                <!-- Bouton désactiver avec SweetAlert2 -->
                <button type="button" class="btn btn-warning btn-sm" onclick="confirmDesactivation({{ $gare->id }})" style="width: 110px">
                  <i class="fa fa-times"></i>Désactiver
                </button>

                <!-- Formulaire caché pour la désactivation -->
                <form id="desactiverForm{{ $gare->id }}" action="{{ route('gares.destroy_desactiver', $gare->id) }}" method="POST" style="display: none;">
                  @csrf
                </form>
              @elseif($gare->status == 3) 
                <!-- Bouton activer avec SweetAlert2 -->
                <button type="button" class="btn btn-success btn-sm" onclick="confirmActivation({{ $gare->id }})" style="width: 110px">
                  <i class="fa fa-check"></i>Activer
                </button>

                <!-- Formulaire caché pour l'activation -->
                <form id="activerForm{{ $gare->id }}" action="{{ route('gares.destroy_reactivation', $gare->id) }}" method="POST" style="display: none;">
                  @csrf
                </form>
              @endif

                <h5 class="mb-0">
                </h5>
                <a href="{{ route('gares.index.2') }}" class="btn btn-light" title="Retour">
                    <i class="fa fa-arrow-left"></i> Retour à la liste
                </a>
            </div>

        <!-- Carte principale -->
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">{{ $gare->nom_gare ?? 'Gare sans nom' }}</h4>
            <div class="d-flex align-items-center">
              <span class="badge status-badge bg-{{ $gare->status == 1 ? 'success' : ($gare->status == 2 ? 'danger' : 'warning') }} me-2">
                {{ $gare->status == 1 ? 'Actif' : ($gare->status == 3 ? 'Désactivé' : 'En attente') }}
              </span>
            
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <!-- Colonne de gauche -->
              <div class="col-md-6">
                <div class="mb-4">
                  <h5 class="mb-3">Informations générales</h5>
                  <div class="row">
                    <div class="col-12 mb-2">
                      <p class="info-label">Adresse</p>
                      <p class="info-value">{{ $gare->adresse_gare ?? 'Non renseignée' }}</p>
                    </div>
                    <div class="col-md-6 mb-2">
                      <p class="info-label">Téléphone</p>
                      <p class="info-value">{{ $gare->telephone_gare ?? 'Non renseigné' }}</p>
                    </div>
                    <div class="col-md-6 mb-2">
                      <p class="info-label">Email</p>
                      <p class="info-value">{{ $gare->email ?? 'Non renseigné' }}</p>
                    </div>
                    {{-- <div class="col-12 mb-2">
                      <p class="info-label">Site web</p>
                      <p class="info-value">
                        @if($gare->site_web)
                          <a href="{{ (strpos($gare->site_web, 'http') === 0 ? '' : 'https://') . $gare->site_web }}" target="_blank">
                            {{ $gare->site_web }}
                          </a>
                        @else
                          Non renseigné
                        @endif
                      </p>
                    </div> --}}
                    @if($gare->description)
                    <div class="col-12">
                      <p class="info-label">Description</p>
                      <div class="info-value">
                        {!! nl2br(e($gare->description)) ?: '<span class="text-muted">Aucune description</span>' !!}
                      </div>
                    </div>
                    @endif
                  </div>
                </div>
              </div>

              <!-- Colonne de droite -->
              <div class="col-md-6">
                <div class="mb-4">
                  <h5 class="mb-3">Horaires et localisation</h5>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <div class="card h-100">
                        <div class="card-body">
                          <p class="info-label">Horaires</p>
                          <p class="info-value">{{ $gare->heure_ouverture ?? '-' }} - {{ $gare->heure_fermeture ?? '-' }}</p>
                          <p class="info-label">Jours d'ouverture</p>
                          <p class="info-value">{{ $gare->jourOuvert?->nom_jour ?? '-' }}</p>
                          <p class="info-label">Jours de fermeture</p>
                          <p class="info-value">{{ $gare->jourFermeture?->nom_jour ?? '-' }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="card h-100">
                        <div class="card-body">
                          <p class="info-label">Ville</p>
                          <p class="info-value">{{ $gare->ville->nom_ville ?? 'Non renseignée' }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body p-0" style="height: 200px;">
                          <div id="map" style="height: 100%; width: 100%;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Section Équipements -->
            <div class="row mt-3">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title mb-0">Équipements et services</h5>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <p class="info-label">Parking</p>
                        <p class="info-value">
                          <span class="badge bg-{{ $gare->parking_disponible ? 'success' : 'black' }}">
                            {{ $gare->parking_disponible ? 'Disponible' : 'Non disponible' }}
                          </span>
                        </p>
                      </div>
                      <div class="col-md-6">
                        <p class="info-label">Wi-Fi</p>
                        <p class="info-value">
                          <span class="badge bg-{{ $gare->wifi_disponible ? 'success' : 'black' }}">
                            {{ $gare->wifi_disponible ? 'Disponible' : 'Non disponible' }}
                          </span>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Section Responsable -->
            @if(isset($gare->compagnie->info_user))
            <div class="row mt-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title mb-0">Responsable de la gare</h5>
                  </div>
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="mb-1">{{ $gare->compagnie->info_user->prenom ?? '' }} {{ $gare->compagnie->info_user->nom ?? '' }}</h5>
                        <p class="mb-1">
                          <i class="fas fa-envelope me-2 text-muted"></i>
                          <a href="mailto:{{ $gare->compagnie->info_user->email ?? '' }}" class="text-decoration-none">
                            {{ $gare->compagnie->info_user->email ?? 'Non renseigné' }}
                          </a>
                        </p>
                        <p class="mb-0">
                          <i class="fas fa-phone me-2 text-muted"></i>
                         (+225) {{ $gare->compagnie->info_user->telephone ?? 'Non renseigné' }}
                        </p>
                      </div>
                      <div class="ms-auto">
                        <a href="mailto:{{ $gare->compagnie->info_user->email ?? '' }}" class="btn btn-outline-secondary btn-sm" style="width: 100px">
                          Contacter
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>
          <div class="card-footer text-muted text-end">
            <small>Dernière mise à jour : {{ $gare->updated_at ? $gare->updated_at->format('d/m/Y H:i') : '-' }}</small>
          </div>
        </div>
      </div>
    </div>
    @include('compagnie.all_element.footer')
  </div>

  <!-- Google Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&callback=initMap" async defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <style>
    .card {
      border: 1px solid rgba(0,0,0,.125);
      border-radius: 0.5rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
    }
    .card-header {
      background-color: #f8f9fa;
      border-bottom: 1px solid rgba(0,0,0,.125);
      padding: 0.75rem 1.25rem;
    }
    .card-title {
      margin-bottom: 0;
      font-size: 1.1rem;
      font-weight: 500;
    }
    .info-label {
      color: #6c757d;
      margin-bottom: 0.25rem;
    }
    .info-value {
      margin-bottom: 1rem;
      font-weight: 400;
    }
    .status-badge {
      font-size: 0.9rem;
      font-weight: 500;
      padding: 0.35em 0.65em;
    }
  </style>

  <script>
    function confirmDesactivation(gareId) {
        Swal.fire({
            title: 'Confirmation',
            text: 'Voulez-vous vraiment désactiver cette gare ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, désactiver',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('desactiverForm' + gareId).submit();
            }
        });
    }

    function confirmActivation(gareId) {
        Swal.fire({
            title: 'Confirmation',
            text: 'Voulez-vous vraiment réactiver cette gare ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, activer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('activerForm' + gareId).submit();
            }
        });
    }

    function initMap() {
      var lat = parseFloat("{{ $gare->latitude ?? 0 }}");
      var lng = parseFloat("{{ $gare->longitude ?? 0 }}");
      var mapElement = document.getElementById('map');

      // Vérification des coordonnées
      if (!lat || !lng || lat === 0 || lng === 0) {
          mapElement.innerHTML = `
            <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-light">
              <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
              <p class="text-muted mb-0 text-center">Localisation non disponible</p>
            </div>`;
          return;
      }

      var map = new google.maps.Map(mapElement, {
          zoom: 15,
          center: {lat: lat, lng: lng},
          mapTypeControl: false,
          streetViewControl: false,
          fullscreenControl: true,
          zoomControl: true,
          styles: [
            {
              featureType: 'poi',
              elementType: 'labels',
              stylers: [{ visibility: 'off' }]
            }
          ]
      });

      new google.maps.Marker({
          position: {lat: lat, lng: lng},
          map: map,
          title: "{{ $gare->nom_gare }}",
          animation: google.maps.Animation.DROP,
          icon: {
            url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
            scaledSize: new google.maps.Size(40, 40)
          }
      });

      // Ajouter un info window
      var infowindow = new google.maps.InfoWindow({
        content: `
          <div class="p-2">
            <h6 class="mb-1">{{ $gare->nom_gare }}</h6>
            <p class="mb-1 small">{{ $gare->adresse_gare ?? '' }}</p>
            <p class="mb-0 small">{{ $gare->ville->nom_ville ?? '' }}</p>
          </div>
        `
      });

      // Ouvrir l'info window au clic sur le marqueur
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
      });
    }

    // Gestion des erreurs de chargement de l'API Google Maps
    window.gm_authFailure = function() {
      const mapElement = document.getElementById('map');
      if (mapElement) {
        mapElement.innerHTML = `
          <div class="alert alert-warning m-0 h-100 d-flex flex-column align-items-center justify-content-center">
            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
            <p class="mb-0 text-center">Impossible de charger la carte. Vérifiez votre connexion Internet.</p>
          </div>`;
      }
    };
  </script>

  <!-- Theme JS -->
  <script src="../assets/js/theme.js"></script>
  <!-- ApexCharts -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  
  <!-- Initialisation des tooltips Bootstrap -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Activer les tooltips
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });
  </script>

</body>

</html>

{{-- resources/views/compagnie/gare/show.blade.php
@include('compagnie.all_element.header')

<body class="layout-1" data-luno="theme-blue">

@include('compagnie.all_element.sidebar')

<div class="wrapper">
    @include('compagnie.all_element.navbar')
    @include('compagnie.all_element.cadre')

    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        <div class="container-fluid">

            <div class="card p-4 shadow-sm rounded">
                <h4 class="mb-3">
                    <i class="fa fa-train me-2"></i> Gare : {{ $gare->nom_gare ?? 'Sans nom' }}
                </h4>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Adresse :</strong> {{ $gare->adresse_gare ?? 'Non renseignée' }}</p>
                        <p><strong>Téléphone :</strong> {{ $gare->telephone_gare ?? 'Non renseigné' }}</p>
                        <p><strong>Email :</strong> {{ $gare->email ?? 'Non renseigné' }}</p>
                        <p><strong>Site web :</strong>
                            @if($gare->site_web)
                                <a href="{{ $gare->site_web }}" target="_blank">{{ $gare->site_web }}</a>
                            @else
                                Non renseigné
                            @endif
                        </p>
                        <p><strong>Ville :</strong> {{ $gare->ville->nom ?? 'Non renseignée' }}</p>
                        <p><strong>Description :</strong> {{ $gare->description ?? 'Aucune' }}</p>
                    </div>

                    <div class="col-md-6">

                        <p><strong>Heure d'ouverture :</strong> {{ $gare->heure_ouverture ?? '-' }}</p>
                        <p><strong>Heure de fermeture :</strong> {{ $gare->heure_fermeture ?? '-' }}</p>
                        <p><strong>Jour d'ouverture :</strong> {{ $gare->jourOuvert?->nom ?? '-' }}</p>
                        <p><strong>Jour de fermeture :</strong> {{ $gare->jourFermeture?->nom ?? '-' }}</p>
                        <p><strong>Nombre de quais :</strong> {{ $gare->nombre_quais ?? 'Non renseigné' }}</p>
                    </div>
                </div>

                <hr>

<h5 class="mt-3"><i class="fa fa-cogs me-2"></i> Équipements :</h5>
<div class="row mb-3">
    <div class="col">
        <strong>Accessible PMR :</strong> {{ $gare->accessible_pm ? 'Oui' : 'Non' }}
    </div>
    <div class="col">
        <strong>Parking disponible :</strong> {{ $gare->parking_disponible ? 'Oui' : 'Non' }}
    </div>
    <div class="col">
        <strong>Wi-Fi disponible :</strong> {{ $gare->wifi_disponible ? 'Oui' : 'Non' }}
    </div>
</div>

<hr>

<h5 class="mt-3"><i class="fa fa-user-shield me-2"></i> Administrateur :</h5>
<div class="row">
    <div class="col">
        <strong>Nom :</strong> {{ $gare->admin_nom ?? '-' }}
    </div>
    <div class="col">
        <strong>Prénom :</strong> {{ $gare->admin_prenom ?? '-' }}
    </div>
    <div class="col">
        <strong>Email :</strong> {{ $gare->admin_email ?? '-' }}
    </div>
    <div class="col">
        <strong>Téléphone :</strong> {{ $gare->admin_telephone ?? '-' }}
    </div>
</div>

<hr>

                <p><strong>Status :</strong>
                    @if($gare->status == 1) ✅ Actif
                    @elseif($gare->status == 2) ❌ Inactif
                    @else ⏳ En attente
                    @endif
                </p>

                <h5 class="mt-3"><i class="fa fa-map-marker-alt me-2"></i> Localisation :</h5>
                <div id="map" style="height: 350px; width: 100%;" class="my-3 border rounded"></div>

                <a href="{{ route('gares.index.2') }}" class="btn btn-secondary mt-3">
                    <i class="fa fa-arrow-left"></i> Retour à la liste
                </a>
            </div>

        </div>
    </div>

    @include('compagnie.all_element.footer')
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&callback=initMap" async defer></script>
<script>
    function initMap() {
        var lat = parseFloat("{{ $gare->latitude ?? 0 }}");
        var lng = parseFloat("{{ $gare->longitude ?? 0 }}");

        // Vérification des coordonnées
        if (!lat || !lng) {
            document.getElementById('map').innerHTML = "<p class='text-danger text-center py-5'>📍 Coordonnées non disponibles</p>";
            return;
        }

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: lat, lng: lng}
        });

        new google.maps.Marker({
            position: {lat: lat, lng: lng},
            map: map,
            title: "{{ $gare->nom_gare }}"
        });
    }
</script>

</body>
</html> --}}
