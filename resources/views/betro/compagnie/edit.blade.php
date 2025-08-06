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

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h6 class="card-title">
                  <i class="fas fa-building-user me-2"></i> Modifier une compagnie et administrateur
                </h6>
              </div>

              <div class="card-body">
                <form method="POST" action="{{ route('compagnies.update', $compagnies->id) }}" enctype="multipart/form-data">
                  @csrf
                  {{-- @method('PUT') <!-- à utiliser si c’est une modification --> --}}

                  <div class="row">
                    <!-- Partie Administrateur -->
                    <div class="col-md-5">
                      <h5 class="mb-4">
                        <i class="fas fa-user-shield me-2 text-primary"></i> Informations Administrateur
                      </h5>

                      <div class="mb-3">
                        <label for="nom" class="form-label">Nom Administrateur</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $users->nom) }}" required>
                        @error('nom')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom Administrateur</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $users->prenom) }}" required>
                        @error('prenom')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $users->telephone) }}" required>
                        @error('telephone')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $users->email) }}" required>
                        @error('email')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                      </div>
                    </div>

                    <!-- Séparateur -->
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div style="width: 1px; height: 100%; background-color: #ddd;"></div>
                    </div>

                    <!-- Partie Compagnie -->
                    <div class="col-md-5">
                      <h5 class="mb-4">
                        <i class="fas fa-building me-2 text-success"></i> Informations Compagnie
                      </h5>

                      <div class="mb-3">
                        <label for="nom_complet_compagnies" class="form-label">Nom de la compagnie</label>
                        <input type="text" class="form-control" id="nom_complet_compagnies" name="nom_complet_compagnies" value="{{ old('nom_complet_compagnies', $compagnies->nom_complet_compagnies) }}" required>
                        @error('nom_complet_compagnies')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="email_compagnies" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_compagnies" name="email_compagnies" value="{{ old('email_compagnies', $compagnies->email_compagnies) }}" required>
                        @error('email_compagnies')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="telephone_compagnies" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="telephone_compagnies" name="telephone_compagnies" value="{{ old('telephone_compagnies', $compagnies->telephone_compagnies) }}" required>
                        @error('telephone_compagnies')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="adresse_compagnies" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse_compagnies" name="adresse_compagnies" value="{{ old('adresse_compagnies', $compagnies->adresse_compagnies) }}" required>
                        @error('adresse_compagnies')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="description_compagnies" class="form-label">Description</label>
                        <textarea class="form-control" id="description_compagnies" name="description_compagnies" rows="3">{{ old('description_compagnies', $compagnies->description_compagnies) }}</textarea>
                        @error('description_compagnies')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="logo_compagnies" class="form-label">Logo</label>
                        <input type="file" class="form-control" id="logo_compagnies" name="logo_compagnies" accept="image/*">
                        @if ($compagnies->logo_compagnies)
                            <img src="{{ asset( 'logo_compagnie/' .$compagnies->logo_compagnies) }}" alt="Logo" style="max-height: 100px; max-width: 100%; object-fit: contain; border-radius: 5px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
                        @endif
                        @error('logo_compagnies')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                    </div>
                  </div>

                  <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-success px-4">
                      <i class="fas fa-check-circle me-2"></i> Modifier
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div> <!-- .row end -->
      </div>
    </div>

    <!-- start: page footer -->
    @include('betro.all_element.footer')
  </div>
</body>
