@php
    use App\Helpers\GlobalHelper;
@endphp
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@include('compagnie.all_element.header')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

{{-- <body class="layout-1" data-luno="theme-blue"> --}}
        {{-- @include('compagnie.all_element.color_global') --}}

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
                <!-- En-tête avec bouton à droite -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                  
                    <div class="ms-auto">
                        <a href="{{ route('voyage.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus-circle me-2"></i>Ajouter un voyage
                        </a>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Filtres -->
                        <div class="border rounded p-3 mb-3">
                        <form id="filterForm" method="GET" action="{{ route('voyage.index') }}" class="row g-3">
                            <div class="col-md-2">
                                <label for="date_debut" class="form-label">Date début</label>
                                <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ request('date_debut') }}">
                            </div>
                            <div class="col-md-2">
                                <label for="date_fin" class="form-label">Date fin</label>
                                <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ request('date_fin') }}">
                            </div>
                            <div class="col-md-2">
                                <label for="status" class="form-label">Statut</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">Tous les statuts</option>
                                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Actif</option>
                                    <option value="3" {{ request('status') === '3' ? 'selected' : '' }}>Inactif</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="ville_depart_id" class="form-label">Ville de départ</label>
                                <select name="ville_depart_id" id="ville_depart_id" class="form-select select2">
                                    <option value="">Toutes les villes</option>
                                    @foreach($villes as $ville)
                                        <option value="{{ $ville->id }}" {{ request('ville_depart_id') == $ville->id ? 'selected' : '' }}>
                                            {{ $ville->nom_ville }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="ville_arrivee_id" class="form-label">Ville d'arrivée</label>
                                <select name="ville_arrivee_id" id="ville_arrivee_id" class="form-select select2">
                                    <option value="">Toutes les villes</option>
                                    @foreach($villes as $ville)
                                        <option value="{{ $ville->id }}" {{ request('ville_arrivee_id') == $ville->id ? 'selected' : '' }}>
                                            {{ $ville->nom_ville }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="ville_arret_id" class="form-label">Ville d'arrêt</label>
                                <select name="ville_arret_id" id="ville_arret_id" class="form-select select2">
                                    <option value="">Toutes les villes</option>
                                    @foreach($villes as $ville)
                                        <option value="{{ $ville->id }}" {{ request('ville_arret_id') == $ville->id ? 'selected' : '' }}>
                                            {{ $ville->nom_ville }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 d-flex align-items-end">
                                <button type="submit" class="btn btn-warning me-1" id="filterBtn" style="min-width: 180px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-filter me-1"></i>
                                    <span id="filterText">Filtrer</span>
                                    <span class="spinner-border spinner-border-sm d-none ms-1" id="filterSpinner" role="status" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-secondary" id="resetBtn" onclick="window.location.href='{{ route('voyage.index') }}'" style="min-width: 180px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-redo me-1"></i>
                                    <span id="resetText">Réinitialiser</span>
                                    <span class="spinner-border spinner-border-sm d-none ms-1" id="resetSpinner" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
                        </div>

                                <table id="myTable" class="table display dataTable table-hover w-100">
                                    <thead class="table-light">
                                        <tr>
                                            {{-- <th>Itinéraire</th> --}}
                                            <th>Villes du parcours</th>
                                            {{-- <th>Compagnie</th> --}}
                                            {{-- <th>Montant</th> --}}
                                            <th>Heure de départ</th>
                                            <th>Date de départ</th>
                                            <th>Bus</th>
                                            <th>Chauffeur</th>
                                            <th>Date de création</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($voyages as $voyage)
                                            <tr>
{{-- <td>{{ \Illuminate\Support\Str::limit($voyage->itineraire->titre ?? 'N/A', 10, '....') }}</td> --}}
<td>
    @php
        $villes = collect();
        // Ajouter la ville de départ
        if ($voyage->itineraire->ville) {
            $villes->push($voyage->itineraire->ville->nom_ville);
        }
        // Ajouter les villes des arrêts
        if ($voyage->itineraire->arrets) {
            foreach ($voyage->itineraire->arrets->sortBy('id') as $arret) {
                if ($arret->gare && $arret->gare->ville) {
                    $villes->push($arret->gare->ville->nom_ville);
                }
            }
        }
        $villesString = $villes->unique()->implode(' → ');
        $villesList = $villes->unique()->implode('<br>');
    @endphp
    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" 
          title="{{ $villesList }}">
        {{ \Illuminate\Support\Str::limit($villesString, 15, '...') }}
    </span>
</td>
{{-- <td>{{ \Illuminate\Support\Str::limit($voyage->info_user->nom ?? 'N/A', 10, '...') }}</td> --}}

                                                {{-- <td>{{ number_format($voyage->montant, 0, ',', ' ') }} FCFA</td> --}}
                                                <td>{{ $voyage->heure_depart ? \Carbon\Carbon::parse($voyage->heure_depart)->format('H:i') : 'N/A' }}</td>
                                                <td>@if ($voyage->disponible_toujours)
                                                    <span class="badge bg-success">Tous les jours</span>
                                                @else
                                                    {{ $voyage->date_depart ? \Carbon\Carbon::parse($voyage->date_depart)->format('d/m/Y') : 'N/A' }}
                                                @endif
         
                                                </td>
                                                <td>{{ \Illuminate\Support\Str::limit($voyage->bus->nom_bus ?? 'N/A', 10) }}</td>
                                                <td>
                                                    {{ \Illuminate\Support\Str::limit(($voyage->chauffeur->nom ?? 'N/A') . ' ' . ($voyage->chauffeur->prenom ?? ''), 10, '') }}
                                                </td>
                                                <td>{{ $voyage->created_at ? \Carbon\Carbon::parse($voyage->created_at)->format('d/m/Y H:i') : 'N/A' }}</td>
<td>
    <span class="badge 
        {{ $voyage->status == 1 ? 'bg-success' : ($voyage->status == 2 ? 'bg-warning' : 'bg-danger') }}">
        {{ $voyage->status == 1 ? 'Actif' : ($voyage->status == 2 ? 'En attente' : 'Inactif') }}
    </span>
</td>
                                                <td>
                                                    <a href="{{ route('voyage.show', $voyage->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('voyage.edit', $voyage->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{-- <a href="
                                                    {{ route('itineraire.edit', $voyage->id) }}
                                                    " class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a> --}}

                                                    {{-- @if($voyage->status == 1)
            <!-- Bouton Désactiver -->
            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeactivate({{ $voyage->id }})">
                <i class="fa fa-trash"></i>
            </button>
            
            <!-- Formulaire de désactivation masqué -->
            <form id="destroy-form-{{ $voyage->id }}" action="{{ route('voyage.destroy', $voyage->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @elseif($voyage->status == 3)
            <!-- Bouton Réactiver -->
            <button type="button" class="btn btn-success btn-sm" onclick="confirmReactivate({{ $voyage->id }})">
                <i class="fa fa-undo"></i>
            </button>
            
            <!-- Formulaire de réactivation masqué -->
            <form id="reactivate-form-{{ $voyage->id }}" action="{{ route('voyage.reactivation', $voyage->id) }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div> <!-- .row end -->
            </div>
        </div>

        <!-- start: page footer -->
        @include('compagnie.all_element.footer')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Initialiser Select2
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Sélectionner une ville",
                allowClear: true,
                width: '100%'
            });

            // Gérer les spinners au clic sur les boutons
            $('#filterBtn').on('click', function() {
                $('#filterSpinner').removeClass('d-none');
            });

            $('#resetBtn').on('click', function() {
                $('#resetSpinner').removeClass('d-none');
            });
        });

        // Fonction de confirmation de désactivation
        function confirmDeactivate(voyageId) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Voulez-vous vraiment désactiver ce voyage ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, désactiver',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire de désactivation
                    document.getElementById('destroy-form-' + voyageId).submit();
                }
            });
        }

        // Fonction de confirmation de réactivation
        function confirmReactivate(voyageId) {
            Swal.fire({
                title: 'Réactiver le voyage',
                text: "Voulez-vous réactiver ce voyage ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, réactiver',
                cancelButtonText: 'Annuler',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire de réactivation
                    document.getElementById('reactivate-form-' + voyageId).submit();
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Initialiser DataTable
            const table = new DataTable('#myTable');

            // Filtre custom si tu veux un input externe
            const searchInput = document.getElementById('customSearch');
            if(searchInput){
                searchInput.addEventListener('input', function() {
                    table.search(this.value).draw();
                });
            }

            // Initialiser tous les tooltips (Bootstrap 5)
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
</body>
</html>
