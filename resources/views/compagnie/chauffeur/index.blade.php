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

        </nav>
      </div>
    </header>
    <!-- start: page toolbar -->
  @include('compagnie.all_element.cadre')

        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <div class="row g-3 row-deck">
                    <!-- 🔹 Titre + bouton -->
                    <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                        <h5 class="mb-0">Liste des chauffeurs</h5>
                        <a href="{{ route('chauffeur.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i> Ajouter un chauffeur
                        </a>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="card">
                            <div class="card-body">


                                <!-- 🔹 Barre de recherche -->


                                <!-- 🔹 Tableau -->
                                <table id="myTable" class="table display nowrap table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Nom</th>
                                            <th>Prénoms</th>
                                            <th>Téléphone</th>
                                            <th>Adresse</th>
                                            <th>Numéro permis</th>
                                            <th>Date de naissance</th>
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
                                                Aucune photo
                                                @endif
                                            </td>
                                            <td>{{ $chauffeur->nom ?? 'Aucun nom' }}</td>
                                            <td>{{ $chauffeur->prenom ?? 'Aucun prénom' }}</td>
                                            <td>{{ $chauffeur->telephone ?? 'Aucun téléphone' }}</td>
                                            <td>{{ $chauffeur->adresse ?? 'Aucune adresse' }}</td>
                                            <td>{{ $chauffeur->numeros_permis ?? 'Non renseigné' }}</td>
                                            <td>
                                                {{ $chauffeur->date_naissance ? Carbon::parse($chauffeur->date_naissance)->format('d/m/Y') : 'Non renseignée' }}
                                            </td>
                                            <td>

                                          <!-- Actions Chauffeur -->
<div class="gap-1">
    <!-- Bouton Modifier -->
    <a href="{{ route('modifier.edit', $chauffeur->id) }}" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i>
    </a>

    <!-- Bouton Voir -->
    <a href="{{ route('voir.show',$chauffeur->id) }}" class="btn btn-info btn-sm">
        <i class="fa fa-eye"></i>
    </a>

    @if($chauffeur->status == 3)
        <!-- Bouton Réactiver -->
        <form action="{{ route('activer.destroy_reactivation', $chauffeur->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fa fa-undo"></i> <!-- icône réactivation -->
            </button>
        </form>
    @else
        <!-- Bouton Supprimer -->
        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteChauffeurModal{{ $chauffeur->id }}">
            <i class="fa fa-trash"></i>
        </button>

        <!-- Modal Suppression -->
        <div class="modal fade" id="deleteChauffeurModal{{ $chauffeur->id }}" tabindex="-1" aria-labelledby="deleteChauffeurLabel{{ $chauffeur->id }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteChauffeurLabel{{ $chauffeur->id }}">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
              </div>
              <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce chauffeur : 
                <strong>{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</strong> ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

                <form action="{{ route('activer.destroy', $chauffeur->id) }}" method="POST" style="display:inline;">
                  @csrf
                  <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    @endif
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

    <!-- 🔹 DataTable + recherche personnalisée -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = new DataTable('#myTable');

            const searchInput = document.getElementById('customSearchChauffeurs');
            searchInput.addEventListener('input', function() {
                table.search(this.value);
            });
        });
    </script>
</body>
</html>
