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
                        <a href="" class="btn btn-danger">
                          <i class="fa fa-trash"></i>
                        </a>
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

