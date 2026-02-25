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

                        <div class="table-responsive" style="overflow-x: auto;">
    <table id="myTable" class="table table-striped table-hover align-middle" style="width: 100%;">
        <thead class="table-light">
            <tr>
                <th style="width: 25%;">Nom de la Gare</th>
                <th style="width: 15%;">Ville</th>
                <th style="width: 30%;">Administrateur</th>
                <th style="width: 15%;">Statut</th>
                <th style="width: 15%;" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($gares as $gare)
                <tr>
                    <td>
                        <i class="fas fa-train text-primary me-2"></i>
                        <strong>{{ $gare->nom_gare }}</strong>
                    </td>

                    <td>{{ $gare->ville?->nom_ville ?? 'N/A' }}</td>

                    <td>
                        @if($gare->infoUser?->user)
                            <div class="d-flex align-items-center">
                                {{-- <div class="avatar-sm bg-primary text-white ">
                                    {{ $gare->infoUser->user->nom ?? 'N/A' }}
                                </div> --}}
                                <div>
                                    <div class="fw-semibold">
                                        {{ $gare->infoUser->user->nom ?? ''}} {{ $gare->infoUser->user->prenom ?? '' }}
                                    </div>
                                    <!-- <br> -->
                                    <small class="text-muted">Admin Gare</small>
                                </div>
                            </div>
                        @else
                            <span class="text-muted">
                                <i class="fas fa-user-slash"></i> Aucun
                            </span>
                        @endif
                    </td>

                    <td>
                        @if($gare->infoUser?->user)
                            <span class="badge {{ $gare->infoUser->user->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $gare->infoUser->user->status ? 'Actif' : 'Inactif' }}
                            </span>
                        @else
                            <span class="badge bg-secondary">Non assigné</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('modifier_admin_gare.edit', $gare->id) }}" class="btn btn-info btn-sm" title="Modifier l'administrateur">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            @if($gare->infoUser?->user)
                                @if($gare->infoUser->user->status == 1)
                                    {{-- <form method="POST" action="{{ route('modifier_admin_gare.deactivate', [$gare->id, $gare->infoUser->user->id]) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-warning" title="Désactiver" onclick="return confirm('Voulez-vous vraiment désactiver cet administrateur ?')">
                                            <i class="fas fa-pause"></i>
                                        </button>
                                    </form> --}}
                                @else
                                    {{-- <form method="POST" action="{{ route('modifier_admin_gare.activate', [$gare->id, $gare->infoUser->user->id]) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success" title="Activer" onclick="return confirm('Voulez-vous vraiment activer cet administrateur ?')">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    </form> --}}
                                @endif
                                
                                {{-- <form method="POST" action="{{ route('modifier_admin_gare.destroy', [$gare->id, $gare->infoUser->user->id]) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Supprimer" onclick="return confirm('Attention ! Cette action supprimera définitivement cet administrateur. Voulez-vous continuer ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-2x mb-2"></i><br>
                        Aucune gare trouvée
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
    
    <!-- DataTables 2.x -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    new DataTable('#myTable', {
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        ordering: true,
        autoWidth: false,
        language: {
            search: "Rechercher :",
            lengthMenu: "Afficher _MENU_ lignes",
            info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
            paginate: {
                previous: "Précédent",
                next: "Suivant"
            },
            zeroRecords: "Aucun résultat trouvé",
        },
        columnDefs: [
            { orderable: false, targets: 4 }, // désactiver tri sur Actions
            { width: "25%", targets: 0 },    // Nom de la Gare
            { width: "15%", targets: 1 },    // Ville
            { width: "30%", targets: 2 },    // Administrateur
            { width: "15%", targets: 3 },    // Statut
            { width: "15%", targets: 4 }     // Actions
        ]
    });
});
</script>

<style>
    /* Forcer l'affichage des colonnes */
    #myTable {
        width: 100% !important;
        table-layout: fixed !important;
    }
    
    #myTable th,
    #myTable td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    /* Styles spécifiques aux colonnes */
    #myTable th:nth-child(1),
    #myTable td:nth-child(1) { width: 25% !important; }
    #myTable th:nth-child(2),
    #myTable td:nth-child(2) { width: 15% !important; }
    #myTable th:nth-child(3),
    #myTable td:nth-child(3) { width: 30% !important; }
    #myTable th:nth-child(4),
    #myTable td:nth-child(4) { width: 15% !important; }
    #myTable th:nth-child(5),
    #myTable td:nth-child(5) { width: 15% !important; }
    
    /* Permettre le retour à la ligne pour la colonne administrateur */
    #myTable td:nth-child(3) {
        white-space: normal;
        word-wrap: break-word;
    }
    
    table.dataTable tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn-group .btn {
        padding: 4px 8px;
    }
    
    /* S'assurer que le container ne cache pas les colonnes */
    .table-responsive {
        min-width: 100%;
        overflow-x: visible !important;
    }
</style>
</body>

</html>


 {{--  --}}