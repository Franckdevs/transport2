@php
    use App\Helpers\GlobalHelper;
@endphp
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

        {{-- @include('compagnie.all_element.cadre') --}}

        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <!-- En-tête amélioré -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                {{-- <h4 class="mb-1 text-primary">
                                    <i class="fa fa-receipt me-2"></i>Détails de la réservation
                                </h4> --}}
                                <p class="text-muted mb-0">
                                  {{-- Informations complètes sur la réservation # --}}
                                  {{-- {{ $detail_reservation->id ?? 'N/A' }} --}}
                                </p>
                            </div>
                            <a href="{{ route('liste_reservation') }}" class="btn btn-outline-secondary" title="Retour à la liste">
                                <i class="fa fa-arrow-left me-2"></i>Retour
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Informations Utilisateur -->
                    <div class="col-xl-4 col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-primary text-white py-3">
                                <h5 class="card-title mb-0">
                                    <i class="fa fa-user me-2"></i>Informations du passager
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="fa fa-user fa-lg text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">{{ $detail_reservation->utilisateur->nom ?? 'N/A' }} {{ $detail_reservation->utilisateur->prenom ?? '' }}</h6>
                                        <p class="text-muted mb-0">Passager</p>
                                    </div>
                                </div>

                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-envelope me-2"></i>Email
                                        </span>
                                        <span class="fw-semibold">{{ $detail_reservation->utilisateur->email ?? 'N/A' }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-phone me-2"></i>Téléphone
                                        </span>
                                        <span class="fw-semibold">{{ $detail_reservation->utilisateur->telephone ?? 'N/A' }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-hashtag me-2"></i>Place
                                        </span>
                                        <span class="badge bg-primary">{{ $detail_reservation->numero_place ?? 'N/A' }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-info-circle me-2"></i>Statut
                                        </span>
                                        @if($detail_reservation->status == 1)
                                            <span class="badge bg-success">Confirmée</span>
                                        @elseif($detail_reservation->status == 2)
                                            <span class="badge bg-warning text-dark">En attente</span>
                                        @else
                                            <span class="badge bg-danger">Annulée</span>
                                        @endif
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-user-check me-2"></i>Compte
                                        </span>
                                        @if(($detail_reservation->utilisateur->status ?? 0) == 1)
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-danger">Inactif</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations Paiement -->
                    <div class="col-xl-4 col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-warning text-dark py-3">
                                <h5 class="card-title mb-0">
                                    <i class="fa fa-credit-card me-2"></i>Informations de paiement
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="fa fa-money-bill-wave fa-lg text-warning"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">
                                            {{ isset($detail_reservation->paiement->montant) ? number_format($detail_reservation->paiement->montant, 0, ',', ' ') . ' FCFA' : '0 FCFA' }}
                                        </h6>
                                        <p class="text-muted mb-0">Montant payé</p>
                                    </div>
                                </div>

                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-wallet me-2"></i>Moyen
                                        </span>
                                        <span class="fw-semibold">{{ $detail_reservation->paiement->moyenPaiement ?? '-' }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-hashtag me-2"></i>Code
                                        </span>
                                        <span class="fw-semibold text-truncate" style="max-width: 120px;">
                                            {{ $detail_reservation->paiement->code_paiement ?? '-' }}
                                        </span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-phone me-2"></i>Téléphone
                                        </span>
                                        <span class="fw-semibold">{{ $detail_reservation->paiement->telephone ?? '-' }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-calendar me-2"></i>Date paiement
                                        </span>
                                        <span class="fw-semibold small">
                                            {{ GlobalHelper::formatCreatedAt($detail_reservation->paiement->datePaiement) ?? '-' }}
                                        </span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-clock me-2"></i>Heure
                                        </span>
                                        <span class="fw-semibold">{{ $detail_reservation->paiement->HeurePaiement ?? '-' }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-file-invoice me-2"></i>Référence
                                        </span>
                                        <span class="fw-semibold text-truncate" style="max-width: 199px;">
                                            {{ $detail_reservation->paiement->referencePaiement ?? '-' }}
                                        </span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-check-circle me-2"></i>Statut paiement
                                        </span>
                                        @switch($detail_reservation->paiement->status ?? '')
                                            @case('1')
                                                <span class="badge bg-success">Validé</span>
                                                @break
                                            @case('2')
                                                <span class="badge bg-warning text-dark">En attente</span>
                                                @break
                                            @case('3')
                                                <span class="badge bg-danger">Annulé</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">Non défini</span>
                                        @endswitch
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations Voyage -->
                    <div class="col-xl-4 col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-info text-white py-3">
                                <h5 class="card-title mb-0">
                                    <i class="fa fa-route me-2"></i>Informations du voyage
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="fa fa-bus fa-lg text-info"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">{{ $detail_reservation->voyage->itineraire->titre ?? 'Non défini' }}</h6>
                                        <p class="text-muted mb-0">Itinéraire</p>
                                    </div>
                                </div>

                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-calendar-day me-2"></i>Date départ
                                        </span>
                                        <span class="fw-semibold">{{ $detail_reservation->voyage->date_depart ?? 'N/A' }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-clock me-2"></i>Heure départ
                                        </span>
                                        <span class="fw-semibold">{{ $detail_reservation->voyage->heure_depart ?? 'N/A' }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-tag me-2"></i>Montant voyage
                                        </span>
                                        <span class="fw-semibold">{{ $detail_reservation->voyage->montant ?? 'N/A' }} FCFA</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-bus me-2"></i>Bus
                                        </span>
                                        <span class="fw-semibold">{{ $detail_reservation->voyage->bus->nom_bus ?? 'N/A' }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-user-tie me-2"></i>Chauffeur
                                        </span>
                                        <span class="fw-semibold">{{ $detail_reservation->voyage->chauffeur->nom ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  
                </div>
            </div>
        </div>

        @include('compagnie.all_element.footer')
    </div>

    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <style>
        .card {
            border-radius: 12px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
        }

        .card-header {
            border-radius: 12px 12px 0 0 !important;
            border: none;
        }

        .list-group-item {
            border: none;
            padding: 0.75rem 0;
        }

        .bg-opacity-10 {
            background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
        }

        .badge {
            font-weight: 500;
            padding: 0.5em 0.75em;
        }

        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .rounded-3 {
            border-radius: 12px !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        h4, h5, h6 {
            font-weight: 600;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .fw-semibold {
            font-weight: 600;
        }
    </style>
</body>
</html>