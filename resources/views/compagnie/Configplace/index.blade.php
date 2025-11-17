@php
use App\Helpers\GlobalHelper;
@endphp
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">

@include('compagnie.all_element.header')

<body class="layout-1" data-luno="theme-blue">

    <!-- Sidebar -->
    @include('compagnie.all_element.sidebar')

    <!-- Body area -->
    <div class="wrapper">

        <!-- Page header -->
        <header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
            <div class="container-fluid">
                <nav class="navbar">
                    @include('compagnie.all_element.navbar')
                </nav>
            </div>
        </header>

        <!-- Toolbar -->
        @include('compagnie.all_element.cadre')

        <!-- Page content -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">

                <!-- Bouton Ajouter -->
                <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                    <h5 class="mb-0">Liste des configurations de bus</h5>
                    <a href="{{ route('creationConfig.creation') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Ajouter configuration
                    </a>
                </div>

                <!-- Tableau -->
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-body">

                            <table id="myTable" class="table display nowrap table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom config</th>
                                        <th>Description</th>
                                        <th>Nombre de places</th>
                                        <th>Date création</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($configurations as $config)
                                        <tr>
                                            <td>{{ Str::limit($config->nom ?? '-', 15) }}</td>
<td>{{ Str::limit($config->description ?? '-', 15) }}</td>
                                            <td>{{ $config->placeconfigbussave->count() }} sièges</td>
                                            <td>{{ $config->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                {{-- @if($config->placeconfigbussave->where('disponible', true)->count() > 0)
                                                    <span class="badge bg-success">Actif</span>
                                                @else
                                                    <span class="badge bg-danger">Inactif</span>
                                                @endif --}}
                                                @if($config->status == 1)
                                                    <span class="badge bg-success">Actif</span>
                                                @else
                                                    <span class="badge bg-danger">Inactif</span>
                                                @endif
                                            </td>
                                           <td>
    <a href="{{ route('config.show', $config->id) }}" class="btn btn-sm btn-info">
        <i class="fa fa-eye"></i>
    </a>

<a href="{{ route('config.edit', $config->id) }}" class="btn btn-sm btn-primary">
    <i class="fa fa-edit"></i>
</a>

@if($config->status == 1)
    <form id="deactivateForm-{{ $config->id }}" action="{{ route('config.desactivation', $config->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDeactivation({{ $config->id }})">
            <i class="fas fa-ban"></i>
        </button>
    </form>
@else
    <form id="activateForm-{{ $config->id }}" action="{{ route('config.activation', $config->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="button" class="btn btn-sm btn-success" onclick="confirmActivation({{ $config->id }})">
            <i class="fa fa-check"></i>
        </button>
    </form>
@endif


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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Initialisation de DataTable
        document.addEventListener("DOMContentLoaded", function() {
            const table = new DataTable('#myTable');
            const searchInput = document.getElementById('customSearchBus');
            if(searchInput){
                searchInput.addEventListener('input', function() {
                    table.search(this.value);
                });
            }
        });

        // Fonction de confirmation de désactivation
        function confirmDeactivation(configId) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: 'Voulez-vous vraiment désactiver cette configuration ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, désactiver',
                cancelButtonText: 'Annuler',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deactivateForm-' + configId).submit();
                }
            });
            return false;
        }

        // Fonction de confirmation d'activation
        function confirmActivation(configId) {
            Swal.fire({
                title: 'Confirmer l\'activation',
                text: 'Voulez-vous activer cette configuration ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, activer',
                cancelButtonText: 'Annuler',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('activateForm-' + configId).submit();
                }
            });
            return false;
        }
    </script>

</body>
</html>
