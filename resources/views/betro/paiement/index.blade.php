@php
use App\Helpers\GlobalHelper;
@endphp

@include('betro.all_element.header')

<body class="layout-1" data-luno="theme-black">
  <!-- start: sidebar -->
@include('betro.all_element.sidebar')
  <!-- start: body area -->
  <div class="wrapper">
    <!-- start: page header -->
   @include('betro.all_element.navbar')
    <!-- start: page toolbar -->
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      @include('betro.all_element.cadre')
    </div>
    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row g-3 row-deck">

@php
    $totalMontant = $paiements->sum('montant');
    $totalReservations = $paiements->count();
    $totalPaye = $paiements->where('status', 1)->sum('montant');
    $totalEchoue = $paiements->where('status', '!=', 1)->sum('montant');
    $countPaye = $paiements->where('status', 1)->count();
    $countEchoue = $paiements->where('status', '!=', 1)->count();
@endphp

<!-- Ajoutez cette partie juste avant le formulaire de recherche -->
<div class="alert alert-info mb-3">
    <div class="row">
        <div class="col-md-3">
            <div class="d-flex align-items-center">
                <div>
                    <small class="text-muted d-block">Montant total</small>
                    <span class="h5 mb-0">{{ number_format($totalMontant, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex align-items-center">
                <div>
                    <small class="text-muted d-block text-success">Montant payé</small>
                    <span class="h5 mb-0 text-success">{{ number_format($totalPaye, 0, ',', ' ') }} FCFA</span>
                    <small class="text-success d-block">({{ $countPaye }} transactions)</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex align-items-center">
                <div>
                    <small class="text-muted d-block text-danger">Montant échoué</small>
                    <span class="h5 mb-0 text-danger">{{ number_format($totalEchoue, 0, ',', ' ') }} FCFA</span>
                    <small class="text-danger d-block">({{ $countEchoue }} transactions)</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex align-items-center">
                <div>
                    <small class="text-muted d-block">Total transactions</small>
                    <span class="h5 mb-0">{{ $totalReservations }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

 <div class="card border mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-filter me-2"></i>Filtres de recherche
                    </h5>
                    <form id="filterForm" method="GET" action="{{ route('paiement.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label for="start_date" class="form-label">Date début</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" class="form-label">Date fin</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Tous les statuts</option>
                                <option value="paye" {{ request('status') == 'paye' ? 'selected' : '' }}>Payé</option>
                                <option value="echoue" {{ request('status') == 'echoue' ? 'selected' : '' }}>Échoué</option>
                            </select>
                        </div>
                        <div class="col-md-3 align-self-end">
                            <div class="d-flex gap-2">
                                <button type="submit" id="filterBtn" class="btn btn-primary flex-fill">
                                    <i class="fa fa-filter"></i> <span class="btn-text">Filtrer</span>
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </button>
                                <a href="{{ route('paiement.index') }}" id="resetBtn" class="btn btn-secondary">
                                    <i class="fa fa-refresh"></i> <span class="btn-text">Réinitialiser</span>
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


              <div class="col-md-12 mt-4">
              <div class="card">
                <div class="card-body">

                  <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                  <h5 class="mb-0">Liste des reservations</h5>
                    {{-- <a href="{{ route('compagnies.create') }}" class="btn btn-success">
                  <i class="fa fa-plus"></i>  Ajouter une compagnie
                    </a> --}}
              </div>

                  <table id="myTable" class="table display dataTable table-hover" style="width:100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Numéro Place</th>
                        <th>Montant</th>
                        <th>Moyen Paiement</th>
                        <th>Code Paiement</th>
                        <th>Statut</th>
                        <th>Téléphone</th>
                        <th>Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                              @if(isset($paiements) && $paiements->count() > 0)
                                  @foreach($paiements as $paiement)
                                      <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $paiement->numero_place ?? 'N/A' }}</td>
                                          <td>{{ number_format($paiement->montant ?? 0, 0, ',', ' ') }} FCFA</td>
                                          <td>{{ $paiement->moyenPaiement ?? 'N/A' }}</td>
                                          <td>{{ $paiement->code_paiement ?? 'N/A' }}</td>
                                            <td>
                                              @if($paiement->status == 1)
                                                  <span class="badge bg-success">Payé</span>
                                              @else
                                                  <span class="badge bg-danger">Échoué</span>
                                              @endif
                                          </td>
                                          <td>{{ $paiement->telephone ?? 'N/A' }}</td>
                                          <td>{{ $paiement->created_at ? $paiement->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                          <td>
                                              <a href="{{ route('paiement.show', $paiement->id) }}" class="btn btn-info btn-sm" title="Voir les détails">
                                                  <i class="fas fa-eye"></i>
                                              </a>
                                          </td>
                                      </tr>
                                  @endforeach
                             @else
{{-- <tr>
    <td colspan="9" class="text-center">Aucun paiement trouvé</td>
</tr> --}}
@endif

                          </tbody>
                    
                  </table>
                </div>
              </div>
            </div>


            {{-- <script>
    $(document).ready(function() {
      $('#myTable').addClass('nowrap').dataTable({
        responsive: true,
      });

      // Gestion du spinner pour le bouton de filtrage
      $('#filterForm').on('submit', function() {
        var $btn = $('#filterBtn');
        var $spinner = $btn.find('.spinner-border');
        var $btnText = $btn.find('.btn-text');
        
        // Afficher le spinner et désactiver le bouton
        $spinner.removeClass('d-none');
        $btnText.text('Filtrage...');
        $btn.prop('disabled', true);
      });

      // Gestion du spinner pour le bouton de réinitialisation
      $('#resetBtn').on('click', function() {
        var $btn = $(this);
        var $spinner = $btn.find('.spinner-border');
        var $btnText = $btn.find('.btn-text');
        
        // Afficher le spinner et désactiver le bouton
        $spinner.removeClass('d-none');
        $btnText.text('Reinitialisation...');
        $btn.prop('disabled', true);
      });
    });
  </script> --}}

  <script>
jQuery(document).ready(function($) {
    // Vérifier que la table existe avant d'initialiser DataTables
    const tableElement = $('#myTable');
    if (tableElement.length) {
        try {
            const table = tableElement.DataTable({
                responsive: true,
                pageLength: 10,
                ordering: true,
                autoWidth: false,
                language: {
                    emptyTable: "Aucun paiement trouvé",
                    search: "Rechercher :",
                    lengthMenu: "Afficher _MENU_ lignes",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ paiements",
                    paginate: {
                        previous: "Précédent",
                        next: "Suivant"
                    }
                },
                columnDefs: [
                    { orderable: false, targets: 8 }, // colonne Actions
                    { width: "50px", targets: 0 }, // #
                    { width: "100px", targets: 2 }, // Montant
                    { width: "80px", targets: 8 }  // Actions
                ],
                initComplete: function() {
                    console.log('DataTable initialisé avec succès');
                }
            });
        } catch (error) {
            console.error('Erreur lors de l\'initialisation de DataTable:', error);
        }
    }

    // Gestion du spinner pour le bouton de filtrage
    $('#filterForm').on('submit', function() {
        const $btn = $('#filterBtn');
        const $spinner = $btn.find('.spinner-border');
        const $btnText = $btn.find('.btn-text');
        
        if ($spinner) $spinner.removeClass('d-none');
        if ($btnText) $btnText.addClass('d-none');
        
        setTimeout(function() {
            $btn.prop('disabled', true);
        }, 100);
    });

    // Gestion du spinner pour le bouton de réinitialisation
    $('#resetBtn').on('click', function() {
        const $btn = $(this);
        const $spinner = $btn.find('.spinner-border');
        const $btnText = $btn.find('.btn-text');
        
        if ($spinner) $spinner.removeClass('d-none');
        if ($btnText) $btnText.addClass('d-none');
        
        setTimeout(function() {
            $btn.prop('disabled', true);
        }, 100);
    });
});
</script>
<style>
  table.dataTable tbody tr:hover {
    background-color: #f8f9fa;
}
</style>

        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page footer -->
    @include('betro.all_element.footer')

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

