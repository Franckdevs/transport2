
@include('compagnie.all_element.header')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
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

    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-xl-3 g-2 mb-3">


            <div class="page-body">
    <div class="container-fluid">

              <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="ms-auto">
            <a href="{{ route('agents.index') }}" class="btn btn-light">
              <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
          </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="text-end">
                            <div class="btn-group d-inline-block">
                                <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-warning me-2">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                @if($agent->status === 'actif')
                                    <form action="{{ route('agents.toggle-status', $agent->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-sm" title="Désactiver">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('agents.toggle-status', $agent->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm" title="Activer">
                                            <i class="fas fa-user-check"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-3 text-center">
                                <div class="mb-3">
                                    {{-- <div class="avatar avatar-xxl mb-2">
                                        <div class="avatar-title bg-light rounded-circle">
                                            <i class="fas fa-user-tie fa-3x text-primary"></i>
                                        </div>
                                    </div> --}}
                                    @if($agent->role_personnel == 'controleur')
                                    <div class="mb-2">
                                        {!! QrCode::size(120)->generate($agent->token) !!}
                                    </div>
                                    @endif
                                    {{-- <div class="small text-muted">ID: {{ $agent->id }}</div> --}}
                                </div>
                                <h5 class="mb-1">{{ $agent->prenom }} {{ $agent->nom }}</h5>
                                <span class="badge {{ $agent->status === 'actif' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($agent->status) }}
                                </span>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">ID</label>
                                            <p class="form-control-static">{{ $agent->id }}</p>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold me-2">Email :</label>
                                            <span class="form-control-static d-inline">
                                                <a href="mailto:{{ $agent->email }}">{{ $agent->email }}</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                            

                                      <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold me-2">Role :</label>
                                            <span class="form-control-static d-inline">{{ $agent->role_personnel ?? 'N/A' }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold me-2">Date de création :</label>
                                            <span class="form-control-static d-inline">
                                                {{ $agent->created_at->format('d/m/Y à H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold me-2">Dernière mise à jour :</label>
                                            <span class="form-control-static d-inline">
                                                {{ $agent->updated_at->format('d/m/Y à H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Ajoutez ce code après la section de détail de l'agent -->
                                                            @if($agent->role_personnel == 'controleur')

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Liste des réservations traitées par cet agent</h5>
            </div>
            <div class="card-body">
                @if($liste_des_reservaion_valider_par_cette_agent->count() > 0)
                    <table id="reservationsTable" class="table display nowrap table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>N° Réservation</th>
                                <th>Date</th>
                                <th>Départ</th>
                                <th>Arrivée</th>
                                <th>Montant</th>
                                <th>Statut Paiement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($liste_des_reservaion_valider_par_cette_agent as $reservation)
                                <tr>
                                    <td>{{ $reservation->numero_reservation }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($reservation->arret && $reservation->arret->tarification && $reservation->arret->tarification->villeDepart)
                                            {{ $reservation->arret->tarification->villeDepart->nom_ville ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($reservation->arret && $reservation->arret->tarification && $reservation->arret->tarification->villeArrivee)
                                            {{ $reservation->arret->tarification->villeArrivee->nom_ville ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($reservation->paiement)
                                            {{ number_format($reservation->paiement->montant, 0, ',', ' ') }} FCFA
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Scanné</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        Aucune réservation trouvée pour cet agent.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



        </div> <!-- .row end -->



      </div>
    </div>
    <!-- start: page footer -->

    @include('compagnie.all_element.footer')
  </div>

    <!-- Jquery Page Js -->
  <script src="../assets/js/theme.js"></script>
  <!-- Plugin Js -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  <!-- Vendor Script -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation de DataTable pour les réservations
        const reservationsTable = new DataTable('#reservationsTable', {
            language: {
                search: "Rechercher :",
                lengthMenu: "Afficher _MENU_ éléments par page",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                infoEmpty: "Aucun élément à afficher",
                infoFiltered: "(filtrés depuis _MAX_ éléments au total)",
                paginate: {
                    first: "Premier",
                    last: "Dernier",
                    next: "Suivant",
                    previous: "Précédent"
                }
            }
        });

        // Initialisation des tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        document.querySelectorAll('form[action*="toggle-status"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const button = this.querySelector('button[type="submit"]');
                const isActivating = button.classList.contains('btn-success');
                const action = isActivating ? 'activer' : 'désactiver';
                const agentName = '{{ $agent->prenom }} {{ $agent->nom }}';

                Swal.fire({
                    title: `Confirmer l'${action}ion`,
                    text: `Êtes-vous sûr de vouloir ${action} l'agent ${agentName} ?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: isActivating ? '#28a745' : '#ffc107',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: `Oui, ${action}`,
                    cancelButtonText: 'Annuler',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    });
  </script>

</body>

</html>
