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
                        <div class="card" style="border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
                            <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(90deg, var(--primary-color), var(--accent-color)); border-radius: 16px 16px 0 0;">
                                <h6 class="card-title mb-0 text-white">
                                    <i class="fas fa-building-user me-2"></i> Création d'une compagnie et administrateur
                                </h6>

                                <a href="{{ route('compagnies') }}" class="btn btn-light animated-btn">
                                    <i class="bi bi-arrow-left"></i> Retour
                                </a>
                            </div>
                            <div class="card-body p-4">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Veuillez corriger les erreurs ci-dessous.</strong>
                                        <ul class="mb-0 mt-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                
                                <form method="POST" action="{{ route('compagnies.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-4">
                                        <!-- Partie Compagnie -->
                                        <div class="col-lg-6">
                                            <h5 class="mb-3"><i class="fas fa-arrow-right me-2"></i> COMPAGNIE</h5>
                                            <div class="mb-3">
                                                <label for="nom_complet_compagnies" class="form-label">Nom de la compagnie <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nom_complet_compagnies" name="nom_complet_compagnies" required minlength="2" maxlength="100" value="{{ old('nom_complet_compagnies') }}">
                                                @error('nom_complet_compagnies')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="email_compagnies" class="form-label">Email compagnie <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email_compagnies" name="email_compagnies" required value="{{ old('email_compagnies') }}">
                                                @error('email_compagnies')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="telephone_compagnies" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><span aria-hidden="true">🇨🇮 +225</span><span class="visually-hidden">Indicatif téléphonique de la Côte d'Ivoire</span></span>
                                                    <input type="tel" class="form-control" id="telephone_compagnies" name="telephone_compagnies" required pattern="[0-9]{10}" maxlength="10" inputmode="numeric" placeholder="0700000000" oninput="this.value=this.value.replace(/\D/g,'').slice(0,10)" value="{{ old('telephone_compagnies') }}">
                                                </div>
                                                @error('telephone_compagnies')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="adresse_compagnies" class="form-label">Adresse (Facultatif)</label>
                                                <input type="text" class="form-control" id="adresse_compagnies" name="adresse_compagnies" value="{{ old('adresse_compagnies') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="description_compagnies" class="form-label">Description (Facultatif)</label>
                                                <textarea class="form-control" id="description_compagnies" name="description_compagnies" rows="3">{{ old('description_compagnies') }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="villes_id" class="form-label">Ville <span class="text-danger">*</span></label>
                                                <select class="form-select" id="villes_id" name="villes_id" required>
                                                    <option value="">Sélectionner une ville</option>
                                                    @foreach($villes as $ville)
                                                        <option value="{{ $ville->id }}" {{ old('villes_id') == $ville->id ? 'selected' : '' }}>{{ $ville->nom_ville }}</option>
                                                    @endforeach
                                                </select>
                                                @error('villes_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="logo_compagnies" class="form-label">Logo (Formats : JPG, JPEG, PNG, GIF – Taille max : 10 Mo)</label>
                                                <input type="file" class="form-control" id="logo_compagnies" name="logo_compagnies" accept="image/*" onchange="previewLogo(this); updateFileInfo(this);">
                                                <div id="logoPreview" class="mt-2 text-center" style="display: none;">
                                                    <img id="logoPreviewImg" src="#" alt="Aperçu du logo" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                                </div>
                                                <div id="fileInfo" class="small text-muted mt-1"></div>
                                                @error('logo_compagnies')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>

                                             <div class="mt-2">
                                                <h6 class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Localisation de la compagnie</h6>
                                                <div class="input-group mb-2">
                                                    <input type="text" name="adresse" id="searchInput" class="form-control" placeholder="Rechercher une adresse..." autocomplete="off">
                                                    <button type="button" id="locateBtn" class="btn btn-primary">
                                                        <i class="fas fa-location-arrow me-1"></i>
                                                        <span>Me localiser</span>
                                                    </button>
                                                </div>
                                                <div id="statusMessage" class="status-message small mb-2"></div>
                                                <div id="map" style="height: 260px; border-radius: 8px;" aria-label="Carte de localisation"></div>
                                                <input type="hidden" id="latitude" name="latitude">
                                                <input type="hidden" id="longitude" name="longitude">
                                            </div>
                                            
                                        </div>

                                        <!-- Séparateur (desktop) -->
                                        <div class="col-lg-1 d-none d-lg-flex align-items-stretch">
                                            <div style="width:1px; background:#ddd; height:100%"></div>
                                        </div>

                                        <!-- Partie Administrateur -->
                                        <div class="col-lg-5">
                                            <h5 class="mb-3"><i class="fas fa-arrow-right me-2"></i> ADMINISTRATEUR DE LA COMPAGNIE</h5>
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Nom administrateur <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nom" name="nom" required pattern="[A-Za-zÀ-ÿ\s-]+" value="{{ old('nom') }}">
                                                @error('nom')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="prenom" class="form-label">Prénom administrateur <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="prenom" name="prenom" required pattern="[A-Za-zÀ-ÿ\s-]+" value="{{ old('prenom') }}">
                                                @error('prenom')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="telephone" class="form-label">Téléphone administrateur <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="countryCodeBtn">
                                                        <span>🇨🇮</span>
                                                        <span>+225</span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item active" href="#">🇨🇮 Côte d'Ivoire (+225)</a></li>
                                                    </ul>
                                                    <input type="hidden" name="country_code" value="+225">
                                                    <input type="tel" class="form-control" id="telephone" name="telephone" required pattern="[0-9]{10}" maxlength="10" inputmode="numeric" placeholder="0700000000" oninput="this.value=this.value.replace(/\D/g,'').slice(0,10)" value="{{ old('telephone') }}">
                                                </div>
                                                @error('telephone')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                                <div class="form-text">10 chiffres uniquement</div>
                                            </div>
                                            <div class="mb-3">
<label for="email" class="form-label">
    Email administrateur <span class="text-danger">*</span>
    <small class="text-muted d-block">
        C'est à cette adresse que sera envoyé l'email de confirmation.
    </small>
</label>
                                                <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                                                @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>

                                         </div>
                                    </div>
                                    <div class="text-center mt-5">
                                        <button type="submit" id="submitBtn" class="btn btn-primary px-4 py-2">
                                            <span class="btn-loader" id="submitLoader"></span>
                                            <span id="submitText">Créer la compagnie</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div> <!-- .row end -->
            </div>
        </div>

        <!-- Styles CSS inspirés de la page d'accueil -->
        <style>
            :root {
                --primary-color: #ffd000;
                --secondary-color: #000000;
                --accent-color: #ffeb3b;
                --light-color: #ffffff;
                --dark-color: #000000;
                --success-color: #4caf50;
                --warning-color: #ff9800;
                --info-color: #000000;
            }
            
            .card {
                border: none;
                border-radius: 15px;
                transition: all 0.3s ease;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            }
            
            .card:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 25px rgba(255,208,0,0.25);
            }
            
            .form-control, .form-select {
                border-radius: 10px;
                border: 1px solid #e0e0e0;
                padding: 12px 15px;
                transition: all 0.3s ease;
            }
            
            .form-control:focus, .form-select:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(255,208,0,0.15);
            }
            
            .btn-primary {
                background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
                border: none;
                border-radius: 10px;
                padding: 12px 30px;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            
            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(255,208,0,0.35);
            }
            
            .btn-light {
                background: rgba(255,255,255,0.9);
                border: 1px solid rgba(255,208,0,0.3);
                color: var(--primary-color);
                border-radius: 10px;
                padding: 10px 25px;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            
            .btn-light:hover {
                background: rgba(255,208,0,0.2);
                color: var(--primary-color);
                transform: translateY(-2px);
                border-color: var(--primary-color);
            }
            
            .input-group-text {
                border-radius: 10px 0 0 10px;
                border: 1px solid #e0e0e0;
                background: rgba(255,208,0,0.1);
            }
            
            .status-message {
                padding: 8px 12px;
                border-radius: 8px;
                font-size: 0.9rem;
            }
            
            .status-message.info { background: #e3f2fd; color: #1976d2; }
            .status-message.success { background: #e8f5e8; color: #2e7d32; }
            .status-message.error { background: #ffebee; color: #c62828; }
            .status-message.warning { background: #fff3e0; color: #f57c00; }
            
            .btn-loader {
                display: none;
                width: 20px;
                height: 20px;
                border: 3px solid rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                border-top-color: #fff;
                animation: spin 1s ease-in-out infinite;
                margin-right: 8px;
            }
            
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
            
            .animated-btn {
                position: relative;
                overflow: hidden;
                transition: all 0.3s ease;
            }
            
            .animated-btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: left 0.5s;
            }
            
            .animated-btn:hover::before {
                left: 100%;
            }
        </style>

        <script>
            // Logo preview handlers
            function previewLogo(input) {
                const file = input.files && input.files[0];
                const wrap = document.getElementById('logoPreview');
                const img = document.getElementById('logoPreviewImg');
                if (!wrap || !img) return;
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e){
                        img.src = e.target.result;
                        wrap.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    wrap.style.display = 'none';
                    img.src = '#';
                }
            }
            
            function removeLogo() {
                const input = document.getElementById('logo_compagnies');
                const wrap = document.getElementById('logoPreview');
                const img = document.getElementById('logoPreviewImg');
                if (input) input.value = '';
                if (wrap) wrap.style.display = 'none';
                if (img) img.src = '#';
            }
            
            // Fonction pour afficher les informations du fichier sélectionné
            function updateFileInfo(input) {
                const fileInfo = document.getElementById('fileInfo');
                const submitBtn = document.getElementById('submitBtn');
                const maxSize = 10; // Taille maximale en Mo
                const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                
                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const fileSize = (file.size / 1024 / 1024).toFixed(2); // Taille en Mo
                    const fileName = file.name;
                    const fileExtension = fileName.split('.').pop().toLowerCase();
                    const isValidExtension = allowedExtensions.includes(fileExtension);
                    const isValidSize = file.size <= maxSize * 1024 * 1024; // Conversion en octets
                    
                    // Mise en forme du message avec les parties problématiques en rouge
                    let message = `Fichier: ${fileName} `;
                    
                    // Vérification de la taille
                    if (!isValidSize) {
                        message += `<span style="color: red;">(${fileSize} Mo - Taille maximale dépassée)</span>`;
                    } else {
                        message += `(${fileSize} Mo)`;
                    }
                    
                    message += ` - Format: `;
                    
                    // Vérification de l'extension
                    if (!isValidExtension) {
                        message += `<span style="color: red;">${fileExtension.toUpperCase()} (Format non supporté)</span>`;
                    } else {
                        message += fileExtension.toUpperCase();
                    }
                    
                    fileInfo.innerHTML = message;
                    fileInfo.style.display = 'block';
                    
                    // Désactiver le bouton de soumission si le fichier n'est pas valide
                    if (submitBtn) {
                        submitBtn.disabled = !(isValidExtension && isValidSize);
                    }
                } else {
                    fileInfo.textContent = '';
                    fileInfo.style.display = 'none';
                    if (submitBtn) {
                        submitBtn.disabled = false;
                    }
                }
            }
            
            // Gestion du loader sur le bouton de soumission
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form[action="{{ route('compagnies.store') }}"]');
                const submitBtn = document.getElementById('submitBtn');
                const submitLoader = document.getElementById('submitLoader');
                const submitText = document.getElementById('submitText');
                
                if (form) {
                    form.addEventListener('submit', function() {
                        // Désactiver le bouton et afficher le loader
                        submitBtn.disabled = true;
                        submitLoader.style.display = 'inline-block';
                        submitText.textContent = 'Création en cours...';
                    });
                }
            });
            
            // Google Maps pour le formulaire de compagnie
            let map, marker, autocomplete;
            let isMapsLoaded = false;

            function showStatus(message, type = 'info') {
                const statusDiv = document.getElementById('statusMessage');
                if (!statusDiv) return;
                
                statusDiv.innerHTML = message;
                statusDiv.className = `status-message ${type}`;
                
                // Cacher le message après 5 secondes pour les messages d'info
                if (type === 'info' || type === 'success') {
                    setTimeout(() => {
                        statusDiv.innerHTML = '';
                        statusDiv.className = 'status-message';
                    }, 5000);
                }
            }

            window.initMap = function () {
                isMapsLoaded = true;
                const mapEl = document.getElementById('map');
                if (!mapEl) return;
                
                const defaultLoc = { lat: 5.345317, lng: -4.024429 };
                
                // Initialiser la carte
                map = new google.maps.Map(mapEl, {
                    center: defaultLoc,
                    zoom: 13,
                    streetViewControl: false,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                        position: google.maps.ControlPosition.TOP_RIGHT
                    }
                });

                // Créer le marqueur
                marker = new google.maps.Marker({
                    position: defaultLoc,
                    map: map,
                    draggable: true,
                    icon: {
                        url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
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
                marker.addListener('dragend', function() {
                    setLocation(marker.getPosition());
                });

                // Gestion du bouton de localisation
                const locateBtn = document.getElementById('locateBtn');
                if (locateBtn) {
                    locateBtn.addEventListener('click', locateUser);
                }

                // Initialiser les champs cachés
                updateCoords(defaultLoc.lat, defaultLoc.lng);
            };

            function initAutocomplete() {
                if (!isMapsLoaded) return;

                const input = document.getElementById('searchInput');
                if (!input) return;

                autocomplete = new google.maps.places.Autocomplete(input, {
                    types: ['geocode', 'establishment'],
                    componentRestrictions: { country: 'ci' }
                });

                autocomplete.bindTo('bounds', map);
                autocomplete.addListener('place_changed', function() {
                    const place = autocomplete.getPlace();
                    if (!place.geometry || !place.geometry.location) {
                        showStatus("Lieu non trouvé !", "error");
                        return;
                    }
                    setLocation(place.geometry.location);
                });
            }

            function locateUser() {
                const locateBtn = document.getElementById('locateBtn');
                
                if (!navigator.geolocation) {
                    showStatus("La géolocalisation n'est pas supportée par ce navigateur.", "error");
                    return;
                }

                showStatus("Localisation en cours... ", "info");
                
                // Désactiver le bouton pendant la localisation
                locateBtn.disabled = true;
                locateBtn.innerHTML = "<i class='fas fa-spinner fa-spin me-1'></i> Localisation...";

                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        setLocation(userLocation);
                        locateBtn.disabled = false;
                        locateBtn.innerHTML = "<i class='fas fa-location-arrow me-1'></i> Me localiser";
                    },
                    function(error) {
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

                // Mettre à jour la position de la carte et du marqueur
                map.setCenter({ lat, lng });
                map.setZoom(16);
                marker.setPosition({ lat, lng });

                // Mettre à jour les champs cachés
                updateCoords(lat, lng);

                // Mettre à jour l'adresse dans le champ de recherche
                showStatus("Récupération de l'adresse...", "info");
                
                // Utiliser le géocodage de Google Maps
                if (isMapsLoaded) {
                    const geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ location: { lat, lng } }, function(results, status) {
                        if (status === "OK" && results[0]) {
                            const searchInput = document.getElementById('searchInput');
                            if (searchInput) {
                                searchInput.value = results[0].formatted_address;
                                showStatus("Position mise à jour avec succès", "success");
                            }
                        } else {
                            // Si Google échoue, essayer avec Nominatim
                            useNominatim(lat, lng);
                        }
                    });
                } else {
                    // Si Google Maps n'est pas chargé, utiliser Nominatim
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
                        const searchInput = document.getElementById('searchInput');
                        if (searchInput && data.display_name) {
                            searchInput.value = data.display_name;
                            showStatus("Position mise à jour avec succès", "success");
                        }
                    })
                    .catch(error => {
                        console.error("Erreur lors de la récupération de l'adresse:", error);
                        showStatus("Impossible de récupérer l'adresse exacte", "warning");
                    });
            }

            function updateCoords(lat, lng) {
                const latI = document.getElementById('latitude');
                const lngI = document.getElementById('longitude');
                if (latI) latI.value = lat;
                if (lngI) lngI.value = lng;
            }
            
            // Vérifier si l'API Google Maps est chargée
            function checkGoogleMapsLoaded() {
                if (typeof google !== 'undefined' && google.maps) {
                    isGoogleMapsLoaded = true;
                    initMap();
                } else {
                    // Réessayer après 1 seconde
                    setTimeout(checkGoogleMapsLoaded, 1000);
                }
            }
            
            // Démarrer la vérification du chargement de Google Maps au cas où le callback ne fonctionne pas
            window.onload = function() {
                setTimeout(checkGoogleMapsLoaded, 1000);
            };
        </script>
        <!-- Styles personnalisés pour le formulaire -->
        <link href="{{ asset('assets/css/compagnie-form.css') }}" rel="stylesheet">
        
        <!-- start: page footer -->
        @include('betro.all_element.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Script personnalisé pour la gestion du formulaire -->
        <script src="{{ asset('assets/js/compagnie-form.js') }}"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&libraries=places&callback=initMap"
            async defer></script>
        <!-- Ton script JS ici -->