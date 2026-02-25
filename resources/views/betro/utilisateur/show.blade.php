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
           <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="ms-auto">
            <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-light animated-btn">
              <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h6 class="card-title m-0">Détails de l'utilisateur</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <h5>Informations personnelles</h5>
                      <hr>
                      <p><strong>Nom complet :</strong> {{ $utilisateur->prenom }} {{ $utilisateur->nom }}</p>
                      <p><strong>Email :</strong> {{ $utilisateur->email }}</p>
                      <p><strong>Téléphone :</strong> {{ $utilisateur->telephone }}</p>
                      <p><strong>Date de création :</strong> {{ $utilisateur->created_at->format('d/m/Y H:i') }}</p>
                      <p><strong>Dernière mise à jour :</strong> {{ $utilisateur->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <h5>Statut du compte</h5>
                      <hr>
                      <div class="d-flex align-items-center mb-3">
                        <strong class="me-3">Statut actuel :</strong>
                        @if($utilisateur->status === '1')
                          <span class="badge bg-success fs-6 p-2">
                            <i class="bi bi-check-circle me-1"></i> Actif
                          </span>
                        @elseif($utilisateur->status === '3')
                          <span class="badge bg-danger fs-6 p-2">
                            <i class="bi bi-x-circle me-1"></i> Bloqué
                          </span>
                        @else
                          <span class="badge bg-secondary fs-6 p-2">
                            <i class="bi bi-question-circle me-1"></i> Inconnu ({{ $utilisateur->status }})
                          </span>
                        @endif
                      </div>
                      @if($utilisateur->status === '1')
                        <p class="text-muted">
                          <i class="bi bi-info-circle"></i> 
                          L'utilisateur peut se connecter et utiliser toutes les fonctionnalités.
                        </p>
                      @elseif($utilisateur->status === '3')
                        <p class="text-muted">
                          <i class="bi bi-exclamation-triangle"></i> 
                          L'utilisateur ne peut pas se connecter au système.
                        </p>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="mt-4">
                  <div class="d-flex gap-2">
                    <a href="{{ route('admin.utilisateurs.edit', $utilisateur) }}" class="btn btn-primary">
                      <i class="bi bi-pencil"></i> Modifier
                    </a>
                    
                    <!-- Boutons de blocage/déblocage -->
                    <form id="delete-form-{{ $utilisateur->id }}" action="{{ route('admin.utilisateurs.destroy', $utilisateur) }}" method="POST" style="display: none;">
                      @csrf
                      @method('DELETE')
                    </form>
                    @if($utilisateur->status === '1')
                        <button type="button" class="btn btn-sm btn-warning" onclick="confirmAction({{ $utilisateur->id }}, 'bloquer')" title="Bloquer l'utilisateur">
                          <i class="bi bi-lock"></i> Bloquer
                        </button>
                    @elseif($utilisateur->status === '3')
                        <button type="button" class="btn btn-sm btn-success" onclick="confirmAction({{ $utilisateur->id }}, 'débloquer')" title="Débloquer l'utilisateur">
                          <i class="bi bi-unlock"></i> Débloquer
                        </button>
                    @else
                        <span class="text-muted">Action non disponible (statut: {{ $utilisateur->status }})</span>
                    @endif
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- start: page footer -->
    @include('betro.all_element.footer')
  </div>
  
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- Formulaires cachés pour les actions de blocage/déblocage -->
  {{-- @if($utilisateur->status === '1')
  <form id="delete-form-{{ $utilisateur->id }}" action="{{ route('admin.utilisateurs.bloquer', $utilisateur->id) }}" method="POST" style="display: none;">
      @csrf
      @method('PUT')
  </form>
  @elseif($utilisateur->status === '3')
  <form id="delete-form-{{ $utilisateur->id }}" action="{{ route('admin.utilisateurs.debloquer', $utilisateur->id) }}" method="POST" style="display: none;">
      @csrf
      @method('PUT')
  </form>
  @endif --}}
  
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
  
</body>
</html>
