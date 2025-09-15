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
            <form id="filterForm" class="row g-3 mb-3">
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
            </form>

              <div class="col-md-12 mt-4">
              <div class="card">
                <div class="card-body">

                  <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                  <h5 class="mb-0">Liste des Paiement effectuer</h5>
                    {{-- <a href="{{ route('compagnies.create') }}" class="btn btn-success">
                  <i class="fa fa-plus"></i>  Ajouter une compagnie
                    </a> --}}
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

