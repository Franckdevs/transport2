@php
    use App\Helpers\GlobalHelper;
@endphp
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@include('compagnie.all_element.header')

<body class="layout-1" data-luno="theme-blue">
    <!-- start: sidebar -->
    @include('compagnie.all_element.sidebar')

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
                                {{-- <h4 class="mb-1 text-primary">
                                    <i class="fa fa-receipt me-2"></i>Gestion des réservations
                                </h4> --}}
                                <p class="text-muted mb-0">Liste complète des réservations et statistiques</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte des statistiques -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h6 class="mb-1 text-primary">
                                    <i class="fa fa-chart-line me-2"></i>Chiffre d'affaires total
                                </h6>
                                <p class="text-muted mb-0">Montant cumulé de toutes les réservations</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <span class="badge bg-primary px-4 py-3 fs-5 fw-bold">
                                    {{ number_format($total_montant, 0, ',', ' ') }} FCFA
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte principale avec filtre et tableau -->
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white border-bottom py-3">
                        <div class="row align-items-center">
                          
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Formulaire de filtre par date -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card bg-light border-0">
                                    <div class="card-body py-3">
                                        <h6 class="mb-3 text-dark">
                                            <i class="fa fa-filter me-2 text-primary"></i>Filtrer par période
                                        </h6>
                                        <form method="GET" action="{{ route('liste_reservation') }}" class="row g-3 align-items-end">
                                            <div class="col-md-2">
                                                <label for="date_debut" class="form-label small fw-semibold text-muted">Date début</label>
                                                <input type="date" name="date_debut" id="date_debut" 
                                                       class="form-control form-control-sm" 
                                                       value="{{ request('date_debut') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="date_fin" class="form-label small fw-semibold text-muted">Date fin</label>
                                                <input type="date" name="date_fin" id="date_fin" 
                                                       class="form-control form-control-sm" 
                                                       value="{{ request('date_fin') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="ville_depart_id" class="form-label small fw-semibold text-muted">Ville de départ</label>
                                                <select name="ville_depart_id" id="ville_depart_id" class="form-select form-select-sm select2">
                                                    <option value="">Toutes les villes</option>
                                                    @foreach($villes as $ville)
                                                        <option value="{{ $ville->id }}" {{ request('ville_depart_id') == $ville->id ? 'selected' : '' }}>
                                                            {{ $ville->nom_ville }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <label for="statut" class="form-label small fw-semibold text-muted">Statut</label>
                                                <select name="statut" id="statut" class="form-select form-select-sm">
                                                    <option value="">Tous les statuts</option>
                                                    <option value="1" {{ request('statut') === '1' ? 'selected' : '' }}>Actif</option>
                                                    <option value="3" {{ request('statut') === '3' ? 'selected' : '' }}>Inactif</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary btn-lg me-2" id="applyFilterBtn">
                                                    <i class="fa fa-filter me-1"></i>
                                                    <span id="applyFilterText">Appliquer filtre</span>
                                                    <span id="applyFilterSpinner" class="spinner-border spinner-border-sm ms-2" style="display: none;" role="status">
                                                        <span class="visually-hidden">Chargement...</span>
                                                    </span>
                                                </button>
                                                <a href="{{ route('liste_reservation') }}" class="btn btn-outline-secondary btn-lg" id="resetFilterBtn">
                                                    <i class="fa fa-refresh me-1"></i>
                                                    <span id="resetFilterText">Réinitialiser</span>
                                                    <span id="resetFilterSpinner" class="spinner-border spinner-border-sm ms-2" style="display: none;" role="status">
                                                        <span class="visually-hidden">Chargement...</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="container">
    <h3 class="mb-4">Liste des réservations</h3>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom du voyage</th>
                <th>Date départ</th>
                <th>Ville de départ</th>
                <th>Ville d'arrivée</th>
                <th>Montant payé</th>
                <th>Statut</th>
                <th>Utilisateur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($liste_reservation as $index => $reservation)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $reservation->voyage->nom ?? 'Non défini' }}</td>
                    <td>{{ $reservation->voyage->date_depart ?? 'Non défini' }}</td>
                    
                    <td>
                        {{ $reservation->voyage->itineraire->arrets->first()->tarification->villeDepart->nom_ville ?? 'Non défini' }}
                    </td>

                    <td>
                        {{ $reservation->voyage->itineraire->arrets->last()->tarification->villeArrivee->nom_ville ?? 'Non défini' }}
                    </td>

                    <td>{{ $reservation->paiement->montant ?? 0 }} FCFA</td>
                    <td>{{ $reservation->status ?? 'Non défini' }}</td>
                    <td>{{ $reservation->utilisateur->name ?? 'Non défini' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-end"><strong>Total Montant :</strong></td>
                <td colspan="3"><strong>{{ $total_montant }} FCFA</strong></td>
            </tr>
        </tfoot>
    </table>
</div> --}}
                        <!-- Tableau responsive -->
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover align-middle mb-0" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">
                                            Ville de départ
                                        </th>
                                        <th>
                                            Ville d'arrivée
                                        </th>
                                        <th>
                                            Montant
                                        </th>
                                        <th>
                                            Durée estimée
                                        </th>
                                        <th>
                                            Date départ
                                        </th>
                                       
                                        <th>
                                            Statut
                                        </th>
                                        <th class="text-center pe-4">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($liste_reservation as $reservation)
                                        <tr class="border-bottom">
                                            <td class="ps-4 fw-semibold text-dark">
                                                {{-- {{ $reservation->voyage->itineraire->ville->nom_ville ?? 'Non défini' }} --}}
                                                {{ $reservation->voyage->itineraire->arrets->first()->tarification->villeDepart->nom_ville ?? 'Non défini' }}
                                            </td>
                                            <td>
                                                <span class="text-truncate" style="max-width: 150px;">
                                                    {{-- {{ $reservation->arretvoyage->arret->gare->ville->nom_ville ?? 'Non défini' }} --}}
                                                    {{ $reservation->voyage->itineraire->arrets->last()->tarification->villeArrivee->nom_ville ?? 'Non défini' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="">
                                                    {{ number_format($reservation->paiement->montant ?? 0, 0, ',', ' ') }} FCFA
                                                </span>
                                            </td>
                                            <td class="text-muted">
                                                <small>
                                                    <i class="fa fa-clock me-1"></i>
                                                    {{ $reservation->voyage->itineraire->estimation ?? 'Non défini' }}
                                                </small>
                                            </td>
                                            {{-- <td class="text-muted">
                                                <small>
                                                    <i class="fa fa-calendar me-1"></i>
                                                    {{ $reservation->voyage->date_depart 
                                                        ? \Carbon\Carbon::parse($reservation->voyage->date_depart)->format('d/m/Y') 
                                                        : 'Non défini' }}
                                                </small>
                                            </td> --}}
                                            <td class="text-muted">
    <small>
        <i class="fa fa-calendar me-1"></i>
        {{ $reservation->voyage->date_depart
            ? \Carbon\Carbon::parse($reservation->voyage->date_depart)->format('d/m/Y')
            : \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y')
             }}
    </small>
</td>

                                          
                                            <td>
                                                @if($reservation->paiement->status == 1)
                                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                                        <i class="fa fa-check-circle me-1"></i>Payé
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">
                                                        <i class="fa fa-clock me-1"></i>En attente
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('voir_detail_reservation.show', $reservation->id) }}" 
                                                       class="btn btn-warning btn-sm" >
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('compagnie.all_element.footer')
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialiser Select2
            $('.select2').select2({
                placeholder: "Sélectionner une ville",
                allowClear: true,
                width: '100%'
            });

            // Initialisation de DataTable
            const table = new DataTable('#myTable', {
                language: {
                    search: "",
                    searchPlaceholder: "Rechercher...",
                    lengthMenu: "Afficher _MENU_ éléments",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                    infoEmpty: "Affichage de 0 à 0 sur 0 éléments",
                    infoFiltered: "(filtrés depuis _MAX_ éléments au total)",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent"
                    }
                },
                responsive: true,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tous"]]
            });

            // Recherche personnalisée
            const searchInput = document.getElementById('customSearch');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    table.search(this.value).draw();
                });
            }

            // Initialisation des tooltips Bootstrap
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Gestionnaire d'événement pour le bouton Appliquer filtre
            const applyFilterBtn = document.getElementById('applyFilterBtn');
            const applyFilterText = document.getElementById('applyFilterText');
            const applyFilterSpinner = document.getElementById('applyFilterSpinner');

            if (applyFilterBtn) {
                applyFilterBtn.addEventListener('click', function(e) {
                    // Laisser le formulaire se soumettre normalement
                    // mais ajouter un feedback visuel après un court délai
                    setTimeout(() => {
                        applyFilterBtn.disabled = true;
                        applyFilterText.textContent = 'Appliquer filtre';
                        applyFilterSpinner.style.display = 'inline-block';
                    }, 100);
                });
            }

            // Gestionnaire d'événement pour le bouton Réinitialiser
            const resetFilterBtn = document.getElementById('resetFilterBtn');
            const resetFilterText = document.getElementById('resetFilterText');
            const resetFilterSpinner = document.getElementById('resetFilterSpinner');

            if (resetFilterBtn) {
                resetFilterBtn.addEventListener('click', function(e) {
                    // Désactiver le bouton et montrer le spinner
                    resetFilterBtn.disabled = true;
                    resetFilterText.textContent = 'Réinitialiser';
                    resetFilterSpinner.style.display = 'inline-block';
                    
                    // Simuler un léger délai pour montrer le spinner avant la redirection
                    setTimeout(() => {
                        window.location.href = resetFilterBtn.href;
                    }, 300);
                });
            }
        });
    </script>

   
</body>
</html>