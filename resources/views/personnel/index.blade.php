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
                    <td>{{ $personnel->fonction ?? 'Aucune fonction' }}</td>
                    <td>
                      <form action="" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-bus"></i>
                        </button>
                      </form>
                      <a href="" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                      <form action="" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                      </form>
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
