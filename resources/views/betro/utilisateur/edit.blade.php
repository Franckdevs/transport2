
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
        <div class="row g-3 row-deck">



<div class="container-fluid">
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title m-0">Modifier l'utilisateur</h6>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.utilisateurs.update', $utilisateur) }}" method="POST" id="editUserForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" 
                                           value="{{ old('prenom', $utilisateur->prenom) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" 
                                           value="{{ old('nom', $utilisateur->nom) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email', $utilisateur->email) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="telephone">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" 
                                   value="{{ old('telephone', $utilisateur->telephone) }}" required>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Changer le mot de passe</h6>
                                    <small class="text-muted">Optionnel - Laissez vide pour conserver le mot de passe actuel</small>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="togglePasswordSection()">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                    <span id="toggleText">Afficher</span>
                                </button>
                            </div>
                            <div class="card-body" id="passwordSection" style="display: none; overflow: hidden; transition: all 0.3s ease-in-out;">
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Attention : Ne modifiez le mot de passe que si c'est absolument nécessaire.
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Nouveau mot de passe</label>
                                    <input type="password" class="form-control" id="password" name="password" style="transition: all 0.2s ease;">
                                    <small class="text-muted">Minimum 8 caractères</small>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmer le mot de passe</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" style="transition: all 0.2s ease;">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('admin.utilisateurs.index') }}">
                                {{-- <i class="bi bi-arrow-left"></i> Retour --}}
                            </a>

                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="bi bi-check-lg" id="submitIcon"></i> 
                                <span id="submitText">Enregistrer les modifications</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
             

   

        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page footer -->
    @include('betro.all_element.footer')

    <style>
    .spinner-border-sm {
        width: 1rem;
        height: 1rem;
        border-width: 0.15em;
    }
    </style>

    <script>
    function togglePasswordSection() {
        const passwordSection = document.getElementById('passwordSection');
        const toggleIcon = document.getElementById('toggleIcon');
        const toggleText = document.getElementById('toggleText');
        const toggleButton = toggleIcon.parentElement;
        
        if (passwordSection.style.display === 'none' || passwordSection.style.display === '') {
            // Animation d'ouverture
            passwordSection.style.display = 'block';
            passwordSection.style.opacity = '0';
            passwordSection.style.maxHeight = '0px';
            
            setTimeout(() => {
                passwordSection.style.opacity = '1';
                passwordSection.style.maxHeight = '500px';
            }, 10);
            
            toggleIcon.className = 'bi bi-eye-slash';
            toggleText.textContent = 'Masquer';
            toggleButton.classList.add('btn-primary');
            toggleButton.classList.remove('btn-outline-secondary');
            
            // Animation de l'icône
            toggleIcon.style.transform = 'rotate(180deg)';
            toggleIcon.style.transition = 'transform 0.3s ease';
            
        } else {
            // Animation de fermeture
            passwordSection.style.opacity = '0';
            passwordSection.style.maxHeight = '0px';
            
            setTimeout(() => {
                passwordSection.style.display = 'none';
            }, 300);
            
            toggleIcon.className = 'bi bi-eye';
            toggleText.textContent = 'Afficher';
            toggleButton.classList.remove('btn-primary');
            toggleButton.classList.add('btn-outline-secondary');
            
            // Animation de l'icône
            toggleIcon.style.transform = 'rotate(0deg)';
            
            // Vider les champs de mot de passe lors du masquage
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';
        }
    }
    
    // Ajouter des animations aux champs de formulaire
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
        
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
                this.style.boxShadow = '0 0 0 3px rgba(13, 110, 253, 0.25)';
            });
            
            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = 'none';
            });
        });
        
        // Animation du bouton submit
        const submitBtn = document.getElementById('submitBtn');
        if (submitBtn) {
            submitBtn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
            });
            
            submitBtn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        }
        
        // Gestion du spinner lors de la soumission
        const editForm = document.getElementById('editUserForm');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                const submitBtn = document.getElementById('submitBtn');
                const submitIcon = document.getElementById('submitIcon');
                const submitText = document.getElementById('submitText');
                
                // Désactiver le bouton et afficher le spinner
                submitBtn.disabled = true;
                submitBtn.classList.add('disabled');
                
                // Remplacer l'icône par un spinner
                submitIcon.className = 'spinner-border spinner-border-sm me-2';
                submitIcon.setAttribute('role', 'status');
                submitIcon.setAttribute('aria-hidden', 'true');
                
                // Changer le texte
                submitText.textContent = 'Enregistrement en cours...';
            });
        }
    });
    </script>

</body>
</html>
