@php
use App\Helpers\GlobalHelper;
@endphp
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
        <div class="row g-3">
          <div class="col-12">
            <div class="card shadow-sm">
              <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h4 class="mb-1 text-primary">
                      <i class="fa fa-users me-2"></i>Gestion du Personnel
                    </h4>
                    <p class="text-muted mb-0">Liste complète du personnel de la compagnie</p>
                  </div>
                  <a href="{{ route('personnel.create') }}" class="btn btn-success btn-lg">
                    <i class="fa fa-plus me-2"></i>Ajouter un utilisateur
                  </a>
                </div>
              </div>
              
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table id="myTable" class="table table-hover mb-0" style="width:100%">
                    <thead class="table-light">
                      <tr>
                        <th class="fw-semibold">
                          <i class="fa fa-user me-1"></i>Nom
                        </th>
                        <th class="fw-semibold">
                          <i class="fa fa-user me-1"></i>Prénoms
                        </th>
                        <th class="fw-semibold">
                          <i class="fa fa-phone me-1"></i>Téléphone
                        </th>
                        <th class="fw-semibold">
                          <i class="fa fa-envelope me-1"></i>E-mail
                        </th>
                        <th class="fw-semibold">
                          <i class="fa fa-briefcase me-1"></i>Fonction
                        </th>
                        <th class="fw-semibold text-center">
                          <i class="fa fa-cogs me-1"></i>Actions
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($personnels as $personnel)
                        <tr>
                          <td class="fw-medium">{{ $personnel->nom ?? 'Non renseigné' }}</td>
                          <td>{{ $personnel->prenom ?? 'Non renseigné' }}</td>
                          <td>
                            @if($personnel->telephone)
                              <a href="tel:{{ $personnel->telephone }}" class="text-decoration-none">
                                {{ $personnel->telephone }}
                              </a>
                            @else
                              <span class="text-muted">Non renseigné</span>
                            @endif
                          </td>
                          <td>
                            @if($personnel->email)
                              <a href="mailto:{{ $personnel->email }}" class="text-decoration-none">
                                {{ $personnel->email }}
                              </a>
                            @else
                              <span class="text-muted">Non renseigné</span>
                            @endif
                          </td>
                          <td>
                            @if($personnel->fonction)
                              <span class="badge bg-info">{{ $personnel->fonction }}</span>
                            @else
                              <span class="text-muted">Non définie</span>
                            @endif
                          </td>
                          <td class="text-center">
                            <div class="btn-group" role="group">
                              <a href="#" class="btn btn-outline-info btn-sm" title="Voir les détails">
                                <i class="fa fa-eye"></i>
                              </a>
                              <a href="#" class="btn btn-outline-primary btn-sm" title="Modifier">
                                <i class="fa fa-edit"></i>
                              </a>
                              <form action="" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce personnel ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Supprimer">
                                  <i class="fa fa-trash"></i>
                                </button>
                              </form>
                            </div>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="6" class="text-center py-4">
                            <div class="text-muted">
                              <i class="fa fa-users fa-3x mb-3 d-block"></i>
                              <h5>Aucun personnel trouvé</h5>
                              <p>Commencez par ajouter du personnel à votre compagnie.</p>
                              <a href="{{ route('personnel.create') }}" class="btn btn-success">
                                <i class="fa fa-plus me-2"></i>Ajouter le premier utilisateur
                              </a>
                            </div>
                          </td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- start: page footer -->

    @include('compagnie.all_element.footer')
  </div>

    <!-- Jquery Page Js -->
  <script src="../assets/js/theme.js"></script>
  <!-- Plugin Js -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  
  <!-- DataTables Enhanced Script -->
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json'
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        columnDefs: [
          { 
            targets: -1, 
            orderable: false,
            searchable: false 
          }
        ],
        order: [[0, 'asc']],
        drawCallback: function() {
          // Réinitialiser les tooltips après chaque redraw
          $('[title]').tooltip();
        }
      });
      
      // Initialiser les tooltips Bootstrap
      $('[title]').tooltip();
    });
  </script>

  <!-- Styles CSS personnalisés -->
  <style>
    .card {
      border: none;
      border-radius: 12px;
    }
    
    .card-header {
      border-bottom: 1px solid #e9ecef;
      border-radius: 12px 12px 0 0 !important;
    }
    
    .table th {
      border-top: none;
      font-weight: 600;
      color: #495057;
      background-color: #f8f9fa;
    }
    
    .table td {
      vertical-align: middle;
      padding: 12px 8px;
    }
    
    .btn-group .btn {
      margin: 0 2px;
    }
    
    .badge {
      font-size: 0.75em;
      padding: 0.35em 0.65em;
    }
    
    .table-responsive {
      border-radius: 0 0 12px 12px;
    }
    
    /* Amélioration responsive */
    @media (max-width: 768px) {
      .card-header .d-flex {
        flex-direction: column;
        gap: 15px;
      }
      
      .btn-group {
        flex-wrap: wrap;
      }
      
      .btn-group .btn {
        margin: 2px;
      }
    }
    
    /* Animation hover sur les lignes */
    .table tbody tr:hover {
      background-color: #f8f9fa;
      transition: background-color 0.2s ease;
    }
    
    /* Style pour les liens */
    a[href^="tel:"], a[href^="mailto:"] {
      color: #0d6efd;
    }
    
    a[href^="tel:"]:hover, a[href^="mailto:"]:hover {
      color: #0a58ca;
      text-decoration: underline !important;
    }
  </style>

</body>

</html>
