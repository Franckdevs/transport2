{{-- resources/views/compagnie/gare/show.blade.php --}}
@include('compagnie.all_element.header')

<body class="layout-1" data-luno="theme-blue">

@include('compagnie.all_element.sidebar')

<div class="wrapper">
    @include('compagnie.all_element.navbar')
    @include('compagnie.all_element.cadre')

    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        <div class="container-fluid">

            <div class="card p-4 shadow-sm rounded">
                {{-- Titre --}}
                <h4 class="mb-3">
                    <i class="fa fa-train me-2"></i> Gare : {{ $gare->nom_gare ?? 'Sans nom' }}
                </h4>

                {{-- Informations principales --}}
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
                        {{-- <p><strong>Latitude :</strong> {{ $gare->latitude ?? '-' }}</p>
                        <p><strong>Longitude :</strong> {{ $gare->longitude ?? '-' }}</p> --}}
                        <p><strong>Heure d'ouverture :</strong> {{ $gare->heure_ouverture ?? '-' }}</p>
                        <p><strong>Heure de fermeture :</strong> {{ $gare->heure_fermeture ?? '-' }}</p>
                        <p><strong>Jour d'ouverture :</strong> {{ $gare->jourOuvert?->nom ?? '-' }}</p>
                        <p><strong>Jour de fermeture :</strong> {{ $gare->jourFermeture?->nom ?? '-' }}</p>
                        <p><strong>Nombre de quais :</strong> {{ $gare->nombre_quais ?? 'Non renseigné' }}</p>
                    </div>
                </div>

                <hr>

{{-- Équipements --}}
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

{{-- Administrateur --}}
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

                {{-- Statut --}}
                <p><strong>Status :</strong>
                    @if($gare->status == 1) ✅ Actif
                    @elseif($gare->status == 2) ❌ Inactif
                    @else ⏳ En attente
                    @endif
                </p>

                {{-- Carte Google Maps --}}
                <h5 class="mt-3"><i class="fa fa-map-marker-alt me-2"></i> Localisation :</h5>
                <div id="map" style="height: 350px; width: 100%;" class="my-3 border rounded"></div>

                {{-- Bouton retour --}}
                <a href="{{ route('gares.index') }}" class="btn btn-secondary mt-3">
                    <i class="fa fa-arrow-left"></i> Retour à la liste
                </a>
            </div>

        </div>
    </div>

    @include('compagnie.all_element.footer')
</div>

{{-- Google Maps --}}
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
</html>
