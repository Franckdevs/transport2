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
          @include('compagnie.all_element.navbar')
        </nav>
      </div>
    </header>

    <!-- start: page toolbar -->
    @include('compagnie.all_element.cadre')

    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">

        <div class="col-md-12 mt-4">
          <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
              <h5 class="mb-0">🚍Information</h5>
              <a href="{{ route('liste.bus') }}" class="btn btn-light btn-sm">⬅ Retour</a>
            </div>

            <div class="card-body">
              <div class="row">
                <!-- Infos texte -->
                <div class="col-md-7">
                  <h5 class="text-primary">📋 Détails du Bus</h5>
                  <hr>
                  <p><strong>Nom :</strong> {{ $bus->nom_bus }}</p>
                  <p><strong>Marque :</strong> {{ $bus->marque_bus }}</p>
                  <p><strong>Modèle :</strong> {{ $bus->modele_bus }}</p>
                  <p><strong>Immatriculation :</strong> {{ $bus->immatriculation_bus }}</p>
                  <p><strong>Description :</strong> {{ $bus->description_bus }}</p>
                  <p><strong>Localisation :</strong> {{ $bus->localisation_bus }}</p>
                  <p><strong>Compagnie :</strong> {{ $bus->compagnie->nom ?? 'Non définie' }}</p>
                </div>

                <!-- Photo -->
                <div class="col-md-5 text-center">
                  <h5 class="text-primary">🖼️ Photo du Bus</h5>
                  <hr>
                  @if($bus->photo_bus)
                    <img src="{{ asset('buses/' . $bus->photo_bus) }}"
                         alt="Photo du bus"
                         class="img-fluid rounded shadow-sm mb-3"
                         style="max-width: 100%; height: auto;">
                  @else
                    <p class="text-muted"><em>Aucune photo disponible</em></p>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>

      </div> <!-- .container-fluid -->
    </div> <!-- .page-body -->

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
