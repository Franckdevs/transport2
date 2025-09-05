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
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($voyages as $voyage)
                                            <tr>
                                                <td>{{ $voyage->id }}</td>
                                                <td>{{ $voyage->itineraire->titre ?? 'N/A' }}</td>
                                                <td>{{ $voyage->info_user->nom ?? 'N/A' }}</td>
                                                <td>{{ number_format($voyage->montant, 0, ',', ' ') }} FCFA</td>
                                                <td>{{ $voyage->heure_depart ? \Carbon\Carbon::parse($voyage->heure_depart)->format('H:i') : 'N/A' }}</td>
                                                <td>{{ $voyage->date_depart ? \Carbon\Carbon::parse($voyage->date_depart)->format('d/m/Y') : 'N/A' }}</td>
                                                <td>{{ $voyage->bus->nom_bus ?? 'N/A' }}</td>
                                                <td>{{ $voyage->chauffeur->nom ?? 'N/A' }} {{ $voyage->chauffeur->prenom ?? '' }}</td>
                                                <td>
                                                    <a href="{{ route('voyage.show', $voyage->id) }}" class="btn btn-primary btn-sm">
                                                        Voir
                                                    </a>
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
