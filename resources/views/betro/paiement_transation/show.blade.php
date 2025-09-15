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
        <div class="row g-3 row-deck">

          <div class="col-md-12">
            <div class="card">
              {{-- <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Détails de la compagnie et de l'administrateur</h5>
              </div> --}}

               <div class="card-header d-flex justify-content-between align-items-center">
    <h6 class="card-title mb-0">
        <i class="fas fa-building-user me-2"></i> Détails de la compagnie et de l'administrateur
    </h6>

    <a href="{{ route('compagnies') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

              <div class="card-body">
                  {{-- <div class="row">
                    <!-- Infos Compagnie -->
                    <div class="col-md-6">
                      <h6>Informations Compagnie</h6>
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                              <tr>
    <th>Logo</th>
    <td>
      @if ($compagnies->logo_compagnies)
        <img src="{{ asset( 'logo_compagnie/' .$compagnies->logo_compagnies) }}" alt="Logo" style="max-height: 100px; max-width: 100%; object-fit: contain; border-radius: 5px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
      @else
        <div class="d-flex align-items-center text-muted" style="height: 100px;">
          <i class="bi bi-building" style="font-size: 3rem; margin-right: 10px;"></i>
          <span>Aucun logo disponible</span>
        </div>
      @endif
    </td>
  </tr>
                            <th>Nom complet</th>
                            <td>{{ $compagnies->nom_complet_compagnies }}</td>
                          </tr>
                          <tr>
                            <th>Email</th>
                            <td>{{ $compagnies->email_compagnies }}</td>
                          </tr>
                          <tr>
                            <th>Téléphone</th>
                            <td>{{ $compagnies->telephone_compagnies }}</td>
                          </tr>
                          <tr>
                            <th>Adresse</th>
                            <td>{{ $compagnies->adresse_compagnies }}</td>
                          </tr>
                          <tr>
                            <th>Description</th>
                            <td>{{ $compagnies->description_compagnies ?? 'Aucune description' }}</td>
                          </tr>

                          <tr>
                            <th>Date de création</th>
                            <td>{{ GlobalHelper::formatCreatedAt($compagnies->created_at) }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <!-- Infos Administrateur -->
                    <div class="col-md-6">
                      <h6>Informations Administrateur</h6>
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <th>Nom</th>
                            <td>{{ $users->nom }}</td>
                          </tr>
                          <tr>
                            <th>Prénom</th>
                            <td>{{ $users->prenom }}</td>
                          </tr>
                          <tr>
                            <th>Email</th>
                            <td>{{ $users->email }}</td>
                          </tr>
                          <tr>
                            <th>Téléphone</th>
                            <td>{{ $users->telephone }}</td>
                          </tr>
                          <tr>
                            <th>Date d'inscription</th>
                            <td>{{ GlobalHelper::formatCreatedAt($users->created_at) }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div> --}}

                {{-- <a href="{{ route('compagnies.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a> --}}


                <div class="card-body">
                <div class="row">
                  <!-- Logo -->
                  <div class="col-md-3 text-center">
                    @if($compagnies->logo_compagnies)
                      <img src="{{ asset( 'logo_compagnie/' .$compagnies->logo_compagnies) }}" 
                           alt="Logo {{ $compagnies->nom_complet_compagnies }}" 
                           class="img-fluid  shadow-sm" style="max-height: 150px;">
                    @else
                      <img src="{{ asset('assets/img/profile_av.png') }}" 
                           alt="Logo par défaut" 
                           class="img-fluid rounded-circle shadow-sm" style="max-height: 150px;">
                    @endif
                    <h6 class="mt-3">{{ $compagnies->nom_complet_compagnies }}</h6>
                  </div>

                  <!-- Infos compagnie -->
                  <div class="col-md-5">
                    <h6 class="text-primary">Informations sur la compagnie</h6>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"><strong>Email :</strong> {{ $compagnies->email_compagnies }}</li>
                      <li class="list-group-item"><strong>Téléphone :</strong> {{ $compagnies->telephone_compagnies }}</li>
                      <li class="list-group-item"><strong>Adresse :</strong> {{ $compagnies->adresse_compagnies }}</li>
                      <li class="list-group-item"><strong>Description :</strong> {{ $compagnies->adresse }}</li>
                      <li class="list-group-item"><strong>Ville :</strong> {{ $compagnies->ville?->nom_ville ?? 'Non renseignée' }}</li>
                      
                     <li class="list-group-item">
  <strong>Localisation :</strong>
  <div id="map" style="width: 100%; height: 300px; border-radius: 8px;" class="mt-2"></div>
</li>
<script>
  function initMap() {
    // coordonnées de la compagnie
    var lat = parseFloat("{{ $compagnies->latitude ?? 0 }}");
    var lng = parseFloat("{{ $compagnies->longitude ?? 0 }}");

    if (!lat || !lng) {
      document.getElementById("map").innerHTML = "<p class='text-muted'>Coordonnées non disponibles</p>";
      return;
    }

    // position
    var location = { lat: lat, lng: lng };

    // carte
    var map = new google.maps.Map(document.getElementById("map"), {
      zoom: 14,
      center: location,
    });

    // marqueur
    new google.maps.Marker({
      position: location,
      map: map,
      title: "{{ $compagnies->nom_complet_compagnies }}",
    });
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&callback=initMap" async defer></script>

                      
                    </ul>
                  </div>

                  <!-- Infos administrateur -->
                  <div class="col-md-4">
                    <h6 class="text-success">Administrateur de la compagnie</h6>
                    @if($users)
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nom :</strong> {{ $users->nom ?? '---' }}</li>
                        <li class="list-group-item"><strong>Prénom :</strong> {{ $users->prenom ?? '---' }}</li>
                        <li class="list-group-item"><strong>Email :</strong> {{ $users->email ?? '---' }}</li>
                        <li class="list-group-item"><strong>Téléphone :</strong> {{ $users->telephone ?? '---' }}</li>
                      </ul>
                    @else
                      <p class="text-muted">Aucun administrateur associé.</p>
                    @endif
                  </div>
                </div>
              </div>

              {{-- <div class="card-footer text-end">
                <a href="{{ route('compagnies') }}" class="btn btn-secondary">
                  <i class="bi bi-arrow-left"></i> Retour
                </a>
              </div> --}}
        
   


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
