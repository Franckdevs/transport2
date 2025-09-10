@php
use App\Helpers\GlobalHelper;
@endphp
@include('compagnie.all_element.header')

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-yH+uXGx9Rw2XxEt5Y6YMPJHepcTspU/3tkQ0+5m6I/MeGe/EQKmL7cFfgH7i/2Xx6cGJ0r0PPZ8lks5kJ4Cj+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<body class="layout-1" data-luno="theme-blue">
    @include('compagnie.all_element.sidebar')

    <div class="wrapper">
        @include('compagnie.all_element.navbar')
        @include('compagnie.all_element.cadre')

        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">

        <div class="card mb-3">
            <div class="card-body">
                <h6 class="mb-0">
                    💰 Coût total des réservations :
                    <span class="badge bg-primary px-4 py-3 fs-6">
                    {{ number_format($total_montant, 0, ',', ' ') }} FCFA
                    </span>

                </h6>
            </div>
        </div>

                <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                    <h5 class="mb-0">Listes des réservations</h5>
                    <a href="{{ route('itineraire.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Ajouter un itinéraire
                    </a>
                </div>

                <div class="card">
                 <div class="card-body">
    <!-- Formulaire de filtre par date -->
    <form method="GET" action="{{ route('liste_reservation') }}" class="mb-3 d-flex gap-2 align-items-end">
        <div class="form-group">
            <label for="date_debut">Date début</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ request('date_debut') }}">
        </div>
        <div class="form-group">
            <label for="date_fin">Date fin</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ request('date_fin') }}">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Filtrer</button>
        <a href="{{ route('liste_reservation') }}" class="btn btn-secondary mt-2">Réinitialiser</a>
    </form>

    <div class="table-responsive"> <!-- scroll horizontal sur mobile -->
        <table id="myTable" class="table table-hover table-striped nowrap" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th>Ville de départ</th>
                    <th>Dernier arrêt</th>
                    <th>Montant du trajet</th>
                    <th>Estimation du trajet</th>
                    <th>Date de départ</th>
                    <th>Titre du trajet</th>
                    <th>Date de création</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($liste_reservation as $reservation)
                    <tr>
                        <td>{{ $reservation->voyage->itineraire->ville->nom_ville ?? 'Non défini' }}</td>
                        <td>{{ $reservation->voyage->itineraire->arrets->last()->nom ?? 'Non défini' }}</td>
                        <td>{{ number_format($reservation->voyage->montant ?? 0, 0, ',', ' ') }} FCFA</td>
                        <td>{{ $reservation->voyage->itineraire->estimation ?? 'Non défini' }}</td>
                        {{-- <td>{{ $reservation->voyage->date_depart ?? 'Non défini' }}</td> --}}
                        <td>{{ GlobalHelper::formatCreatedAt($reservation->voyage->date_depart) }}</td>
                        <td>{{ $reservation->voyage->itineraire->titre ?? 'Non défini' }}</td>
                        <td>{{ GlobalHelper::formatCreatedAt($reservation->created_at) }}</td>
                        <td>
                            <span class="badge bg-{{ $reservation->statut == 1 ? 'success' : 'secondary' }}">
                                {{ $reservation->statut == 1 ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                {{-- Actions possibles --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- /.table-responsive -->
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = new DataTable('#myTable', {
                responsive: true,
                paging: true,
                searching: true,
            });

            const searchInput = document.getElementById('customSearch');
            if(searchInput){
                searchInput.addEventListener('input', function() {
                    table.search(this.value);
                });
            }
        });
    </script>
</body>
</html>
