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
                    @include('compagnie.all_element.navbar') <!-- Navbar -->
                </nav>
            </div>
        </header>

        <!-- start: page toolbar -->
        @include('compagnie.all_element.cadre')

        <!-- start: page body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">
                </h5>
                <a href="{{ route('voyage.index') }}" class="btn btn-light" title="Retour">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </div>
                <div class="row">
                    <div class="col-12 animate-fadeInUp">
                        <!-- Title Section -->
                        <h3 class="mb-4 text-primary fw-bold border-start border-5 border-primary ps-3"
                            style="letter-spacing: 1.2px;">
                            Détails du voyage
                        </h3>

                        <div class="row g-4">
                            <!-- Ville de départ -->
                            <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Ville de départ</label>
                                <p class="fs-5 mb-0">{{ $voyage->itineraire->ville->nom_ville ?? 'Non défini' }}</p>
                            </div>

                            <!-- Estimation du trajet -->
                            <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Estimation du trajet (H:min)</label>
                                <p class="fs-5 mb-0">{{ $voyage->itineraire->estimation ?? 'Non défini' }}</p>
                            </div>

                            <!-- Titre du trajet -->
                            <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Titre du trajet</label>
                                <p class="fs-5 mb-0">{{ $voyage->itineraire->titre ?? 'Non défini' }}</p>
                            </div>

                            <!-- Date de création -->
                            <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Date de création</label>
                                <p class="fs-5 mb-0">{{ $voyage->created_at->format('d/m/Y H:i') }}</p>
                            </div>

                            

                            <!-- Statut -->
                            {{-- <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Statut</label>
                                <div>
                                    <span
                                        class="badge statut-badge {{ $voyage->statut == 1 ? 'active' : 'inactive' }} fs-6 px-3 py-2 rounded-pill">
                                        {{ $voyage->statut == 1 ? 'Actif' : 'Inactif' }}
                                    </span>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-6">
    <label class="form-label text-muted fw-semibold">Statut</label>
    <div>
        <span
            class="badge fs-6 px-3 py-2 rounded-pill
                {{ $voyage->status == 1 ? 'bg-success' : ($voyage->status == 2 ? 'bg-warning text-dark' : ($voyage->status == 3 ? 'bg-danger' : 'bg-secondary')) }}">
            {{ $voyage->status == 1 ? 'Actif' : ($voyage->status == 2 ? 'En attente' : ($voyage->status == 3 ? 'Inactif' : 'Inconnu')) }}
        </span>
    </div>
</div> --}}


                        </div>

                        <!-- Bus Information -->
                        <hr class="my-4">
                        {{-- <h5 class="fw-semibold mb-3 text-secondary">Informations sur le Bus</h5> --}}
                        
                   <div class="row g-4">

    <!-- SECTION BUS -->
    <div class="col-12 mb-3">
        <h5 class="text-primary fw-bold">Informations sur le Bus</h5>
        <hr>
    </div>

    <!-- Nom du bus -->
    <div class="col-md-4">
        <label class="form-label text-muted fw-semibold">Nom du Bus</label>
        <p class="fs-5 mb-0">{{ $voyage->bus->nom_bus ?? 'Non défini' }}</p>
    </div>

    <!-- Nombre de places -->
    <div class="col-md-4">
        <label class="form-label text-muted fw-semibold">Nombre de places</label>
        <p class="fs-5 mb-0">{{ $voyage->bus->nombre_places ?? 'Non défini' }} Places disponibles (Dans le bus)</p>
    </div>

    <!-- Marque -->
    <div class="col-md-4">
        <label class="form-label text-muted fw-semibold">Marque du Bus</label>
        <p class="fs-5 mb-0">{{ $voyage->bus->marque_bus ?? 'Non défini' }}</p>
    </div>

    <!-- Modèle -->
    <div class="col-md-4">
        <label class="form-label text-muted fw-semibold">Modèle du Bus</label>
        <p class="fs-5 mb-0">{{ $voyage->bus->modele_bus ?? 'Non défini' }}</p>
    </div>

    <!-- Immatriculation -->
    <div class="col-md-4">
        <label class="form-label text-muted fw-semibold">Immatriculation du Bus</label>
        <p class="fs-5 mb-0">{{ $voyage->bus->immatriculation_bus ?? 'Non défini' }}</p>
    </div>

    <!-- Description -->
    <div class="col-md-4">
        <label class="form-label text-muted fw-semibold">Description du Bus</label>
        <p class="fs-5 mb-0">{{ $voyage->bus->description_bus ?? 'Non défini' }}</p>
    </div>

    <!-- Disposition -->
    <div class="col-md-4">
        <label class="form-label text-muted fw-semibold">Disposition du Bus</label>
        <p class="fs-5 mb-0">{{ $voyage->bus->configurationPlace->disposition ?? 'Non défini' }}</p>
    </div>

    <!-- Nom complet -->
    <div class="col-md-4">
        <label class="form-label text-muted fw-semibold">Nom complet</label>
        <p class="fs-5 mb-0">{{ $voyage->bus->configurationPlace->nom_complet ?? 'Non défini' }}</p>
    </div>

    <!-- Photo du bus -->
    <div class="col-md-4">
        <label class="form-label text-muted fw-semibold">Photo du Bus</label>
        <p class="fs-5 mb-0">
            <img src="{{ url($voyage->bus->photo_bus) }}" alt="Photo du bus" class="img-fluid rounded" style="max-height:120px;">
        </p>
    </div>

    <!-- SECTION CHAUFFEUR -->
                            <hr class="my-4">

    <div class="col-12 mt-4 mb-3">
        <h5 class="text-primary fw-bold">Informations sur le Chauffeur</h5>
        <hr>
    </div>

    <!-- Nom complet -->
    <div class="col-md-4">
        <label class="form-label text-muted fw-semibold">Nom et Prénom</label>
        <p class="fs-5 mb-0">{{ $voyage->chauffeur->nom ?? 'Non défini' }} {{ $voyage->chauffeur->prenom ?? 'Non défini' }}</p>
    </div>

    <!-- Numéro de téléphone -->
    <div class="col-md-4">
        <label class="form-label text-muted fw-semibold">Numéro de téléphone</label>
        <p class="fs-5 mb-0">{{ $voyage->chauffeur->telephone ?? 'Non défini' }}</p>
    </div>

    <!-- Photo du chauffeur -->
    <div class="col-md-4">
        <label class="form-label text-muted fw-semibold">Photo du Chauffeur</label>
        <p class="fs-5 mb-0">
            <img src="{{ asset($voyage->chauffeur->photo) }}" alt="Photo du chauffeur" class="img-fluid rounded" style="max-height:120px;">
        </p>
    </div>

