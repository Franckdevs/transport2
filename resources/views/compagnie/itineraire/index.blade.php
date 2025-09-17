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
        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-xl-3 g-2 mb-3">


        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">

                <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                    <h5 class="mb-0">Liste des itinéraires</h5>
                    <a href="{{ route('itineraire.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Ajouter un itineraire
                    </a>
                </div>

                <!-- Barre de recherche personnalisée -->


                <!-- Tableau -->
                <div class="card">
                    <div class="card-body">
                        <table id="myTable" class="table display nowrap table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Ville de départ</th>
                                    <th>Estimation du trajet (h:min)</th>
                                    <th>Titre du trajet</th>
                                    <th>Date de création</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($voyages as $voyage)
                                <tr>
                                    <td>{{ $voyage->ville->nom_ville }}</td>
                                    <td>{{ $voyage->estimation ?? 'Non défini' }}</td>
                                    <td>{{ $voyage->titre ?? 'Non défini' }}</td>
                                    <td>{{ GlobalHelper::formatCreatedAt($voyage->created_at) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $voyage->statut == 1 ? 'success' : 'secondary' }}">
                                            {{ $voyage->statut == 1 ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </td>
                                    
                                 <td>
    <a href="{{ route('itineraire.show', $voyage->id) }}" class="btn btn-info btn-sm">
        <i class="fa fa-eye"></i>
    </a>
    <a href="
    {{ route('itineraire.edit', $voyage->id) }}
     " class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i>
    </a>

    @if($voyage->status == 1)
        <!-- Bouton Désactiver -->
        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDesactiver{{ $voyage->id }}">
            <i class="fa fa-trash"></i>
        </button>

        <!-- Modal Désactiver -->
        <div class="modal fade" id="modalDesactiver{{ $voyage->id }}" tabindex="-1" aria-labelledby="modalDesactiverLabel{{ $voyage->id }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalDesactiverLabel{{ $voyage->id }}">Confirmer la désactivation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
              </div>
              <div class="modal-body">
                Voulez-vous vraiment désactiver ce voyage ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('itineraire.destroy', $voyage->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Désactiver</button>
                </form>
              </div>
            </div>
          </div>
        </div>

    @elseif($voyage->status == 3)
        <!-- Bouton Réactiver -->
        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalReactiver{{ $voyage->id }}">
            <i class="fa fa-undo"></i>
        </button>

        <!-- Modal Réactiver -->
        <div class="modal fade" id="modalReactiver{{ $voyage->id }}" tabindex="-1" aria-labelledby="modalReactiverLabel{{ $voyage->id }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalReactiverLabel{{ $voyage->id }}">Confirmer la réactivation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
              </div>
              <div class="modal-body">
                Voulez-vous réactiver ce voyage ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('itineraire.reactivation', $voyage->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Réactiver</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    @endif
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
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <!-- DataTables 2.x + recherche personnalisée -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = new DataTable('#myTable');

            const searchInput = document.getElementById('customSearch');
            searchInput.addEventListener('input', function() {
                table.search(this.value);
            });
        });
    </script>
</body>
</html>
