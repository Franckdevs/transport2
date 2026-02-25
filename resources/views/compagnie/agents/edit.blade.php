
@php
use App\Helpers\GlobalHelper;
@endphp
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
          <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="ms-auto">
            <a href="{{ route('agents.index') }}" class="btn btn-light">
              <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
          </div>
        </div>
        <div class="row g-xl-3 g-2 mb-3">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('agents.update', $agent->id) }}" class="form-validate">
                            @csrf
                            @method('PUT')
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                        <input id="nom" type="text" class="form-control form-control-lg @error('nom') is-invalid @enderror" 
                                               name="nom" value="{{ old('nom', $agent->nom) }}" required autocomplete="nom">
                                        @error('nom')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                                        <input id="prenom" type="text" class="form-control form-control-lg @error('prenom') is-invalid @enderror" 
                                               name="prenom" value="{{ old('prenom', $agent->prenom) }}" required>
                                        @error('prenom')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                               name="email" value="{{ old('email', $agent->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="role_personnel" class="form-label">Rôle <span class="text-danger">*</span></label>
                                        <select class="form-control form-control-lg select2" id="role_personnel" name="role_personnel" required>
                                            <option value="">Sélectionner un rôle</option>
                                            <option value="controleur" {{ old('role_personnel', $agent->role_personnel) == 'controleur' ? 'selected' : '' }}>Contrôleur</option>
                                            <option value="manager" {{ old('role_personnel', $agent->role_personnel) == 'manager' ? 'selected' : '' }}>Manager</option>
                                            <option value="directeur" {{ old('role_personnel', $agent->role_personnel) == 'directeur' ? 'selected' : '' }}>Directeur</option>
                                            <option value="comptable" {{ old('role_personnel', $agent->role_personnel) == 'comptable' ? 'selected' : '' }}>Comptable</option>
                                            <option value="assistant_admin" {{ old('role_personnel', $agent->role_personnel) == 'assistant_admin' ? 'selected' : '' }}>Assistant Admin</option>
                                            <option value="chauffeur" {{ old('role_personnel', $agent->role_personnel) == 'chauffeur' ? 'selected' : '' }}>Chauffeur</option>
                                            <option value="receveur" {{ old('role_personnel', $agent->role_personnel) == 'receveur' ? 'selected' : '' }}>Receveur</option>
                                            <option value="chef_gare" {{ old('role_personnel', $agent->role_personnel) == 'chef_gare' ? 'selected' : '' }}>Chef de gare</option>
                                            <option value="planificateur" {{ old('role_personnel', $agent->role_personnel) == 'planificateur' ? 'selected' : '' }}>Planificateur</option>
                                            <option value="agent_vente" {{ old('role_personnel', $agent->role_personnel) == 'agent_vente' ? 'selected' : '' }}>Agent de vente</option>
                                            <option value="caissier" {{ old('role_personnel', $agent->role_personnel) == 'caissier' ? 'selected' : '' }}>Caissier</option>
                                            <option value="service_client" {{ old('role_personnel', $agent->role_personnel) == 'service_client' ? 'selected' : '' }}>Service client</option>
                                            <option value="technicien" {{ old('role_personnel', $agent->role_personnel) == 'technicien' ? 'selected' : '' }}>Technicien</option>
                                            <option value="mecanicien" {{ old('role_personnel', $agent->role_personnel) == 'mecanicien' ? 'selected' : '' }}>Mécanicien</option>
                                            <option value="electricien" {{ old('role_personnel', $agent->role_personnel) == 'electricien' ? 'selected' : '' }}>Électricien</option>
                                            <option value="informaticien" {{ old('role_personnel', $agent->role_personnel) == 'informaticien' ? 'selected' : '' }}>Informaticien</option>
                                            <option value="gardien" {{ old('role_personnel', $agent->role_personnel) == 'gardien' ? 'selected' : '' }}>Gardien</option>
                                            <option value="vigile" {{ old('role_personnel', $agent->role_personnel) == 'vigile' ? 'selected' : '' }}>Vigile</option>
                                            <option value="chef_securite" {{ old('role_personnel', $agent->role_personnel) == 'chef_securite' ? 'selected' : '' }}>Chef de sécurité</option>
                                            <option value="nettoyeur" {{ old('role_personnel', $agent->role_personnel) == 'nettoyeur' ? 'selected' : '' }}>Nettoyeur</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6" style="display: none;">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                                        <select id="status" class="form-control form-control-lg @error('status') is-invalid @enderror" name="status" required>
                                            <option value="actif" {{ old('status', $agent->status) === 'actif' ? 'selected' : '' }}>Actif</option>
                                            <option value="desactif" {{ old('status', $agent->status) === 'desactif' ? 'selected' : '' }}>Désactif</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            
                            
                            <div class="card mt-4">
                                <div class="card-header d-flex justify-content-between align-items-center" style="cursor: pointer;" id="passwordToggle">
                                    <div>
                                        <h5 class="mb-0">Modifier le mot de passe</h5>
                                        <small class="text-muted">Remplissez uniquement si vous souhaitez modifier le mot de passe</small>
                                    </div>
                                    <i class="fas fa-chevron-down" id="passwordIcon" style="transition: transform 0.3s ease;"></i>
                                </div>
                                <div class="card-body" id="passwordSection" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Nouveau mot de passe</label>
                                                <div class="input-group">
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                                           name="password" autocomplete="new-password">
                                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                        <i class="fas fa-eye" id="passwordIconToggle"></i>
                                                    </button>
                                                </div>
                                                <small class="form-text text-muted">Laissez vide pour ne pas modifier</small>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="password-confirm" class="form-label">Confirmer le mot de passe</label>
                                                <div class="input-group">
                                                    <input id="password-confirm" type="password" class="form-control" 
                                                           name="password_confirmation" autocomplete="new-password">
                                                    <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                                        <i class="fas fa-eye" id="passwordConfirmIconToggle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-warning" id="submitBtn" style="min-width: 120px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-save me-1"></i>
                                    <span id="submitText">Mettre à jour</span>
                                    <span class="spinner-border spinner-border-sm d-none ms-1" id="submitSpinner" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
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
  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- Vendor Script -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

  <script>
      document.addEventListener("DOMContentLoaded", function() {
          // Initialisation de Select2 pour le champ rôle avec recherche
          $('.select2').select2({
              placeholder: 'Rechercher un rôle...',
              allowClear: true,
              width: '100%',
          });

          // Gestion du spinner pour le bouton de mise à jour
          $('form').on('submit', function(e) {
              const submitBtn = $('#submitBtn');
              const spinner = $('#submitSpinner');
              const submitText = $('#submitText');
              
              // Désactiver le bouton et afficher le spinner
              submitBtn.prop('disabled', true);
              spinner.removeClass('d-none');
              submitText.text('Mise à jour...');
          });

          // Gestion du toggle pour la section mot de passe
          $('#passwordToggle').click(function() {
              const passwordSection = $('#passwordSection');
              const passwordIcon = $('#passwordIcon');
              
              // Toggle la visibilité de la section
              passwordSection.slideToggle();
              
              // Toggle l'icône chevron avec transition
              passwordIcon.toggleClass('fa-chevron-down fa-chevron-up');
          });

          // Gestion du toggle pour afficher/masquer le mot de passe
          $('#togglePassword').click(function() {
              const passwordInput = $('#password');
              const passwordIcon = $('#passwordIconToggle');
              
              if (passwordInput.attr('type') === 'password') {
                  passwordInput.attr('type', 'text');
                  passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
              } else {
                  passwordInput.attr('type', 'password');
                  passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
              }
          });

          // Gestion du toggle pour afficher/masquer la confirmation du mot de passe
          $('#togglePasswordConfirm').click(function() {
              const passwordConfirmInput = $('#password-confirm');
              const passwordConfirmIcon = $('#passwordConfirmIconToggle');
              
              if (passwordConfirmInput.attr('type') === 'password') {
                  passwordConfirmInput.attr('type', 'text');
                  passwordConfirmIcon.removeClass('fa-eye').addClass('fa-eye-slash');
              } else {
                  passwordConfirmInput.attr('type', 'password');
                  passwordConfirmIcon.removeClass('fa-eye-slash').addClass('fa-eye');
              }
          });
      });
  </script>

</body>

</html>
