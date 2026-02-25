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
        {{-- <h3 class="mb-4 text-uppercase">
          <i class="fas fa-cogs me-2"></i>Paramètres du compte
        </h3> --}}

        @if(session('success'))
        <div class="alert alert-success" role="alert">
          <i class="fas fa-check-circle me-2"></i>
          {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-warning" role="alert">
          <i class="fas fa-exclamation-triangle me-2"></i>
          {{ $errors->first() }}
        </div>
        @endif

        <div class="row">
          <!-- Informations utilisateur -->
          <div class="col-lg-12 mb-4">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center" style="cursor: pointer;" onclick="toggleSection('adminInfo')">
                <h5 class="mb-0">
                  <i class="fas fa-user-edit me-2"></i>
                  Mes informations administrateur
                </h5>
                <i class="fas fa-chevron-down" id="adminInfoIcon"></i>
              </div>
              <div class="card-body" id="adminInfoSection" style="display: none;">
                <form action="{{ route('parametre.update-infos') }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" 
                           value="{{ auth()->user()->nom }}" placeholder="Votre nom">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" 
                           value="{{ auth()->user()->prenom }}" placeholder="Votre prénom">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" 
                           value="{{ auth()->user()->telephone }}" placeholder="Votre téléphone">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" 
                           value="{{ auth()->user()->email }}" placeholder="Votre email">
                  </div>

                  <button type="submit" class="btn btn-warning btn-submit">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <i class="fas fa-save me-2"></i>Mettre à jour
                  </button>
                </form>
              </div>
            </div>
          </div>

          <!-- Modifier le logo de la compagnie -->
          @if(auth()->user()->info_user && auth()->user()->info_user->compagnie)
          <div class="col-lg-6 mb-4">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center" style="cursor: pointer;" onclick="toggleSection('logoSection')">
                <h5 class="mb-0">
                  <i class="fas fa-image me-2"></i>
                  Logo de la compagnie
                </h5>
                <i class="fas fa-chevron-down" id="logoSectionIcon"></i>
              </div>
              <div class="card-body text-center" id="logoSectionSection" style="display: none;">
                <form  action="{{ route('parametre.update-logo') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  
                  <div class="mb-3">
                    <img id="logo-preview" 
                         src="{{ auth()->user()->info_user->compagnie->logo_compagnies ? asset( auth()->user()->info_user->compagnie->logo_compagnies) : asset('assets/images/default-company-logo.png') }}" 
                         class="img-fluid rounded-circle mb-3" 
                         style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #e9ecef;"
                         alt="Logo de la compagnie">
                  </div>
                  
                  <div class="input-group mb-3">
                    <input type="file" name="logo" id="logo" class="form-control" 
                           accept="image/jpeg,image/png,image/jpg,image/gif,image/svg" required>
                    <button type="submit" class="btn btn-warning btn-submit">
                      <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                      <i class="fas fa-upload me-1"></i> Mettre à jour
                    </button>
                  </div>
                  
                  <small class="text-muted">Formats acceptés: JPG, PNG, GIF, SVG (max 25MB)</small>
                </form>
              </div>
            </div>
          </div>
          @endif

          <!-- Changer le mot de passe -->
          <div class="col-lg-6 mb-4">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center" style="cursor: pointer;" onclick="toggleSection('passwordSection')">
                <h5 class="mb-0">
                  <i class="fas fa-lock me-2"></i>
                  Changer le mot de passe
                </h5>
                <i class="fas fa-chevron-down" id="passwordSectionIcon"></i>
              </div>
              <div class="card-body" id="passwordSectionSection" style="display: none;">
                <form action="{{ route('parametre.update-password') }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="mb-3">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="new_password" class="form-control" required 
                           placeholder="Saisir le nouveau mot de passe">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="new_password_confirmation" id="confirm_password" class="form-control" required 
                           placeholder="Confirmer le nouveau mot de passe" onkeyup="checkPasswordMatch()">
                    <div id="passwordMatchMessage" class="mt-2"></div>
                  </div>

                  <button type="submit" class="btn btn-warning btn-submit" id="submitPasswordBtn" disabled>
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <i class="fas fa-lock me-2"></i>Modifier le mot de passe
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      @include('compagnie.all_element.footer')
    </div> <!-- .wrapper end -->
  </div>
</body>

<style>
  .btn-warning, .btn-primary, .btn-success {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    background-color: #ffc107;
    border-color: #ffc107;
    color: #000;
  }
  
  .btn-warning:hover, .btn-primary:hover, .btn-success:hover {
    background-color: #e0a800 !important;
    border-color: #d39e00 !important;
    color: #000 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  .btn-loading .spinner-border {
    display: inline-block !important;
    margin-right: 5px;
  }
  
  .btn-loading span:not(.spinner-border) {
    display: none;
  }
</style>

@push('scripts')
<script>
// Fonction pour basculer l'affichage des sections
function toggleSection(sectionId) {
  const section = document.getElementById(sectionId + 'Section');
  const icon = document.getElementById(sectionId + 'Icon');
  
  if (section && icon) {
    if (section.style.display === 'none' || !section.style.display) {
      section.style.display = 'block';
      icon.classList.remove('fa-chevron-down');
      icon.classList.add('fa-chevron-up');
    } else {
      section.style.display = 'none';
      icon.classList.remove('fa-chevron-up');
      icon.classList.add('fa-chevron-down');
    }
  }
}

// Gestion de la soumission des formulaires
function setupFormSubmissions() {
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
      const submitBtn = this.querySelector('.btn-submit');
      if (submitBtn) {
        const spinner = submitBtn.querySelector('.spinner-border');
        const icon = submitBtn.querySelector('i');
        
        // Afficher le spinner et masquer l'icône
        if (spinner) spinner.classList.remove('d-none');
        if (icon) icon.style.display = 'none';
        
        // Désactiver le bouton
        submitBtn.disabled = true;
        submitBtn.classList.add('btn-loading');
        
        // Si le formulaire n'est pas celui du logo, on laisse le comportement par défaut
        if (!this.id || this.id !== 'logo-upload-form') {
          return true;
        } else {
          e.preventDefault();
        }
      }
    });
  });
}

