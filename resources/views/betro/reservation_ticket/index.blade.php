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
            {{-- <form id="filterForm" class="row g-3 mb-3">
                <div class="col-md-3">
                    <label for="start_date" class="form-label">Date début</label>
                    <input type="date" class="form-control" id="start_date" name="start_date">
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="form-label">Date fin</label>
                    <input type="date" class="form-control" id="end_date" name="end_date">
                </div>
                <div class="col-md-3 align-self-end">
                    <button type="button" id="filterBtn" class="btn btn-primary mt-2">
                        <i class="fa fa-filter"></i> Filtrer
                    </button>
                    <button type="button" id="resetBtn" class="btn btn-secondary mt-2">
                        <i class="fa fa-refresh"></i> Réinitialiser
                    </button>
                </div>
            </form> --}}

            {{-- 🔎 Formulaire de filtre --}}
    <form id="filterForm" method="GET" action="{{ route('ticket_reservation.index') }}" class="row g-3 mb-3">
        <div class="col-md-3">
            <label for="start_date" class="form-label">Date début</label>
            <input type="date" class="form-control" id="start_date" name="start_date"
                   value="{{ request('start_date') }}">
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">Date fin</label>
            <input type="date" class="form-control" id="end_date" name="end_date"
                   value="{{ request('end_date') }}">
        </div>
        <div class="col-md-3 align-self-end">
            <button type="submit" id="filterBtn" class="btn btn-primary mt-2">
                <i class="fa fa-filter"></i> Filtrer
            </button>
            <a href="{{ route('ticket_reservation.index') }}" id="resetBtn" class="btn btn-secondary mt-2">
                <i class="fa fa-refresh"></i> Réinitialiser
            </a>
        </div>
    </form>


              <div class="col-md-12 mt-4">
              <div class="card">
                <div class="card-body">

                  <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                  <h5 class="mb-0">Liste des tickets et reservation</h5>
                    {{-- <a href="{{ route('compagnies.create') }}" class="btn btn-success">
                  <i class="fa fa-plus"></i>  Ajouter une compagnie
                    </a> --}}
              </div>

                  <table id="myTable" class="table display dataTable table-hover" style="width:100%">
                    <thead>
                      <tr>
                        <th>Nom complet</th>
                        {{-- <th>Trajet</th> --}}
                        <th>Telephone</th>
                        <th>Montant</th>
                        <th>Numero_place</th>
                        <th>Date Depart et heure</th>
                        <th>trajet</th>
                        <th>Statut</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($reservations as $reservation)
                        <tr>
                          {{-- <td>{{ $reservation->id }}</td> --}}
                          <td>{{ $reservation->utilisateur->nom ?? '-' }} {{ $reservation->utilisateur->prenom ?? '-' }} </td>
                          {{-- <td>{{ $reservation->utilisateur->email ?? '-' }}</td> --}}
                          <td>(+225) {{ $reservation->utilisateur->telephone ?? '-' }}</td>
                          <td>{{ number_format($reservation->voyage->montant ?? 0, 0, ',', ' ') }} FCFA</td> <!-- ✅ Affichage du montant -->      
                          <td>
                              <i class="fa fa-chair me-1" aria-hidden="true"></i>
                              {{ $reservation->numero_place ?? '-' }}
                          </td>
                         <td>{{ $reservation->voyage->date_depart}} {{ $reservation->voyage->heure_depart}}</td>                   
                          {{-- <td>{{ $reservation->created_at->format('d/m/Y') }}</td> --}}
                          {{-- <td>
                            @if($reservation->statut == 1)
                              <span class="badge bg-success">Active</span>
                            @else
                              <span class="badge bg-danger">Annulée</span>
                            @endif
                          </td> --}}
                          <td>
                            @if($reservation->voyage->itineraire && $reservation->voyage->itineraire->arrets->count() > 0)
                            {{ $reservation->voyage->itineraire->arrets->pluck('nom')->implode(' → ') }}
                            @else
                            -
                            @endif
                          </td>
                          <td>Payé</td>

                          <td>
                            <a href="" class="btn btn-info btn-sm">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a href="" class="btn btn-warning btn-sm">
                              <i class="fa fa-edit"></i>
                            </a>
                          </td>
                        </tr>
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

