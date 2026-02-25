 @php
    use App\Helpers\GlobalHelper;
@endphp
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

    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-xl-3 g-2 mb-3">


               <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <div class="row g-3 row-deck">
                      <!-- 🔹 Titre + bouton -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0"></h5>
                                    <a href="{{ route('gares.create') }}" class="btn btn-warning">
                                        <i class="fa fa-plus"></i> Ajouter une gare
                                    </a>
                                </div>
                    <div class="col-md-12 mt-4">
                        
                        <div class="card">
                            
                            <div class="card-body">

                    

                                <!-- 🔹 Formulaire de filtre -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <form action="{{ route('gares.index.2') }}" method="GET" class="row g-3 align-items-end">
                                            <div class="col-md-3">
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
                                            
                                            <div class="col-md-3">
                                                <label for="status" class="form-label">Statut</label>
                                                <select class="form-control form-control-lg" id="status" name="status">
                                                    <option value="">Tous les statuts</option>
                                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Actif</option>
                                                    <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Inactif</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-3 d-flex align-items-end">
                                                <button type="submit" class="btn btn-warning btn-lg me-2" style="min-width: 140px; height: 48px; display: flex; align-items: center; justify-content: center;" id="filterBtn">
                                                    <i class="fas fa-filter me-1" id="filterIcon"></i>
                                                    <span id="filterText">Filtrer</span>
                                                    <div class="spinner-border spinner-border-sm ms-2 d-none" id="filterSpinner" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </button>
                                                <a href="{{ route('gares.index.2') }}" class="btn btn-secondary btn-lg" style="min-width: 180px; height: 48px; display: flex; align-items: center; justify-content: center;" id="resetBtn">
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

                                <!-- 🔹 Barre de recherche -->


                                <!-- 🔹 Tableau -->
                                <table id="myTable" class="table display nowrap table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nom gare</th>
                                            <th>ville</th>
                                            <th>Adresse</th>
                                            {{-- <th>Heure ouverture</th>
                                            <th>Heure fermeture</th> --}}
                                            <th>status</th>
                                            <th>Date de création</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listegares as $gare)
                                        <tr>
                                            <td>{{   GlobalHelper::limitText($gare->nom_gare, 11) ?? 'Aucun nom' }}</td>
                                            <td>{{  GlobalHelper::limitText($gare->ville->nom_ville, 11) ?? 'Aucune ville' }}</td>
                                            <td>{{ GlobalHelper::limitText($gare->adresse_gare, 11) ?? 'Aucune adresse' }}</td>
                                            {{-- <td>{{ GlobalHelper::limitText($gare->heure_ouverture, 7) ?? 'Aucune heure' }}</td>
                                            <td>{{ GlobalHelper::limitText($gare->heure_fermeture, 7) ?? 'Aucune heure' }}</td> --}}
                                            <td>
                                                <span class="badge bg-{{ $gare->status == 1 ? 'success' : 'danger' }}">
                                                    {{ $gare->status == 1 ? 'Actif' : 'Inactif' }}
                                                </span>
                                            </td>
                                            <td>{{ GlobalHelper::formatCreatedAt($gare->created_at) }}</td>
                                            <td>
                                                 <a href="
                                                 {{ route('gares.edit', $gare->id) }}
                                                  " class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="{{ route('gares.show', $gare->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            {{-- @if($gare->status == 1) 
                                                <!-- Bouton désactiver avec SweetAlert2 -->
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDesactivation({{ $gare->id }})">
                                                    <i class="fa fa-ban"></i>
                                                </button>

                                                <!-- Formulaire caché pour la désactivation -->
                                                <form id="desactiverForm{{ $gare->id }}" action="{{ route('gares.destroy_desactiver', $gare->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            @elseif($gare->status == 3) 
                                                <!-- Bouton activer avec SweetAlert2 -->
                                                <button type="button" class="btn btn-success btn-sm" onclick="confirmActivation({{ $gare->id }})">
                                                    <i class="fa fa-check"></i>
                                                </button>

                                                <!-- Formulaire caché pour l'activation -->
                                                <form id="activerForm{{ $gare->id }}" action="{{ route('gares.destroy_reactivation', $gare->id) }}" method="POST" style="display: none;">
                                                    @csrf
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

                    <!-- Script DataTables 2.x + recherche personnalisée -->
                    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
                    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const table = new DataTable('#myTable');

                            // 🔎 Recherche personnalisée
                            const searchInput = document.getElementById('customSearchGares');
                            searchInput.addEventListener('input', function() {
                                table.search(this.value);
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../assets/js/theme.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
  <!-- Plugin Js -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  
  <script>
    function confirmDesactivation(gareId) {
        Swal.fire({
            title: 'Confirmation',
            text: 'Voulez-vous vraiment désactiver cette gare ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, désactiver',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('desactiverForm' + gareId).submit();
            }
        });
    }

    function confirmActivation(gareId) {
        Swal.fire({
            title: 'Confirmation',
            text: 'Voulez-vous vraiment réactiver cette gare ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, activer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('activerForm' + gareId).submit();
            }
        });
    }

    // Gestion du spinner pour le bouton filtre
    document.addEventListener("DOMContentLoaded", function() {
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

