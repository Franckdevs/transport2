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

            <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="ms-auto">
            <a href="{{ route('paiement.index') }}" class="btn btn-light animated-btn">
              <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
          </div>
        </div>

        <div class="row g-3 row-deck">


    <div class="row">
        <div class="col-12">
            <div class="card">

                {{-- <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Détails du Paiement</h4>
                    <a href="{{ route('paiement.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Retour
                    </a>
                </div> --}}

                <div class="card-body">
                    <div class="row">
                        <!-- Informations du Paiement -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Informations de Paiement</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                       
                                        <tr>
                                            <th>Montant</th>
                                            <td class="font-weight-bold">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                                        </tr>
                                        <tr>
                                            <th>Moyen de Paiement</th>
                                            <td>{{ $paiement->moyenPaiement ?? 'Non spécifié' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Code Paiement</th>
                                            <td>{{ $paiement->code_paiement ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Statut</th>
                                            <td>
                                               
                                                    <span class="badge bg-success">validé</span>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Date du Paiement</th>
                                            <td>{{ $paiement->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Informations du Client -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Informations du Client</h5>
                                </div>

                                {{-- <p>{{ dd($paiement->reservation) }}</p> --}}
                                @if($paiement->reservation->telephone_proprietaire == null && $paiement->reservation->nom_proprietaire == null)
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 40%">Nom</th>
                                            <td>{{ $paiement->utilisateur->nom ?? ($paiement->nom_usager ?? 'N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Prénom</th>
                                            <td>{{ $paiement->utilisateur->prenom ?? ($paiement->prenom_usager ?? 'N/A') }}</td>
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <td>
                                                {{ $paiement->utilisateur->email ?? ($paiement->email ?? 'N/A') }}
                                                @if($paiement->utilisateur && $paiement->utilisateur->email_verified_at)
                                                    <span class="badge bg-success ml-2">Vérifié</span>
                                                
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Téléphone</th>
                                            <td>
                                                @if($paiement->utilisateur)
                                                    <a href="tel:{{ $paiement->utilisateur->telephone }}" class="text-decoration-none">
                                                        <i class="fas fa-phone-alt me-2"></i>{{ $paiement->utilisateur->telephone }}
                                                    </a>
                                                @else
                                                    {{ $paiement->telephone ?? 'N/A' }}
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                @else
                               <span class="text-center mt-2 ">Reservation attribuée quelqu'un </span>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 40%">Nom complet</th>
                                            <td>{{ $paiement->nom_complet ?? 'N/A' }}</td>
                                        </tr>
                                    
                                        <tr>
                                            <th>Téléphone</th>
                                            <td>
                                                @if($paiement->telephone_proprietaire)
                                                    <a href="tel:{{ $paiement->telephone_proprietaire }}" class="text-decoration-none">
                                                        <i class="fas fa-phone-alt me-2"></i>{{ $paiement->telephone_proprietaire }}
                                                    </a>
                                                @else
                                                    {{ $paiement->telephone ?? 'N/A' }}
                                                @endif
                                            </td>
                                        </tr>

                                    </table>
                                </div>

                                @endif



                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Détails du Voyage -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Détails du Voyage</h5>
                                </div>
                                <div class="card-body">
                                    @if($paiement->voyage)
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width: 40%">Compagnie</th>
                                                <td>
                                                    @if($paiement->voyage->compagnie)
                                                        {{ $paiement->voyage->compagnie->nom_complet_compagnies ?? 'N/A' }}
                                                        @if($paiement->voyage->compagnie->logo)
                                                            <img src="{{ asset('logo_compagnie/' . $paiement->voyage->compagnie->logo) }}" alt="Logo" class="img-fluid ml-2" style="max-height: 30px;">
                                                        @endif
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            @if($paiement->voyage->gare)
                                                <tr>
                                                    <th>Gare de départ</th>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                            <div>
                                                                <div class="fw-medium">{{ $paiement->voyage->gare->nom_gare }}</div>
                                                                @if($paiement->voyage->gare->ville)
                                                                    <div class="text-muted small">{{ $paiement->voyage->gare->ville->nom_ville ?? '' }}</div>
                                                                @endif
                                                                @if($paiement->voyage->gare->adresse)
                                                                    <div class="text-muted small">{{ $paiement->voyage->gare->adresse }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                {{-- <th>Itinéraire</th>
                                                <td>
                                                    @if($paiement->voyage->itineraire)
                                                        {{ $paiement->voyage->itineraire->lieu_depart ?? 'N/A' }} 
                                                        <i class="fas fa-arrow-right mx-2"></i>
                                                        {{ $paiement->voyage->itineraire->lieu_arrivee ?? 'N/A' }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td> --}}
                                            </tr>
                                            <tr>
                                                <th>Date de Départ</th>
                                                <td>
                                                    @if($paiement->voyage->date_depart)
                                                        {{ \Carbon\Carbon::parse($paiement->voyage->date_depart)->format('d/m/Y') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <th> Heure de depart </th>
                                                <td>
                                                    @if ($paiement->voyage->heure_depart)
                                                        {{ \Carbon\Carbon::parse($paiement->voyage->heure_depart)->format('H:i') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            
                                        </table>
                                    @else
                                        <div class="alert alert-warning">Aucune information de voyage disponible pour ce paiement.</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Point d'Arrêt -->
                       <!-- Point d'Arrêt -->
<div class="col-md-6">
    <div class="card mb-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-map-marker-alt me-2 text-primary"></i>Détails du Trajet
            </h5>
        </div>
        <div class="card-body">
            {{-- @if($arretvoyage && $arret) --}}
                {{-- @if($arret_debut_arrive)
                <div class="mb-4">
                    <h6 class="text-muted mb-3">Points du Trajet</h6>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-bold">Départ</p>
                            <p class="mb-0">{{ $arret_debut_arrive->villeDepart->nom_ville ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="fas fa-flag-checkered text-success"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-bold">Arrivée</p>
                            <p class="mb-0">{{ $arret_debut_arrive->villeArrivee->nom_ville ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                @endif --}}

                @if($arret_debut_arrive)
    <div class="mb-4">
        <h6 class="text-muted mb-3">Points du Trajet</h6>

        <div class="d-flex justify-content-between">

            {{-- Départ --}}
            <div class="d-flex align-items-center me-4">
                <div class=" bg-opacity-10 p-2 rounded-circle me-2">
                    <i class="fas fa-map-marker-alt text-primary"></i>
                </div>
                <div>
                    <p class="mb-0 fw-bold">Départ</p>
                    <p class="mb-0">{{ $arret_debut_arrive->villeDepart->nom_ville ?? 'N/A' }}</p>
                </div>
            </div>

            {{-- Arrivée --}}
            <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 p-2 rounded-circle me-2">
                    <i class="fas fa-flag-checkered text-success"></i>
                </div>
                <div>
                    <p class="mb-0 fw-bold">Arrivée</p>
                    <p class="mb-0">{{ $arret_debut_arrive->villeArrivee->nom_ville ?? 'N/A' }}</p>
                </div>
            </div>

        </div>
    </div>
{{-- @endif --}}


            
                @if($arret_debut_arrive)
                <div class="p-3 bg-light rounded">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Prix du Trajet</h6>
                        <span class="badge  bg-opacity-10 text-primary fs-5 px-3 py-2">
                            {{ number_format($arret_debut_arrive->montant ?? 0, 0, ',', ' ') }} FCFA
                        </span>
                    </div>
                </div>
                @endif
            @else
                <div class="alert alert-warning mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>Aucune information d'arrêt disponible pour ce paiement.
                </div>
            @endif
        </div>
    </div>
</div>
                    </div>

                    <!-- Détails de la Réservation -->
                    @if($paiement->reservation)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Détails de la Réservation</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                     
                                        <tr>
                                            <th>Date de Réservation</th>
                                            <td>
                                                @if($paiement->reservation->created_at)
                                                    {{ $paiement->reservation->created_at->format('d/m/Y H:i') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                       
                                        <tr>
                                            <th>Numero de la Place</th>
                                            <td>{{ $paiement->reservation->numero_place ?? '1' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Informations de la Gare -->
                    @if($paiement->reservation && $paiement->reservation->gares)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Informations de la Gare</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Nom de la gare</th>
                                            <td>{{ $paiement->reservation->gares->nom_gare ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ville</th>
                                            <td>{{ $paiement->reservation->gares->ville?->nom_ville ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Adresse</th>
                                            <td>{{ $paiement->reservation->gares->adresse_gare ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Téléphone</th>
                                            <td>
                                                @if($paiement->reservation->gares->telephone_gare)
                                                    <a href="tel:{{ $paiement->reservation->gares->telephone_gare }}" class="text-decoration-none">
                                                        <i class="fas fa-phone-alt me-2"></i>{{ $paiement->reservation->gares->telephone_gare }}
                                                    </a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>
                                                @if($paiement->reservation->gares->email)
                                                    <a href="mailto:{{ $paiement->reservation->gares->email }}" class="text-decoration-none">
                                                        <i class="fas fa-envelope me-2"></i>{{ $paiement->reservation->gares->email }}
                                                    </a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Heures d'ouverture</th>
                                            <td>
                                                @if($paiement->reservation->gares->heure_ouverture && $paiement->reservation->gares->heure_fermeture)
                                                    {{ $paiement->reservation->gares->heure_ouverture }} - {{ $paiement->reservation->gares->heure_fermeture }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Services disponibles</th>
                                            <td>
                                                @if($paiement->reservation->gares->parking_disponible)
                                                    <span class="badge bg-info me-1">Parking</span>
                                                @endif
                                                @if($paiement->reservation->gares->wifi_disponible)
                                                    <span class="badge bg-primary">WiFi</span>
                                                @endif
                                                @if(!$paiement->reservation->gares->parking_disponible && !$paiement->reservation->gares->wifi_disponible)
                                                    Aucun service spécifié
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                {{-- <div class="card-footer text-right">
                    <button class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print"></i> Imprimer
                    </button>
                </div> --}}
            </div>
        </div>
    </div>


<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .card, .card * {
            visibility: visible;
        }
        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none;
        }
        .no-print, .card-header .btn {
            display: none !important;
        }
        .card-header {
            border-bottom: 1px solid #dee2e6 !important;
        }
    }
    .card {
        margin-bottom: 1.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }
    .table th {
        background-color: #f8f9fa;
    }
</style>


        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page footer -->
    @include('betro.all_element.footer')
  </div> <!-- end wrapper -->
</body>
</html>
