@php
    use App\Helpers\GlobalHelper;
@endphp
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">

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
                <div class="row g-xl-3 g-2 mb-3">
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                                    <h5 class="mb-0">Liste des voyages</h5>
                                    <a href="{{ route('voyage.create') }}" class="btn btn-success">
                                        <i class="fa fa-plus"></i> Ajouter un itinéraire
                                    </a>
                                </div>

                                <table id="myTable" class="table display dataTable table-hover w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Itinéraire</th>
                                            <th>Compagnie</th>
                                            <th>Montant</th>
                                            <th>Heure de départ</th>
                                            <th>Date de départ</th>
                                            <th>Bus</th>
                                            <th>Chauffeur</th>
                                    <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($voyages as $voyage)
                                            <tr>
                                                <td>{{ $voyage->id }}</td>
<td>{{ \Illuminate\Support\Str::limit($voyage->itineraire->titre ?? 'N/A', 10, '....') }}</td>
<td>{{ \Illuminate\Support\Str::limit($voyage->info_user->nom ?? 'N/A', 10, '...') }}</td>

                                                <td>{{ number_format($voyage->montant, 0, ',', ' ') }} FCFA</td>
                                                <td>{{ $voyage->heure_depart ? \Carbon\Carbon::parse($voyage->heure_depart)->format('H:i') : 'N/A' }}</td>
                                                <td>{{ $voyage->date_depart ? \Carbon\Carbon::parse($voyage->date_depart)->format('d/m/Y') : 'N/A' }}</td>
<td>{{ \Illuminate\Support\Str::limit($voyage->bus->nom_bus ?? 'N/A', 10) }}</td>
<td>
    {{ \Illuminate\Support\Str::limit(($voyage->chauffeur->nom ?? 'N/A') . ' ' . ($voyage->chauffeur->prenom ?? ''), 10, '') }}
</td>
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

                                                    @if($voyage->status == 1)
            <!-- Bouton Désactiver -->
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDestroy{{ $voyage->id }}">
                <i class="fa fa-trash"></i>
            </button>

            <!-- Modal Désactivation -->
            <div class="modal fade" id="confirmDestroy{{ $voyage->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $voyage->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel{{ $voyage->id }}">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    Voulez-vous vraiment désactiver ce voyage ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="{{ route('voyage.destroy', $voyage->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Oui, désactiver</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        @elseif($voyage->status == 3)
            <!-- Bouton Réactiver -->
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmReactivate{{ $voyage->id }}">
                <i class="fa fa-undo"></i>
            </button>

            <!-- Modal Réactivation -->
            <div class="modal fade" id="confirmReactivate{{ $voyage->id }}" tabindex="-1" aria-labelledby="modalReactivateLabel{{ $voyage->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalReactivateLabel{{ $voyage->id }}">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    Voulez-vous vraiment réactiver ce voyage ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="{{ route('voyage.reactivation', $voyage->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Oui, réactiver</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        @endif
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
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <script>
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
