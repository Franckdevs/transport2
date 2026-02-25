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
    $totalMontant = $reservations->sum(function($reservation) {
        return $reservation->paiement->montant ?? 0;
    });
    $totalReservations = $reservations->count();
@endphp

<!-- Ajoutez cette partie juste avant le formulaire de recherche -->
<div class="alert alert-info mb-3">
    <div class="row">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <div>
                    <small class="text-muted d-block">Montant total</small>
                    <span class="h5 mb-0">{{ number_format($totalMontant, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <div>
                    <small class="text-muted d-block">Nombre de réservations</small>
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
                    <form id="filterForm" method="GET" action="{{ route('ticket_reservation.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Date début</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">Date fin</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button type="submit" id="filterBtn" class="btn btn-primary w-100">
                                <i class="fa fa-filter"></i> <span class="btn-text">Filtrer</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                          </div>
                          <div class="col-md-2 align-self-end">
                          <a href="{{ route('ticket_reservation.index') }}" id="resetBtn" class="btn btn-secondary w-100 mt-2">
                              <i class="fa fa-refresh"></i> <span class="btn-text">Réinitialiser</span>
                              <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                          </a>
                          </div>
                    </form>
                </div>
            </div>


              <div class="col-md-12 mt-4">
              <div class="card">
                <div class="card-body">

                  <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                 
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
                        <th>Date de reservation</th>
                        {{-- <th>Action</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($reservations as $reservation)
                        <tr>
                          {{-- <td>{{ $reservation->id }}</td> --}}
                          <td>{{ $reservation->utilisateur->nom ?? '-' }} {{ $reservation->utilisateur->prenom ?? '-' }} </td>
                          {{-- <td>{{ $reservation->utilisateur->email ?? '-' }}</td> --}}
                          <td>(+225) {{ $reservation->utilisateur->telephone ?? '-' }}</td>
                          <td>{{ number_format($reservation->paiement->montant ?? 0, 0, ',', ' ') }} FCFA</td> <!-- ✅ Affichage du montant -->      
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
                    {{ $reservation->arret->tarification->villeDepart->nom_ville ?? '-' }}
                    &#8594; {{-- → --}}
                    {{ $reservation->arret->tarification->villeArrivee->nom_ville ?? '-' }}
                </td>

                          <td class="badge bg-success text-white">Payé</td>
                          <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>

                          {{-- <td>
                            <a href="" class="btn btn-info btn-sm">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a href="" class="btn btn-warning btn-sm">
                              <i class="fa fa-edit"></i>
                            </a>
                          </td> --}}
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
  </script>

        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page footer -->
    @include('betro.all_element.footer')

