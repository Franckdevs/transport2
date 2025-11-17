@include('betro.all_element.header')

<body class="layout-1" data-luno="theme-black">
    <!-- start: sidebar -->
    @include('betro.all_element.sidebar')
    <!-- start: body area -->
    <div class="wrapper">
        <!-- start: page header -->
        @include('betro.all_element.navbar')
        <!-- start: page toolbar -->
        <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
            @include('betro.all_element.cadre')
        </div>
        <!-- start: page body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <div class="row g-3 row-deck">

                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h6 class="card-title">
                                    <i class="fas fa-building-user me-2"></i> Ajouter une compagnie et administrateur
                                </h6>
                            </div> --}}
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-building-user me-2"></i> Création d'une compagnie et administrateur
                                </h6>

                                <a href="{{ route('compagnies') }}" class="btn btn-light-primary animated-btn">
                                    <i class="bi bi-arrow-left"></i> Retour
                                </a>
                                {{-- <button type="button" class="btn btn-light-primary">Primary</button> --}}
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('compagnies.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <!-- Partie Administrateur -->
                                        <div class="col-md-5">
                                            <h5 class="mb-4">
                                                <i class="bi bi-arrow-right-short me-2"></i>
                                                ADMINISTRATEUR
                                            </h5>
                                            <div class="mb-3">
                                                <label for="nom" class="form-label" aria-required="true">Nom <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nom" name="nom" 
                                                    required 
                                                    pattern="[A-Za-zÀ-ÿ\s-]+" 
                                                    title="Veuillez entrer un nom valide (lettres, espaces et tirets)"
                                                    aria-describedby="nomHelp"
                                                    value="{{ old('nom') }}">
                                                <div id="nomHelp" class="form-text">Uniquement des lettres, espaces et tirets</div>
                                                @error('nom')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="prenom" class="form-label" aria-required="true">Prénom <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="prenom" name="prenom"
                                                    required
                                                    pattern="[A-Za-zÀ-ÿ\s-]+"
                                                    title="Veuillez entrer un prénom valide (lettres, espaces et tirets)"
                                                    aria-describedby="prenomHelp"
                                                    value="{{ old('prenom') }}">
                                                <div id="prenomHelp" class="form-text">Uniquement des lettres, espaces et tirets</div>
                                                @error('prenom')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="telephone" class="form-label" aria-required="true">Téléphone <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="countryCodeBtn">
                                                        <span id="selectedFlag">🇨🇮</span>
                                                        <span id="selectedCode">+225</span>
                                                    </button>
                                                    <ul class="dropdown-menu" id="countryList">
                                                        <li><a class="dropdown-item active" href="#" data-flag="🇨🇮" data-code="+225">🇨🇮 Côte d'Ivoire (+225)</a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="#" data-flag="🇧🇫" data-code="+226">🇧🇫 Burkina Faso (+226)</a></li>
                                                        <li><a class="dropdown-item" href="#" data-flag="🇲🇱" data-code="+223">🇲🇱 Mali (+223)</a></li>
                                                        <li><a class="dropdown-item" href="#" data-flag="🇳🇪" data-code="+227">🇳🇪 Niger (+227)</a></li>
                                                        <li><a class="dropdown-item" href="#" data-flag="🇧🇯" data-code="+229">🇧🇯 Bénin (+229)</a></li>
                                                        <li><a class="dropdown-item" href="#" data-flag="🇹🇬" data-code="+228">🇹🇬 Togo (+228)</a></li>
                                                        <li><a class="dropdown-item" href="#" data-flag="🇫🇷" data-code="+33">🇫🇷 France (+33)</a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="#" data-flag="🌐" data-code="">Autre pays</a></li>
                                                    </ul>
                                                    <input type="hidden" id="countryCode" name="country_code" value="+225">
                                                    <input type="tel" class="form-control" id="telephone" name="telephone"
                                                        required
                                                        pattern="^(0[0-9]{2}[-. ]?[0-9]{2}[-. ]?[0-9]{2}[-. ]?[0-9]{2})$|^(0[0-9]{1}[-. ]?[0-9]{2}[-. ]?[0-9]{2}[-. ]?[0-9]{2})$"
                                                        title="Veuillez entrer un numéro de téléphone ivoirien valide (ex: 01 23 45 67 89 ou 012 34 56 78)"
                                                        aria-describedby="telHelp"
                                                        placeholder="01 23 45 67 89"
                                                        value="{{ old('telephone') }}">
                                                </div>
                                                <div id="telHelp" class="form-text">Format : 01 23 45 67 89 ou 01.23.45.67.89 ou 0123456789</div>
                                                @error('telephone')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label" aria-required="true">Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    required
                                                    pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$"
                                                    title="Veuillez entrer une adresse email valide"
                                                    aria-describedby="emailHelp"
                                                    value="{{ old('email') }}">
                                                <div id="emailHelp" class="form-text">Format : exemple@domaine.com</div>
                                                @error('email')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="mt-2">
                                                <h5 class="mb-4">
                                                    <i class="bi bi-arrow-right-short me-2"></i>
                                                    LOCALISATION DE LA COMPAGNIE <span class="text-danger">*</span>
                                                </h5>

                                                <div class="mb-2">
                                                    <input type="text" name="adresse" id="searchInput"
                                                        class="form-control"
                                                        placeholder="Rechercher une adresse..."
                                                        autocomplete="off"
                                                        aria-label="Rechercher une adresse">
                                                </div>
                                                <div class="mb-2">
                                                    <button type="button" id="locateBtn"
                                                        class="btn btn-outline-primary"
                                                        aria-label="Utiliser ma position actuelle">
                                                        <i class="fas fa-location-arrow me-1" aria-hidden="true"></i> Me localiser
                                                    </button>
                                                </div>
                                                <div id="statusMessage" class="status-message" role="alert" aria-live="polite"></div>
                                                <div id="map"
                                                    style="height: 300px; border-radius: 8px; margin-bottom: 10px;"
                                                    aria-label="Carte de localisation"
                                                    tabindex="0">
                                                </div>
                                                <div id="addressDetails" class="mt-2" style="display:none;" role="region" aria-live="polite"></div>
                                                <div class="row mt-2">
                                                    <div class="col-md-6" style="display:none;">
                                                        <label>Latitude :</label>
                                                        <span id="latValue">-</span>
                                                        <input type="hidden" id="latitude" name="latitude">
                                                    </div>
                                                    <div class="col-md-6" style="display:none;">
                                                        <label>Longitude :</label>
                                                        <span id="lngValue">-</span>
                                                        <input type="hidden" id="longitude" name="longitude">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="mb-3">
                                                <label for="password" class="form-label">Mot de passe</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Confirmer le mot
                                                    de passe</label>
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" required>
                                            </div> --}}
                                            <!-- Section Permissions -->
                                        </div>

                                        <!-- Séparateur -->
                                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                                            <div style="width: 1px; height: 100%; background-color: #ddd;"></div>
                                        </div>

                                        <!-- Partie Compagnie -->
                                        <div class="col-md-5">
                                            <h5 class="mb-4">
                                                <i class="bi bi-arrow-right-short me-2"></i>
                                                COMPAGNIE
                                            </h5>

                                            <div class="mb-3">
                                                <label for="nom_complet_compagnies" class="form-label" aria-required="true">
                                                    Nom de la compagnie <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="nom_complet_compagnies"
                                                    name="nom_complet_compagnies" 
                                                    required
                                                    minlength="2"
                                                    maxlength="100"
                                                    aria-describedby="nomCompagnieHelp"
                                                    value="{{ old('nom_complet_compagnies') }}">
                                                <div id="nomCompagnieHelp" class="form-text">Entre 2 et 100 caractères</div>
                                                @error('nom_complet_compagnies')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {{-- <label for="email_compagnies" class="form-label">Email compagnie
                                                    <span class="text-danger">*</span></label> --}}
                                                <label for="email_compagnies" class="form-label"
                                                    data-bs-toggle="tooltip" data-bs-placement="right"
                                                    title="C'est sur cette adresse que vous recevrez le mail de connexion et vos identifiants ainsi que les notifications."
                                                    aria-describedby="emailCompagnieHelp">
                                                    Email compagnie <i class="bi bi-info-circle" aria-hidden="true"></i>
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="email" class="form-control" id="email_compagnies"
                                                    name="email_compagnies" 
                                                    required
                                                    pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$"
                                                    title="Veuillez entrer une adresse email valide"
                                                    value="{{ old('email_compagnies') }}"
                                                    aria-describedby="emailCompagnieHelp">
                                                <div id="emailCompagnieHelp" class="form-text">Format : contact@votrecompagnie.com</div>
                                                @error('email_compagnies')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- <div class="mb-3">
                                                <label for="telephone_compagnies" class="form-label">Téléphone</label>
                                                <input type="text" class="form-control" id="telephone_compagnies"
                                                    name="telephone_compagnies" required>
                                            </div> --}}

                                            <div class="mb-3">
                                                <label for="telephone_compagnies" class="form-label" aria-required="true">
                                                    Téléphone <span class="text-danger">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <span aria-hidden="true">🇨🇮 +225</span>
                                                        <span class="visually-hidden">Indicatif téléphonique de la Côte d'Ivoire</span>
                                                    </span>
                                                    <input type="tel" class="form-control" id="telephone_compagnies"
                                                        name="telephone_compagnies" 
                                                        placeholder="ex : 0700000000"
                                                        required
                                                        pattern="[0-9]{10}"
                                                        title="Veuillez entrer un numéro de téléphone valide (10 chiffres)"
                                                        aria-describedby="telCompagnieHelp"
                                                        value="{{ old('telephone_compagnies') }}">
                                                </div>
                                                <div id="telCompagnieHelp" class="form-text">Format : 10 chiffres (ex: 0700000000)</div>
                                                @error('telephone_compagnies')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                                <!-- Le script a été déplacé dans un fichier séparé -->
                                            </div>


                                            <div class="mb-3">
                                                <label for="adresse_compagnies" class="form-label">Adresse
                                                    (Facultatif)</label>
                                                <input type="text" class="form-control" id="adresse_compagnies"
                                                    name="adresse_compagnies" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description_compagnies" class="form-label">Description
                                                    (Facultatif)</label>
                                                <textarea class="form-control" id="description_compagnies"
                                                    name="description_compagnies" rows="3"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="villes_id" class="form-label">Ville <span class="text-danger">*</span></label>
                                                <select class="form-select" id="villes_id" name="villes_id" required
                                                        aria-label="Sélectionner une ville">
                                                    <option value="">Sélectionner une ville</option>
                                                    @foreach($villes as $ville)
                                                        <option value="{{ $ville->id }}" {{ old('villes_id') == $ville->id ? 'selected' : '' }}>
                                                            {{ $ville->nom_ville }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('villes_id')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="logo_compagnies" class="form-label">Logo Taille maximale : 10MB. Formats acceptés : JPG, PNG, GIF</label>
                                                <input type="file" class="form-control mb-2" id="logo_compagnies"
                                                    name="logo_compagnies" accept="image/*" 
                                                    onchange="previewLogo(this)">
                                                <div id="logoPreview" class="mt-2 text-center" style="display: none;">
                                                    <img id="logoPreviewImg" src="#" alt="Aperçu du logo" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeLogo()">
                                                        <i class="fas fa-trash-alt me-1"></i> Supprimer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="mb-4">
                                        <h5>
                                            <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                                            Localisation de la compagnie
                                        </h5>
                                        <div class="mb-2">
                                            <input type="text" name="adresse" id="searchInput" class="form-control"
                                                placeholder="Rechercher une adresse ou un lieu..." autocomplete="off">
                                        </div>
                                        <div class="mb-2">
                                            <button type="button" id="locateBtn" class="btn btn-outline-primary">
                                                <i class="fas fa-location-arrow me-1"></i> Me localiser
                                            </button>
                                        </div>
                                        <div id="statusMessage" class="status-message"></div>
                                        <div id="map" style="height: 300px; border-radius: 8px; margin-bottom: 10px;">
                                        </div>
                                        <div id="addressDetails" class="mt-2" style="display:none;"></div>
                                        <div class="row mt-2">
                                            <div class="col-md-6" style="display:none;">
                                                <label>Latitude :</label>
                                                <span id="latValue">-</span>
                                                <input type="hidden" id="latitude" name="latitude">
                                            </div>
                                            <div class="col-md-6" style="display:none;">
                                                <label>Longitude :</label>
                                                <span id="lngValue">-</span>
                                                <input type="hidden" id="longitude" name="longitude">
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="mt-4 text-center">
                                        <button type="submit" id="submitButton" class="btn btn-success px-3 py-3 animated-btn">
                                            <span id="submitText">
                                                <i class="fas fa-check-circle me-2"></i>
                                                Créer l'administrateur et la compagnie
                                            </span>
                                            <span id="submitSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                                        </button>
                                        
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const form = document.querySelector('form');
                                                const submitButton = document.getElementById('submitButton');
                                                const submitText = document.getElementById('submitText');
                                                const submitSpinner = document.getElementById('submitSpinner');
                                                
                                                if (form) {
                                                    form.addEventListener('submit', function() {
                                                        // Désactiver le bouton
                                                        submitButton.disabled = true;
                                                        // Masquer le texte et afficher le spinner
                                                        submitText.classList.add('d-none');
                                                        submitSpinner.classList.remove('d-none');
                                                        // Ajouter une classe pour le style désactivé
                                                        submitButton.classList.add('pe-none');
                                                    });
                                                }
                                            });
                                        </script>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div> <!-- .row end -->
            </div>
        </div>

        <script>
            let map, marker, autocomplete;
            let isGoogleMapsLoaded = false;

            // Attendre que Google Maps soit chargé
            window.initMap = function () {
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
                marker.addListener("dragend", function () {
                    setLocation(marker.getPosition());
                });

                document.getElementById("locateBtn").addEventListener("click", function () {
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

                showStatus("Localisation en cours... ", "info");

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
                        switch (error.code) {
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

                map.setCenter({ lat, lng });
                map.setZoom(16);
                marker.setPosition({ lat, lng });

                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;
                updateCoordinates(lat, lng);

                showStatus("Récupération de l'adresse... <span class='loading'></span>", "info");

                // Essayer d'abord avec Google Geocoding
                if (isGoogleMapsLoaded) {
                    const geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ location: { lat, lng } }, function (results, status) {
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
        <!-- Styles personnalisés pour le formulaire -->
        <link href="{{ asset('assets/css/compagnie-form.css') }}" rel="stylesheet">
        
        <!-- start: page footer -->
        @include('betro.all_element.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Script personnalisé pour la gestion du formulaire -->
        <script src="{{ asset('assets/js/compagnie-form.js') }}"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&libraries=places"
            async defer></script>
        <!-- Ton script JS ici -->