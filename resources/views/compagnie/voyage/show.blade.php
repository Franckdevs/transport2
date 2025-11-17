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

        <!-- start: page toolbar -->
        @include('compagnie.all_element.cadre')

        <!-- start: page body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                {{-- <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Détails du voyage</h5>
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

                <div class="row">
                    <div class="col-12">
                        <!-- Carte Informations Générales -->
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-transparent border-0 py-3">
                                <h5 class="card-title text-primary mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Informations générales
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Ville de départ -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Ville de départ</label>
                                            <p class="fs-6 fw-bold text-dark mb-0 text-truncate" title="{{ $voyage->itineraire->ville->nom_ville ?? 'Non défini' }}">
                                                {{ $voyage->itineraire->ville->nom_ville ?? 'Non défini' }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Estimation du trajet -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Estimation du trajet</label>
                                            <p class="fs-6 fw-bold text-dark mb-0">{{ $voyage->itineraire->estimation ?? 'Non défini' }}</p>
                                        </div>
                                    </div>

                                    <!-- Titre du trajet -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Titre du trajet</label>
                                            <p class="fs-6 fw-bold text-dark mb-0 text-truncate" title="{{ $voyage->itineraire->titre ?? 'Non défini' }}">
                                                {{ $voyage->itineraire->titre ?? 'Non défini' }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Date de création -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Date de création</label>
                                            <p class="fs-6 fw-bold text-dark mb-0">{{ $voyage->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carte Informations Bus -->
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-transparent border-0 py-3">
                                <h5 class="card-title text-primary mb-0">
                                    <i class="fas fa-bus me-2"></i>Informations sur le Bus
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Nom du bus -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Nom du Bus</label>
                                            <p class="fs-6 fw-bold text-dark mb-0 text-truncate" title="{{ $voyage->bus->nom_bus ?? 'Non défini' }}">
                                                {{ $voyage->bus->nom_bus ?? 'Non défini' }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Nombre de places -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Nombre de places</label>
                                            <p class="fs-6 fw-bold text-dark mb-0">{{ $voyage->bus->nombre_places ?? 'Non défini' }} Places</p>
                                        </div>
                                    </div>

                                    <!-- Marque -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Marque du Bus</label>
                                            <p class="fs-6 fw-bold text-dark mb-0 text-truncate" title="{{ $voyage->bus->marque_bus ?? 'Non défini' }}">
                                                {{ $voyage->bus->marque_bus ?? 'Non défini' }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Modèle -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Modèle du Bus</label>
                                            <p class="fs-6 fw-bold text-dark mb-0 text-truncate" title="{{ $voyage->bus->modele_bus ?? 'Non défini' }}">
                                                {{ $voyage->bus->modele_bus ?? 'Non défini' }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Immatriculation -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Immatriculation</label>
                                            <p class="fs-6 fw-bold text-dark mb-0">{{ $voyage->bus->immatriculation_bus ?? 'Non défini' }}</p>
                                        </div>
                                    </div>

                                    <!-- Disposition -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Disposition</label>
                                            <p class="fs-6 fw-bold text-dark mb-0 text-truncate" title="{{ $voyage->bus->configurationPlace->disposition ?? 'Non défini' }}">
                                                {{ $voyage->bus->configurationPlace->disposition ?? 'Non défini' }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Configuration des places -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Configuration</label>
                                            <p class="fs-6 fw-bold text-dark mb-0 text-truncate" title="{{ $voyage->bus->configurationPlace->nom_complet ?? 'Non défini' }}">
                                                {{ $voyage->bus->configurationPlace->nom_complet ?? 'Non défini' }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-12">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Description du Bus</label>
                                            <p class="fs-6 text-dark mb-0 text-wrap">{{ $voyage->bus->description_bus ?? 'Non défini' }}</p>
                                        </div>
                                    </div>

                                    <!-- Photo du bus -->
                                    <div class="col-12">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Photo du Bus</label>
                                            <div class="mt-2">
                                                @if (!empty($voyage->bus->photo_bus))
                                                    <img src="{{ asset($voyage->bus->photo_bus) }}" 
                                                         alt="Photo du bus" 
                                                         class="img-fluid rounded border" 
                                                         style="max-height: 150px; max-width: 100%;">
                                                @else
                                                    <p class="text-muted fst-italic mb-0">Aucune photo disponible</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carte Informations Chauffeur -->
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-transparent border-0 py-3">
                                <h5 class="card-title text-primary mb-0">
                                    <i class="fas fa-user-tie me-2"></i>Informations sur le Chauffeur
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Nom complet -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Nom et Prénom</label>
                                            <p class="fs-6 fw-bold text-dark mb-0">
                                                {{ $voyage->chauffeur->nom ?? 'Non défini' }} {{ $voyage->chauffeur->prenom ?? '' }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Numéro de téléphone -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Téléphone</label>
                                            <p class="fs-6 fw-bold text-dark mb-0">{{ $voyage->chauffeur->telephone ?? 'Non défini' }}</p>
                                        </div>
                                    </div>

                                    <!-- Photo du chauffeur -->
                                    <div class="col-12">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Photo du Chauffeur</label>
                                            <div class="mt-2">
                                                @if(!empty($voyage->chauffeur->photo))
                                                    <img src="{{ asset($voyage->chauffeur->photo) }}" 
                                                         alt="Photo du chauffeur" 
                                                         class="img-fluid rounded border" 
                                                         style="max-height: 150px; max-width: 100%;">
                                                @else
                                                    <p class="text-muted fst-italic mb-0">Photo non disponible</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carte Itinéraire et Arrêts -->
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-transparent border-0 py-3">
                                <h5 class="card-title text-primary mb-0">
                                    <i class="fas fa-map-marked-alt me-2"></i>Itinéraire et Arrêts
                                </h5>
                            </div>
                            <div class="card-body">
                                <!-- Informations itinéraire -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Point de départ</label>
                                            <p class="fs-6 fw-bold text-dark mb-0 text-truncate" title="{{ $voyage->itineraire->ville->nom_ville ?? 'Non défini' }}">
                                                {{ $voyage->itineraire->ville->nom_ville ?? 'Non défini' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label text-muted fw-semibold small">Durée estimée</label>
                                            <p class="fs-6 fw-bold text-dark mb-0">{{ $voyage->itineraire->estimation ?? 'Non défini' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Arrêts du voyage -->
                                <div class="info-item">
                                    <label class="form-label text-muted fw-semibold small mb-3">Arrêts du voyage</label>
                                    @if ($voyage->itineraire && $voyage->itineraire->arrets && $voyage->itineraire->arrets->count() > 0)
                                        <div class="arrets-list">
                                            @foreach ($voyage->itineraire->arrets as $arret)
                                                <div class="arret-item border rounded p-3 mb-2">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                                <h6 class="fw-bold text-dark mb-0 text-truncate" title="{{ $arret->gare->nom_gare ?? 'Gare non définie' }}">
                                                                    {{ $arret->gare->nom_gare ?? 'Gare non définie' }}
                                                                </h6>
                                                            </div>
                                                            <div class="ms-4">
                                                                @if($arret->gare->ville)
                                                                    <p class="text-muted mb-1 text-truncate" title="{{ $arret->gare->ville->nom_ville }}">
                                                                        <i class="fas fa-city me-1"></i>{{ $arret->gare->ville->nom_ville }}
                                                                    </p>
                                                                @endif
                                                                @if($arret->arretVoyages && $arret->arretVoyages->count() > 0)
                                                                    @foreach($arret->arretVoyages as $av)
                                                                        <p class="text-success mb-0">
                                                                            {{-- <i class="fas fa-money-bill-wave me-1"></i> --}}
                                                                            <strong>Montant :</strong> {{ number_format($av->montant, 0, ',', ' ') }} FCFA
                                                                        </p>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted fst-italic mb-0">Aucun arrêt défini pour ce voyage.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- start: page footer -->
        @include('compagnie.all_element.footer')
    </div>

    <!-- Jquery Page Js -->
    <script src="../assets/js/theme.js"></script>
    <!-- Plugin Js -->
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

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

        .info-item {
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background-color: #f8f9fa;
        }

        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .text-wrap {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .arret-item {
            transition: all 0.3s ease;
            border-left: 4px solid #007bff !important;
        }

        .arret-item:hover {
            transform: translateX(5px);
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .info-item {
                padding: 0.5rem;
            }
            
            .fs-6 {
                font-size: 0.9rem !important;
            }
        }
    </style>
</body>
</html>