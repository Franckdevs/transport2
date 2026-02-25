@php
    use App\Helpers\GlobalHelper;
@endphp
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
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

        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <!-- En-tête avec bouton à droite -->
                <div class="d-flex justify-content-between align-items-center mb-2">
                    {{-- <h1 class="page-title mb-0">
                        <i class="fas fa-bus me-2"></i>Liste des bus
                    </h1> --}}
                    <div class="ms-auto">
                        <a href="{{ route('bus.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus me-2"></i>Ajouter un bus
                        </a>
                    </div>
                </div>

                  <style>
        /* Styles pour les boutons de la DataTable */
        .btn-sm {
            min-width: 50px;
            width: 50px;
            height: 50px;
            padding: 0.25rem 0.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Assure que les icônes sont centrées */
        .btn-sm i {
            margin: 0;
            padding: 0;
            font-size: 0.875rem;
            line-height: 1;
        }
        
        /* Empêche le débordement des boutons dans les cellules */
        td {
            white-space: nowrap;
        }
        
        /* Style pour la colonne d'actions */
        .actions-cell {
            white-space: nowrap;
            width: 90px; /* Largeur fixe pour la colonne d'actions */
        }
    </style>




                <div class="row g-3 row-deck">
                    <div class="col-md-12">
                        <div class="card shadow-sm">
                            {{-- <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-table me-2"></i>Liste des véhicules
                                </h5>
                            </div> --}}
                            <div class="card-body">
                                <!-- Barre de recherche personnalisée -->

                                <div class="mb-3">
                                    <label for="statusFilter" class="form-label">Filtrer par statut :</label>
                                    <select id="statusFilter" class="form-select" style="width:200px">
                                        <option value="">Tous</option>
                                        <option value="1">Actif</option>
                                        <option value="0">Inactif</option>
                                    </select>
                                </div>

                                <!-- Tableau -->
                                <table id="myTable" class="display responsive nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom du bus</th>
                                            <th>Modèle</th>
                                            <th>Marque</th>
                                            <th>Immatriculation</th>
                                            <th>Date de création</th>
                                            <th>Statut</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bus as $bu)
                                            <tr>
                                                <td class="actions-cell">{{ $bu->id }}</td>
                                                <td class="actions-cell">{{ Str::limit($bu->nom_bus ?? 'Aucun nom', 12) }}</td>
                                                <td class="actions-cell">{{ Str::limit($bu->modele_bus ?? 'Non défini', 12) }}</td>
                                                <td class="actions-cell">{{ Str::limit($bu->marque_bus ?? 'Non défini', 12) }}</td>
                                                <td class="actions-cell">{{ Str::limit($bu->immatriculation_bus ?? 'Non défini', 10) }}</td>
                                                <td class="actions-cell">{{ GlobalHelper::formatCreatedAt($bu->created_at) }}</td>
                                                <td class="actions-cell">
                                                    @if ($bu->status == 1)
                                                        <span class="badge bg-success">Actif</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactif</span>
                                                    @endif
                                                </td>
                                                <td class="actions-cell">
                                                    <a href="{{ route('bus.edit', $bu->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a href="{{ route('bus.show', $bu->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    {{-- @if ($bu->status == 1)
    <!-- Bouton Blocage avec SweetAlert2 -->
    <form action="{{ route('bus.destroy', $bu->id) }}" method="POST" class="status-change-form" style="display:inline;">
        @csrf
        <button type="button" class="btn btn-warning btn-sm block-bus" 
                data-bus-name="{{ $bu->nom_bus }}"
                data-action="bloquer">
            <i class="fas fa-ban"></i>
        </button>
    </form>
@else
    <!-- Bouton Débloquer avec SweetAlert2 -->
    <form action="{{ route('activation.bus', $bu->id) }}" method="POST" class="status-change-form" style="display:inline;">
        @csrf
        <button type="button" class="btn btn-success btn-sm unblock-bus" 
                data-bus-name="{{ $bu->nom_bus }}"
                data-action="débloquer">
            <i class="fas fa-check-circle"></i>
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
        </div>

        @include('compagnie.all_element.footer')
    </div>
    

    
    
    <!-- Jquery + DataTables 2.x + SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  
    <script src="https://cdn.datatables.net/responsive/3.0.7/js/dataTables.responsive.js"></script>
    <script src='https://cdn.datatables.net/responsive/3.0.7/js/dataTables.responsive.js'></script>
  
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.js"></script>
    <!-- DataTable + recherche personnalisée + SweetAlert2 Confirmation -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = new DataTable('#myTable', {
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                order: [
                    [0, 'desc']
                ], // tri par ID décroissant (du plus récent au plus ancien)
                language: {
                    search: "Rechercher :",
                    lengthMenu: "Afficher _MENU_ lignes",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    infoEmpty: "Affichage de 0 à 0 sur 0 entrées",
                    paginate: {
                        next: "Suivant",
                        previous: "Précédent"
                    }
                },
                columnDefs: [{
                        target: 0, // Première colonne (ID)
                        visible: false, // Masquer la colonne
                        searchable: false // Ne pas inclure dans la recherche
                    },
                    {
                        targets: [5], // Colonne statut
                        orderable: false, // Désactiver le tri sur la colonne statut
                        searchable: true
                    },
                    {
                        targets: [6], // Colonne actions
                        orderable: false, // Désactiver le tri sur la colonne actions
                        searchable: false
                    },
                    {
                        targets: [4], // Colonne date
                        searchable: false
                    },
                    {
                        targets: [3], // Colonne marque
                        type: 'string'
                    }
                ]
            });

            // Filtre par statut
            const statusFilter = document.getElementById('statusFilter');
            
            // Fonction pour filtrer le tableau
            function filterByStatus(statusValue) {
                return function(settings, data, dataIndex) {
                    if (statusValue === '') return true; // Afficher toutes les lignes si pas de filtre
                    
                    const rowData = table.row(dataIndex).data();
                    const statusText = $(rowData[6]).text().trim(); // Colonne de statut (index 6)
                    
                    if (statusValue === '1') {
                        return statusText === 'Actif';
                    } else {
                        return statusText === 'Inactif';
                    }
                };
            }

            // Gestionnaire d'événement pour le filtre
            statusFilter.addEventListener('change', function() {
                const value = this.value;
                
                // Supprimer les anciens filtres
                $.fn.dataTable.ext.search = [];
                
                if (value !== '') {
                    // Ajouter le nouveau filtre
                    $.fn.dataTable.ext.search.push(filterByStatus(value));
                }
                
                // Redessiner le tableau
                table.draw();
            });

            // Détection dynamique des boutons via delegation
            const tableBody = document.querySelector('#myTable tbody');

            // Initialisation des tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            function handleStatusChange(button, action) {
                const form = button.closest('form');
                const busName = button.getAttribute('data-bus-name') || 'ce bus';
                const actionTitle = action === 'bloquer' ? 'Bloquer le bus' : 'Débloquer le bus';
                const actionTextConfirm = action === 'bloquer' ? 'bloquer' : 'débloquer';
                const icon = action === 'bloquer' ? 'warning' : 'info';

                Swal.fire({
                    title: `${actionTitle} ?`,
                    html: `Voulez-vous vraiment <strong>${actionTextConfirm}</strong> le bus <strong>${busName}</strong> ?`,
                    icon: icon,
                    showCancelButton: true,
                    confirmButtonColor: action === 'bloquer' ? '#ffc107' : '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: `Oui, ${actionTextConfirm}`,
                    cancelButtonText: 'Annuler',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }

            // Event delegation pour bloquer/débloquer
            tableBody.addEventListener('click', function(e) {
                if (e.target.closest('.block-bus')) {
                    e.preventDefault();
                    handleStatusChange(e.target.closest('.block-bus'), 'bloquer');
                }

                if (e.target.closest('.unblock-bus')) {
                    e.preventDefault();
                    handleStatusChange(e.target.closest('.unblock-bus'), 'débloquer');
                }
            });

            // Messages de session
            @if (session('success'))
                Swal.fire({
                    title: 'Succès !',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#198754'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Erreur !',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonColor: '#dc3545'
                });
            @endif
        });
    </script>

</body>

</html>
