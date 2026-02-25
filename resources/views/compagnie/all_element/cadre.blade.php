  <script>
      @if ($errors->any())
          @foreach ($errors->all() as $error)
              Toastify({
                  text: "{{ $error }}",
                  duration: 5000,
                  close: true,
                  gravity: "top",
                  position: "right",
                  backgroundColor: "#f44336", // rouge
                  stopOnFocus: true,
              }).showToast();
          @endforeach
      @endif

      @if (session('error'))
          Toastify({
              text: "{{ session('error') }}",
              duration: 5000,
              close: true,
              gravity: "top",
              position: "right",
              backgroundColor: "#f44336",
              stopOnFocus: true,
          }).showToast();
      @endif

      @if (session('success'))
          Toastify({
              text: "{{ session('success') }}",
              duration: 5000,
              close: true,
              gravity: "top",
              position: "right",
              backgroundColor: "#4CAF50", // vert
              stopOnFocus: true,
          }).showToast();
      @endif
  </script>
  <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
          <div class="row g-3 mb-3 align-items-center">
              <div class="col">
                  <ol class="breadcrumb bg-transparent mb-0">
                      {{-- <li class="breadcrumb-item"><a class="text-secondary" href="index.html">Home</a></li> --}}
                      <li class="breadcrumb-item active" aria-current="page">

                          {{-- @php
    $routeName = Route::currentRouteName();
    $routeName = Str::startsWith(Route::currentRouteName());
@endphp
@switch($routeName)
    @case('dashboardcompagnie')
        <span>Tableau de bord</span>
        @break
@endswitch --}}

                          @php
                              use Illuminate\Support\Str;
                              $routePartdefaut = 'Acceuil';
                          @endphp

                          @if (Str::startsWith(Route::currentRouteName(), 'dashboardcompagnie'))
                              <span><i class ="fas fa-home"></i> {{ $routePartdefaut }} / Tableau de bord</span>
                          @endif

                          @if (Str::startsWith(Route::currentRouteName(), 'liste.bus'))
                              <span><i class ="fas fa-home"></i> {{ $routePartdefaut }} / Liste des bus</span>
                          @endif

                          @if (Str::startsWith(Route::currentRouteName(), 'bus.show'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des bus / Details du
                                  bus</span>
                          @endif
                          @if (Str::startsWith(Route::currentRouteName(), 'bus.create'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des bus / Ajouter un
                                  bus</span>
                          @endif

                          @if (Str::startsWith(Route::currentRouteName(), 'bus.edit'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des bus / Modifier le
                                  bus</span>
                          @endif

                          @if (Str::startsWith(Route::currentRouteName(), 'listeconfig'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des Configurations</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'creationConfig.creation'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des Configurations /
                                  Création d'une Configuration</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'config.edit'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des Configurations /
                                  Modification d'une Configuration</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'config.show'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des Configurations /
                                  Details d'une Configuration</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'config.update'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des Configurations /
                                  Mise à jour d'une Configuration</span>
                          @endif

                          @if (Str::startsWith(Route::currentRouteName(), 'chauffeur.index'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des chaffeurs</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'chauffeur.create'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des chaffeurs / Ajouter
                                  un chauffeur</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'modifier.edit'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des chaffeurs / Modifier
                                  un chauffeur</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'voir.show'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des chaffeurs / Details
                                  d'un chauffeur</span>
                          @endif

                          {{-- classe des voyage --}}
                          @if (Str::startsWith(Route::currentRouteName(), 'classe.index'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des classes</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'classe.create'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des classes / creation
                                  d'une nouvelle classe </span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'classe.edit'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des classes /
                                  modification d'une classe </span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'classe.show'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des classes / details
                                  d'une classe </span>
                          @endif
                          {{-- tarifaction des voyage  --}}
                          @if (Str::startsWith(Route::currentRouteName(), 'tarification.index'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des tarifications</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'tarification.create'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des tarifications /
                                  Creation d'une nouvelle tarification</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'tarification.edit'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des tarifications /
                                  Modification d'une tarification</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'tarification.show'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des tarifications /
                                  Details d'une tarification</span>
                          @endif
                          {{-- personnel et agent --}}
                          @if (Str::startsWith(Route::currentRouteName(), 'agents.index'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste du personnel</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'agents.create'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste du personnel / Creation
                                  d'un personnel</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'agents.edit'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste du personnel /
                                  Modification d'un personnel</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'agents.show'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste du personnel / Details
                                  d'un personnel</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'agents.destroy'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste du personnel /
                                  Suppression d'un personnel</span>
                          @endif
                          {{-- itineraire  --}}
                          @if (Str::startsWith(Route::currentRouteName(), 'itineraire.index'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des Itineraire</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'itineraire.create'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des Itineraire /
                                  Creation d'un itineraire</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'itineraire.edit'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des Itineraire /
                                  Modification d'un itineraire</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'itineraire.show'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des Itineraire / Details
                                  d'un itineraire</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'itineraire.destroy'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des Itineraire /
                                  Suppression d'un itineraire</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'itineraire.reactivation'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des Itineraire /
                                  Reactivation d'un itineraire</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'itineraire.update'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des Itineraire / Mise a
                                  jour d'un itineraire</span>
                          @endif
                          {{-- voyage --}}
                          @if (Str::startsWith(Route::currentRouteName(), 'voyage.index'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des voyages</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'voyage.create'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des voyages / Creation
                                  d'un voyage</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'voyage.edit'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des voyages /
                                  Modification d'un voyage</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'voyage.show'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des voyages / Details
                                  d'un voyage</span>
                          @endif

                          @if (Str::startsWith(Route::currentRouteName(), 'liste_reservation'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des reservations</span>
                          @elseif(Str::startsWith(Route::currentRouteName(), 'voir_detail_reservation.show'))
                              <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Liste des reservations / Details d'une reservation</span>
                          @endif
                          {{-- Reservation --}}
                          {{-- Parametre  --}}
@if (Str::startsWith(Route::currentRouteName(), 'paramettre.index'))
    <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Page des paramètres</span>
@endif


{{-- @if (Str::startsWith(Route::currentRouteName(), 'gares.show'))
    <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Listes des gares / détaille de cette gare </span>
     @elseif(Str::startsWith(Route::currentRouteName(), 'gares.index.2'))
 <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Listes des gares / Details gare</span>
      @elseif(Str::startsWith(Route::currentRouteName(), ' gares.create'))
 <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Listes des gares / creation gare</span>

@endif --}}
@if (Str::startsWith(Route::currentRouteName(), 'gares.show'))
    <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Listes des gares / Détail de cette gare</span>
@elseif(Str::startsWith(Route::currentRouteName(), 'gares.index.2'))
    <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Listes des gares / Détails gare</span>
@elseif(Str::startsWith(Route::currentRouteName(), 'gares.create'))
    <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Listes des gares / Création gare</span>
@elseif(Str::startsWith(Route::currentRouteName(), 'gares.edit'))
    <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Listes des gares / Modification gare</span>
@endif

{{-- Modifier Administrateur Gare --}}
@if (Str::startsWith(Route::currentRouteName(), 'modifier_admin_gare.index'))
    <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Gestion des administrateurs de gare</span>
@elseif(Str::startsWith(Route::currentRouteName(), 'modifier_admin_gare.edit'))
    <span><i class="fas fa-home"></i> {{ $routePartdefaut }} / Gestion des administrateurs de gare / Modifier administrateur</span>
@endif

                          {{-- @if (Str::startsWith(Route::currentRouteName(), ''))
    
@endif --}}

                          {{-- @elseif(Str::startsWith(Route::currentRouteName(), 'chauffeur'))
        <span><i class="fas fa-user-tie"></i> {{$routePartdefaut}} / Chauffeur</span>  --}}


                      </li>
                  </ol>
              </div>
          </div> <!-- .row end -->
          <div class="row align-items-center">


          </div> <!-- .row end -->
      </div>
  </div>

  <style>
      /* Styles pour les boutons de la DataTable */
      .btn-sm {
          min-width: 50px;
          width: 50px;
          height: 50px;
          padding: 0.25rem 0.5rem;
          display: inline-flex;
          align-items: center;
          justify-content: center;
      }

      /* Assure que les icônes sont centrées */
      .btn-sm i {
          margin: 0;
          padding: 0;
          font-size: 0.875rem;
          line-height: 1;
      }

      /* Empêche le débordement des boutons dans les cellules */
      td {
          white-space: nowrap;
      }

      /* Style pour la colonne d'actions */
      .actions-cell {
          white-space: nowrap;
          width: 90px;
          /* Largeur fixe pour la colonne d'actions */
      }
  </style>

  <script>
      // Gestion des messages flash avec SweetAlert2
      @if (session('success'))
          Swal.fire({
              title: 'Succès !',
              text: '{{ session('success') }}',
              icon: 'success',
              timer: 3000,
              showConfirmButton: false
          });
      @endif

      @if ($errors->any())
          Swal.fire({
              title: 'Erreur !',
              html: '{!! implode('<br>', $errors->all()) !!}',
              icon: 'error',
              confirmButtonText: 'OK'
          });
      @endif
  </script>
