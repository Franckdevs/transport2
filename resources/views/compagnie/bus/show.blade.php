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

            <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">

    </h5>
    <a href="{{ route('liste.bus') }}" class="btn btn-light" title="Retour">
        <i class="fa fa-arrow-left"></i>
    </a>
</div>

            <div class="card-body">
              <div class="row">
               {{-- <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
    <h4 class="mb-0 text-primary"><i class="fa fa-bus me-2"></i>Liste des bus</h4>
    <a href="{{ route('liste.bus') }}" class="btn btn-outline-success d-flex align-items-center">
        <i class="fa fa-arrow-left me-1"></i> Retour
    </a>
</div> --}}

                <!-- Infos texte -->
             <div class="col-md-7">
    <h5 class="text-primary">📋 Détails du Bus</h5>
    <hr>
    <div class="row">
        <div class="col-md-6 mb-2">
            <p><strong>Nom :</strong> {{ $bus->nom_bus }}</p>
        </div>
        <div class="col-md-6 mb-2">
            <p><strong>Marque :</strong> {{ $bus->marque_bus }}</p>
        </div>

        <div class="col-md-6 mb-2">
            <p><strong>Modèle :</strong> {{ $bus->modele_bus }}</p>
        </div>
        <div class="col-md-6 mb-2">
            <p><strong>Immatriculation :</strong> {{ $bus->immatriculation_bus }}</p>
        </div>

        <div class="col-md-6 mb-2">
            <p><strong>Description :</strong> {{ $bus->description_bus }}</p>
        </div>
        <div class="col-md-6 mb-2">
            <p><strong>Localisation :</strong> {{ $bus->localisation_bus }}</p>
        </div>

           <div class="col-md-6 mb-2">
            <p><strong>configuration :</strong> {{ $configuration->nom_complet }} - {{ $configuration->disposition }}</p>
        </div>
    </div>
</div>


                <!-- Photo -->
                <div class="col-md-5 text-center">
                  <h5 class="text-primary">🖼️ Photo du Bus</h5>
                  <hr>
                  @if($bus->photo_bus)
                    <img src="{{ asset($bus->photo_bus) }}"
                         alt="Photo du bus"
                         class="img-fluid rounded shadow-sm mb-3"
                         style="max-width: 100%; height: auto;">
                  @else
                    <p class="text-muted"><em>Aucune photo disponible</em></p>
                  @endif
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
