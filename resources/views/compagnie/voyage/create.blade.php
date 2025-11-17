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
                    @include('compagnie.all_element.navbar')
                </nav>
            </div>
        </header>

        @include('compagnie.all_element.cadre')

        <!-- start: page body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <!-- En-tête amélioré -->
                {{-- <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Ajouter un nouveau voyage</h5>
                    <a href="{{ route('voyage.index') }}" class="btn btn-outline-primary btn-hover" title="Retour">
                        <i class="fas fa-arrow-left me-2"></i> Retour
                    </a>
                </div> --}}

                
              <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="section-title mb-0">
                      {{-- Modifier l'utilisateur
                      Votre gare {{ $gares->nom_gare ?? '' }} --}}
                    </h4>
                    <a href="{{ route('voyage.index') }}" class="btn" title="Retour">
                        <i class="fa fa-arrow-left me-2"></i> Retour à la liste
                    </a>
                </div>

                <div class="col-md-12 mt-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-transparent border-0 py-4">
                            <h5 class="card-title text-primary mb-0">
                                <i class="fas fa-plus-circle me-2"></i>Informations du voyage
                            </h5>
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

                            <!-- Zone pour afficher les infos de l'itinéraire -->
                            
                            <!-- Formulaire de création -->
                            <form action="{{ route('voyage.store') }}" method="POST">
                                @csrf
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
                                                <option value="{{ $itineraire->id }}">{{ $itineraire->titre }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text text-muted">
                                            <i class="fas fa-info-circle me-1"></i>Choisissez l'itinéraire pour ce voyage
                                        </div>
                                    </div>

                                    <!-- Heure de départ -->
                                    

                                    <!-- Date de départ -->
                                    <div class="col-md-6 mb-4">
                                        <label for="date_depart" class="form-label fw-semibold">
                                            <i class="fas fa-calendar-alt me-2 text-primary"></i>Date du départ
                                        </label>
                                        <input type="date" name="date_depart" id="date_depart" class="form-control form-control-lg shadow-sm" value="{{ old('date_depart') }}" required>
                                        <div class="form-text text-muted">
                                            <i class="fas fa-info-circle me-1"></i>Date prévue du départ
                                        </div>
                                    </div>


                                    <div class="col-md-6 mb-4">
                                        <label for="heure_depart" class="form-label fw-semibold">
                                            <i class="fas fa-clock me-2 text-primary"></i>Heure de départ
                                        </label>
                                        <input type="time" name="heure_depart" id="heure_depart" class="form-control form-control-lg shadow-sm" required>
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
                                                <option value="{{ $bus->id }}">{{ $bus->nom_bus }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text text-muted">
                                            <i class="fas fa-info-circle me-1"></i>Véhicule assigné au voyage
                                        </div>
                                    </div>

                                    <!-- Chauffeur -->
                                    <div class="col-md-6 mb-4">
                                        <label for="chauffeur_id" class="form-label fw-semibold">
                                            <i class="fas fa-user-tie me-2 text-primary"></i>Chauffeur
                                        </label>
                                        <select name="chauffeur_id" id="chauffeur_id" class="form-select form-select-lg shadow-sm" required>
                                            <option value="">Sélectionner un chauffeur</option>
                                            @foreach ($chauffeurs as $chauffeur)
                                                <option value="{{ $chauffeur->id }}">{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text text-muted">
                                            <i class="fas fa-info-circle me-1"></i>Chauffeur assigné au voyage
                                        </div>
                                    </div>
                                </div>

                                

                                <div class="text-end mt-4 pt-3 border-top">
                                    <button type="reset" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-undo me-2"></i>Réinitialiser
                                    </button>
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save me-2"></i>Enregistrer le voyage
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

            selectItineraire.addEventListener('change', function() {
                const itineraireId = this.value;

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
                                                    <div class="tarif-input">
                                                        <input type="number" class="form-control form-control-sm" 
                                                            placeholder="Montant (FCFA)" name="montant[${arret.id}]" 
                                                            min="0" step="0.01" style="width: 120px;">
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
            });

            // Focus sur le premier champ
            document.getElementById('itineraire_id').focus();
        });
    </script>

    <style>
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
    </style>

</body>
</html>