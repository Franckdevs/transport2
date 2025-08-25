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
