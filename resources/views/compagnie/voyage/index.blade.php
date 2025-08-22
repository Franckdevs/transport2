    @include('compagnie.all_element.header')

    <body class="layout-1" data-luno="theme-blue">

    @include('compagnie.all_element.sidebar')

    <div class="wrapper">

        @include('compagnie.all_element.navbar')

        @include('compagnie.all_element.cadre')

        <!-- start: page title -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-3">Gestion des Voyages et Itinéraires</h2>
                </div>
            </div>
        </div>

        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        <div class="container-fluid">

            <div class="card mb-3 shadow-sm border-0">
            <div class="card-header bg-gradient-primary text-white">
                <h5 class="mb-0"><i class="fas fa-route me-2"></i>Configuration de l'Itinéraire</h5>
            </div>
            <div class="card-body p-4">
                {{-- {{ Auth::user()->id}} --}}
                <!-- Sélection du bus -->
                <div class="mb-4">
                    <label for="busSelect" class="form-label fw-bold">
                        <i class="fas fa-bus text-primary me-2"></i>Sélectionner un bus
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-bus text-muted"></i>
                        </span>
                        <select id="busSelect" class="form-select border-start-0 shadow-sm">
                            <option value="">🚌 Choisir un bus...</option>
                            @foreach($listebus as $bus)
                                <option value="{{ $bus->id }}">{{ $bus->nom_bus ?? 'Bus ' . $bus->id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Configuration des points -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="start" class="form-label fw-bold">
                            <i class="fas fa-map-marker-alt text-success me-2"></i>Point de départ
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-success text-white">
                                <i class="fas fa-play"></i>
                            </span>
                            <input id="start" type="text" placeholder="📍 Entrez le point de départ..." 
                                   class="form-control border-start-0 shadow-sm">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="end" class="form-label fw-bold">
                            <i class="fas fa-flag-checkered text-danger me-2"></i>Point d'arrivée
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-danger text-white">
                                <i class="fas fa-stop"></i>
                            </span>
                            <input id="end" type="text" placeholder="🏁 Entrez le point d'arrivée..." 
                                   class="form-control border-start-0 shadow-sm">
                        </div>
                    </div>
                </div>

                <!-- Arrêts intermédiaires -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <label class="form-label fw-bold mb-0">
                            <i class="fas fa-map-signs text-warning me-2"></i>Arrêts intermédiaires
                        </label>
                        <button id="addStop" type="button" class="btn btn-outline-warning btn-sm shadow-sm">
                            <i class="fas fa-plus me-1"></i>Ajouter un arrêt
                        </button>
                    </div>
                    <div id="stops-container" class="border rounded p-3 bg-light min-height-60">
                        <div class="text-center text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Aucun arrêt ajouté. Cliquez sur "Ajouter un arrêt" pour en créer.
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex gap-3 flex-wrap">
                    <button id="routeBtn" class="btn btn-primary shadow-sm flex-fill">
                        <i class="fas fa-route me-2"></i>Calculer l'itinéraire
                    </button>
                    <button id="saveRouteBtn" class="btn btn-success shadow-sm flex-fill">
                        <i class="fas fa-save me-2"></i>Enregistrer l'itinéraire
                    </button>
                </div>

                {{-- <div class="mb-3">
                <input id="start" type="text" placeholder="Point de départ" class="form-control mb-2">
                <input id="end" type="text" placeholder="Point d'arrivée" class="form-control mb-2">
                <button id="routeBtn" class="btn btn-primary">Afficher l'itinéraire</button>
                </div> --}}
                <!-- Informations de l'itinéraire -->
                <div id="route-info" class="mt-4 p-3 bg-info bg-opacity-10 border border-info rounded shadow-sm" style="display: none;">
                    <h6 class="text-info mb-2">
                        <i class="fas fa-info-circle me-2"></i>Informations de l'itinéraire
                    </h6>
                    <div id="route-details"></div>
                </div>

                <!-- Carte interactive -->
                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 fw-bold">
                            <i class="fas fa-map text-primary me-2"></i>Carte Interactive
                        </h6>
                        <small class="text-muted">
                            <i class="fas fa-mouse-pointer me-1"></i>Survolez les marqueurs pour plus d'infos
                        </small>
                    </div>
                    <div id="map" class="border rounded shadow-sm" style="width: 100%; height: 500px; border-radius: 10px !important;"></div>
                </div>
                <!-- Zone d'affichage des infos -->
            </div>
            </div>

        </div>
        </div>

        @include('compagnie.all_element.footer')
    </div>


    <script>
        document.getElementById("saveRouteBtn").addEventListener("click", () => {
            saveItinerary();
        });

    </script>

    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <script>
    let map, directionsService, directionsRenderer;
    let startMarker = null, endMarker = null;
    let startPlace, endPlace;
    let stopMarkers = []; // marqueurs des arrêts
    let stopPlaces = [];  // lieux des arrêts
    let stopCounter = 0;  // compteur pour les IDs uniques
    let totalDistance = 0, totalDuration = 0; // variables globales pour la sauvegarde
    let infoWindows = []; // fenêtres d'information pour les marqueurs

    function initMap() {
    const defaultLocation = { lat: 5.354, lng: -4.008 };

    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: defaultLocation,
    });

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({ draggable: true, suppressMarkers: true });
    directionsRenderer.setMap(map);

    const startInput = document.getElementById("start");
    const endInput = document.getElementById("end");

    const autocompleteStart = new google.maps.places.Autocomplete(startInput);
    const autocompleteEnd = new google.maps.places.Autocomplete(endInput);

    autocompleteStart.addListener('place_changed', () => { startPlace = autocompleteStart.getPlace(); });
    autocompleteEnd.addListener('place_changed', () => { endPlace = autocompleteEnd.getPlace(); });

    document.getElementById("addStop").addEventListener("click", () => {
        addNewStop();
    });

    document.getElementById("routeBtn").addEventListener("click", () => {
        if (!startPlace || !endPlace) { 
            showNotification("Veuillez sélectionner un lieu de départ et d'arrivée !", "error");
            return; 
        }
        calculateAndDisplayRoute();
    });
    }

    // Fonction pour ajouter un nouvel arrêt
    function addNewStop() {
        const stopContainer = document.getElementById("stops-container");
        const stopId = `stop-${stopCounter++}`;
        
        // Créer un conteneur pour l'arrêt avec input et bouton supprimer
        const stopWrapper = document.createElement("div");
        stopWrapper.className = "d-flex mb-2 stop-wrapper";
        stopWrapper.dataset.stopId = stopId;
        
        const stopInput = document.createElement("input");
        stopInput.type = "text";
        stopInput.placeholder = "Ajouter un arrêt";
        stopInput.className = "form-control me-2 stop-input";
        stopInput.id = `input-${stopId}`;
        
        // Bouton supprimer
        const removeBtn = document.createElement("button");
        removeBtn.type = "button";
        removeBtn.className = "btn btn-outline-danger btn-sm";
        removeBtn.innerHTML = '<i class="fa fa-trash"></i>';
        removeBtn.title = "Supprimer cet arrêt";
        
        stopWrapper.appendChild(stopInput);
        stopWrapper.appendChild(removeBtn);
        stopContainer.appendChild(stopWrapper);

        // Initialiser l'autocomplétion
        const autocompleteStop = new google.maps.places.Autocomplete(stopInput);
        
        // Gérer la sélection d'un lieu
        autocompleteStop.addListener('place_changed', () => {
            const place = autocompleteStop.getPlace();
            if (place && place.geometry) {
                // Créer un objet arrêt avec toutes les infos nécessaires
                const stopData = {
                    id: stopId,
                    place: place,
                    marker: null,
                    input: stopInput,
                    wrapper: stopWrapper
                };
                
                // Créer le marqueur
                const label = String.fromCharCode(67 + stopPlaces.length);
                const marker = new google.maps.Marker({
                    map,
                    position: place.geometry.location,
                    draggable: true,
                    label: { text: label, color: "white", fontWeight: "bold" },
                    title: "Arrêt " + label
                });

                // Créer une infoWindow pour ce marqueur
                const infoWindow = new google.maps.InfoWindow({
                    content: `<div class="p-2"><strong>Arrêt ${label}</strong><br><small>Calcul en cours...</small></div>`
                });

                // Ajouter les événements hover
                marker.addListener('mouseover', () => {
                    closeAllInfoWindows();
                    infoWindow.open(map, marker);
                });

                marker.addListener('mouseout', () => {
                    infoWindow.close();
                });

                // Stocker l'infoWindow
                infoWindows.push(infoWindow);
                stopData.infoWindow = infoWindow;

                // Ajouter listener pour le drag avec mise à jour des coordonnées
                marker.addListener("dragend", () => {
                    const newPosition = marker.getPosition();
                    // Mettre à jour les coordonnées de l'arrêt dans stopPlaces
                    updateStopPosition(stopData, newPosition);
                    
                    if (startPlace && endPlace) {
                        calculateAndDisplayRoute();
                    }
                });

                stopData.marker = marker;
                stopPlaces.push(stopData);
                stopMarkers.push(marker);
                
                // Recalculer l'itinéraire si on a départ et arrivée
                if (startPlace && endPlace) {
                    calculateAndDisplayRoute();
                }
            }
        });
        
        // Gérer la suppression
        removeBtn.addEventListener("click", () => {
            removeStop(stopId);
        });
    }
    
    // Fonction améliorée pour supprimer un arrêt
    function removeStop(stopId) {
        // Trouver l'arrêt dans le tableau
        const stopIndex = stopPlaces.findIndex(stop => stop.id === stopId);
        if (stopIndex === -1) return;
        
        const stopData = stopPlaces[stopIndex];
        
        // Supprimer le marqueur de la carte
        if (stopData.marker) {
            stopData.marker.setMap(null);
            const markerIndex = stopMarkers.indexOf(stopData.marker);
            if (markerIndex > -1) {
                stopMarkers.splice(markerIndex, 1);
            }
        }
        
        // Supprimer l'élément DOM
        if (stopData.wrapper) {
            stopData.wrapper.remove();
        }
        
        // Supprimer des tableaux
        stopPlaces.splice(stopIndex, 1);
        
        // Mettre à jour les labels des marqueurs restants
        updateMarkerLabels();
        
        // Recalculer l'itinéraire
        if (startPlace && endPlace) {
            calculateAndDisplayRoute();
        }
    }
    
    // Fonction pour mettre à jour les labels des marqueurs
    function updateMarkerLabels() {
        stopMarkers.forEach((marker, index) => {
            const label = String.fromCharCode(67 + index);
            marker.setLabel({ text: label, color: "white", fontWeight: "bold" });
            marker.setTitle("Arrêt " + label);
        });
    }
    
    // Fonction pour réinitialiser tous les arrêts
    function clearAllStops() {
        // Supprimer tous les marqueurs
        stopMarkers.forEach(marker => marker.setMap(null));
        stopMarkers = [];
        stopPlaces = [];
        
        // Vider le conteneur DOM
        document.getElementById("stops-container").innerHTML = "";
        
        // Réinitialiser le compteur
        stopCounter = 0;
    }

    // Fonction améliorée pour calculer et afficher l'itinéraire
    function calculateAndDisplayRoute() {
        if (!startPlace || !endPlace) {
            console.log("Points de départ ou d'arrivée manquants");
            return;
        }

        // Préparer les waypoints à partir des arrêts
        const waypoints = stopPlaces
            .filter(stopData => stopData && stopData.place && stopData.place.geometry)
            .map(stopData => ({ 
                location: stopData.place.geometry.location, 
                stopover: true 
            }));

        const request = {
            origin: startPlace.geometry.location,
            destination: endPlace.geometry.location,
            waypoints: waypoints,
            travelMode: google.maps.TravelMode.DRIVING,
        };

        directionsService.route(request, (response, status) => {
            if (status === "OK") {
                directionsRenderer.setDirections(response);

                // Créer ou mettre à jour les marqueurs de départ et arrivée
                updateStartEndMarkers(response);

                // Calculer et afficher distance et durée totales
                updateRouteInfo(response);
                
                // Mettre à jour les infobulles avec les distances cumulatives
                updateMarkersInfoWindows(response);
            } else {
                console.error("Erreur lors du calcul de l'itinéraire:", status);
                showNotification("Erreur lors du calcul de l'itinéraire : " + status, "error");
            }
        });
    }

    // Fonction pour mettre à jour les marqueurs de départ et arrivée
    function updateStartEndMarkers(response) {
        const route = response.routes[0];
        const startLocation = route.legs[0].start_location;
        const endLocation = route.legs[route.legs.length - 1].end_location;

        if (!startMarker) {
            startMarker = new google.maps.Marker({
                map,
                position: startLocation,
                draggable: true,
                label: { text: "A", color: "white", fontWeight: "bold" },
                title: "Départ",
                icon: {
                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                            <circle cx="16" cy="16" r="12" fill="#28a745" stroke="white" stroke-width="2"/>
                            <text x="16" y="21" text-anchor="middle" fill="white" font-size="14" font-weight="bold">A</text>
                        </svg>
                    `),
                    scaledSize: new google.maps.Size(32, 32)
                }
            });

            // Créer infoWindow pour le point de départ
            const startInfoWindow = new google.maps.InfoWindow({
                content: `<div class="p-2"><strong>Point de Départ</strong><br><small>0 km - 0 min</small></div>`
            });

            startMarker.addListener('mouseover', () => {
                closeAllInfoWindows();
                startInfoWindow.open(map, startMarker);
            });

            startMarker.addListener('mouseout', () => {
                startInfoWindow.close();
            });

            infoWindows.push(startInfoWindow);
            
            // Ajouter listener pour le drag du marqueur de départ
            startMarker.addListener("dragend", () => {
                const newPosition = startMarker.getPosition();
                // Mettre à jour startPlace avec la nouvelle position (sans géocodage)
                updateStartPlaceFromPosition(newPosition);
                if (endPlace) {
                    calculateAndDisplayRoute();
                }
            });
        } else {
            startMarker.setPosition(startLocation);
        }

        if (!endMarker) {
            endMarker = new google.maps.Marker({
                map,
                position: endLocation,
                draggable: true,
                label: { text: "B", color: "white", fontWeight: "bold" },
                title: "Arrivée",
                icon: {
                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                            <circle cx="16" cy="16" r="12" fill="#dc3545" stroke="white" stroke-width="2"/>
                            <text x="16" y="21" text-anchor="middle" fill="white" font-size="14" font-weight="bold">B</text>
                        </svg>
                    `),
                    scaledSize: new google.maps.Size(32, 32)
                }
            });

            // Créer infoWindow pour le point d'arrivée
            const endInfoWindow = new google.maps.InfoWindow({
                content: `<div class="p-2"><strong>Point d'Arrivée</strong><br><small>Calcul en cours...</small></div>`
            });

            endMarker.addListener('mouseover', () => {
                closeAllInfoWindows();
                endInfoWindow.open(map, endMarker);
            });

            endMarker.addListener('mouseout', () => {
                endInfoWindow.close();
            });

            infoWindows.push(endInfoWindow);
            
            // Ajouter listener pour le drag du marqueur d'arrivée
            endMarker.addListener("dragend", () => {
                const newPosition = endMarker.getPosition();
                // Mettre à jour endPlace avec la nouvelle position (sans géocodage)
                updateEndPlaceFromPosition(newPosition);
                if (startPlace) {
                    calculateAndDisplayRoute();
                }
            });
        } else {
            endMarker.setPosition(endLocation);
        }
    }

    // Fonction pour mettre à jour les informations de route
    function updateRouteInfo(response) {
        const legs = response.routes[0].legs;
        totalDistance = 0;
        totalDuration = 0;
        
        legs.forEach(leg => {
            totalDistance += leg.distance.value;
            totalDuration += leg.duration.value;
        });

        const distanceKm = (totalDistance / 1000).toFixed(1);
        const durationMin = Math.floor(totalDuration / 60);
        const durationHours = Math.floor(durationMin / 60);
        const remainingMin = durationMin % 60;

        let durationText = "";
        if (durationHours > 0) {
            durationText = `${durationHours}h ${remainingMin}min`;
        } else {
            durationText = `${durationMin}min`;
        }

        document.getElementById("route-info").innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <span><i class="fa fa-route me-2"></i>Distance : ${distanceKm} km</span>
                <span><i class="fa fa-clock me-2"></i>Temps estimé : ${durationText}</span>
                <span><i class="fa fa-map-marker-alt me-2"></i>Arrêts : ${stopPlaces.length}</span>
            </div>
        `;
    }

    // Fonction pour afficher des notifications
    function showNotification(message, type = "info") {
        const alertClass = type === "error" ? "alert-danger" : 
                          type === "success" ? "alert-success" : "alert-info";
        
        const notification = document.createElement("div");
        notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
        notification.style.cssText = "top: 20px; right: 20px; z-index: 9999; min-width: 300px;";
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto-remove après 5 secondes
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }

    // Fonction améliorée pour sauvegarder l'itinéraire
    function saveItinerary() {
        // Validation des données
        const busId = document.getElementById("busSelect").value;
        if (!busId) {
            showNotification("Veuillez sélectionner un bus !", "error");
            return;
        }

        if (!startPlace || !endPlace) {
            showNotification("Veuillez sélectionner un lieu de départ et d'arrivée !", "error");
            return;
        }

        if (totalDistance === 0 || totalDuration === 0) {
            showNotification("Veuillez d'abord calculer l'itinéraire !", "error");
            return;
        }

        // Préparer les données des arrêts
        const arretsData = stopPlaces.map(stopData => ({
            adresse: stopData.place.formatted_address,
            lat: stopData.place.geometry.location.lat(),
            lng: stopData.place.geometry.location.lng()
        }));

        // Préparer les données à envoyer
        const data = {
            bus_id: busId,
            start_address: startPlace.formatted_address,
            end_address: endPlace.formatted_address,
            distance: totalDistance,
            duration: totalDuration,
            arrets: arretsData
        };

        // Désactiver le bouton pendant la sauvegarde
        const saveBtn = document.getElementById("saveRouteBtn");
        const originalText = saveBtn.innerHTML;
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Enregistrement...';

        // Envoi via fetch à Laravel
        fetch("{{ route('itineraires.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(resp => {
            if (resp.success) {
                showNotification("Itinéraire enregistré avec succès !", "success");
                resetForm();
            } else {
                showNotification("Erreur lors de l'enregistrement : " + (resp.message || "Erreur inconnue"), "error");
            }
        })
        .catch(err => {
            console.error("Erreur lors de la sauvegarde:", err);
            showNotification("Une erreur est survenue lors de l'enregistrement.", "error");
        })
        .finally(() => {
            // Réactiver le bouton
            saveBtn.disabled = false;
            saveBtn.innerHTML = originalText;
        });
    }

    // Fonction pour réinitialiser le formulaire
    function resetForm() {
        // Réinitialiser les sélections
        document.getElementById("busSelect").value = "";
        document.getElementById("start").value = "";
        document.getElementById("end").value = "";
        document.getElementById("route-info").innerHTML = "";

        // Réinitialiser les variables
        startPlace = null;
        endPlace = null;
        totalDistance = 0;
        totalDuration = 0;

        // Supprimer tous les marqueurs
        if (startMarker) {
            startMarker.setMap(null);
            startMarker = null;
        }
        if (endMarker) {
            endMarker.setMap(null);
            endMarker = null;
        }

        // Nettoyer les arrêts
        clearAllStops();

        // Effacer l'itinéraire
        directionsRenderer.setDirections({ routes: [] });
    }

    // Fonction pour mettre à jour le lieu de départ sans géocodage
    function updateStartPlaceFromPosition(position) {
        const lat = position.lat();
        const lng = position.lng();
        
        // Créer un objet place simplifié avec les coordonnées
        startPlace = {
            formatted_address: `Départ (${lat.toFixed(6)}, ${lng.toFixed(6)})`,
            geometry: {
                location: position
            },
            place_id: `custom_start_${Date.now()}`,
            name: `Point de départ`
        };
        
        // Mettre à jour le champ de saisie avec les coordonnées
        document.getElementById("start").value = startPlace.formatted_address;
        
        // Afficher une notification
        showNotification('Point de départ mis à jour', 'info');
    }

    // Fonction pour mettre à jour le lieu d'arrivée sans géocodage
    function updateEndPlaceFromPosition(position) {
        const lat = position.lat();
        const lng = position.lng();
        
        // Créer un objet place simplifié avec les coordonnées
        endPlace = {
            formatted_address: `Arrivée (${lat.toFixed(6)}, ${lng.toFixed(6)})`,
            geometry: {
                location: position
            },
            place_id: `custom_end_${Date.now()}`,
            name: `Point d'arrivée`
        };
        
        // Mettre à jour le champ de saisie avec les coordonnées
        document.getElementById("end").value = endPlace.formatted_address;
        
        // Afficher une notification
        showNotification('Point d\'arrivée mis à jour', 'info');
    }

    // Fonction pour mettre à jour la position d'un arrêt
    function updateStopPosition(stopData, newPosition) {
        const lat = newPosition.lat();
        const lng = newPosition.lng();
        
        // Mettre à jour l'objet place de l'arrêt avec les nouvelles coordonnées
        stopData.place = {
            formatted_address: `Arrêt (${lat.toFixed(6)}, ${lng.toFixed(6)})`,
            geometry: {
                location: newPosition
            },
            place_id: `custom_stop_${stopData.id}_${Date.now()}`,
            name: `Arrêt ${stopData.id}`
        };
        
        // Mettre à jour le champ input correspondant
        if (stopData.input) {
            stopData.input.value = stopData.place.formatted_address;
        }
        
        // Afficher une notification
        showNotification('Arrêt mis à jour', 'info');
    }

    // Fonction pour fermer toutes les infoWindows
    function closeAllInfoWindows() {
        infoWindows.forEach(infoWindow => {
            infoWindow.close();
        });
    }

    // Fonction pour mettre à jour les infobulles avec les distances cumulatives
    function updateMarkersInfoWindows(response) {
        const legs = response.routes[0].legs;
        let cumulativeDistance = 0;
        let cumulativeDuration = 0;

        // Parcourir chaque segment de l'itinéraire
        legs.forEach((leg, index) => {
            cumulativeDistance += leg.distance.value;
            cumulativeDuration += leg.duration.value;

            const distanceKm = (cumulativeDistance / 1000).toFixed(1);
            const durationMin = Math.floor(cumulativeDuration / 60);
            const durationHours = Math.floor(durationMin / 60);
            const remainingMin = durationMin % 60;

            let durationText = "";
            if (durationHours > 0) {
                durationText = `${durationHours}h ${remainingMin}min`;
            } else {
                durationText = `${durationMin}min`;
            }

            // Mettre à jour l'infoWindow correspondante
            if (index < stopPlaces.length) {
                // C'est un arrêt
                const stopData = stopPlaces[index];
                if (stopData.infoWindow) {
                    const label = String.fromCharCode(67 + index);
                    stopData.infoWindow.setContent(`
                        <div class="p-2">
                            <strong>Arrêt ${label}</strong><br>
                            <small><i class="fa fa-route"></i> ${distanceKm} km depuis le départ</small><br>
                            <small><i class="fa fa-clock"></i> ${durationText} de trajet</small>
                        </div>
                    `);
                }
            } else if (index === legs.length - 1) {
                // C'est le point d'arrivée
                const endInfoWindow = infoWindows.find(iw => 
                    iw.getContent().includes("Point d'Arrivée")
                );
                if (endInfoWindow) {
                    endInfoWindow.setContent(`
                        <div class="p-2">
                            <strong>Point d'Arrivée</strong><br>
                            <small><i class="fa fa-route"></i> ${distanceKm} km depuis le départ</small><br>
                            <small><i class="fa fa-clock"></i> ${durationText} de trajet total</small>
                        </div>
                    `);
                }
            }
        });
    }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&libraries=places&callback=initMap" async defer></script>
    </body>
    </html>
