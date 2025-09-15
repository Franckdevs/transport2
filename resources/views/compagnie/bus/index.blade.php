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
                <div class="row g-3 row-deck">
                    <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                        <h5 class="mb-0">Liste des bus</h5>
                        <a href="{{ route('bus.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i> Ajouter un bus
                        </a>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="card">
                            <div class="card-body">

                                <!-- Titre + bouton -->

                                <!-- Barre de recherche personnalisée -->


                                <!-- Tableau -->
                                <table id="myTable" class="table display nowrap table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nom du bus</th>
                                            <th>Modèle</th>
                                            <th>Marque</th>
                                            <th>Immatriculation</th>
                                            <th>Date de création</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bus as $bu)
                                        <tr>
                                            <td>{{ $bu->nom_bus ?? 'Aucun nom' }}</td>
                                            <td>{{ $bu->modele_bus ?? 'Non défini' }}</td>
                                            <td>{{ $bu->marque_bus ?? 'Non défini' }}</td>
                                            <td>{{ $bu->immatriculation_bus ?? 'Non défini' }}</td>
                                            <td>{{ GlobalHelper::formatCreatedAt($bu->created_at) }}</td>
                                            <td>
                                                <a href="{{ route('bus.edit', $bu->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                
                                                <a href="{{ route('bus.show', $bu->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <!-- Bouton modal suppression -->
@if($bu->status == 1)
    <!-- Bouton Supprimer -->
    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteBusModal{{ $bu->id }}">
        <i class="fa fa-trash"></i>
    </button>
@else
    <!-- Bouton Réactiver -->
    <form action="{{ route('activation.bus', $bu->id) }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-success btn-sm">
            <i class="fa fa-check"></i> Réactiver
        </button>
    </form>
@endif

<!-- Modal suppression -->
<div class="modal fade" id="deleteBusModal{{ $bu->id }}" tabindex="-1" aria-labelledby="deleteBusModalLabel{{ $bu->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBusModalLabel{{ $bu->id }}">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer le bus <strong>{{ $bu->nom_bus }} </strong> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('bus.destroy', $bu->id) }}" method="POST" style="display:inline;">
                    @csrf
                    {{-- @method('DELETE') --}}
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>


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

    <!-- Jquery + DataTables 2.x -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <!-- DataTable + recherche personnalisée -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = new DataTable('#myTable');
            const searchInput = document.getElementById('customSearchBus');
            searchInput.addEventListener('input', function() {
                table.search(this.value);
            });
        });
    </script>

</body>
</html>
