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
        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-xl-3 g-2">

 <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">
            </h5>
            <a href="{{ route('gares.index.2') }}" class="btn btn-light" title="Retour">
            <i class="fa fa-arrow-left"></i> Retour
            </a>
            </div>

            <div class="card p-4 shadow-sm rounded">
                <h4 class="mb-3">
                    <i class="fa fa-train me-2"></i> Gare : {{ $gare->nom_gare ?? 'Sans nom' }}
                </h4>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Adresse :</strong> {{ $gare->adresse_gare ?? 'Non renseignée' }}</p>
                        <p><strong>Téléphone :</strong> {{ $gare->telephone_gare ?? 'Non renseigné' }}</p>
                        <p><strong>Email :</strong> {{ $gare->email ?? 'Non renseigné' }}</p>
                        <p><strong>Site web :</strong>
                            @if($gare->site_web)
                                <a href="{{ $gare->site_web }}" target="_blank">{{ $gare->site_web }}</a>
                            @else
                                Non renseigné
                            @endif
                        </p>
                        <p><strong>Description :</strong> {{ $gare->description ?? 'Aucune' }}</p>
                    </div>

                    <div class="col-md-6">

                        <p><strong>Heure d'ouverture :</strong> {{ $gare->heure_ouverture ?? '-' }}</p>
                        <p><strong>Heure de fermeture :</strong> {{ $gare->heure_fermeture ?? '-' }}</p>
                        <p><strong>Jour d'ouverture :</strong> {{ $gare->jourOuvert?->nom_jour ?? '-' }}</p>
                        <p><strong>Jour de fermeture :</strong> {{ $gare->jourFermeture?->nom_jour ?? '-' }}</p>
                        <p><strong>Ville :</strong> {{ $gare->ville->nom_ville ?? 'Non renseignée' }}</p>
                        {{-- <p><strong>Nombre de quais :</strong> {{ $gare->nombre_quais ?? 'Non renseigné' }}</p> --}}
                    </div>
                </div>

                <hr>

<h5 class="mt-3"><i class="fa fa-cogs me-2 mb-4"></i> Équipements :</h5>
<div class="row mb-3">
    <div class="col">
        <strong>Parking disponible :</strong>
        @if($gare->parking_disponible)
            <span class="badge bg-success">Oui</span>
        @else
            <span class="badge bg-danger">Non</span>
        @endif
    </div>
    <div class="col">
        <strong>Wi-Fi disponible :</strong>
        @if($gare->wifi_disponible)
            <span class="badge bg-success">Oui</span>
        @else
            <span class="badge bg-danger">Non</span>
        @endif
    </div>
</div>


<hr>

<h5 class="mt-3"><i class="fa fa-user-shield me-2 mb-3"></i> Administrateur :</h5>
<div class="row ">
    <div class="col">
        <strong>Nom :</strong> {{ $gare->compagnie->info_user->nom ?? '-' }}
    </div>
    <div class="col">
        <strong>Prénom :</strong> {{ $gare->compagnie->info_user->prenom ?? '-' }}
    </div>
    <div class="col">
        <strong>Email :</strong> {{ $gare->compagnie->info_user->email ?? '-' }}
    </div>
    
    <div class="col">
        <strong>Téléphone :</strong> {{ $gare->compagnie->info_user->telephone ?? '-' }}
    </div>

    <div class="col">
    <p><strong>Status :</strong>
    @if($gare->status == 1) 
        <span class="badge bg-success">✅ Actif</span>
    @elseif($gare->status == 2) 
        <span class="badge bg-danger">❌ Inactif</span>
    @else 
        <span class="badge bg-warning text-dark">⏳ En attente</span>
    @endif
</p>
    </div>

</div>

<hr>


                <h5 class="mt-3"><i class="fa fa-map-marker-alt me-2"></i> Localisation</h5>
                <div id="map" style="height: 350px; width: 100%;" class="my-3 border rounded"></div>

                {{-- <a href="{{ route('gares.index.2') }}" class="btn btn-secondary mt-3">
                    <i class="fa fa-arrow-left"></i> Retour à la liste
                </a> --}}
            </div>

        </div>
    </div>

        </div> <!-- .row end -->



      </div>
    </div>
    <!-- start: page footer -->

    @include('compagnie.all_element.footer')
  </div>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&callback=initMap" async defer></script>
<script>
    function initMap() {
        var lat = parseFloat("{{ $gare->latitude ?? 0 }}");
        var lng = parseFloat("{{ $gare->longitude ?? 0 }}");

        // Vérification des coordonnées
        if (!lat || !lng) {
            document.getElementById('map').innerHTML = "<p class='text-danger text-center py-5'>📍 Coordonnées non disponibles</p>";
            return;
        }

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: lat, lng: lng}
        });

        new google.maps.Marker({
            position: {lat: lat, lng: lng},
            map: map,
            title: "{{ $gare->nom_gare }}"
        });
    }
