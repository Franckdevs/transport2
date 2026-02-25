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
                {{-- <h1 class="page-title mb-0">
                    <i class="fas fa-plus-circle me-2"></i>Créer un nouvel itinéraire
                </h1> --}}
                <div class="ms-auto">
                    <a href="{{ route('modifier_admin_gare.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                </div>
            </div>

        <div class="row g-3">
    <div class="col-12">
        <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-user-shield me-2"></i>
                        @if($adminActuel)
                            Modifier l'Administrateur - {{ $gare->nom_gare }}
                        @else
                            Ajouter un Administrateur - {{ $gare->nom_gare }}
                        @endif
                    </h4>
                    {{-- <a href="{{ route('modifier_admin_gare.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                    </a> --}}
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Informations de la gare -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="alert alert-info">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle me-3"></i>
                                    <div>
                                        <strong>Gare:</strong> {{ $gare->nom_gare }}<br>
                                        <strong>Ville:</strong> {{ $gare->ville?->nom_ville ?? 'N/A' }}<br>
                                        <strong>Adresse:</strong> {{ $gare->adresse_gare ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire de modification -->
                    <form method="POST" action="{{ route('modifier_admin_gare.update', $gare->id) }}" id="adminForm">
                        @csrf
                        @if($adminActuel)
                            <input type="hidden" name="admin_id" value="{{ $adminActuel->id }}">
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">
                                            <i class="fas fa-user me-2"></i>Informations Personnelles
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nom" name="nom" 
                                                   value="{{ old('nom', $adminActuel?->nom) }}" required>
                                            @error('nom')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="prenom" name="prenom" 
                                                   value="{{ old('prenom', $adminActuel?->prenom) }}" required>
                                            @error('prenom')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" 
                                                   value="{{ old('email', $adminActuel?->email) }}" required>
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" id="telephone" name="telephone" 
                                                   value="{{ old('telephone', $adminActuel?->telephone) }}" required>
                                            @error('telephone')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">
                                            <i class="fas fa-lock me-2"></i>Sécurité
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">
                                                Nouveau mot de passe 
                                                @if(!$adminActuel)
                                                    <span class="text-danger">*</span>
                                                @else
                                                    <small class="text-muted">(Laisser vide pour ne pas changer)</small>
                                                @endif
                                            </label>
                                            <input type="password" class="form-control" id="password" name="password" 
                                                   @if(!$adminActuel) required @endif>
                                            @error('password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">
                                                Confirmer le mot de passe 
                                                @if(!$adminActuel)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="password" class="form-control" id="password_confirmation" 
                                                   name="password_confirmation" @if(!$adminActuel) required @endif>
                                            @error('password_confirmation')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        @if($adminActuel)
                                            <div class="alert alert-warning">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                <strong>Note:</strong> Si vous ne saisissez pas de nouveau mot de passe, le mot de passe actuel sera conservé.
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Statut de l'administrateur -->
                                @if($adminActuel)
                                    <div class="card">

                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">
                                                <i class="fas fa-info-circle me-2"></i>Statut de l'administrateur actuel
                                            </h6>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <strong>Statut:</strong>
                                                    <div>
                                                        @if($adminActuel->status == 1)
                                                            <span class="badge bg-success">Actif</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactif</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <strong>Date de création:</strong>
                                                    <div>{{ $adminActuel->created_at->format('d/m/Y H:i') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Option de modification avec historique -->
                        @if($adminActuel)
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card border-warning">
                                    {{-- <div class="card-header bg-warning text-dark">
                                        <h6 class="mb-0">
                                            <i class="fas fa-history me-2"></i>Option d'historique
                                        </h6>
                                    </div> --}}
                                    <div class="card-body">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="modifier_utilisateur" id="modifier_utilisateur" value="1">
                                            <label class="form-check-label" for="modifier_utilisateur">
                                                <strong>Modifier l'utilisateur et enregistrer dans l'historique</strong>
                                            </label>
                                            <small class="form-text text-muted d-block">
                                                Cochez cette case pour conserver les informations de l'ancien administrateur dans l'historique avant de le modifier.
                                            </small>
                                        </div>
                                        
                                        <div id="motif_section" style="display: none;">
                                            <label for="motif_modification" class="form-label">
                                                Motif de la modification <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control" id="motif_modification" name="motif_modification" rows="3" 
                                                      placeholder="Veuillez indiquer la raison de cette modification..."></textarea>
                                            @error('motif_modification')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Historique des administrateurs -->
                        @if($gare->historiqueAdmins && $gare->historiqueAdmins->count() > 0)
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <h6 class="mb-0">
                                            <i class="fas fa-clock-rotate-left me-2"></i>Historique des administrateurs
                                            <span class="badge bg-light text-dark ms-2">{{ $gare->historiqueAdmins->count() }}</span>
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                        <th>Ancien admin</th>
                                                        <th>Nouvel admin</th>
                                                        <th>Motif</th>
                                                        <th>Modifié par</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($gare->historiqueAdmins as $historique)
                                                    <tr>
                                                        <td>
                                                            <small>{{ $historique->date_modification->format('d/m/Y H:i') }}</small>
                                                        </td>
                                                        <td>
                                                            @if($historique->type_action == 'creation')
                                                                <span class="badge bg-success">Création</span>
                                                            @elseif($historique->type_action == 'modification')
                                                                <span class="badge bg-warning">Modification</span>
                                                            @else
                                                                <span class="badge bg-danger">Suppression</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($historique->ancien_admin_nom)
                                                                <small>
                                                                    <strong>{{ $historique->ancien_admin_nom }} {{ $historique->ancien_admin_prenom }}</strong><br>
                                                                    {{ $historique->ancien_admin_email }}<br>
                                                                    {{ $historique->ancien_admin_telephone }}
                                                                </small>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($historique->nouvel_admin_nom)
                                                                <small>
                                                                    <strong>{{ $historique->nouvel_admin_nom }} {{ $historique->nouvel_admin_prenom }}</strong><br>
                                                                    {{ $historique->nouvel_admin_email }}<br>
                                                                    {{ $historique->nouvel_admin_telephone }}
                                                                </small>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <small>{{ $historique->motif_modification }}</small>
                                                        </td>
                                                        <td>
                                                            <small>{{ $historique->modifie_par_nom }}</small>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Boutons d'action -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">

                                    <a >
                                        {{-- <i class="fas fa-times me-2"></i>Annuler --}}
                                    </a>

                                    <div>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-save me-2"></i>
                                            <span class="btn-text">
                                                @if($adminActuel)
                                                    Mettre à jour
                                                @else
                                                    Créer l'administrateur
                                                @endif
                                            </span>
                                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Gestion du spinner lors de la soumission
        $('#adminForm').on('submit', function() {
            var $btn = $('#submitBtn');
            var $spinner = $btn.find('.spinner-border');
            var $btnText = $btn.find('.btn-text');
            
            // Afficher le spinner et désactiver le bouton
            $spinner.removeClass('d-none');
            $btnText.text('Enregistrement...');
            $btn.prop('disabled', true);
        });

        // Validation du mot de passe
        $('#password, #password_confirmation').on('input', function() {
            var password = $('#password').val();
            var confirmation = $('#password_confirmation').val();
            
            if (password.length > 0 && confirmation.length > 0) {
                if (password !== confirmation) {
                    $('#password_confirmation').addClass('is-invalid');
                    if (!$('#password_confirmation').next('.invalid-feedback').length) {
                        $('#password_confirmation').after('<div class="invalid-feedback">Les mots de passe ne correspondent pas.</div>');
                    }
                } else {
                    $('#password_confirmation').removeClass('is-invalid');
                    $('#password_confirmation').next('.invalid-feedback').remove();
                }
            }
        });

        // Formatage du téléphone
        $('#telephone').on('input', function() {
            var value = $(this).val().replace(/\s/g, '');
            // Format: +225 XX XX XX XX XX
            if (value.length > 5 && value.startsWith('225')) {
                var formatted = '+225 ' + value.substring(5).replace(/(.{2})/g, '$1 ').trim();
                $(this).val(formatted);
            }
        });

        // Gestion de la checkbox d'historique
        $('#modifier_utilisateur').on('change', function() {
            var $motifSection = $('#motif_section');
            var $motifField = $('#motif_modification');
            
            if ($(this).is(':checked')) {
                $motifSection.slideDown();
                $motifField.prop('required', true);
            } else {
                $motifSection.slideUp();
                $motifField.prop('required', false).val('');
            }
        });
    });
</script>


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

</body>

</html>
