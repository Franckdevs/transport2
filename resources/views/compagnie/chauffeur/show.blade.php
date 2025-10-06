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
                <!-- En-tête amélioré -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1 text-primary">
                                    <i class="fa fa-user-circle me-2"></i>Détails du chauffeur
                                </h4>
                                <p class="text-muted mb-0">Informations complètes du chauffeur</p>
                            </div>
                            <a href="{{ route('chauffeur.index') }}" class="btn btn-outline-secondary" title="Retour à la liste">
                                <i class="fa fa-arrow-left me-2"></i>Retour
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12">
                        <!-- Carte principale -->
                        <div class="card border-0 shadow-lg">
                            <div class="card-header bg-primary text-white py-3">
                                <h5 class="card-title mb-0 text-center">
                                    <i class="fa fa-id-card me-2"></i>Profil du Chauffeur
                                </h5>
                            </div>
                            
                            <div class="card-body p-0">
                                <div class="row g-0 align-items-stretch">
                                    <!-- Photo et statut -->
                                    <div class="col-md-4 bg-light py-4">
                                        <div class="text-center">
                                            <!-- Photo -->
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ $chauffeur->photo ? url($chauffeur->photo) : asset('assets/img/default-user.png') }}" 
                                                     class="img-fluid rounded-circle shadow border-4 border-white" 
                                                     alt="Photo du chauffeur" 
                                                     style="width: 200px; height: 200px; object-fit: cover;">
                                                <!-- Badge de statut -->
                                                <span class="position-absolute bottom-0 end-0 badge 
                                                    {{ $chauffeur->status == 1 ? 'bg-success' : 'bg-danger' }} 
                                                    rounded-pill p-2 border border-3 border-white">
                                                    <i class="fa {{ $chauffeur->status == 1 ? 'fa-check' : 'fa-times' }} me-1"></i>
                                                    {{ $chauffeur->status == 1 ? 'Actif' : 'Inactif' }}
                                                </span>
                                            </div>
                                            
                                            <!-- Nom complet -->
                                            <h4 class="mt-4 mb-1 text-dark fw-bold">{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</h4>
                                            <p class="text-muted mb-3">Chauffeur professionnel</p>
                                            
                                            <!-- Actions rapides -->
                                            <div class="d-grid gap-2 px-4">
                                                <a href="tel:{{ $chauffeur->telephone }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fa fa-phone me-2"></i>Appeler
                                                </a>
                                                <a href="{{ route('modifier.edit', $chauffeur->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit me-2"></i>Modifier le profil
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Informations détaillées -->
                                    <div class="col-md-8">
                                        <div class="p-4">
                                            <h5 class="text-primary mb-4 border-bottom pb-2">
                                                <i class="fa fa-info-circle me-2"></i>Informations personnelles
                                            </h5>
                                            
                                            <div class="row">
                                                <!-- Colonne gauche -->
                                                <div class="col-md-6">
                                                    <!-- Téléphone -->
                                                    <div class="mb-4">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                                <i class="fa fa-phone text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <label class="form-label fw-semibold text-muted mb-0 small">Téléphone</label>
                                                                <p class="mb-0 fw-semibold text-dark">
                                                                    <a href="tel:{{ $chauffeur->telephone }}" class="text-decoration-none text-dark">
                                                                        {{ $chauffeur->telephone }}
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Numéro de permis -->
                                                    <div class="mb-4">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                                                <i class="fa fa-id-card text-success"></i>
                                                            </div>
                                                            <div>
                                                                <label class="form-label fw-semibold text-muted mb-0 small">Numéro de permis</label>
                                                                <p class="mb-0 fw-semibold text-dark">
                                                                    @if($chauffeur->numeros_permis)
                                                                        <span class="badge bg-light text-dark border px-3 py-2">
                                                                            {{ $chauffeur->numeros_permis }}
                                                                        </span>
                                                                    @else
                                                                        <span class="text-muted">Non renseigné</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Colonne droite -->
                                                <div class="col-md-6">
                                                    <!-- Date de naissance -->
                                                    <div class="mb-4">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                                                <i class="fa fa-calendar text-info"></i>
                                                            </div>
                                                            <div>
                                                                <label class="form-label fw-semibold text-muted mb-0 small">Date de naissance</label>
                                                                <p class="mb-0 fw-semibold text-dark">
                                                                    @if($chauffeur->date_naissance)
                                                                        {{ \Carbon\Carbon::parse($chauffeur->date_naissance)->format('d/m/Y') }}
                                                                        <small class="text-muted">
                                                                            ({{ \Carbon\Carbon::parse($chauffeur->date_naissance)->age }} ans)
                                                                        </small>
                                                                    @else
                                                                        <span class="text-muted">Non renseignée</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Adresse -->
                                                    <div class="mb-4">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                                                <i class="fa fa-map-marker text-warning"></i>
                                                            </div>
                                                            <div>
                                                                <label class="form-label fw-semibold text-muted mb-0 small">Adresse</label>
                                                                <p class="mb-0 fw-semibold text-dark">
                                                                    @if($chauffeur->adresse)
                                                                        {{ $chauffeur->adresse }}
                                                                    @else
                                                                        <span class="text-muted">Non renseignée</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Statistiques supplémentaires -->
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <h6 class="text-primary mb-3 border-bottom pb-2">
                                                        <i class="fa fa-chart-bar me-2"></i>Informations complémentaires
                                                    </h6>
                                                    
                                                    <div class="row text-center">
                                                        <div class="col-md-3 mb-3">
                                                            <div class="border rounded p-3 bg-light">
                                                                <i class="fa fa-calendar-check fa-2x text-primary mb-2"></i>
                                                                <h6 class="mb-1">Date d'ajout</h6>
                                                                <p class="mb-0 text-muted small">
                                                                    {{ $chauffeur->created_at ? \Carbon\Carbon::parse($chauffeur->created_at)->format('d/m/Y') : 'N/A' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <div class="border rounded p-3 bg-light">
                                                                <i class="fa fa-clock fa-2x text-success mb-2"></i>
                                                                <h6 class="mb-1">Dernière modif.</h6>
                                                                <p class="mb-0 text-muted small">
                                                                    {{ $chauffeur->updated_at ? \Carbon\Carbon::parse($chauffeur->updated_at)->format('d/m/Y') : 'N/A' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <div class="border rounded p-3 bg-light">
                                                                <i class="fa fa-bus fa-2x text-info mb-2"></i>
                                                                <h6 class="mb-1">Bus assigné</h6>
                                                                <p class="mb-0 text-muted small">
                                                                    {{ $chauffeur->bus_id ? 'Bus #' . $chauffeur->bus_id : 'Aucun' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <div class="border rounded p-3 bg-light">
                                                                <i class="fa fa-star fa-2x text-warning mb-2"></i>
                                                                <h6 class="mb-1">Statut</h6>
                                                                <p class="mb-0">
                                                                    <span class="badge {{ $chauffeur->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                                        {{ $chauffeur->status == 1 ? 'Actif' : 'Inactif' }}
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pied de carte avec actions -->
                            <div class="card-footer bg-light border-top-0 py-3">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('chauffeur.index') }}" class="btn btn-outline-secondary">
                                                <i class="fa fa-list me-2"></i>Liste des chauffeurs
                                            </a>
                                            <a href="{{ route('modifier.edit', $chauffeur->id) }}" class="btn btn-warning">
                                                <i class="fa fa-edit me-2"></i>Modifier
                                            </a>
                                            @if($chauffeur->status == 1)
                                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#desactiverModal">
                                                    <i class="fa fa-ban me-2"></i>Désactiver
                                                </button>
                                            @else
                                                <form action="{{ route('activer.destroy_reactivation', $chauffeur->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-check me-2"></i>Réactiver
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de désactivation -->
        <div class="modal fade" id="desactiverModal" tabindex="-1" aria-labelledby="desactiverModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title" id="desactiverModalLabel">
                            <i class="fa fa-exclamation-triangle me-2"></i>Confirmation
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <i class="fa fa-user-times fa-3x text-warning mb-3"></i>
                        <h6>Êtes-vous sûr de vouloir désactiver ce chauffeur ?</h6>
                        <p class="text-muted mb-0">
                            {{ $chauffeur->nom }} {{ $chauffeur->prenom }} ne pourra plus être assigné à des trajets.
                        </p>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <form action="{{ route('activer.destroy', $chauffeur->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning">Confirmer la désactivation</button>
                        </form>
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

    <style>
        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
        }

        .border-4 {
            border-width: 4px !important;
        }

        .bg-opacity-10 {
            background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .badge {
            font-weight: 500;
        }

        .rounded-circle {
            transition: transform 0.3s ease;
        }

        .rounded-circle:hover {
            transform: scale(1.05);
        }

        .border {
            border-color: #e9ecef !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
        }
    </style>
</body>
</html>