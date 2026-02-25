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
                        <i class="fas fa-layer-group me-2"></i>Liste des classes
                    </h1> --}}
                    <div class="ms-auto">
                        <a href="{{ route('classe.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus me-2"></i>Ajouter une classe
                        </a>
                    </div>
                </div>

                <!-- Tableau -->
                <div class="col-12">
                    <div class="card shadow-sm">
                        
                        <div class="card-body">
                            <div class="col-md-3">
                        <label for="statusFilter" class="form-label">Filtrer par statut :</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">Tous</option>
                            <option value="1">Actif</option>
                            <option value="0">Inactif</option>
                        </select>
                    </div>
                            {{-- @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif --}}

                            <table id="myTable" class="table display nowrap table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                                <th style="display:none;">ID</th>
                                        <th>NOM</th>
                                        <th>DESCRIPTION</th>
                                        <th>DATE DE CRÉATION</th>
                                        <th>STATUT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classes as $classe)
                                    <tr>
                                        <td style="display:none;">{{ $classe->id }}</td>
                                        <td>{{ Str::limit($classe->nom, 17) }}</td>
                                        <td>{{ Str::limit($classe->description ?? '-', 30) }}</td>
                                        <td>{{ $classe->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if($classe->est_actif)
                                                <span class="badge bg-success">Actif</span>
                                            @else
                                                <span class="badge bg-danger">Inactif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('classe.edit', $classe->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('classe.show', $classe->id) }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            {{-- <button type="button" 
                                                    class="btn btn-sm {{ $classe->est_actif ? 'btn-danger' : 'btn-success' }}" 
                                                    onclick="toggleStatus({{ $classe->id }}, {{ $classe->est_actif ? 'true' : 'false' }})"
                                                    title="{{ $classe->est_actif ? 'Désactiver' : 'Activer' }}">
                                                <i class="fas {{ $classe->est_actif ? 'fa-ban' : 'fa-check' }}"></i>
                                            </button> --}}
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialisation de DataTable
            const table = $('#myTable').DataTable({
                responsive: true,
               order: [[0, 'desc']], // maintenant l'ID est la colonne 0
    columnDefs: [
        { targets: 0, visible: false } // cache la colonne ID
    ]
            });

            // Gestion du filtre de statut
            const statusFilter = document.getElementById('statusFilter');
            if (statusFilter) {
                statusFilter.addEventListener('change', function() {
                    const status = this.value;
                    
                    if (status === '') {
                        // Si aucun filtre, on réinitialise la recherche
                        table.column(4).search('').draw();
                    } else {
                        // On filtre sur la colonne Statut (index 4)
                        const statusText = status === '1' ? 'Actif' : 'Inactif';
                        table.column(4).search('^' + statusText + '$', true, false).draw();
                    }
                });
            }

            // Gestion de la barre de recherche personnalisée si elle existe
            const searchInput = document.getElementById('customSearch');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    table.search(this.value).draw();
                });
            }
        });

        // Fonction pour basculer le statut actif/inactif
        function toggleStatus(classeId, currentStatus) {
            const action = currentStatus ? 'désactiver' : 'activer';
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const url = `/classes/${classeId}/toggle-status`;
            
            console.log(`Tentative de ${action} la classe ${classeId}`);
            console.log('URL de la requête:', url);
            
            // Créer un formulaire pour la soumission
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            
            // Ajouter le jeton CSRF
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            
            // Ajouter la méthode spoofing pour PUT
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            
            // Afficher la confirmation
            Swal.fire({
                title: 'Confirmation',
                text: `Voulez-vous vraiment ${action} cette classe ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Oui, ${action}`,
                cancelButtonText: 'Annuler',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: new URLSearchParams({
                            _method: 'PUT',
                            _token: csrfToken
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Erreur HTTP: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Réponse du serveur:', data);
                        if (data.success) {
                            Swal.fire({
                                title: 'Succès !',
                                text: `La classe a été ${action} avec succès.`,
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Erreur inconnue');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        Swal.fire(
                            'Erreur',
                            error.message || 'Une erreur est survenue lors de la mise à jour du statut',
                            'error'
                        );
                    });
                }
            });
            
            // Nettoyer le formulaire
            document.body.removeChild(form);
        }

                // Gestion des messages flash avec SweetAlert2
      
    </script>
</body>
</html>
