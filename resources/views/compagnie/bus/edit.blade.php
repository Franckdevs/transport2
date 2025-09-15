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

                    {{-- <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Modifier le bus</h5>
        <a href=" " class="btn btn-success">
            <i class="fa fa-arrow-left"></i> Retour
        </a>
    </div> --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Modifier le bus</h5>
    <a href="{{ route('liste.bus') }}" class="btn btn-light" title="Retour">
        <i class="fa fa-arrow-left"></i>
    </a>
</div>


                <div class="col-md-12 mt-4">
                    <div class="card">

                        <div class="card-body">



                        <div class="card-body">
                            <h5 class="mb-4">Modifier le bus</h5>

                            <form action="{{ route('bus.update' , $bus->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <input type="hidden" name="compagnies_id" id="compagnies_id">
                                    <div class="col-md-6 mb-3">
                                        <label for="nom_bus" class="form-label">Libellé du bus</label>
                                        <input type="text" name="nom_bus" id="nom_bus" class="form-control"
                                            value="{{ old('nom_bus' , $bus->nom_bus) }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="marque_bus" class="form-label">Marque du bus</label>
                                        <input type="text" name="marque_bus" id="marque_bus" class="form-control"
                                            value="{{ old('marque_bus' , $bus->marque_bus) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="modele_bus" class="form-label">Modèle du bus</label>
                                        <input type="text" name="modele_bus" id="modele_bus" class="form-control"
                                            value="{{ old('modele_bus' , $bus->modele_bus) }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="immatriculation_bus" class="form-label">Immatriculation du
                                            bus</label>
                                        <input type="text" name="immatriculation_bus" id="immatriculation_bus"
                                            class="form-control" value="{{ old('immatriculation_bus' , $bus->immatriculation_bus) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="photo_bus" class="form-label">Photo du bus</label>
                                        <input type="file" name="photo_bus" id="photo_bus" class="form-control" value="{{ old('photo_bus' , $bus->photo_bus) }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="description_bus" class="form-label">Description du bus</label>
                                        <input type="text" name="description_bus" id="description_bus"
                                            class="form-control" value="{{ old('description_bus' , $bus->description_bus) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="localisation_bus" class="form-label">Localisation</label>
                                        <input type="text" name="localisation_bus" id="localisation_bus"
                                            class="form-control" value="{{ old('localisation_bus' , $bus->localisation_bus) }}">
                                    </div>


                                    
           <div class="col-md-6 mb-3">
            <label for="configuration_car" class="form-label">Configuration</label>
            {{-- <select name="configuration_car" id="configuration_car" class="form-select">
                <option value="">-- Choisir --</option>
                <option value="1" {{ old('configuration_car') == '2-1' ? 'selected' : '' }}>2-1 (2 sièges gauche, 1 siège droite)</option>
                <option value="2" {{ old('configuration_car') == '2-2' ? 'selected' : '' }}>2-2 (2 sièges gauche, 2 sièges droite)</option>
                <option value="3" {{ old('configuration_car') == '3-2' ? 'selected' : '' }}>3-2 (3 sièges gauche, 2 sièges droite)</option>
                <option value="4" {{ old('configuration_car') == '1-1' ? 'selected' : '' }}>1-1 (1 siège gauche, 1 siège droite)</option>
            </select> --}}

{{-- <select name="configuration_place_id" id="configuration_place_id" class="form-select">
    @foreach(App\Models\ConfigurationPlaceBus::all() as $config)
        <option value="{{ $config->id }}" {{ old('configuration_place_id') == $config->id ? 'selected' : '' }}>
            {{ $config->disposition }} ({{ $config->nom_complet }})
        </option>
    @endforeach
</select> --}}

<select name="configuration_place_id" id="configuration_place_id" class="form-select">
    @foreach(App\Models\ConfigurationPlaceBus::all() as $config)
        <option value="{{ $config->id }}" 
            {{ old('configuration_place_id', $bus->configuration_place_id) == $config->id ? 'selected' : '' }}>
            {{ $config->disposition }} ({{ $config->nom_complet }})
        </option>
    @endforeach
</select>
</div>

                                </div>
 



                                <button type="submit" class="btn btn-primary">Enregistrer le bus</button>
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