</div>


                        <!-- Itinéraire -->
                        <hr class="my-4">
                        
                        <h5 class="fw-semibold mb-3 text-secondary">Itinéraire du Voyage</h5>
                        <div class="row g-4">
                            <!-- Départ -->
                            <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Point de départ</label>
                                <p class="fs-5 mb-0">{{ $voyage->itineraire->ville->nom_ville ?? 'Non défini' }}</p>
                            </div>

                            <!-- Arrivée -->
                            {{-- <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Point d'arrivée</label>
                                <p class="fs-5 mb-0">
                                    {{ $voyage->itineraire->arrets->last()->nom ?? 'Non défini' }}
                                </p>
                            </div> --}}

                              <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Estimation</label>
                                <p class="fs-5 mb-0">{{ $voyage->itineraire->estimation ?? 'Non défini' }} </p>
                            </div>

                            
                             {{-- <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Titre</label>
                                <p class="fs-5 mb-0">{{ $voyage->itineraire->titre ?? 'Non défini' }}</p>
                            </div> --}}



                            <!-- Durée du trajet -->
                            {{-- <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Durée estimée</label>
                                <p class="fs-5 mb-0">{{ $voyage->itineraire->duree ?? 'Non défini' }}</p>
                            </div>

                            <!-- Distance -->
                            <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Distance (en km)</label>
                                <p class="fs-5 mb-0">{{ $voyage->itineraire->distance ?? 'Non défini' }}</p>
                            </div> --}}
                        </div>

                        <!-- Arrêts du voyage -->
                      <hr class="my-4">
<h5 class="fw-semibold mb-3 text-secondary">Arrêts du voyage </h5>

@if ($voyage->itineraire && $voyage->itineraire->arrets && $voyage->itineraire->arrets->count() > 0)
    <ul class="list-group list-group-flush">
        @foreach ($voyage->itineraire->arrets as $arret)
            <li class="list-group-item d-flex align-items-center border-0 px-0 py-2 animate-slideInLeft">
                <i class="fas fa-map-marker-alt text-primary fs-5 me-3"></i>
                <span class="fs-6 text-dark">
                    @if($arret->gare)
                        <strong>Gare:</strong> {{ $arret->gare->nom_gare }}
                        @if($arret->gare->ville)
                            (<strong>Ville:</strong> {{ $arret->gare->ville->nom_ville }})
                        @endif
                    @else
                        <em>Gare non définie</em>
                    @endif
                </span>
            </li>
        @endforeach
    </ul>
@else
    <p class="text-muted fst-italic">Aucun arrêt défini pour ce voyage.</p>
@endif


                        <!-- Liens et Boutons -->
                        {{-- <a href="{{ route('voyage.index') }}"
                            class="btn btn-primary mt-4 shadow-sm btn-hover-scale">
                            <i class="fas fa-arrow-left me-2"></i> Retour à la liste
                        </a>
                        <a href="" class="btn btn-warning mt-4 shadow-sm btn-hover-scale">
                            <i class="fas fa-edit me-2"></i> Modifier ce voyage
                        </a> --}}
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

</body>

</html>
