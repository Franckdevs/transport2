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
                


              <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title m-0">Liste des utilisateurs</h6>
                {{-- <a href="{{ route('admin.utilisateurs.create') }}" class="btn btn-primary btn-sm">
                  <i class="bi bi-plus-lg"></i> Nouvel utilisateur
                </a> --}}
              </div>
              
              <div class="card-body">
                @if(session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif

                @if(session('error'))
                  <div class="alert alert-danger">
                    {{ session('error') }}
                  </div>
                @endif

                <div class="table-responsive">
                  <table class="table table-hover"  id="myTable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Statut</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($utilisateurs as $utilisateur)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $utilisateur->prenom }} {{ $utilisateur->nom }}</td>
                          <td>{{ $utilisateur->email }}</td>
                          <td>{{ $utilisateur->telephone }}</td>
                          <td>
                              @if($utilisateur->status === '1')
                                  <span class="badge bg-success">Actif</span>
                              @elseif($utilisateur->status === '3')
                                  <span class="badge bg-danger">Bloqué</span>
                              @else
                                  <span class="badge bg-secondary">Inconnu ({{ $utilisateur->status }})</span>
                              @endif
                          </td>
                          <td>
                            <div class="d-flex">

                              <a href="{{ route('admin.utilisateurs.show', $utilisateur) }}" class="btn btn-sm btn-primary me-2" title="Voir les détails">
                                <i class="bi bi-eye"></i>
                              </a>

                              <a href="{{ route('admin.utilisateurs.edit', $utilisateur) }}" class="btn btn-sm btn-info me-2" title="Modifier">
                                <i class="bi bi-pencil"></i>
                              </a>

                              {{-- <form id="delete-form-{{ $utilisateur->id }}" action="{{ route('admin.utilisateurs.destroy', $utilisateur) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                              </form>
                              
                              @if($utilisateur->status === '1')
                                  <button type="button" class="btn btn-sm btn-warning" onclick="confirmAction({{ $utilisateur->id }}, 'bloquer')" title="Bloquer l'utilisateur">
                                    <i class="bi bi-lock"></i>
                                  </button>
                              @elseif($utilisateur->status === '3')
                                  <button type="button" class="btn btn-sm btn-success" onclick="confirmAction({{ $utilisateur->id }}, 'débloquer')" title="Débloquer l'utilisateur">
                                    <i class="bi bi-unlock"></i>
                                  </button>
                              @else
                                  <span class="text-muted">Action non disponible (statut: {{ $utilisateur->status }})</span>
                              @endif --}}
                            </div>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="6" class="text-center">Aucun utilisateur trouvé</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>

               

            </div>


              </div>
            </div>

            <!-- SweetAlert2 -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            function confirmAction(userId, action) {
                const actionText = action === 'bloquer' ? 'bloquer' : 'débloquer';
                const actionTextCapitalized = actionText.charAt(0).toUpperCase() + actionText.slice(1);
                
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: `Voulez-vous vraiment ${actionText} cet utilisateur ?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: action === 'bloquer' ? '#ffc107' : '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: `Oui, ${actionText} !`,
                    cancelButtonText: 'Annuler',
                    buttonsStyling: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + userId).submit();
                    }
                });
            }
            </script>


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

