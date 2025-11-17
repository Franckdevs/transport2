<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - BETRO</title>
    <link rel="icon" href="{{ asset('log.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #ffd000;
            --secondary-color: #000000;
            --accent-color: #ffeb3b;
            --light-color: #ffffff;
            --dark-color: #000000;
            --text-color: #333333;
            --border-color: #e0e0e0;
            --error-color: #e74c3c;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .card-register {
            width: 100%;
            max-width: 1200px;
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }
        .card-register .card-header {
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            color: #000;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            padding: 1.25rem 1.5rem;
            text-align: center;
            font-weight: 700;
        }
        .card-register .card-body { padding: 2rem; }
        .form-label { font-weight: 500; }
        .form-control {
            height: 48px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
        }
        .form-control:focus {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 0.25rem rgba(255,208,0,0.25) !important;
        }
        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: #000 !important;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-weight: 600;
        }
        .btn-primary:hover { background-color: #e6c000 !important; border-color: #e6c000 !important; }
        .btn-outline-dark {
            background-color: var(--light-color);
            color: #000;
            border: 1px solid #000;
            border-radius: 10px;
        }
        .btn-outline-dark:hover { background-color: #f2f2f2; }
        .back-to-home { text-decoration: none; }
        .back-to-home i { color: #000; }
        .text-primary, .text-info { color: #ffffff !important; }
        .bg-primary, .bg-info { background-color: #ffffff !important; color: #000 !important; }
        .small a { color: #000; text-decoration: none; }
        .small a:hover { text-decoration: underline; }
        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            margin-bottom: .5rem;
        }
        .brand .dot {
            width: 10px; height: 10px; border-radius: 50%; background: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="card card-register">
        <div class="card-header">
            <div class="brand">
                <span class="dot"></span>
                <span>BETRO</span>
                <span class="dot"></span>
            </div>
            <div>Créer un compte</div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Partie Administrateur -->
                    <div class="col-md-5">
                        <h5 class="mb-4">
                            <i class="bi bi-arrow-right-short me-2"></i>
                            ADMINISTRATEUR
                        </h5>
                        <div class="mb-3">
                            <label for="nom" class="form-label" aria-required="true">Nom <span class="text-danger">*</span></label>
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
                            <label for="prenom" class="form-label" aria-required="true">Prénom <span class="text-danger">*</span></label>
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
                                </ul>
                                <input type="hidden" id="countryCode" name="country_code" value="+225">
                                <input type="tel" class="form-control numeric-10" id="telephone" name="telephone"
                                    required
                                    pattern="[0-9]{10}"
                                    maxlength="10"
                                    inputmode="numeric"
                                    title="Veuillez entrer exactement 10 chiffres"
                                    aria-describedby="telHelp"
                                    placeholder="0700000000"
                                    oninput="this.value=this.value.replace(/\D/g,'').slice(0,10)"
                                    value="{{ old('telephone') }}">
                            </div>
                            <div id="telHelp" class="form-text">Format : 01 23 45 67 89 ou 01.23.45.67.89 ou 0123456789</div>
                            @error('telephone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label" aria-required="true">Email <span class="text-danger">*</span></label>
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

                        <div class="mb-3">
                            <label for="telephone_compagnies" class="form-label" aria-required="true">
                                Téléphone <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <span aria-hidden="true">🇨🇮 +225</span>
                                    <span class="visually-hidden">Indicatif téléphonique de la Côte d'Ivoire</span>
                                </span>
                                <input type="tel" class="form-control numeric-10" id="telephone_compagnies"
                                    name="telephone_compagnies" 
                                    placeholder="ex : 0700000000"
                                    required
                                    pattern="[0-9]{10}"
                                    maxlength="10"
                                    inputmode="numeric"
                                    title="Veuillez entrer un numéro de téléphone valide (10 chiffres)"
                                    aria-describedby="telCompagnieHelp"
                                    oninput="this.value=this.value.replace(/\D/g,'').slice(0,10)"
                                    value="{{ old('telephone_compagnies') }}">
                            </div>
                            <div id="telCompagnieHelp" class="form-text">Format : 10 chiffres (ex: 0700000000)</div>
                            @error('telephone_compagnies')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
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
                                    submitButton.disabled = true;
                                    submitText.classList.add('d-none');
                                    submitSpinner.classList.remove('d-none');
                                    submitButton.classList.add('pe-none');
                                });
                            }
                        });
                    </script>
                </div>
            </form>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <a href="{{ route('login') }}" class="btn btn-outline-dark">
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    Se connecter
                </a>
                <a href="{{ url('/') }}" class="back-to-home">
                    <i class="bi bi-arrow-left"></i> Retour à l'accueil
                </a>
            </div>
            <p class="small text-muted text-center mt-3 mb-0">En vous inscrivant, vous acceptez nos conditions d'utilisation.</p>
        </div>
    </div>

    <script>
        function previewLogo(input) {
            const file = input.files && input.files[0];
            const previewWrap = document.getElementById('logoPreview');
            const img = document.getElementById('logoPreviewImg');
            if (!previewWrap || !img) return;
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    img.src = e.target.result;
                    previewWrap.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewWrap.style.display = 'none';
                img.src = '#';
            }
        }
        function removeLogo() {
            const input = document.getElementById('logo_compagnies');
            const previewWrap = document.getElementById('logoPreview');
            const img = document.getElementById('logoPreviewImg');
            if (input) input.value = '';
            if (previewWrap) previewWrap.style.display = 'none';
            if (img) img.src = '#';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let map, marker, autocomplete;
        let isGoogleMapsLoaded = false;
        window.initMap = function () {
            isGoogleMapsLoaded = true;
            initializeMap();
        };
        function initializeMap() {
            const defaultLocation = { lat: 5.345317, lng: -4.024429 };
            const mapEl = document.getElementById("map");
            if (!mapEl) return;
            map = new google.maps.Map(mapEl, {
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
            const circle = new google.maps.Circle({
                map: map,
                radius: 100,
                fillColor: '#AA0000',
                fillOpacity: 0.2,
                strokeColor: '#AA0000',
                strokeOpacity: 0.8,
                strokeWeight: 1
            });
            circle.bindTo('center', marker, 'position');
            initAutocomplete();
            marker.addListener("dragend", function () {
                setLocation(marker.getPosition());
            });
            const locateBtn = document.getElementById("locateBtn");
            if (locateBtn) {
                locateBtn.addEventListener("click", function () {
                    locateUser();
                });
            }
            updateCoordinates(defaultLocation.lat, defaultLocation.lng);
        }
        function initAutocomplete() {
            if (!isGoogleMapsLoaded) return;
            const input = document.getElementById("searchInput");
            if (!input) return;
            autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['geocode', 'establishment'],
                componentRestrictions: { country: 'ci' }
            });
            autocomplete.bindTo("bounds", map);
            autocomplete.addListener("place_changed", function () {
                const place = autocomplete.getPlace();
                if (!place.geometry || !place.geometry.location) return;
                setLocation(place.geometry.location);
            });
        }
        function locateUser() {
            if (!navigator.geolocation) return;
            const locateBtn = document.getElementById("locateBtn");
            if (locateBtn) {
                locateBtn.disabled = true;
                locateBtn.innerHTML = "<i class='fas fa-spinner fa-spin me-1'></i> Localisation...";
            }
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    setLocation(userLocation);
                    if (locateBtn) {
                        locateBtn.disabled = false;
                        locateBtn.innerHTML = "<i class='fas fa-location-arrow me-1'></i> Me localiser";
                    }
                },
                function () {
                    if (locateBtn) {
                        locateBtn.disabled = false;
                        locateBtn.innerHTML = "<i class='fas fa-location-arrow me-1'></i> Me localiser";
                    }
                },
                { timeout: 15000, enableHighAccuracy: true, maximumAge: 60000 }
            );
        }
        function setLocation(latlng) {
            if (!map || !marker) return;
            map.setCenter(latlng);
            marker.setPosition(latlng);
            updateCoordinates(latlng.lat ? latlng.lat() : latlng.lat, latlng.lng ? latlng.lng() : latlng.lng);
        }
        function updateCoordinates(lat, lng) {
            const latInput = document.getElementById("latitude");
            const lngInput = document.getElementById("longitude");
            const latSpan = document.getElementById("latValue");
            const lngSpan = document.getElementById("lngValue");
            if (latInput) latInput.value = lat;
            if (lngInput) lngInput.value = lng;
            if (latSpan) latSpan.textContent = lat.toFixed(6);
            if (lngSpan) lngSpan.textContent = lng.toFixed(6);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&libraries=places&callback=initMap" async defer></script>
</body>
</html>
