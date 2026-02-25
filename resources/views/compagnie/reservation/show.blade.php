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

        @include('compagnie.all_element.cadre')

        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                 
                <div class="d-flex justify-content-between align-items-center mb-4">
                   
                    <div class="ms-auto">
                        <a href="{{ route('liste_reservation') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>
              

                <!-- Section Principale -->
                <div class="row g-4">
                    <!-- Colonne de gauche - Informations principales -->
                    <div class="col-lg-8">
                        <!-- Carte d'itinéraire -->
                        <div class="card border-0 shadow-sm mb-4">
                           
                            {{-- <div class="card-header bg-white border-bottom py-3">
                                <h5 class="card-title mb-0 text-primary">
                                    <i class="fas fa-route me-2"></i>Détails du trajet
                                </h5>
                            </div> --}}

                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <!-- Départ -->
                                    <div class="col-md-4 p-4 border-end">
                                        <div class="d-flex flex-column h-100">
                                            <div class="mb-4">
                                                <span class="badge bg-primary bg-opacity-10 mb-3">DÉPART</span>
                                                <h2 class="h3 mb-2">
                                                    {{-- {{ $detail_reservation->voyage->itineraire->ville->nom_ville ?? 'N/A' }} --}}
                                                        {{ $detail_reservation->voyage->itineraire->arrets->first()->tarification->villeDepart->nom_ville ?? 'N/A' }}
                                                </h2>
                                                <p class="text-muted mb-1">
                                                    <i class="far fa-calendar-alt me-2"></i> 
{{ \Carbon\Carbon::parse($detail_reservation->voyage->date_depart)->locale('fr')->isoFormat('dddd DD MMMM YYYY') }}                                                </p>
                                                <p class="h4 text-primary mb-4">
                                                    <i class="far fa-clock me-2"></i> 
                                                    {{ date('H:i', strtotime($detail_reservation->voyage->heure_depart)) ?? 'N/A' }}
                                                </p>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="d-flex align-items-center text-muted mb-2">
                                                    <i class="fas fa-bus me-2"></i>
                                                    <span>{{ $detail_reservation->voyage->bus->nom_bus ?? 'N/A' }}</span>
                                                </div>
                                                <div class="d-flex align-items-center text-muted">
                                                    <i class="fas fa-user-tie me-2"></i>
                                                    <span>Chauffeur: {{ $detail_reservation->voyage->chauffeur->nom ?? 'N/A' }} {{ $detail_reservation->voyage->chauffeur->prenom ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Itinéraire -->
                                    <div class="col-md-4 p-4 d-flex align-items-center justify-content-center position-relative bg-light">
                                        <div class="text-center">
                                            {{-- <div class="position-relative mb-4">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                                    <i class="fas fa-route fa-2x text-primary"></i>
                                                </div>
                                                <div class="position-absolute top-50 start-0 end-0 h-1 bg-light z-n1"></div>
                                            </div> --}}
                                            <h5 class="mb-1">Durée du trajet</h5>
                                            <p class="h5 text-primary mb-0">{{ $detail_reservation->voyage->itineraire->estimation ?? 'N/A' }}</p>
                                            <div class="mt-3">
                                                <span class="badge bg-primary bg-opacity-10  px-3 py-2">
                                                    <i class="fas fa-chair me-1"></i> Siège: {{ $detail_reservation->numero_place ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Arrivée -->
                                    <div class="col-md-4 p-4">
                                        <div class="d-flex flex-column h-100">
                                            <div class="mb-4">
                                                <span class="badge bg-success bg-opacity-10 text-success mb-3">ARRIVÉE</span>
                                                <h2 class="h3 mb-2">
                                                    {{-- {{ $detail_reservation->arretvoyage->arret->gare->ville->nom_ville ?? 'N/A' }} --}}
                                                        {{ $detail_reservation->voyage->itineraire->arrets->last()->tarification->villeArrivee->nom_ville ?? 'N/A' }}
                                                </h2>
                                                <p class="text-muted">
                                                    <i class="fas fa-map-marker-alt me-2"></i>
                                                    {{-- {{ $detail_reservation->arretvoyage->arret->gare->nom_gare ?? 'Gare non spécifiée' }} --}}
    {{ $detail_reservation->voyage->itineraire->arrets->last()->tarification->villeArrivee->nom_ville ?? 'N/A' }}
                                                </p>
                                            </div>
                                            <div class="mt-auto">
                                                {{-- <div class="d-flex align-items-center text-muted mb-2">
                                                    <i class="fas fa-route me-2"></i>
                                                    <span>Itinéraire: {{ $detail_reservation->voyage->itineraire->titre ?? 'N/A' }}</span>
                                                </div> --}}
                                                {{-- <div class="d-flex align-items-center text-muted">
                                                    <i class="fas fa-tag me-2"></i>
                                                    <span>Prix: {{ number_format($detail_reservation->paiement->montant ?? 0, 0, ',', ' ') }} FCFA</span>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Carte Détails du Passager -->
                        {{-- <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="card-title mb-0 text-primary">
                                    <i class="fas fa-user me-2"></i>Informations du passager
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded hover-highlight">
                                            <p class="text-muted mb-1 small">
                                                <i class="far fa-envelope me-2"></i>Email
                                            </p>
                                            <p class="mb-0 fw-semibold text-truncate">{{ $detail_reservation->utilisateur->email ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded hover-highlight">
                                            <p class="text-muted mb-1 small">
                                                <i class="fas fa-phone me-2"></i>Téléphone
                                            </p>
                                            <p class="mb-0 fw-semibold">{{ $detail_reservation->utilisateur->telephone ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded hover-highlight">
                                            <p class="text-muted mb-1 small">
                                                <i class="fas fa-chair me-2"></i>Siège
                                            </p>
                                            <p class="mb-0">
                                                <span class="badge bg-primary">{{ $detail_reservation->numero_place ?? 'N/A' }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded hover-highlight">
                                            <p class="text-muted mb-1 small">
                                                <i class="fas fa-info-circle me-2"></i>Statut
                                            </p>
                                            <p class="mb-0">
                                                @if($detail_reservation->status == 1)
                                                    <span class="badge bg-success">Confirmée</span>
                                                @elseif($detail_reservation->status == 2)
                                                    <span class="badge bg-warning text-dark">En attente</span>
                                                @else
                                                    <span class="badge bg-danger">Annulée</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                    </div>
                    
                    <!-- Colonne de droite - Informations secondaires -->
                    <div class="col-lg-4">
                        <!-- Carte Paiement -->
                        <div class="card border-0 shadow-sm mb-4">
                            {{-- <div class="card-header bg-white border-bottom py-3">
                                <h5 class="card-title mb-0 text-warning">
                                Détails du paiement
                                </h5>
                            </div> --}}
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    
                                    <div>
                                        <h6 class="fw-bold">
                                            {{ isset($detail_reservation->paiement->montant) ? number_format($detail_reservation->paiement->montant, 0, ',', ' ') . ' FCFA' : '0 FCFA' }}
                                        </h6>
                                        {{-- <p class="text-muted mb-0">Montant payé</p> --}}
                                    </div>
                                </div>
                                
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-wallet me-2"></i>Moyen
                                        </span>
                                        <span class="fw-semibold">{{ $detail_reservation->paiement->moyenPaiement ?? '-' }}</span>
                                    </div>
                                    {{-- <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-hashtag me-2"></i>Code
                                        </span>
                                        <span class="fw-semibold text-truncate" style="max-width: 120px;">
                                            {{ $detail_reservation->paiement->code_paiement ?? '-' }}
                                        </span>
                                    </div> --}}
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
                                    {{-- <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                        <span class="text-muted">
                                            <i class="fa fa-clock me-2"></i>Heure
                                        </span>
                                        <span class="fw-semibold">{{ $detail_reservation->paiement->HeurePaiement ?? '-' }}</span>
                                    </div> --}}
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
                                                <span class="badge bg-warning text-dark">Echoué</span>
                                                @break
                                            @case('3')
                                                <span class="badge bg-danger">Annulé</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">Non défini</span>
                                        @endswitch
                                    </div>
                                </div>
                                <hr>
                                @if($detail_reservation->paiement->utilisateur)
                    {{-- <div class="bg-white rounded-lg p-4 shadow-sm mt-4"> --}}
                        <p class="text-xs text-yellow-600 font-semibold mb-2">Informations client:</p>
                        
                        @if(!empty($detail_reservation->paiement->nom_complet) && !empty($detail_reservation->paiement->telephone_proprietaire))
                            {{-- <div class="space-y-3"> --}}
                                <div>
                                    <span class="block text-xs font-semibold text-gray-600 uppercase mb-1">Attribuer à</span>
                                    <div class="space-y-1">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Nom:</span>
                                            <span class="text-sm text-gray-700">{{ $detail_reservation->paiement->nom_complet }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Téléphone:</span>
                                            <span class="text-sm text-gray-700">{{ $detail_reservation->paiement->telephone_proprietaire }}7</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 border-t border-gray-200">
                                    <span class="block text-xs font-semibold text-gray-600 uppercase mb-1">L’attributeur</span>
                                    <div class="space-y-1">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Nom:</span>
                                            <span class="text-sm text-gray-700">{{ $detail_reservation->paiement->utilisateur->nom ?? '-' }} {{ $detail_reservation->paiement->utilisateur->prenom ?? '-' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Email:</span>
                                            <span class="text-sm text-gray-700">{{ $detail_reservation->paiement->utilisateur->email ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        @else
                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Nom:</span>
                                    <span class="text-sm text-gray-700">{{ $detail_reservation->paiement->utilisateur->nom ?? '-' }} {{ $detail_reservation->paiement->utilisateur->prenom ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Email:</span>
                                    <span class="text-sm text-gray-700">{{ $detail_reservation->paiement->utilisateur->email ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Téléphone:</span>
                                    <span class="text-sm text-gray-700">{{ $detail_reservation->paiement->telephone }}</span>
                                </div>
                            </div>
                        @endif
                    {{-- </div> --}}
                    @endif
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
       
        .status-badge {
            display: inline-flex;
            align-items: center;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .status-badge:hover {
            transform: translateY(-2px);
        }

        /* Boutons améliorés */
      

        /* Typographie améliorée */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            color: #1a202c;
            line-height: 1.3;
            margin-bottom: 0.75rem;
        }
        
        h1 { font-size: 2.2rem; }
        h2 { font-size: 1.8rem; }
        h3 { font-size: 1.5rem; }
        h4 { font-size: 1.3rem; }
        h5 { font-size: 1.1rem; }
        h6 { font-size: 1rem; }
        
        .text-muted {
            color: #718096 !important;
            font-size: 0.9rem;
        }

        h5.card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .text-muted {
            color: #7f8c8d !important;
            font-size: 0.9rem;
        }

        /* Icônes améliorées */
        .fa, .fas, .far, .fab {
            width: 1.25em;
            text-align: center;
            vertical-align: middle;
        }
        
        /* Effet de vague dégradé */
        .wave-bg {
            position: relative;
            overflow: hidden;
        }
        
        .wave-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 10px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            opacity: 0.8;
        }

        /* Section trajet */
        .journey-timeline {
            position: relative;
            z-index: 1;
        }

        .journey-timeline::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #e9ecef;
            z-index: -1;
        }

        .timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.5rem;
        }

        .timeline-dot.start {
            background-color: #3498db;
            border: 2px solid #e3f2fd;
        }

        .timeline-dot.end {
            background-color: #2ecc71;
            border: 2px solid #e8f5e9;
        }

        /* Styles pour les cartes d'information */
        .info-card {
            padding: 1.5rem;
            border-radius: var(--border-radius);
            background: #fff;
            transition: var(--transition);
            border: 1px solid rgba(0, 0, 0, 0.03);
        }
        
        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }
        
        .info-card .icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        /* Effet de surbrillance au survol */
        .hover-highlight {
            transition: var(--transition);
        }
        
        .hover-highlight:hover {
            background-color: rgba(67, 97, 238, 0.05);
            border-left: 3px solid var(--primary-color);
            padding-left: 0.75rem;
            margin-left: -0.75rem;
        }
        
        /* Styles pour la timeline */
        .timeline {
            position: relative;
            padding-left: 2rem;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 0.5rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e2e8f0;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
            padding-left: 1.5rem;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -0.4rem;
            top: 0.25rem;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            background: var(--primary-color);
            border: 3px solid #fff;
            box-shadow: 0 0 0 2px var(--primary-color);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.25rem;
            }
            
            .timeline::before {
                left: 0.25rem;
            }
            
            .timeline-item {
                padding-left: 1.25rem;
            }
            
            .timeline-item::before {
                left: -0.3rem;
                width: 0.75rem;
                height: 0.75rem;
            }
            
            h1 { font-size: 1.8rem; }
            h2 { font-size: 1.5rem; }
            h3 { font-size: 1.3rem; }
            h4 { font-size: 1.1rem; }
        }
        
        /* Animation de chargement */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        /* Délai d'animation pour les éléments */
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
    </style>
</body>
</html>