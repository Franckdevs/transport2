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

        <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
          <h5 class="mb-0">Liste des utilisateurs</h5>
          <a href="{{ route('personnel.create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i> Ajouter un utilisateur
          </a>
        </div>

        <div class="card">
          <div class="card-body">

<table id="myTable" class="table display nowrap table-hover" style="width:100%">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénoms</th>
      <th>Téléphone</th>
      <th>E-mail</th>
      <th>Fonction</th>
      <th>Statut</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($personnels as $personnel)
      <tr>
        <td>{{ $personnel->nom ?? 'Aucun nom' }}</td>
        <td>{{ $personnel->prenom ?? 'Aucun prénom' }}</td>
        <td>{{ $personnel->telephone ?? 'Aucun téléphone' }}</td>
        <td>{{ $personnel->email ?? 'Aucun email' }}</td>
        <td>{{ $personnel->RolePersonnel->nom_role ?? 'Aucune fonction' }}</td>

        <!-- Affichage du statut -->
        <td>
          @if($personnel->status == 1)
            <span class="badge bg-success">Actif</span>
          @elseif($personnel->status == 3)
            <span class="badge bg-danger">Inactif</span>
          @else
            <span class="badge bg-secondary">Inconnu</span>
          @endif
        </td>

        <!-- Boutons d'action -->
        <td>
          <!-- Voir -->
          <a href="{{ route('personnel.show', $personnel->id) }}" class="btn btn-sm btn-info" title="Voir">
            <i class="fa fa-eye"></i>
          </a>

          <!-- Modifier -->
          <a href="{{ route('personnel.edit', $personnel->id) }}" class="btn btn-sm btn-warning" title="Modifier">
            <i class="fa fa-edit"></i>
          </a>

          <!-- Désactiver ou Réactiver -->
          {{-- @if($personnel->status == 1)
            <form action="{{ route('personnel.destroy', $personnel->id) }}" method="POST" style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" title="Désactiver" onclick="return confirm('Voulez-vous vraiment désactiver ce personnel ?')">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          @elseif($personnel->status == 3)
            <form action="{{ route('personnel.reactivation', $personnel->id) }}" method="POST" style="display:inline-block;">
              @csrf
              @method('PUT')
              <button type="submit" class="btn btn-sm btn-success" title="Réactiver" onclick="return confirm('Voulez-vous réactiver ce personnel ?')">
                <i class="fa fa-undo"></i>
              </button>
            </form>
          @endif --}}

          @if($personnel->status == 1)
    <!-- Bouton Désactiver -->
    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDesactivate{{ $personnel->id }}">
        <i class="fa fa-trash"></i>
    </button>

    <!-- Modal Désactivation -->
    <div class="modal fade" id="confirmDesactivate{{ $personnel->id }}" tabindex="-1" aria-labelledby="confirmDesactivateLabel{{ $personnel->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="confirmDesactivateLabel{{ $personnel->id }}">Confirmation de désactivation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
          </div>
          <div class="modal-body">
            Voulez-vous vraiment <strong class="text-danger">désactiver</strong> le personnel <br>
            <strong>{{ $personnel->nom }} {{ $personnel->prenom }}</strong> ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <form action="{{ route('personnel.destroy', $personnel->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Oui, désactiver</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@elseif($personnel->status == 3)
    <!-- Bouton Réactiver -->
    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmReactivate{{ $personnel->id }}">
        <i class="fa fa-undo"></i>
    </button>

    <!-- Modal Réactivation -->
    <div class="modal fade" id="confirmReactivate{{ $personnel->id }}" tabindex="-1" aria-labelledby="confirmReactivateLabel{{ $personnel->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="confirmReactivateLabel{{ $personnel->id }}">Confirmation de réactivation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
          </div>
          <div class="modal-body">
            Voulez-vous vraiment <strong class="text-success">réactiver</strong> le personnel <br> 
            <strong>{{ $personnel->nom }} {{ $personnel->prenom }}</strong> ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <form action="{{ route('personnel.reactivation', $personnel->id) }}" method="POST">
              @csrf
              @method('PUT')
              <button type="submit" class="btn btn-success">Oui, réactiver</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endif


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

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
  <script src="../assets/js/theme.js"></script>
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

  <!-- DataTables 2.x initialization -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const table = new DataTable('#myTable');

      // Recherche personnalisée
      const searchInput = document.getElementById('customSearchUsers');
      searchInput.addEventListener('input', function() {
        table.search(this.value);
      });
    });
  </script>

</body>
</html>
 