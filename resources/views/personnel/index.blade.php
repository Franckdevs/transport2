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
      <th>Photo</th>
      <th>Nom</th>
      <th>Prénoms</th>
      <th>Téléphone</th>
      <th>E-mail</th>
      <th>Fonction</th>
      <th>Statut</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($personnels as $personnel)
      <tr>
        <td>
           {{-- <img src="{{ $personnel->photo ? asset($personnel->photo) : asset('assets/img/default-user.png') }}" 
                                             alt="Photo de {{ $personnel->prenom ?? '' }} {{ $personnel->nom ?? '' }}" 
                                             class="profile-image rounded-3 shadow"> --}}
          @if($personnel->photo)
            <img src="{{ asset( $personnel->photo) }}" alt="Photo de {{ $personnel->nom }}" class="rounded-circle" width="40" height="40">
          @else
            <img src="{{ asset('images/default-avatar.png') }}" alt="Photo par défaut" class="rounded-circle" width="40" height="40">
          @endif
        </td>
        <td title="{{ $personnel->nom ?? '' }}">{{ $personnel->nom ? (strlen($personnel->nom) > 10 ? substr($personnel->nom, 0, 10).'...' : $personnel->nom) : 'Aucun nom' }}</td>
        <td title="{{ $personnel->prenom ?? '' }}">{{ $personnel->prenom ? (strlen($personnel->prenom) > 10 ? substr($personnel->prenom, 0, 10).'...' : $personnel->prenom) : 'Aucun prénom' }}</td>
        <td title="{{ $personnel->telephone ?? '' }}">{{ $personnel->telephone ? (strlen($personnel->telephone) > 10 ? substr($personnel->telephone, 0, 10).'...' : $personnel->telephone) : 'Aucun téléphone' }}</td>
        <td title="{{ $personnel->email ?? '' }}">{{ $personnel->email ? (strlen($personnel->email) > 10 ? substr($personnel->email, 0, 10).'...' : $personnel->email) : 'Aucun email' }}</td>
        <td title="{{ $personnel->RolePersonnel->nom_role ?? '' }}">{{ $personnel->RolePersonnel ? (strlen($personnel->RolePersonnel->nom_role) > 10 ? substr($personnel->RolePersonnel->nom_role, 0, 10).'...' : $personnel->RolePersonnel->nom_role) : 'Aucune fonction' }}</td>

        <!-- Affichage du statut -->
        <td>
          @if($personnel->status == 1)
            <span class="badge bg-success">Actif</span>
          @elseif($personnel->status == 3)
            <span class="badge bg-danger">Inactif</span>
          @else
            <span class="badge bg-secondary">Inconnu</span>
          @endif
        </td>

        <!-- Boutons d'action -->
        <td>
          <!-- Voir -->
          <a href="{{ route('personnel.show', $personnel->id) }}" class="btn btn-sm btn-info" title="Voir">
            <i class="fa fa-eye"></i>
          </a>

          <!-- Modifier -->
          <a href="{{ route('personnel.edit', $personnel->id) }}" class="btn btn-sm btn-warning" title="Modifier">
            <i class="fa fa-edit"></i>
          </a>

          <!-- Désactiver ou Réactiver -->
          @if($personnel->status == 1)
            <form action="{{ route('personnel.destroy', $personnel->id) }}" method="POST" id="deleteForm{{ $personnel->id }}" style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-sm btn-danger" title="Désactiver" onclick="confirmDelete({{ $personnel->id }}, '{{ addslashes($personnel->prenom) }} {{ addslashes($personnel->nom) }}')">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          @elseif($personnel->status == 3)
            <form action="{{ route('personnel.reactivation', $personnel->id) }}" method="POST" id="reactivateForm{{ $personnel->id }}" style="display:inline-block;">
              @csrf
              @method('PUT')
              <button type="button" class="btn btn-sm btn-success" title="Réactiver" onclick="confirmReactivate({{ $personnel->id }}, '{{ addslashes($personnel->prenom) }} {{ addslashes($personnel->nom) }}')">
                <i class="fa fa-undo"></i>
              </button>
            </form>
          @endif



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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('assets/js/theme.js') }}"></script>
  <script src="{{ asset('assets/js/bundle/apexcharts.bundle.js') }}"></script>

  <!-- DataTables 2.x initialization -->
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable({
        responsive: true,
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
        }
      });
    });

    // Fonction pour confirmer la désactivation
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Confirmer la désactivation',
            html: `
                <div class="text-left">
                    <p>Attention ! En désactivant <strong>${name}</strong> :</p>
                    <ul style="padding-left: 20px; margin: 15px 0;">
                        <li>L'utilisateur ne pourra plus se connecter</li>
                        <li>Son compte sera marqué comme inactif</li>
                        <li>Vous pourrez le réactiver à tout moment</li>
                    </ul>
                    <p class="mb-0">Êtes-vous sûr de vouloir continuer ?</p>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, désactiver',
            cancelButtonText: 'Annuler',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }

    // Fonction pour confirmer la réactivation
    function confirmReactivate(id, name) {
        Swal.fire({
            title: 'Confirmer la réactivation',
            html: `
                <div class="text-left">
                    <p>Voulez-vous réactiver l'utilisateur <strong>${name}</strong> ?</p>
                    <p class="text-muted">L'utilisateur pourra à nouveau se connecter à son compte.</p>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Oui, réactiver',
            cancelButtonText: 'Annuler',
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('reactivateForm' + id).submit();
            }
        });
    }
  </script>

</body>
</html>