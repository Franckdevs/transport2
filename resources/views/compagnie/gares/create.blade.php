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

            <div class="col-md-12 mt-4">
  <div class="card">
    <div class="card-body">
      <h5 class="mb-4">Créer une nouvelle gare</h5>

<form action="{{ route('gares.store') }}" method="POST">
@csrf

<div class="row">
    {{-- Nom gare (plein largeur) --}}
    <div class="col-12 mb-3">
      <label for="nom_gare" class="form-label">Nom de la gare</label>
      <input type="text" name="nom_gare" id="nom_gare" class="form-control" value="{{ old('nom_gare') }}">
    </div>
  </div>

  <div class="row">
    {{-- Adresse gare --}}
    <div class="col-md-6 mb-3">
      <label for="adresse_gare" class="form-label">Adresse</label>
      <input type="text" name="adresse_gare" id="adresse_gare" class="form-control" value="{{ old('adresse_gare') }}">
    </div>

    {{-- Téléphone gare --}}
    <div class="col-md-6 mb-3">
      <label for="telephone_gare" class="form-label">Téléphone</label>
      <input type="text" name="telephone_gare" id="telephone_gare" class="form-control" value="{{ old('telephone_gare') }}">
    </div>
  </div>

  <div class="row">
    {{-- ville_id --}}
    <div class="col-md-6 mb-3">
      <label for="ville_id" class="form-label">Ville</label>
      <select name="ville_id" id="ville_id" class="form-select">
        <option value="">-- Sélectionner une ville --</option>
        @foreach($villes as $ville)
          <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>
            {{ $ville->nom_ville ?? $ville->id }}
          </option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="row">
    {{-- jour_id --}}
    <div class="col-md-6 mb-3">
      <label for="jour_id" class="form-label">Jour</label>
      <select name="jour_id" id="jour_id" class="form-select">
        <option value="">-- Sélectionner un jour --</option>
        @foreach($jours as $jour)
          <option value="{{ $jour->id }}" {{ old('jour_id') == $jour->id ? 'selected' : '' }}>
            {{ $jour->nom_jour ?? $jour->id }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- jour_ouvert_id --}}
    <div class="col-md-6 mb-3">
      <label for="jour_ouvert_id" class="form-label">Jour d'ouverture</label>
      <select name="jour_ouvert_id" id="jour_ouvert_id" class="form-select">
        <option value="">-- Sélectionner un jour d'ouverture --</option>
        @foreach($jours as $jour)
          <option value="{{ $jour->id }}" {{ old('jour_ouvert_id') == $jour->id ? 'selected' : '' }}>
            {{ $jour->nom_jour ?? $jour->id }}
          </option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="row">
    {{-- jour_de_fermeture_id --}}
    <div class="col-md-6 mb-3">
      <label for="jour_de_fermeture_id" class="form-label">Jour de fermeture</label>
      <select name="jour_de_fermeture_id" id="jour_de_fermeture_id" class="form-select">
        <option value="">-- Sélectionner un jour de fermeture --</option>
        @foreach($jours as $jour)
          <option value="{{ $jour->id }}" {{ old('jour_de_fermeture_id') == $jour->id ? 'selected' : '' }}>
            {{ $jour->nom_jour ?? $jour->id }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- Nombre de quais --}}
    <div class="col-md-6 mb-3">
      <label for="nombre_quais" class="form-label">Nombre de quais</label>
      <input type="number" name="nombre_quais" id="nombre_quais" class="form-control" value="{{ old('nombre_quais') }}" min="0">
    </div>
  </div>

  {{-- <div class="row">
    <div class="col-md-6 mb-3">
      <label for="latitude" class="form-label">Latitude</label>
      <input type="text" name="latitude" id="latitude" class="form-control" value="{{ old('latitude') }}" placeholder="Ex: 48.8566">
    </div>

    <div class="col-md-6 mb-3">
      <label for="longitude" class="form-label">Longitude</label>
      <input type="text" name="longitude" id="longitude" class="form-control" value="{{ old('longitude') }}" placeholder="Ex: 2.3522">
    </div>
  </div> --}}

  <div class="row">
    {{-- Heure ouverture --}}
    <div class="col-md-6 mb-3">
      <label for="heure_ouverture" class="form-label">Heure d'ouverture</label>
      <input type="time" name="heure_ouverture" id="heure_ouverture" class="form-control" value="{{ old('heure_ouverture') }}">
    </div>

    {{-- Heure fermeture --}}
    <div class="col-md-6 mb-3">
      <label for="heure_fermeture" class="form-label">Heure de fermeture</label>
      <input type="time" name="heure_fermeture" id="heure_fermeture" class="form-control" value="{{ old('heure_fermeture') }}">
    </div>
  </div>

  <div class="row">
    {{-- Parking disponible --}}
    <div class="col-md-6 mb-3 form-check">
      <input class="form-check-input" type="checkbox" value="1" id="parking_disponible" name="parking_disponible" {{ old('parking_disponible') ? 'checked' : '' }}>
      <label class="form-check-label" for="parking_disponible">Parking disponible</label>
    </div>

    {{-- Wifi disponible --}}
    <div class="col-md-6 mb-3 form-check">
      <input class="form-check-input" type="checkbox" value="1" id="wifi_disponible" name="wifi_disponible" {{ old('wifi_disponible') ? 'checked' : '' }}>
      <label class="form-check-label" for="wifi_disponible">Wi-Fi disponible</label>
    </div>
  </div>

  <div class="row">
    {{-- Téléphone --}}
    <div class="col-md-6 mb-3">
      <label for="telephone" class="form-label">Téléphone (contact général)</label>
      <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') }}">
    </div>

    {{-- Email --}}
    <div class="col-md-6 mb-3">
      <label for="email" class="form-label">Email (contact général)</label>
      <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
    </div>
  </div>

  {{-- Site web (plein largeur) --}}
  {{-- <div class="mb-3">
    <label for="site_web" class="form-label">Site web</label>
    <input type="url" name="site_web" id="site_web" class="form-control" value="{{ old('site_web') }}">
  </div> --}}

  {{-- Description (plein largeur) --}}
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
  </div>


        <button type="submit" class="btn btn-primary">Enregistrer la gare</button>
      </form>

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
  <!-- Vendor Script -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

</body>

</html>
