
@php
    use Carbon\Carbon;
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
                        <a href="{{ route('chauffeur.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus me-2"></i>Ajouter un chauffeur
                        </a>
                    </div>
                </div>

                <div class="row g-3 row-deck">
                    <div class="col-md-12">
                        <div class="card shadow-sm">
 
                            <div class="card-body">
                                <!-- Barre de recherche -->

                    <div class="d-flex align-items-center gap-2">
                        <div class="filter-group">
    <label for="statusFilter" class="form-label mb-0">
        Filtrer par statut :
    </label>

    <select id="statusFilter"
            class="form-select"
            style="width: 150px; height: 38px;">
        <option value="">Tous</option>
        <option value="Actif">Actif</option>
        <option value="Inactif">Inactif</option>
    </select>
</div>
                    </div>
                                <!-- 🔹 Tableau -->
                                <table id="myTable" class="table responsive display nowrap table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Nom</th>
                                            <th>Prénoms</th>
                                            <th>Téléphone</th>
                                            <th>Adresse</th>
                                            <th>Numéro permis</th>
                                            <th>Date de naissance</th>
                                            <th>Statut</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($chauffeurs as $chauffeur)
                                        <tr>
                                            <td>
                                                @if($chauffeur->photo)
                                                <img src="{{ ($chauffeur->photo) }}" alt="Photo"
                                                    width="50" height="50" style="object-fit: cover; border-radius: 50%;">
                                                @else
                                                photo vide
                                                @endif
                                            </td>
                                          <td>{{ Str::limit($chauffeur->nom ?? 'Aucun nom', 9) }}</td>
                                            <td>{{ Str::limit($chauffeur->prenom ?? 'Aucun prénom', 9) }}</td>
                                            <td>{{ Str::limit($chauffeur->telephone ?? 'Aucun téléphone', 9) }}</td>
                                            <td>{{ Str::limit($chauffeur->adresse ?? 'Aucune adresse',9 ) }}</td>
                                            <td>{{ Str::limit($chauffeur->numeros_permis ?? 'Non renseigné', 9) }}</td>
                                            <td>
                                                {{ $chauffeur->date_naissance ? Carbon::parse($chauffeur->date_naissance)->format('d/m/Y') : 'Non renseignée' }}
                                            </td>
                                            <td>
                                                @if($chauffeur->status == 1)
                                                    <span class="badge bg-success">Actif</span>
                                                @elseif($chauffeur->status == 3)
                                                    <span class="badge bg-danger">Inactif</span>
                                                @else
                                                    <span class="badge bg-secondary">Inconnu</span>
                                                @endif
                                            </td>
                                            <td>

                                          <!-- Actions Chauffeur -->
<div class="gap-1">
    <!-- Bouton Modifier -->
    <a href="{{ route('modifier.edit', $chauffeur->id) }}" class="btn btn-warning btn-sm">
        <i class="fa fa-edit"></i>
    </a>

    <!-- Bouton Voir -->
    <a href="{{ route('voir.show',$chauffeur->id) }}" class="btn btn-info btn-sm">
        <i class="fa fa-eye"></i>
    </a>

</div>

 {{-- @if($chauffeur->status == 3)
        <!-- Bouton Réactiver avec SweetAlert2 -->
        <form id="reactivateForm{{ $chauffeur->id }}" action="{{ route('activer.destroy', $chauffeur->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="button" onclick="confirmReactivation(event, {{ $chauffeur->id }}, '{{ addslashes($chauffeur->nom) }} {{ addslashes($chauffeur->prenom) }}')" class="btn btn-success btn-sm">
                <i class="fa fa-undo"></i>
            </button>
        </form>

    @else
        <!-- Bouton Désactiver avec SweetAlert2 -->
        <form id="deleteForm{{ $chauffeur->id }}" action="{{ route('activer.destroy', $chauffeur->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="button" onclick="confirmDelete(event, {{ $chauffeur->id }}, '{{ addslashes($chauffeur->nom) }} {{ addslashes($chauffeur->prenom) }}')" class="btn btn-warning btn-sm" title="Désactiver le chauffeur">
                <i class="fas fa-user-slash"></i>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/3.0.7/js/dataTables.responsive.js"></script>
    <script src='https://cdn.datatables.net/responsive/3.0.7/js/dataTables.responsive.js'></script>
    <script>
        $(document).ready(function() {
            // Vérifier si la DataTable est déjà initialisée
            if (!$.fn.DataTable.isDataTable('#myTable')) {
                var table = $('#myTable').DataTable({
                    responsive: true,
                    order: [[1, 'desc']],
                    language: {
                        // url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
                    },
                    columnDefs: [
                        { orderable: false, targets: [0, 7, 8] } // Désactiver le tri sur les colonnes Photo, Statut et Actions
                    ]
                });
            }

            // Gestion du filtre de statut
           $('#statusFilter').on('change', function () {
    var status = $(this).val();
    var table = $('#myTable').DataTable();

    if (status === '') {
        table.column(7).search('').draw();
    } else {
        table.column(7).search('^' + status + '$', true, false).draw();
    }
});

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <!-- 🔹 Recherche personnalisée -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // La DataTable est déjà initialisée plus haut dans le code
            const table = $('#myTable').DataTable();
            
            const searchInput = document.getElementById('customSearchChauffeurs');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    table.search(this.value);
                });
            }
        });

        // Fonction de confirmation de suppression avec SweetAlert2
        function confirmDelete(event, id, name) {
            event.preventDefault(); // Empêche la soumission directe du formulaire
            
            Swal.fire({
                title: 'Confirmer la désactivation',
                text: `Êtes-vous sûr de vouloir désactiver le chauffeur : ${name} ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-danger mx-2',
                    cancelButton: 'btn btn-secondary mx-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire de suppression
                    document.getElementById(`deleteForm${id}`).submit();
                }
            });
        }

        // Fonction de confirmation de réactivation avec SweetAlert2
        function confirmReactivation(event, id, name) {
            event.preventDefault(); // Empêche la soumission directe du formulaire
            
            Swal.fire({
                title: 'Confirmer la réactivation',
                text: `Voulez-vous vraiment réactiver le chauffeur : ${name} ?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, réactiver',
                cancelButtonText: 'Annuler',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-secondary mx-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire de réactivation
                    document.getElementById(`reactivateForm${id}`).submit();
                }
            });
        }

        // Gestion des messages de session (succès/erreur)
        // @if(session('success'))
        //     Swal.fire({
        //         title: 'Succès !',
        //         text: '{{ session('success') }}',
        //         icon: 'success',
        //         confirmButtonText: 'OK'
        //     });
        // @endif

        //   @if(session('success'))
        //     Swal.fire({
        //         title: 'Succès !',
        //         text: '{{ session('success') }}',
        //         icon: 'success',
        //         timer: 3000,
        //         showConfirmButton: false
        //     });
        // @endif

        // @if(session('error'))
        //     Swal.fire({
        //         title: 'Erreur !',
        //         text: '{{ session('error') }}',
        //         icon: 'error',
        //         confirmButtonText: 'OK'
        //     });
        // @endif
    </script>
</body>
</html>