</script>


    <!-- Jquery Page Js -->
  <script src="../assets/js/theme.js"></script>
  <!-- Plugin Js -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  <!-- Vendor Script -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

</body>

</html>

{{-- resources/views/compagnie/gare/show.blade.php
@include('compagnie.all_element.header')

<body class="layout-1" data-luno="theme-blue">

@include('compagnie.all_element.sidebar')

<div class="wrapper">
    @include('compagnie.all_element.navbar')
    @include('compagnie.all_element.cadre')

    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        <div class="container-fluid">

            <div class="card p-4 shadow-sm rounded">
                <h4 class="mb-3">
                    <i class="fa fa-train me-2"></i> Gare : {{ $gare->nom_gare ?? 'Sans nom' }}
                </h4>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Adresse :</strong> {{ $gare->adresse_gare ?? 'Non renseignée' }}</p>
                        <p><strong>Téléphone :</strong> {{ $gare->telephone_gare ?? 'Non renseigné' }}</p>
                        <p><strong>Email :</strong> {{ $gare->email ?? 'Non renseigné' }}</p>
                        <p><strong>Site web :</strong>
                            @if($gare->site_web)
                                <a href="{{ $gare->site_web }}" target="_blank">{{ $gare->site_web }}</a>
                            @else
                                Non renseigné
                            @endif
                        </p>
                        <p><strong>Ville :</strong> {{ $gare->ville->nom ?? 'Non renseignée' }}</p>
                        <p><strong>Description :</strong> {{ $gare->description ?? 'Aucune' }}</p>
                    </div>

                    <div class="col-md-6">

                        <p><strong>Heure d'ouverture :</strong> {{ $gare->heure_ouverture ?? '-' }}</p>
                        <p><strong>Heure de fermeture :</strong> {{ $gare->heure_fermeture ?? '-' }}</p>
                        <p><strong>Jour d'ouverture :</strong> {{ $gare->jourOuvert?->nom ?? '-' }}</p>
                        <p><strong>Jour de fermeture :</strong> {{ $gare->jourFermeture?->nom ?? '-' }}</p>
                        <p><strong>Nombre de quais :</strong> {{ $gare->nombre_quais ?? 'Non renseigné' }}</p>
                    </div>
                </div>

                <hr>

<h5 class="mt-3"><i class="fa fa-cogs me-2"></i> Équipements :</h5>
<div class="row mb-3">
    <div class="col">
        <strong>Accessible PMR :</strong> {{ $gare->accessible_pm ? 'Oui' : 'Non' }}
    </div>
    <div class="col">
        <strong>Parking disponible :</strong> {{ $gare->parking_disponible ? 'Oui' : 'Non' }}
    </div>
    <div class="col">
        <strong>Wi-Fi disponible :</strong> {{ $gare->wifi_disponible ? 'Oui' : 'Non' }}
    </div>
</div>

<hr>

<h5 class="mt-3"><i class="fa fa-user-shield me-2"></i> Administrateur :</h5>
<div class="row">
    <div class="col">
        <strong>Nom :</strong> {{ $gare->admin_nom ?? '-' }}
    </div>
    <div class="col">
        <strong>Prénom :</strong> {{ $gare->admin_prenom ?? '-' }}
    </div>
    <div class="col">
        <strong>Email :</strong> {{ $gare->admin_email ?? '-' }}
    </div>
    <div class="col">
        <strong>Téléphone :</strong> {{ $gare->admin_telephone ?? '-' }}
    </div>
</div>

<hr>

                <p><strong>Status :</strong>
                    @if($gare->status == 1) ✅ Actif
                    @elseif($gare->status == 2) ❌ Inactif
                    @else ⏳ En attente
                    @endif
                </p>

                <h5 class="mt-3"><i class="fa fa-map-marker-alt me-2"></i> Localisation :</h5>
                <div id="map" style="height: 350px; width: 100%;" class="my-3 border rounded"></div>

                <a href="{{ route('gares.index.2') }}" class="btn btn-secondary mt-3">
                    <i class="fa fa-arrow-left"></i> Retour à la liste
                </a>
            </div>

        </div>
    </div>

    @include('compagnie.all_element.footer')
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&callback=initMap" async defer></script>
<script>
    function initMap() {
        var lat = parseFloat("{{ $gare->latitude ?? 0 }}");
        var lng = parseFloat("{{ $gare->longitude ?? 0 }}");

        // Vérification des coordonnées
        if (!lat || !lng) {
            document.getElementById('map').innerHTML = "<p class='text-danger text-center py-5'>📍 Coordonnées non disponibles</p>";
            return;
        }

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: lat, lng: lng}
        });

        new google.maps.Marker({
            position: {lat: lat, lng: lng},
            map: map,
            title: "{{ $gare->nom_gare }}"
        });
    }
</script>

</body>
</html> --}}
