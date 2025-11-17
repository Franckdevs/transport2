@include('compagnie.all_element.header')
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

           @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        </nav>
      </div>
    </header>
    <!-- start: page toolbar -->
  @include('compagnie.all_element.cadre')

    <!-- start: page body -->
    <div class="page-body">
      <div class="container-fluid">
          <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">
                </h5>
                <a href="{{ route('gares.index.2') }}" class="btn btn-light" title="Retour">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </div>

<div class="col-12">
  <div class="card shadow-sm">
    {{-- <div class="card-header bg-white border-bottom-0 py-3">
      <h5 class="card-title mb-0 text-primary">
        <i class="fas fa-edit me-2"></i>Modification de la gare
      </h5>
    </div> --}}
    <div class="card-body pt-0">
<form action="{{ route('gares.update2', $gare) }}" method="POST" id="gareForm">
@csrf
@method('PUT')
    <style>
        /* Styles de base */
        #map {
            height: 300px;
            width: 100%;
            border-radius: 8px;
            margin-top: 15px;
            border: 1px solid #dee2e6;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
        }
        
        /* Boutons et formulaires */
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            white-space: nowrap;
            transition: all 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            transform: translateY(-1px);
        }
        
        /* Messages d'état */
        .status-message {
            font-size: 14px;
            margin-top: 10px;
            padding: 10px 15px;
            border-radius: 6px;
            display: none;
            border-left: 4px solid transparent;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            display: block;
            border-left-color: #28a745;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            display: block;
            border-left-color: #dc3545;
        }
        .info {
            background-color: #e7f5ff;
            color: #0c63e4;
            display: block;
            border-left-color: #0d6efd;
        }
        
        /* Animation de chargement */
        .loading {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 3px solid rgba(13, 110, 253, 0.2);
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .address-details {
            margin-top: 15px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
<div class="container px-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="mt-3 mb-2">
            <h5 class="mb-0 text-primary"><i class="fas fa-map-marker-alt me-2"></i>Localisation de la gare</h5>
            <p class="text-muted mb-0 small">Définissez l'emplacement exact de votre gare sur la carte</p>
          </div>
          {{-- <button type="button" onclick="locateUser()" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-location-arrow me-1"></i> Me localiser
          </button> --}}
        </div>
        <input type="hidden" name="compagnie_id" value="{{ $compagnie_id }}">
        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $gare->latitude) }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude' ,$gare) }}">

        <div class="row">
            <div class="col-md-12 mb-3 d-flex">
                <input id="searchInput" name="adresse_gare" value="{{ old('adresse_gare' ,$gare) }}" class="form-control me-2" type="text" placeholder="Entrer une adresse ou un lieu">
                <button type="button" id="locateBtn" class="btn btn-primary">
                    <i class="fas fa-location-arrow me-1"></i> Me localiser
                </button>
            </div>

            <div class="col-md-12 mb-3">
                <div id="statusMessage" class="status-message"></div>
            </div>

            <div class="col-md-12 mb-3">
                <div id="map"></div>
            </div>
        </div>

        <style>
        /* Masquer la section des détails de l'adresse et des coordonnées */
        #addressDetails,
        #coordinates,
        #addressDetailsContainer {
            display: none;
        }
        </style>
        <div class="row mt-4">
            <div class="col-md-6">
                <h5><i class="fas fa-info-circle me-2"></i>Détails de l'adresse:</h5>
                <div id="addressDetails" class="address-details">
                    Les détails de l'adresse s'afficheront ici...
                </div>
            </div>
            <div class="col-md-6">
                <h5><i class="fas fa-globe me-2"></i>Coordonnées:</h5>
                <div id="coordinates" class="address-details">
                    Latitude: <span id="latValue">5.345317</span><br>
                    Longitude: <span id="lngValue">-4.024429</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function formatPhoneNumber(input) {
            // Récupérer la valeur actuelle et supprimer tout ce qui n'est pas un chiffre
            let value = input.value.replace(/\D/g, '');
            
            // Limiter à 10 chiffres
            if (value.length > 10) {
                value = value.substring(0, 10);
            }
            
            // Mettre à jour la valeur dans le champ
            input.value = value;
            
            // Formater avec des espaces tous les 2 chiffres
            let formattedValue = '';
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 2 === 0) {
                    formattedValue += ' ';
                }
                formattedValue += value[i];
            }
            
            // Mettre à jour la valeur formatée dans le champ
            input.value = formattedValue;
        }
        
        // Ajouter des écouteurs d'événements pour les champs de téléphone
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInputs = document.querySelectorAll('input[type="text"][pattern*="[0-9]"]');
            phoneInputs.forEach(input => {
                input.addEventListener('input', function() {
                    formatPhoneNumber(this);
                });
            });
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&libraries=places&callback=initMap" async defer></script>

    <script>
        let map, marker, autocomplete;
        let isGoogleMapsLoaded = false;

        // Attendre que Google Maps soit chargé
        window.initMap = function() {
            isGoogleMapsLoaded = true;
            initializeMap();
        };

        function initializeMap() {
            const defaultLocation = { lat: 5.345317, lng: -4.024429 };

            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 13,
                streetViewControl: false,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.TOP_RIGHT
                }
            });

            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true,
                icon: {
                    url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
                    scaledSize: new google.maps.Size(40, 40)
                },
                title: "Déplacez-moi pour ajuster la position"
            });

            // Ajouter un cercle de précision autour du marqueur
            const circle = new google.maps.Circle({
                map: map,
                radius: 100, // 100 mètres
                fillColor: '#AA0000',
                fillOpacity: 0.2,
                strokeColor: '#AA0000',
                strokeOpacity: 0.8,
                strokeWeight: 1
            });
            circle.bindTo('center', marker, 'position');

            // Initialiser l'autocomplétion des adresses
            initAutocomplete();

            // Événements
            marker.addListener("dragend", function() {
                setLocation(marker.getPosition());
            });

            document.getElementById("locateBtn").addEventListener("click", function() {
                locateUser();
            });

            // Mettre à jour l'affichage des coordonnées
            updateCoordinates(defaultLocation.lat, defaultLocation.lng);
        }

        function initAutocomplete() {
            if (!isGoogleMapsLoaded) return;

            const input = document.getElementById("searchInput");
            autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['geocode', 'establishment'],
                componentRestrictions: { country: 'ci' } // Restreindre à la Côte d'Ivoire
            });

            autocomplete.bindTo("bounds", map);
            autocomplete.addListener("place_changed", function () {
                const place = autocomplete.getPlace();
                if (!place.geometry || !place.geometry.location) {
                    showStatus("Lieu non trouvé !", "error");
                    return;
                }
                setLocation(place.geometry.location);
            });
        }

        function locateUser() {
            if (!navigator.geolocation) {
                showStatus("La géolocalisation n'est pas supportée par ce navigateur.", "error");
                return;
            }

            showStatus("Localisation en cours... <span class='loading'></span>", "info");

            // Désactiver le bouton pendant la localisation
            const locateBtn = document.getElementById("locateBtn");
            locateBtn.disabled = true;
            locateBtn.innerHTML = "<i class='fas fa-spinner fa-spin me-1'></i> Localisation...";

            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    setLocation(userLocation);
                    locateBtn.disabled = false;
                    locateBtn.innerHTML = "<i class='fas fa-location-arrow me-1'></i> Me localiser";
                },
                function (error) {
                    let errorMessage = "Impossible de récupérer votre position.";
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage = "Vous avez refusé l'accès à votre position. Veuillez autoriser la localisation dans les paramètres de votre navigateur.";
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = "Votre position n'a pas pu être déterminée. Vérifiez votre connexion Internet ou le signal GPS.";
                            break;
                        case error.TIMEOUT:
                            errorMessage = "La requête a expiré. Veuillez réessayer.";
                            break;
                    }
                    showStatus(errorMessage, "error");
                    locateBtn.disabled = false;
                    locateBtn.innerHTML = "<i class='fas fa-location-arrow me-1'></i> Me localiser";
                },
                {
                    timeout: 15000,
                    enableHighAccuracy: true,
                    maximumAge: 60000
                }
            );
        }

        function setLocation(latlng) {
            const lat = typeof latlng.lat === 'function' ? latlng.lat() : latlng.lat;
            const lng = typeof latlng.lng === 'function' ? latlng.lng() : latlng.lng;

            map.setCenter({lat, lng});
            map.setZoom(16);
            marker.setPosition({lat, lng});

            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lng;
            updateCoordinates(lat, lng);

            showStatus("Récupération de l'adresse... <span class='loading'></span>", "info");

            // Essayer d'abord avec Google Geocoding
            if (isGoogleMapsLoaded) {
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({ location: {lat, lng} }, function(results, status) {
                    if (status === "OK" && results[0]) {
                        processAddressResults(results[0]);
                    } else {
                        // Si Google échoue, utiliser Nominatim
                        useNominatim(lat, lng);
                    }
                });
            } else {
                // Utiliser Nominatim si Google Maps n'est pas chargé
                useNominatim(lat, lng);
            }
        }

        function useNominatim(lat, lng) {
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
                .then(response => {
                    if (!response.ok) throw new Error("Erreur réseau");
                    return response.json();
                })
                .then(data => {
                    if (data && data.address) {
                        processNominatimResult(data);
                    } else {
                        throw new Error("Aucune adresse trouvée");
                    }
                })
                .catch(err => {
                    console.error("Erreur Nominatim:", err);
                    showStatus("Impossible de récupérer l'adresse. Vous pouvez saisir manuellement.", "error");
                    document.getElementById("searchInput").value = `Position: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                    document.getElementById("addressDetails").innerHTML = "Adresse non disponible. Veuillez saisir manuellement.";
                });
        }

        function processAddressResults(result) {
            const address = result.formatted_address;
            document.getElementById("searchInput").value = address;

            let detailsHTML = `<strong>Adresse complète:</strong> ${address}<br><br>`;
            detailsHTML += "<strong>Détails:</strong><br>";
            detailsHTML += "<ul>";

            for (const component of result.address_components) {
                detailsHTML += `<li><strong>${component.types[0]}:</strong> ${component.long_name}</li>`;
            }

            detailsHTML += "</ul>";
            document.getElementById("addressDetails").innerHTML = detailsHTML;

            showStatus("Adresse trouvée avec succès!", "success");
        }

        function processNominatimResult(data) {
            const address = data.display_name;
            document.getElementById("searchInput").value = address;

            let detailsHTML = `<strong>Adresse complète:</strong> ${address}<br><br>`;
            detailsHTML += "<strong>Détails:</strong><br>";
            detailsHTML += "<ul>";

            for (const [key, value] of Object.entries(data.address)) {
                detailsHTML += `<li><strong>${key}:</strong> ${value}</li>`;
            }

            detailsHTML += "</ul>";
            document.getElementById("addressDetails").innerHTML = detailsHTML;

            showStatus("Adresse trouvée avec succès!", "success");
        }

        function showStatus(message, type) {
            const statusElement = document.getElementById("statusMessage");
            statusElement.innerHTML = message;
            statusElement.className = "status-message " + type;
        }

        function updateCoordinates(lat, lng) {
            document.getElementById("latValue").textContent = lat.toFixed(6);
            document.getElementById("lngValue").textContent = lng.toFixed(6);
        }

        // Vérifier si l'API Google Maps est chargée
        function checkGoogleMapsLoaded() {
            if (typeof google !== 'undefined' && google.maps) {
                isGoogleMapsLoaded = true;
                initializeMap();
            } else {
                // Réessayer après 1 seconde
                setTimeout(checkGoogleMapsLoaded, 1000);
            }
        }
        // Démarrer la vérification du chargement de Google Maps
        window.onload = checkGoogleMapsLoaded;
    </script>





<div class="row mt-4">
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header bg-white py-3 border-bottom-0">
        <h5 class="card-title mb-0 text-primary">
          <i class="fas fa-info-circle me-2"></i>Informations générales
        </h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 mb-3">
            <label for="nom_gare" class="form-label">Nom de la gare</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-train"></i></span>
              <input type="text" name="nom_gare" id="nom_gare" class="form-control" value="{{ old('nom_gare', $gare->nom_gare) }}">
            </div>
  </div>
</div>

<div class="row">
  {{-- Adresse gare --}}
  {{-- <div class="col-12 mb-3">
  <label for="adresse_gare" class="form-label">Adresse</label>
  <div class="input-group">
    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
    <input type="text" name="adresse_gare" id="adresse_gare" class="form-control" value="{{ old('adresse_gare', $gare->adresse_gare) }}">
  </div>
</div> --}}

  {{-- Téléphone gare --}}
  <div class="col-md-6 mb-3">
    <label for="telephone_gare" class="form-label">Téléphone</label>
    <div class="input-group">
      <span class="input-group-text">
        <img src="https://flagcdn.com/w20/ci.png" alt="Drapeau Côte d'Ivoire" class="me-1" style="width: 20px;">
        +225
      </span>
      <input type="text" name="telephone_gare" id="telephone_gare" class="form-control" 
             placeholder="XX XX XX XX XX" 
             value="{{ old('telephone_gare', $gare->telephone_gare) }}" 
             pattern="[0-9]{2}( [0-9]{2}){4}" 
             onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 32"
             oninput="formatPhoneNumber(this)"
             onpaste="return false;"
             ondrop="return false;"
             autocomplete="off">
    </div>
    <small class="text-muted">Format: XX XX XX XX XX (10 chiffres)</small>
  </div>
</div>

<div class="row">
  {{-- Ville --}}
  <div class="col-md-6 mb-3">
    <label for="ville_id" class="form-label">Ville</label>
    <select name="ville_id" id="ville_id" class="form-select">
      <option value="">-- Sélectionner une ville --</option>
      @foreach($villes as $ville)
        <option value="{{ $ville->id }}" {{ old('ville_id',$gare) == $ville->id ? 'selected' : '' }}>
          {{ $ville->nom_ville ?? $ville->id }}
        </option>
      @endforeach
    </select>
  </div>

  {{-- Jour d'ouverture --}}
  <div class="col-md-6 mb-3">
    <label for="jour_ouvert_id" class="form-label">Jour d'ouverture</label>
    <select name="jour_ouvert_id" id="jour_ouvert_id" class="form-select">
      <option value="">-- Sélectionner un jour d'ouverture --</option>
      @foreach($jours as $jour)
        <option value="{{ $jour->id }}" {{ old('jour_ouvert_id',$gare) == $jour->id ? 'selected' : '' }}>
          {{ $jour->nom_jour ?? $jour->id }}
        </option>
      @endforeach
    </select>
  </div>
</div>

<div class="row">
  {{-- Jour de fermeture --}}
  <div class="col-md-6 mb-3">
    <label for="jour_de_fermeture_id" class="form-label">Jour de fermeture</label>
    <select name="jour_de_fermeture_id" id="jour_de_fermeture_id" class="form-select">
      <option value="">-- Sélectionner un jour de fermeture --</option>
      @foreach($jours as $jour)
        <option value="{{ $jour->id }}" {{ old('jour_de_fermeture_id',$gare) == $jour->id ? 'selected' : '' }}>
          {{ $jour->nom_jour ?? $jour->id }}
        </option>
      @endforeach
    </select>
  </div>

</div>

<div class="row">
  {{-- Heure ouverture --}}
  <div class="col-md-6 mb-3">
    <label for="heure_ouverture" class="form-label">Heure d'ouverture</label>
    <input type="time" name="heure_ouverture" id="heure_ouverture" class="form-control" value="{{ old('heure_ouverture',$gare) }}">
  </div>

  {{-- Heure fermeture --}}
  <div class="col-md-6 mb-3">
    <label for="heure_fermeture" class="form-label">Heure de fermeture</label>
    <input type="time" name="heure_fermeture" id="heure_fermeture" class="form-control" value="{{ old('heure_fermeture',$gare) }}">
  </div>
</div>

<div class="row mb-4">
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header bg-white py-3 border-bottom-0">
        <h5 class="card-title mb-0 text-primary">
          <i class="fas fa-cogs me-2"></i>Équipements disponibles
        </h5>
      </div>
      <div class="card-body">
     

     
        {{-- <div class="row">
  <div class="col-md-6 mb-3">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" role="switch" id="parking_disponible" name="parking_disponible" value="1" {{ (old('parking_disponible', $gare->parking_disponible) == 1) ? 'checked' : '' }}>
      <label class="form-check-label" for="parking_disponible">
        <i class="fas fa-parking me-2"></i>Parking disponible
      </label>
    </div>
  </div>

  <div class="col-md-6 mb-3">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" role="switch" id="wifi_disponible" name="wifi_disponible" value="1" {{ (old('wifi_disponible', $gare->wifi_disponible) == 1) ? 'checked' : '' }}>
      <label class="form-check-label" for="wifi_disponible">
        <i class="fas fa-wifi me-2"></i>Wi-Fi disponible
      </label>
    </div>
  </div>
</div> --}}

<!-- Section Équipements -->
<div class="row mb-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h6 class="card-title mb-0"><i class="fas fa-cogs me-2"></i>Équipements disponibles</h6>
        <p class="text-muted small mb-0">Sélectionnez les équipements disponibles dans cette gare</p>
      </div>
      <div class="card-body">
        <div class="row">
          <!-- Parking -->
          <div class="col-md-6 mb-3">
            <div class="d-flex align-items-center">
              <div class="form-check form-switch me-3">
                <input type="hidden" name="parking_disponible" value="0">
                <input class="form-check-input" type="checkbox" role="switch" id="parking_disponible" name="parking_disponible" value="1" {{ (old('parking_disponible', $gare->parking_disponible) ? 'checked' : '') }}>
                <label class="form-check-label" for="parking_disponible"></label>
              </div>
              <div class="d-flex align-items-center">
                {{-- <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                  <i class="fas fa-parking text-primary fs-4"></i>
                </div> --}}
                <div>
                  <h6 class="mb-0">Parking</h6>
                  <p class="text-muted small mb-0">Espace de stationnement disponible</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Wifi -->
          <div class="col-md-6 mb-3">
            <div class="d-flex align-items-center">
              <div class="form-check form-switch me-3">
                <input type="hidden" name="wifi_disponible" value="0">
                <input class="form-check-input" type="checkbox" role="switch" id="wifi_disponible" name="wifi_disponible" value="1" {{ (old('wifi_disponible', $gare->wifi_disponible) ? 'checked' : '') }}>
                <label class="form-check-label" for="wifi_disponible"></label>
              </div>
              <div class="d-flex align-items-center">
                {{-- <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                  <i class="fas fa-wifi text-primary fs-4"></i>
                </div> --}}
                <div>
                  <h6 class="mb-0">Wi-Fi gratuit</h6>
                  <p class="text-muted small mb-0">Accès Internet sans fil</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  {{-- Téléphone --}}
  <div class="col-md-6 mb-3">
    <label for="telephone" class="form-label">Téléphone (contact général)</label>
    <div class="input-group">
      <span class="input-group-text">
        <img src="https://flagcdn.com/w20/ci.png" alt="Drapeau Côte d'Ivoire" class="me-1" style="width: 20px;">
        +225
      </span>
      <input type="text" name="telephone" id="telephone" class="form-control" 
             placeholder="XX XX XX XX XX" 
             value="{{ old('telephone', $gare->telephone) }}" 
             pattern="[0-9]{2}( [0-9]{2}){4}" 
             onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 32"
             oninput="formatPhoneNumber(this)"
             onpaste="return false;"
             ondrop="return false;"
             autocomplete="off">
    </div>
    <small class="text-muted">Format: XX XX XX XX XX (10 chiffres)</small>
  </div>

  {{-- Email --}}
  <div class="col-md-6 mb-3">
    <label for="email" class="form-label">Email (contact général)</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email',$gare) }}">
  </div>
</div>

{{-- Site web (plein largeur) --}}
<div class="mb-3">
  <label for="site_web" class="form-label">Site web</label>
  <input type="url" name="site_web" id="site_web" class="form-control" value="{{ old('site_web',$gare) }}">
</div>

{{-- Description (plein largeur) --}}
<div class="col-12 mb-3">
  <label for="description" class="form-label">Description</label>
  <div class="input-group">
    <span class="input-group-text"><i class="fas fa-align-left"></i></span>
    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $gare->description) }}</textarea>
  </div>
</div>


  {{-- Section Administrateur de la gare --}}
  <div class="card shadow-sm mt-4 mb-4">
    <div class="card-header bg-white py-3 border-bottom-0">
      <h5 class="card-title mb-0 text-primary">
        <i class="fas fa-user-shield me-2"></i>Administrateur de la gare
      </h5>
    </div>
    <div class="card-header bg-primary text-white">
      <h6 class="mb-0"><i class="fas fa-user-tie"></i>Informations de l'Administrateur de la Gare</h6>
    </div>
    <div class="card-body">
      <div class="row">
        {{-- Nom admin --}}
        <div class="col-md-6 mb-3">
          <label for="admin_nom" class="form-label">Nom de l'administrateur</label>
          <input type="text" name="admin_nom" id="admin_nom" class="form-control" value="{{ old('admin_nom',$gare->infoUser->nom) }}" placeholder="Nom de famille">
        </div>

        {{-- Prénom admin --}}
        <div class="col-md-6 mb-3">
          <label for="admin_prenom" class="form-label">Prénom de l'administrateur</label>
          <input type="text" name="admin_prenom" id="admin_prenom" class="form-control" value="{{ old('admin_prenom' ,$gare->infoUser->prenom) }}" placeholder="Prénom">
        </div>
      </div>

      <div class="row">
        {{-- Email admin --}}
        <div class="col-md-6 mb-3">
          <label for="admin_email" class="form-label">Email de l'administrateur</label>
          <input type="email" name="admin_email" id="admin_email" class="form-control" value="{{ old('admin_email',$gare->infoUser->email) }}" placeholder="admin@exemple.com">
        </div>

        {{-- Téléphone admin --}}
        <div class="col-md-6 mb-3">
          <label for="admin_telephone" class="form-label">Téléphone de l'administrateur</label>
          <div class="input-group">
            <span class="input-group-text">
              <img src="https://flagcdn.com/w20/ci.png" alt="Drapeau Côte d'Ivoire" class="me-1" style="width: 20px;">
              +225
            </span>
            <input type="text" name="admin_telephone" id="admin_telephone" class="form-control" 
                   placeholder="XX XX XX XX XX" 
                   value="{{ old('admin_telephone', $gare->infoUser->telephone ?? '') }}"
                   pattern="[0-9]{2}( [0-9]{2}){4}"
                   onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 32"
                   oninput="formatPhoneNumber(this)"
                   onpaste="return false;"
                   ondrop="return false;"
                   autocomplete="off">
          </div>
          <small class="text-muted">Format: XX XX XX XX XX (10 chiffres)</small>
        </div>
      </div>

      {{-- Section Permissions --}}
     <div class="row">
    @foreach($permissions as $permission)
        <div class="col-md-6 col-lg-4 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       name="admin_permissions[]"
                       value="{{ $permission->name }}"
                       id="perm_{{ $permission->id }}"
                       {{ 
                          // coche si l'ancienne saisie existe
                          (is_array(old('admin_permissions')) && in_array($permission->name, old('admin_permissions'))) 
                          // ou coche si l'utilisateur a déjà cette permission
                          || (!old('admin_permissions') && $user && $user->hasPermissionTo($permission->name)) 
                          ? 'checked' : '' 
                       }}>
                <label class="form-check-label" for="perm_{{ $permission->id }}">
                    <span class="fw-bold">{{ ucfirst(str_replace('-', ' ', $permission->name)) }}</span>
                    <br><small class="text-muted">{{ $permission->name }}</small>
                </label>
            </div>
        </div>
    @endforeach
</div>

@if($permissions->isEmpty())
    <div class="alert alert-info mt-2">
        <i class="fas fa-info-circle me-2"></i>
        Aucune permission disponible. Exécutez d'abord les seeders pour créer les permissions.
    </div>
@endif

<div class="mt-3">
    <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectAllPermissions()">
        <i class="fas fa-check-double me-1"></i>Tout sélectionner
    </button>
    <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="deselectAllPermissions()">
        <i class="fas fa-times me-1"></i>Tout désélectionner
    </button>
</div>

<script>
function selectAllPermissions() {
    const checkboxes = document.querySelectorAll('input[name="admin_permissions[]"]');
    checkboxes.forEach(checkbox => checkbox.checked = true);
}

function deselectAllPermissions() {
    const checkboxes = document.querySelectorAll('input[name="admin_permissions[]"]');
    checkboxes.forEach(checkbox => checkbox.checked = false);
}
</script>


    </div>
  </div>
    <div class="d-flex justify-content-between mt-4 mb-2">
        <a href="{{ route('gares.index.2') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Retour
        </a>
        <button type="submit" class="btn btn-primary px-4">
            <i class="fas fa-save me-1"></i> Enregistrer les modifications
        </button>
    </div>
      </form>

    </div>
  </div>
</div>



        </div> <!-- .row end -->


      </div>
    </div>
    <!-- start: page footer -->

    @include('compagnie.all_element.footer')
  </div>

    <!-- Jquery Page Js -->
  <script src="../assets/js/theme.js"></script>
  <!-- Plugin Js -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  <!-- Vendor Script -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

  {{-- <script>
    function selectAllPermissions() {
      const checkboxes = document.querySelectorAll('input[name="admin_permissions[]"]');
      checkboxes.forEach(checkbox => checkbox.checked = true);
    }

    function deselectAllPermissions() {
      const checkboxes = document.querySelectorAll('input[name="admin_permissions[]"]');
      checkboxes.forEach(checkbox => checkbox.checked = false);
    }
  </script> --}}

</body>

</html>
