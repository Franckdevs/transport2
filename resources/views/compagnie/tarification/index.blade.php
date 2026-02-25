@php
    use App\Helpers\GlobalHelper;
@endphp
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@include('compagnie.all_element.header')

<body class="layout-1" data-luno="theme-blue">
    @include('compagnie.all_element.sidebar')

    <div class="wrapper">
        <header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
            <div class="container-fluid">
                <nav class="navbar">
                    @include('compagnie.all_element.navbar')
                </nav>
            </div>
        </header>

        @include('compagnie.all_element.cadre')

        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <!-- En-tête avec bouton à droite -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                
                    <div class="ms-auto">
                        <a href="{{ route('tarification.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus me-2"></i>Ajouter une tarification
                        </a>
                    </div>
                </div>
                
                <div class="row g-xl-3 g-2 mb-3">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            
<div class="row g-3 mb-4">
    <div class="col-md-12">
        <div class="card">
        
            <div class="card-body">
                <div class="border rounded p-3 mb-3">
                <form id="filterForm" method="GET" action="{{ route('tarification.index') }}" class="row g-3">
                    <div class="col-md-3">
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
                    <div class="col-md-3">
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
    <label for="est_actif" class="form-label">Statut</label>
    <select name="est_actif" id="est_actif" class="form-select">
        <option value="">Tous les statuts</option>
        <option value="1" {{ request('est_actif') === '1' ? 'selected' : '' }}>Actif</option>
        <option value="0" {{ request('est_actif') === '0' ? 'selected' : '' }}>Inactif</option>
    </select>
</div>
<div class="col-md-2 d-flex align-items-end">
    <button type="submit" class="btn btn-warning me-1" id="filterBtn" style="min-width: 180px; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-filter me-1"></i>
        <span id="filterText">Filtrer</span>
        <span class="spinner-border spinner-border-sm d-none ms-1" id="filterSpinner" role="status" aria-hidden="true"></span>
    </button>
    <button type="button" class="btn btn-secondary" id="resetBtn" onclick="window.location.href='{{ route('tarification.index') }}'" style="min-width: 180px; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-redo me-1"></i>
        <span id="resetText">Réinitialiser</span>
        <span class="spinner-border spinner-border-sm d-none ms-1" id="resetSpinner" role="status" aria-hidden="true"></span>
    </button>
