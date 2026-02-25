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
                        <a href="{{ route('itineraire.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus-circle me-2"></i>Ajouter un itinéraire
                        </a>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                <!-- Formulaire de filtre -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('itineraire.index') }}" method="GET" class="row g-3 align-items-end">
                            <div class="col-md-2">
                                <label for="ville_id" class="form-label">Ville</label>
                                <select class="form-control form-control-lg select2" id="ville_id" name="ville_id">
                                    <option value="">Toutes les villes</option>
                                    @foreach($villes as $ville)
                                        <option value="{{ $ville->id }}" {{ request('ville_id') == $ville->id ? 'selected' : '' }}>
                                            {{ $ville->nom_ville }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="date_debut" class="form-label">Date de début</label>
                                <input type="date" class="form-control form-control-lg" id="date_debut" name="date_debut" value="{{ request('date_debut') }}">
                            </div>
                           
                            <div class="col-md-2">
                                <label for="date_fin" class="form-label">Date de fin</label>
                                <input type="date" class="form-control form-control-lg" id="date_fin" name="date_fin" value="{{ request('date_fin') }}">
                            </div>

                            <div class="col-md-2">
                                <label for="status" class="form-label">Statut</label>
                                <select class="form-control form-control-lg" id="status" name="status">
                                    <option value="">Tous les statuts</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Actif</option>
                                    <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Inactif</option>
                                </select>
                            </div>
                            
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-warning btn-lg me-2" style="min-width: 140px; height: 48px; display: flex; align-items: center; justify-content: center;" id="filterBtn">
                                    <i class="fas fa-filter me-1" id="filterIcon"></i>
                                    <span id="filterText">Filtrer</span>
                                    <div class="spinner-border spinner-border-sm ms-2 d-none" id="filterSpinner" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                                <a href="{{ route('itineraire.index') }}" class="btn btn-secondary btn-lg" style="min-width: 180px; height: 48px; display: flex; align-items: center; justify-content: center;" id="resetBtn">
                                    <i class="fas fa-undo me-1" id="resetIcon"></i>
                                    <span id="resetText">Réinitialiser</span>
                                    <div class="spinner-border spinner-border-sm ms-2 d-none" id="resetSpinner" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Tableau -->
                        <table id="myTable" class="table display nowrap table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Ville de départ</th>
                                    <th>Estimation du trajet </th>
                                    <th>Titre du trajet</th>
                                    <th>Montant</th>
                                    <th>Nombre d'arrêts</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itineraires as $voyage)
                                <tr>
                                    <td>{{ \Illuminate\Support\Str::limit($voyage->ville->nom_ville ?? 'Non défini', 10) }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($voyage->estimation ?? 'Non défini', 10) }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($voyage->titre ?? 'Non défini', 10) }}</td>
                                    {{-- <td>{{ GlobalHelper::formatCreatedAt($voyage->created_at ) }}</td> --}}
                                            <td>
                                                {{ number_format($voyage->total_montant, 0, ',', ' ') }} FCFA</td>
                                            </td>        <td>
                                                {{ \Illuminate\Support\Str::limit($voyage->nombre_arrets, 2) }}
                                                <span class="text-white ms-2">7</span>
                                            </td>
                                            <td>

                                        <span class="badge bg-{{ $voyage->status  == 1 ? 'success' : 'danger' }}">
                                            {{ $voyage->status  == 1 ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </td>
                                    <td>{{ \Illuminate\Support\Str::limit(GlobalHelper::formatCreatedAt($voyage->created_at ) , 19) }}</td>
                                 <td>
                                     <a href="{{ route('itineraire.edit', $voyage->id) }}
                                      " class="btn btn-warning btn-sm">
                                         <i class="fa fa-edit"></i>
                                     </a>
    <a href="{{ route('itineraire.show', $voyage->id) }}" class="btn btn-info btn-sm">
        <i class="fa fa-eye"></i>
    </a>

    {{-- @if($voyage->status == 1)
        <!-- Bouton Bloquer avec SweetAlert2 -->
        <button type="button" class="btn btn-sm btn-warning" onclick="confirmBlock({{ $voyage->id }})" title="Bloquer l'itinéraire">
            <i class="fas fa-lock"></i>
        </button>

        <!-- Formulaire caché pour le blocage -->
        <form id="block-form-{{ $voyage->id }}" action="{{ route('itineraire.destroy', $voyage->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

    @elseif($voyage->status == 3)
        <!-- Bouton Débloquer avec SweetAlert2 -->
        <button type="button" class="btn btn-sm btn-success" onclick="confirmUnblock({{ $voyage->id }})" title="Débloquer l'itinéraire">
            <i class="fas fa-unlock"></i>
        </button>

        <!-- Formulaire caché pour le déblocage -->
        <form id="unblock-form-{{ $voyage->id }}" action="{{ route('itineraire.reactivation', $voyage->id) }}" method="POST" style="display: none;">
            @csrf
            @method('PUT')
        </form>
    @endif --}}
</td>



                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        @include('compagnie.all_element.footer')
    </div>

     </div> <!-- .row end -->



      </div>
    </div>
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <!-- DataTables 2.x + recherche personnalisée -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = new DataTable('#myTable');

            const searchInput = document.getElementById('customSearch');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    table.search(this.value);
                });
            }

            // Gestion du spinner pour le bouton filtre
            const filterBtn = document.getElementById('filterBtn');
            const filterForm = filterBtn.closest('form');
            
            filterForm.addEventListener('submit', function(e) {
                const filterSpinner = document.getElementById('filterSpinner');
                
                // Afficher le spinner à droite du texte
                filterSpinner.classList.remove('d-none');
                filterBtn.disabled = true;
            });

            // Gestion du spinner pour le bouton réinitialiser
            const resetBtn = document.getElementById('resetBtn');
            resetBtn.addEventListener('click', function(e) {
                const resetSpinner = document.getElementById('resetSpinner');
                
                // Afficher le spinner à droite du texte
                resetSpinner.classList.remove('d-none');
                resetBtn.style.pointerEvents = 'none';
                resetBtn.style.opacity = '0.65';
            });
        });

        // Fonction de confirmation de blocage
        function confirmBlock(voyageId) {
            Swal.fire({
                title: 'Confirmer le blocage',
                text: 'Voulez-vous vraiment bloquer cet itinéraire ? Il ne sera plus disponible pour les réservations.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ffc107',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, bloquer',
                cancelButtonText: 'Annuler',
                customClass: {
                    confirmButton: 'btn btn-warning me-2',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('block-form-' + voyageId).submit();
                }
            });
        }

        // Fonction de confirmation de déblocage
        function confirmUnblock(voyageId) {
            Swal.fire({
                title: 'Confirmer le déblocage',
                text: 'Voulez-vous débloquer cet itinéraire ? Il sera à nouveau disponible pour les réservations.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, débloquer',
                cancelButtonText: 'Annuler',
                customClass: {
                    confirmButton: 'btn btn-success me-2',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('unblock-form-' + voyageId).submit();
                }
            });
        }
    </script>

    <!-- Script Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Sélectionner une ville",
                allowClear: true,
                width: '100%',
                dropdownCssClass: 'select2-dropdown-custom',
                containerCssClass: 'select2-container-custom'
            });
        });
    </script>
    
    <style>
        .select2-container-custom .select2-selection {
            height: 48px !important;
            min-height: 48px !important;
            display: flex !important;
            align-items: center !important;
        }
        
        .select2-container-custom .select2-selection__rendered {
            line-height: 48px !important;
            padding: 0 12px !important;
        }
        
        .select2-container-custom .select2-selection__arrow {
            height: 46px !important;
        }
        
        .select2-dropdown-custom .select2-search__field {
            height: 40px !important;
        }
    </style>
</body>
</html>