// Gestion de la prévisualisation du logo
// Vérifie si les mots de passe correspondent
function checkPasswordMatch() {
  const password = document.querySelector('input[name="new_password"]');
  const confirmPassword = document.getElementById('confirm_password');
  const message = document.getElementById('passwordMatchMessage');
  const submitBtn = document.getElementById('submitPasswordBtn');
  
  if (password.value !== confirmPassword.value) {
    message.innerHTML = '<div class="text-danger"><i class="fas fa-times-circle me-1"></i>Les mots de passe ne correspondent pas</div>';
    submitBtn.disabled = true;
    submitBtn.classList.add('disabled');
    return false;
  } else if (password.value === '' || confirmPassword.value === '') {
    message.innerHTML = '';
    submitBtn.disabled = true;
    submitBtn.classList.add('disabled');
    return false;
  } else {
    message.innerHTML = '<div class="text-success"><i class="fas fa-check-circle me-1"></i>Les mots de passe correspondent</div>';
    submitBtn.disabled = false;
    submitBtn.classList.remove('disabled');
    return true;
  }
}

// Ajouter l'écouteur d'événement pour le premier champ de mot de passe
document.addEventListener('DOMContentLoaded', function() {
  const passwordInput = document.querySelector('input[name="new_password"]');
  if (passwordInput) {
    passwordInput.addEventListener('keyup', checkPasswordMatch);
  }
});

function setupLogoPreview() {
  const logoInput = document.getElementById('logo');
  const logoPreview = document.getElementById('logo-preview');

  if (logoInput && logoPreview) {
    logoInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          logoPreview.src = e.target.result;
        }
        reader.readAsDataURL(file);
      }
    });
  }
}

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
  // Configurer les événements
  setupFormSubmissions();
  setupLogoPreview();
  
  // Toutes les sections sont fermées par défaut
  // Aucune section ne s'ouvre automatiquement

  // Gestion de la soumission du formulaire de logo
  const logoForm = document.getElementById('logo-upload-form');
  if (logoForm) {
    logoForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      const submitBtn = this.querySelector('button[type="submit"]');
      const originalBtnText = submitBtn.innerHTML;
      
      // Désactiver le bouton et afficher un indicateur de chargement
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mise à jour...';
      
      fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Mettre à jour l'aperçu du logo
          if (data.logo_url) {
            logoPreview.src = data.logo_url + '?t=' + new Date().getTime();
          }
          showAlert('success', 'Logo mis à jour avec succès');
        } else {
          showAlert('danger', data.message || 'Une erreur est survenue');
        }
      })
      .catch(error => {
        console.error('Erreur:', error);
        showAlert('danger', 'Une erreur est survenue lors de la mise à jour du logo');
      })
      .finally(() => {
        // Réactiver le bouton
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
      });
    });
  }

  // Gestion de la soumission des formulaires
document.querySelectorAll('form').forEach(form => {
  form.addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('.btn-submit');
    if (submitBtn) {
      const spinner = submitBtn.querySelector('.spinner-border');
      const icon = submitBtn.querySelector('i');
      
      // Afficher le spinner et masquer l'icône
      if (spinner) spinner.classList.remove('d-none');
      if (icon) icon.style.display = 'none';
      
      // Désactiver le bouton
      submitBtn.disabled = true;
      submitBtn.classList.add('btn-loading');
      
      // Si le formulaire n'est pas celui du logo, on laisse le comportement par défaut
      if (!this.id || this.id !== 'logo-upload-form') {
        return true;
      }
    }
  });
});

function showAlert(type, message) {
    // Créer ou mettre à jour une alerte existante
    let alertDiv = document.getElementById('logo-alert');
    if (!alertDiv) {
      alertDiv = document.createElement('div');
      alertDiv.id = 'logo-alert';
      alertDiv.className = 'alert';
      document.querySelector('.card-body').insertBefore(alertDiv, document.querySelector('form'));
    }
    
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
      <i class="${type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle'} me-2"></i>
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    `;
    
    // Supprimer l'alerte après 5 secondes
    setTimeout(() => {
      if (alertDiv) {
        alertDiv.remove();
      }
    }, 5000);
  }
});
</script>
@endpush
  
  @stack('scripts')
</html>
