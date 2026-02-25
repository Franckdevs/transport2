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
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('agents.store') }}" class="form-validate">
                            @csrf
                            

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                        <input id="nom" type="text" class="form-control form-control-lg @error('nom') is-invalid @enderror" 
                                               name="nom" value="{{ old('nom') }}" required autocomplete="nom">
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
                                               name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom">
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
                                               name="email" value="{{ old('email') }}" required autocomplete="email">
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
                                        <select class="form-control form-control-lg select2" id="role_personnel" name="role_personnel" value="{{ old('role_personnel') }}" required>
                                            <option value="">Sélectionner un rôle</option>
                                            <option value="controleur">Contrôleur</option>
                                            <option value="manager">Manager</option>
                                            <option value="directeur">Directeur</option>
                                            <option value="comptable">Comptable</option>
                                            <option value="assistant_admin">Assistant Admin</option>
                                            <option value="chauffeur">Chauffeur</option>
                                            <option value="receveur">Receveur</option>
                                            <option value="chef_gare">Chef de gare</option>
                                            <option value="planificateur">Planificateur</option>
                                            <option value="agent_vente">Agent de vente</option>
                                            <option value="caissier">Caissier</option>
                                            <option value="service_client">Service client</option>
                                            <option value="technicien">Technicien</option>
                                            <option value="mecanicien">Mécanicien</option>
                                            <option value="electricien">Électricien</option>
                                            <option value="informaticien">Informaticien</option>
                                            <option value="gardien">Gardien</option>
                                            <option value="vigile">Vigile</option>
                                            <option value="chef_securite">Chef de sécurité</option>
                                            <option value="nettoyeur">Nettoyeur</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-warning" id="submitBtn" style="min-width: 120px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-save me-1"></i>
                                    <span id="submitText">Enregistrer</span>
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

          // Gestion du spinner pour le bouton d'enregistrement
          $('form').on('submit', function(e) {
              const submitBtn = $('#submitBtn');
              const spinner = $('#submitSpinner');
              const submitText = $('#submitText');
              
              // Désactiver le bouton et afficher le spinner
              submitBtn.prop('disabled', true);
              spinner.removeClass('d-none');
              submitText.text('Enregistrement...');
          });
      });
  </script>

</body>

</html>
