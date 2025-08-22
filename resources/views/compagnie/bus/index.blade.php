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
        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-xl-3 g-2 mb-3">

             <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row g-3 row-deck">


             <div class="col-md-12 mt-4">
            <div class="card">
              <div class="card-body">

                 <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                <h5 class="mb-0">Liste des gares</h5>
                <a href="{{ route('bus.create') }}" class="btn btn-success">
               <i class="fa fa-plus"></i>  Ajouter une gare
                </a>
            </div>

                <table id="myTable" class="table display dataTable table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>Nom du bus</th>
                      <th>modele du bus</th>
                      <th>marque du bus</th>
                      <th>immatriculation</th>
                      <th>Date de création</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                @foreach ($bus as $bu)

                    <tr>
                      <td>{{ $bu->nom_bus ?? 'Aucun nom' }}</td>
                      <td>{{ $bu->modele_bus ?? 'Aucune adresse' }}</td>
                      <td>{{ $bu->marque_bus ?? 'Aucune heure' }}</td>
                      <td>{{ $bu->immatriculation_bus ?? 'Aucune heure' }}</td>
                      <td>{{ GlobalHelper::formatCreatedAt($bu->created_at) }}</td>

                      <td>
                   <form action="" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                    <i class="fa fa-bus"></i> Bus
                    </button>
                    </form>
                    <!-- Bouton pour modifier le bus -->
                    <a href="{{ route('bus.edit', $bu->id) }}" class="btn btn-warning">
                        <i class="fa fa-edit"></i>
                    </a>

                        <a href="{{ route('bus.show', $bu->id) }}" class="btn btn-info">
                          <i class="fa fa-eye"></i>
                        </a>


                        {{-- <form action="{{ route('bus.destroy', $bu->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce bus ?')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form> --}}

                    <!-- Bouton pour ouvrir la modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBusModal{{ $bu->id }}">
                        <i class="fa fa-trash"></i>
                    </button>

                                    <!-- Modal -->
                <div class="modal fade" id="deleteBusModal{{ $bu->id }}" tabindex="-1" aria-labelledby="deleteBusModalLabel{{ $bu->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteBusModalLabel{{ $bu->id }}">Confirmer la suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer le bus <strong>{{ $bu->nom_bus }}</strong> ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

                        <form action="{{ route('bus.destroy', $bu->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                    </div>
                </div>
                </div>



                      </td>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
            <script>
    $(document).ready(function() {
      $('#myTable').addClass('nowrap').dataTable({
        responsive: true,
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
  <script src="../assets/js/theme.js"></script>
  <!-- Plugin Js -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  <!-- Vendor Script -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

</body>

</html>