</div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

                            <div class="card-body">
                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="tarificationsTable">
                                            <thead>
                                                <tr>
                                                    <th>Classe</th>
                                                    <th>Ville de départ</th>
                                                    <th>Ville d'arrivée</th>
                                                    <th>Montant</th>
                                                    <th>Statut</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($tarifications as $tarification)
                                                    <tr>
                                                        <td>{{ $tarification->classe->nom ?? 'N/A' }}</td>
                                                        <td>{{ $tarification->villeDepart->nom_ville ?? 'N/A' }}</td>
                                                        <td>{{ $tarification->villeArrivee->nom_ville ?? 'N/A' }}</td>
                                                        <td>{{ number_format($tarification->montant, 0, ',', ' ') }} FCFA</td>
                                                        <td>
                                                            @if($tarification->est_actif == 1)
                                                                <span class="badge bg-success status-badge">Actif</span>
                                                            @elseif($tarification->est_actif == 0)
                                                                <span class="badge bg-danger status-badge">Inactif</span>
                                                            @else
                                                                <span class="badge bg-warning status-badge">Inconnu</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('tarification.edit', $tarification->id) }}" 
                                                               class="btn btn-warning btn-sm" 
                                                               title="Modifier">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                                <a href="{{ route('tarification.show', $tarification->id) }}" 
                                                                   class="btn btn-info btn-sm" 
                                                                   title="Voir">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                                
                                                                {{-- <button type="button" 
                                                                        class="btn btn-sm {{ $tarification->est_actif ? 'btn-success' : 'btn-secondary' }} toggle-status" 
                                                                        data-id="{{ $tarification->id }}"
                                                                        title="{{ $tarification->est_actif ? 'Désactiver' : 'Activer' }}">
                                                                    <i class="fa {{ $tarification->est_actif ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                                                </button> --}}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center">Aucune tarification trouvée.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    {{-- {{ $tarifications->links() }} --}}
                                </div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Initialisation de Select2 avec recherche pour les filtres
            $('.select2').select2({
                placeholder: 'Rechercher...',
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Aucun résultat trouvé";
                    },
                    searching: function() {
                        return "Recherche en cours...";
                    }
                }
            });

            // Gestion du spinner pour le bouton de filtrage
            $('#filterForm').on('submit', function() {
                const filterBtn = $('#filterBtn');
                const spinner = $('#filterSpinner');
                const filterText = $('#filterText');
                
                // Désactiver le bouton et afficher le spinner
                filterBtn.prop('disabled', true);
                spinner.removeClass('d-none');
                filterText.text('Filtrage...');
            });

            // Gestion du spinner pour le bouton de réinitialisation
            $('#resetBtn').on('click', function(e) {
                const resetBtn = $(this);
                const spinner = $('#resetSpinner');
                const resetText = $('#resetText');
                
                // Désactiver le bouton et afficher le spinner
                resetBtn.prop('disabled', true);
                spinner.removeClass('d-none');
                resetText.text('Réinitialisation...');
            });

            $('#tarificationsTable').DataTable({
                serverSide: false,
                data: @json($tarifications),
                responsive: true,
                order: [[, 'desc']],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
                },
                columns: [
                    { data: 'classe.nom', defaultContent: '' },
                    { data: 'ville_depart.nom_ville', defaultContent: '' },
                    { data: 'ville_arrivee.nom_ville', defaultContent: '' },
                    { data: 'montant', defaultContent: '0' },
                    { data: 'est_actif', defaultContent: '', 
                        render: function(data, type, row) {
                            if(data == 1) {
                                return '<span class="badge bg-success status-badge">Actif</span>';
                            } else if(data == 0) {
                                return '<span class="badge bg-danger status-badge">Inactif</span>';
                            } else {
                                return '<span class="badge bg-warning status-badge">Inconnu</span>';
                            }
                        }
                    },
                    { data: 'actions', orderable: false, defaultContent: '',
                        render: function(data, type, row) {
                            return `<a href="/modifier-tarification/${row.id}" class="btn btn-warning btn-sm" title="Modifier">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="/voir-tarification/${row.id}" class="btn btn-info btn-sm" title="Voir">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    {{-- <button type="button" class="btn btn-sm ${row.est_actif ? 'btn-success' : 'btn-secondary'} toggle-status" 
                                            data-id="${row.id}" title="${row.est_actif ? 'Désactiver' : 'Activer'}">
                                        <i class="fa ${row.est_actif ? 'fa-toggle-on' : 'fa-toggle-off'}"></i>
                                    </button> --}}`;
                        }
                    }
                ]
            });
            

            // Gestion de l'activation/désactivation
            $(document).on('click', '.toggle-status', function(e) {
                e.preventDefault();
                const button = $(this);
                const tarificationId = button.data('id');
                const isActive = button.hasClass('btn-success');
                const action = isActive ? 'désactiver' : 'activer';
                const statusText = isActive ? 'désactivée' : 'activée';

                Swal.fire({
                    title: `Voulez-vous vraiment ${action} cette tarification ?`,
                    text: `La tarification sera ${statusText}.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Oui, ${action}`,
                    cancelButtonText: 'Annuler',
                    allowOutsideClick: false,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return fetch(`/tarification/status/${tarificationId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                est_actif: isActive ? 0 : 1
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => {
                                    throw new Error(err.message || 'Erreur lors de la mise à jour du statut');
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Mettre à jour le bouton et le statut
                                if (isActive) {
                                    button.removeClass('btn-success').addClass('btn-secondary').html('<i class="fa fa-toggle-off"></i>');
                                    button.closest('tr').find('.status-badge')
                                        .removeClass('bg-success')
                                        .addClass('bg-danger')
                                        .text('Inactif');
                                    button.attr('title', 'Activer');
                                } else {
                                    button.removeClass('btn-secondary').addClass('btn-success').html('<i class="fa fa-toggle-on"></i>');
                                    button.closest('tr').find('.status-badge')
                                        .removeClass('bg-danger')
                                        .addClass('bg-success')
                                        .text('Actif');
                                    button.attr('title', 'Désactiver');
                                }
                                
                                return data;
                            } else {
                                throw new Error(data.message || 'Erreur lors de la mise à jour du statut');
                            }
                        })
                        .catch(error => {
                            console.error('Erreur:', error);
                            Swal.showValidationMessage(
                                `Erreur: ${error.message || 'Une erreur est survenue'}`
                            );
                        });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Succès!',
                            text: `La tarification a été ${statusText} avec succès.`,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
    <script>
        
    </script>
</body>
</html>
