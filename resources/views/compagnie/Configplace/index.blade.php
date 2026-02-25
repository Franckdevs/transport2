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

                <!-- En-tête avec bouton à droite -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    {{-- <h1 class="page-title mb-0">
                        <i class="fas fa-cog me-2"></i>Liste des configurations de bus
                    </h1> --}}
                    <div class="ms-auto">
                        <a href="{{ route('creationConfig.creation') }}" class="btn btn-warning">
                            <i class="fas fa-plus me-2"></i>Ajouter une configuration
                        </a>
                    </div>
                </div>

                <!-- Tableau -->
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        {{-- <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-table me-2"></i>Liste des configurations
                            </h5>
                        </div> --}}
                        <div class="card-body">
                            <!-- Filtre par statut -->
                            <div class="mb-3">
                                <label for="statusFilter" class="form-label">Filtrer par statut :</label>
                                <select id="statusFilter" class="form-select" style="width:200px">
                                    <option value="">Tous</option>
                                    <option value="1">Actif</option>
                                    <option value="3">Inactif</option>
                                </select>
                            </div>

                            <table id="myTable" class="table display nowrap table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom config</th>
                                        <th>Description</th>
                                        <th>Nombre de places</th>
                                        <th>Date création</th>
                                        <th data-orderable="false">Statut</th>
                                        <th data-orderable="false">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($configurations as $config)
                                        <tr>
                                            <td>{{ Str::limit($config->nom ?? '-', 20) }}</td>
<td>{{ Str::limit($config->description ?? '-', 15) }}</td>
                                            <td>{{ $config->placeconfigbussave->count() }} sièges</td>
                                            <td>{{ $config->created_at->format('d/m/Y H:i') }}</td>
                                            <td data-search="{{ $config->status }}">
                                                @if($config->status == 1)
                                                    <span class="badge bg-success">Actif</span>
                                                @else
                                                    <span class="badge bg-danger">Inactif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('config.edit', $config->id) }}" class="btn btn-sm btn-warning me-1">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('config.show', $config->id) }}" class="btn btn-sm btn-info me-1">
                                                    <i class="fa fa-eye"></i>
                                                </a>

{{-- @if($config->status == 1)
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
@endif --}}


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

        <script src="https://cdn.datatables.net/responsive/3.0.7/js/dataTables.responsive.js"></script>
    <script src='https://cdn.datatables.net/responsive/3.0.7/js/dataTables.responsive.js'></script>

    <script>
        // Initialisation de DataTable
        document.addEventListener("DOMContentLoaded", function() {
            const table = new DataTable('#myTable', {
                pageLength: 10,
                responsive: true,
                lengthMenu: [5, 10, 25, 50],
                // order: [[0, 'asc']], // Tri par ID croissant (du plus ancien au plus récent)
                // order: [[0, 'desc']], // Tri par date de création décroissante
                language: {
                    search: "Rechercher :",
                    lengthMenu: "Afficher _MENU_ lignes",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    infoEmpty: "Affichage de 0 à 0 sur 0 entrées",
                    infoFiltered: "(filtré à partir de _MAX_ entrées totales)",
                    paginate: {
                        next: "Suivant",
                        previous: "Précédent"
                    }
                },
                // Réinitialiser le filtre lors du rechargement de la table
                initComplete: function() {
                    $('#statusFilter').val('');
                }
            });

            // Fonction de filtrage personnalisée
            function filterStatus(settings, data, dataIndex) {
                const statusFilterValue = $('#statusFilter').val();
                if (!statusFilterValue) return true; // Afficher toutes les lignes si pas de filtre
                
                // La colonne 4 contient le statut (index 0-based)
                const statusCell = $(table.row(dataIndex).node()).find('td:eq(4)');
                const statusValue = statusCell.attr('data-search');
                
                // Vérifier la correspondance avec les valeurs de statut
                return statusValue === statusFilterValue;
            }
            
            // Supprimer tous les filtres existants
            $.fn.dataTable.ext.search = [];
            
            // Ajouter notre filtre personnalisé
            $.fn.dataTable.ext.search.push(filterStatus);

            // Événement de changement du filtre
            $('#statusFilter').on('change', function() {
                table.draw();
            });
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

        //     @if(session('success'))
        //     Swal.fire({
        //         title: 'Succès !',
        //         text: '{{ session('success') }}',
        //         icon: 'success',
        //         timer: 3000,
        //         showConfirmButton: false
        //     });
        // @endif
    </script>

</body>
</html>
