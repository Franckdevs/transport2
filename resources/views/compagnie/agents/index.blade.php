@php
use App\Helpers\GlobalHelper;
@endphp
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                <div class="d-flex justify-content-between align-items-center mb-4">
                   
                    <div class="ms-auto">
                        <a href="{{ route('agents.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus me-2"></i>Ajouter une nouvelle personne 
                        </a>
                    </div>
                </div>

                <!-- Cartes de statistiques -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-success bg-opacity-10 border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0 text-success">Personnel actif</h6>
                                        <h2 class="mt-2 mb-0">{{ $agents->where('status', 'actif')->count() }}</h2>
                                    </div>
                                    <div class="bg-success bg-opacity-25 p-3 rounded-3">
                                        <i class="fas fa-user-check fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-danger bg-opacity-10 border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0 text-danger">Personnel Inactif</h6>
                                        <h2 class="mt-2 mb-0">{{ $agents->where('status', '!=', 'actif')->count() }}</h2>
                                    </div>
                                    <div class="bg-danger bg-opacity-25 p-3 rounded-3">
                                        <i class="fas fa-user-slash fa-2x text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 row-deck">
                    <div class="col-12">
                        <div class="card shadow-sm">
                          
                            <div class="card-body">
                                <!-- Filtre par date -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <form action="{{ route('agents.index') }}" method="GET" class="row g-3 align-items-end">
                                            <div class="col-md-2">
                                                <label for="date_debut" class="form-label">Date de début</label>
                                                <input type="date" class="form-control form-control-lg" id="date_debut" name="date_debut" value="{{ request('date_debut') }}">
                                            </div>
                                           
                                            <div class="col-md-2">
                                                <label for="date_fin" class="form-label">Date de fin</label>
                                                <input type="date" class="form-control form-control-lg" id="date_fin" name="date_fin" value="{{ request('date_fin') }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="role_personnel" class="form-label">Rôle</label>
                                                <select class="form-control form-control-lg select2" id="role_personnel" name="role_personnel">
                                                    <option value="">Tous les rôles</option>
                                                    <option value="controleur" {{ request('role_personnel') == 'controleur' ? 'selected' : '' }}>Contrôleur</option>
                                                    <option value="manager" {{ request('role_personnel') == 'manager' ? 'selected' : '' }}>Manager</option>
                                                    <option value="directeur" {{ request('role_personnel') == 'directeur' ? 'selected' : '' }}>Directeur</option>
                                                    <option value="comptable" {{ request('role_personnel') == 'comptable' ? 'selected' : '' }}>Comptable</option>
                                                    <option value="assistant_admin" {{ request('role_personnel') == 'assistant_admin' ? 'selected' : '' }}>Assistant Admin</option>
                                                    <option value="chauffeur" {{ request('role_personnel') == 'chauffeur' ? 'selected' : '' }}>Chauffeur</option>
                                                    <option value="receveur" {{ request('role_personnel') == 'receveur' ? 'selected' : '' }}>Receveur</option>
                                                    <option value="chef_gare" {{ request('role_personnel') == 'chef_gare' ? 'selected' : '' }}>Chef de gare</option>
                                                    <option value="planificateur" {{ request('role_personnel') == 'planificateur' ? 'selected' : '' }}>Planificateur</option>
                                                    <option value="agent_vente" {{ request('role_personnel') == 'agent_vente' ? 'selected' : '' }}>Agent de vente</option>
                                                    <option value="caissier" {{ request('role_personnel') == 'caissier' ? 'selected' : '' }}>Caissier</option>
                                                    <option value="service_client" {{ request('role_personnel') == 'service_client' ? 'selected' : '' }}>Service client</option>
                                                    <option value="technicien" {{ request('role_personnel') == 'technicien' ? 'selected' : '' }}>Technicien</option>
                                                    <option value="mecanicien" {{ request('role_personnel') == 'mecanicien' ? 'selected' : '' }}>Mécanicien</option>
                                                    <option value="electricien" {{ request('role_personnel') == 'electricien' ? 'selected' : '' }}>Électricien</option>
                                                    <option value="informaticien" {{ request('role_personnel') == 'informaticien' ? 'selected' : '' }}>Informaticien</option>
                                                    <option value="gardien" {{ request('role_personnel') == 'gardien' ? 'selected' : '' }}>Gardien</option>
                                                    <option value="vigile" {{ request('role_personnel') == 'vigile' ? 'selected' : '' }}>Vigile</option>
                                                    <option value="chef_securite" {{ request('role_personnel') == 'chef_securite' ? 'selected' : '' }}>Chef de sécurité</option>
                                                    <option value="nettoyeur" {{ request('role_personnel') == 'nettoyeur' ? 'selected' : '' }}>Nettoyeur</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="status" class="form-label">Statut</label>
                                                <select class="form-control form-control-lg" id="status" name="status">
                                                    <option value="">Tous les statuts</option>
                                                    <option value="actif" {{ request('status') == 'actif' ? 'selected' : '' }}>Actif</option>
                                                    <option value="inactif" {{ request('status') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="submit" class="btn btn-warning btn-lg me-2" id="filterBtn" style="min-width: 140px; height: 48px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-filter me-1"></i>
                                                    <span id="filterText">Filtrer</span>
                                                    <span class="spinner-border spinner-border-sm d-none ms-1" id="filterSpinner" role="status" aria-hidden="true"></span>
                                                </button>
                                                <a href="{{ route('agents.index') }}" class="btn btn-secondary btn-lg" id="resetBtn" style="min-width: 80px; height: 48px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-undo me-1"></i>
                                                    <span id="resetText"></span>
                                                    <span class="spinner-border spinner-border-sm d-none ms-1" id="resetSpinner" role="status" aria-hidden="true"></span>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Tableau -->
                                <table id="myTable" class="table display nowrap table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                        <th>Date de création</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($agents as $agent)
                                    <tr>
                                        <td>{{ $agent->id }}</td>
                                        <td>{{ $agent->nom ?? 'N/A' }}</td>
                                        <td>{{ $agent->prenom ?? 'N/A' }}</td>
                                        <td>{{ $agent->email ?? 'N/A' }}</td>
                                        <td>{{ $agent->role_personnel ?? 'N/A' }}</td>
                                        <td>{{ $agent->created_at ? $agent->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                        
                                        <td>
                                            <span class="badge {{ $agent->status === 'actif' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($agent->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{-- <div class="btn-group" role="group"> --}}
                                                <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-sm btn-warning" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('agents.show', $agent->id) }}" class="btn btn-sm btn-info" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
{{-- 
                                                @if($agent->status === 'actif')
                                                <form action="{{ route('agents.toggle-status', $agent->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-warning btn-sm" title="Désactiver">
                                                        <i class="fas fa-user-slash"></i>
                                                    </button>
                                                </form>
                                                @else
                                                <form action="{{ route('agents.toggle-status', $agent->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm" title="Activer">
                                                        <i class="fas fa-user-check"></i>
                                                    </button>
                                                </form>
                                                @endif --}}
                
                                            {{-- </div> --}}
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <!-- DataTable + recherche personnalisée + SweetAlert2 Confirmation -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialisation de Select2 avec recherche pour les filtres
            $('.select2').select2({
                placeholder: 'Rechercher...',
                allowClear: true,
                width: '100%',
            });

            // Initialisation de DataTable
            const table = new DataTable('#myTable', {
                language: {
                    search: "Rechercher :",
                    lengthMenu: "Afficher _MENU_ éléments par page",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                    infoEmpty: "Aucun élément à afficher",
                    infoFiltered: "(filtrés depuis _MAX_ éléments au total)",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent"
                    }
                }
            });

            // Gestion du spinner pour le formulaire de filtrage
            $('form[action="{{ route('agents.index') }}"]').on('submit', function(e) {
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
                const icon = resetBtn.find('i');
                
                // Cacher l'icône et afficher le spinner
                icon.hide();
                spinner.removeClass('d-none');
                resetText.text('');
            });

            // Gestion de l'activation/désactivation avec SweetAlert2
            document.querySelectorAll('form[action*="toggle-status"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const button = this.querySelector('button[type="submit"]');
                    const isActivating = button.classList.contains('btn-success');
                    const action = isActivating ? 'activer' : 'désactiver';
                    const agentName = this.closest('tr').querySelector('td:nth-child(2)').textContent + ' ' + 
                                     this.closest('tr').querySelector('td:nth-child(3)').textContent;

                    Swal.fire({
                        title: `Confirmer l'${action}ion`,
                        text: `Êtes-vous sûr de vouloir ${action} l'agent ${agentName} ?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: isActivating ? '#28a745' : '#ffc107',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: `Oui, ${action}`,
                        cancelButtonText: 'Annuler',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });

           
        });
    </script>

</body>
</html>
