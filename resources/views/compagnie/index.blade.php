@php
use Carbon\Carbon;
use App\Helpers\GlobalHelper;
@endphp

@include('compagnie.all_element.header')

<!-- DataTables 2.3.3 CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">

<body class="layout-1" data-luno="theme-blue">
    @include('compagnie.all_element.sidebar')

    <div class="wrapper">
        @include('compagnie.all_element.navbar')
        @include('compagnie.all_element.cadre')

        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">

                <!-- 🔹 Barre de recherche personnalisée -->
                <div class="mb-3" style="max-width: 400px;">
                    <input type="text" id="customSearch" class="form-control"
                        placeholder="Rechercher...">
                </div>

                <!-- 🔹 Tableau générique -->
                <div class="card">
                    <div class="card-body">
                        <table id="mainTable" class="table display nowrap table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Colonne 1</th>
                                    <th>Colonne 2</th>
                                    <th>Colonne 3</th>
                                    <th>Colonne 4</th>
                                    <th>Colonne 5</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->col1 ?? '-' }}</td>
                                    <td>{{ $item->col2 ?? '-' }}</td>
                                    <td>{{ $item->col3 ?? '-' }}</td>
                                    <td>{{ $item->col4 ?? '-' }}</td>
                                    <td>{{ $item->col5 ?? '-' }}</td>
                                    <td>
                                        <!-- Boutons actions -->
                                        <a href="{{ route($route_show, $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route($route_edit, $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- Modal suppression -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Confirmer la suppression</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Êtes-vous sûr de vouloir supprimer cet élément ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <form action="{{ route($route_delete, $item->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> <!-- .container-fluid -->
        </div> <!-- .page-body -->

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
            const table = new DataTable('#mainTable');

            // Recherche personnalisée
            const searchInput = document.getElementById('customSearch');
            searchInput.addEventListener('input', function() {
                table.search(this.value);
            });
        });
    </script>
</body>
</html>
