@php
    use App\Helpers\GlobalHelper;
@endphp
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
                    <!-- start: toggle btn -->
                    <!-- start: search area -->
                    @include('compagnie.all_element.navbar')
                    <!-- start: link -->

                </nav>
            </div>
        </header>
        <!-- start: page toolbar -->
        @include('compagnie.all_element.cadre')

        <!-- start: page body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-xl-3 g-2 mb-3">

                    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
                        <div class="container-fluid">
                            <div class="row g-3 row-deck">


                                <div class="col-md-12 mt-4">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                                                <h5 class="mb-0">Liste des voyages</h5>
                                                <a href="{{ route('voyage.create') }}" class="btn btn-success">
                                                    <i class="fa fa-plus"></i> Ajouter un itineraire
                                                </a>

                                            </div>

                                            <table id="myTable" class="table display dataTable table-hover"
                                                style="width:100%">
                                                <thead>
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
                                                            <td>{{ $voyage->montant }} FCFA</td>
                                                            <td>{{ $voyage->heure_depart ? \Carbon\Carbon::parse($voyage->heure_depart)->format('H:i') : 'N/A' }}
                                                            </td>
                                                            <td>{{ $voyage->date_depart ? \Carbon\Carbon::parse($voyage->date_depart)->format('d/m/Y') : 'N/A' }}
                                                            </td>

                                                            <td>{{ $voyage->bus->nom_bus ?? 'N/A' }}</td>
                                                            <td>{{ $voyage->chauffeur->nom ?? 'N/A' }}
                                                                {{ $voyage->chauffeur->prenom ?? 'N/A' }}</td>
                                                            <td>
                                                                <a href="{{ route('voyage.show', $voyage->id) }}"
                                                                    class="btn btn-primary btn-sm">Voir</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>



                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('#myTable').addClass('nowrap').dataTable({
                                            responsive: true,
                                        });
                                    });
                                </script>

                            </div> <!-- .row end -->
                        </div>
                    </div>



                </div> <!-- .row end -->



            </div>
        </div>
        <!-- start: page footer -->

        @include('compagnie.all_element.footer')
    </div>

    <!-- Jquery Page Js -->
    <script src="../assets/js/theme.js"></script>
    <!-- Plugin Js -->
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
    <!-- Vendor Script -->
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

</body>

</html>
