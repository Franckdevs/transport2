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

           <!-- Filtre par date -->
          <form id="filterForm" class="row g-3 mb-3" method="GET" action="{{ route('compagnies') }}">
    <div class="col-md-3">
        <label for="start_date" class="form-label">Date début</label>
        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
    </div>
    <div class="col-md-3">
        <label for="end_date" class="form-label">Date fin</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
    </div>
    <div class="col-md-3 align-self-end">
        <button type="submit" class="btn btn-primary mt-2">
            <i class="fa fa-filter"></i> Filtrer
        </button>
        <a href="{{ route('compagnies') }}" class="btn btn-secondary mt-2">
            <i class="fa fa-refresh"></i> Réinitialiser
        </a>
    </div>
</form>


             <div class="col-md-12 mt-4">
            <div class="card">
              <div class="card-body">

                 <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                <h5 class="mb-0">Liste des compagnies</h5>
                <a href="{{ route('compagnies.create') }}" class="btn btn-success">
               <i class="fa fa-plus"></i>  Ajouter une compagnie
                </a>
            </div>

                <table id="myTable" class="table display dataTable table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>Nom complet</th>
                      <th>Email</th>
                      <th>Telephone</th>
                      <th>Adresse</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($compagnies as $compagnie)

                    <tr>
                      <td>{{ $compagnie->nom_complet_compagnies }}</td>
                      <td>{{ $compagnie->email_compagnies }}</td>
                      <td>{{ $compagnie->telephone_compagnies }}</td>
                      <td>{{ $compagnie->adresse_compagnies }}</td>
                      <td>{{ GlobalHelper::formatCreatedAt($compagnie->created_at) }}</td>
                      <td>
                        <a href="{{ route('compagnies.edit', $compagnie->id) }}" class="btn btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ route('compagnies.show', $compagnie->id) }}" class="btn btn-info">
                          <i class="fa fa-eye"></i>
                        </a>
                      {{-- <form action="{{ route('compagnies.destroy', $compagnie->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette compagnie ?')">
        <i class="fa fa-trash"></i>
    </button>
</form> --}}
<!-- Bouton de suppression -->
@if($compagnie->status == 1)
    <!-- Bouton Supprimer -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $compagnie->id }}">
<i class="fa fa-ban"></i>    </button>
@else
    <!-- Bouton Réactiver -->
    <form action="{{ route('compagnies.reactivate', $compagnie->id) }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-success">
            <i class="fa fa-refresh"></i>
        </button>
    </form>
@endif
@if($compagnie->status == 1)
<div class="modal fade" id="confirmDeleteModal{{ $compagnie->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel{{ $compagnie->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Ajout de modal-lg -->
    <div class="modal-content">
      
      <!-- Header -->
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="confirmDeleteLabel{{ $compagnie->id }}">
          Confirmation de blocage
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      
      <!-- Body -->
      <div class="modal-body">
        <p>
          Attention ! En bloquant <strong>{{ $compagnie->nom_complet_compagnies }}</strong> :
        </p>
        <ul>
          <li>Toutes les gares associées seront désactivées.</li>
          <li>Tous les utilisateurs possédant des droits seront déconnectés.</li>
          <li>Ils ne pourront plus se connecter tant que la compagnie est bloquée.</li>
        </ul>
        <p>Voulez-vous continuer ?</p>
      </div>
      
      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        
        {{-- <form action="{{ route('compagnies.destroy', $compagnie->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fa fa-ban"></i> Bloquer
            </button>
        </form> --}}
      </div>
    </div>
  </div>
</div>

@endif

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
    <!-- start: page footer -->
    @include('betro.all_element.footer')

