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

        @include('compagnie.all_element.cadre')

        <!-- start: page body -->
        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">
                </h5>
                <a href="{{ route('voyage.index') }}" class="btn btn-light" title="Retour">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </div>
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4">Créer un voyage</h5>

                            <!-- Affichage des erreurs -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Formulaire de création -->
                            <form action="{{ route('voyage.update' ,$voyage->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                <div class="row">
                                    <!-- Itinéraire -->
                                    <div class="col-md-6 mb-3">
                                        <label for="itineraire_id" class="form-label">Itinéraire</label>
                                        {{-- <select name="itineraire_id" id="itineraire_id" class="form-control" required>
                                            <option value="">Sélectionner un itinéraire</option>
                                            @foreach ($itineraires as $itineraire)
                                                <option value="{{ $itineraire->id }}">{{ $itineraire->titre }}</option>
                                            @endforeach
                                        </select> --}}
                                         <select name="itineraire_id" id="itineraire_id" class="form-select">
        <option value="">-- Sélectionnez un itinéraire --</option>
        @foreach($itineraires as $itineraire)
            <option value="{{ $itineraire->id }}" 
                {{ $voyage->itineraire_id == $itineraire->id ? 'selected' : '' }}>
                {{ $itineraire->titre }}
            </option>
        @endforeach
    </select>
                                    </div>

    
<div id="itineraire-loading" class="text-center my-3" style="display:none;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Chargement...</span>
    </div>
    <p>Chargement des arrêts, veuillez patienter...</p>
</div>

<div id="itineraire-info" class="mt-3"></div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectItineraire = document.getElementById('itineraire_id');
    const infoDiv = document.getElementById('itineraire-info');
    const loadingDiv = document.getElementById('itineraire-loading');

    if (!selectItineraire) return;

    const renderArrets = (data, arretVoyages) => {
        if (!data.arrets || data.arrets.length === 0) {
            return '<p>Aucun arrêt pour cet itinéraire.</p>';
        }

        return `<ul class="list-group list-group-flush mb-0">
            ${data.arrets.map(arret => `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-bold">
                            ${data.gare.status === 1 ? '✔ ' : ''}${arret.gare ? arret.gare.nom : 'N/A'}
                        </span><br>
                        <small class="text-muted fw-bold">
                            Ville: ${arret.gare && arret.gare.ville ? arret.gare.ville : 'N/A'}
                        </small>
                    </div>
                    <input type="number" class="form-control form-control-sm w-25" 
                        placeholder="Montant" 
                        name="montant[${arret.id}]" 
                        min="0" step="0.01"
                        value="${arretVoyages[arret.id] ?? ''}">
                </li>
            `).join('')}
        </ul>`;
    };

    const loadItineraire = (itineraireId) => {
        if (!itineraireId) {
            infoDiv.innerHTML = "";
            return;
        }

        // Afficher le loading
        loadingDiv.style.display = 'block';
        infoDiv.style.display = 'none';

        fetch(`/itineraire/${itineraireId}`)
            .then(res => res.ok ? res.json() : Promise.reject('Itinéraire non trouvé'))
            .then(data => {
                const arretsHtml = renderArrets(data, @json($arretVoyages->mapWithKeys(fn($item) => [$item->arret_id => $item->montant])));

                infoDiv.innerHTML = `
                    <div class="card shadow-sm p-3 mb-3">
                        <div class="card-body">
                            <h4 class="card-title mb-3">${data.titre}</h4>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>Estimation:</strong> ${data.estimation}</div>
                                <div class="col-md-4"><strong>Ville de départ :</strong> ${data.ville_depart_gare} (${data.nom_gare})</div>
                            </div>
                            <h5 class="mt-3">Arrêts et montants:</h5>
                            ${arretsHtml}
                        </div>
                    </div>
                `;
            })
            .catch(err => {
                infoDiv.innerHTML = `<p class="text-danger">Impossible de récupérer les informations de l'itinéraire.</p>`;
                console.error(err);
            })
            .finally(() => {
                // Masquer le loading et afficher le contenu
                loadingDiv.style.display = 'none';
                infoDiv.style.display = 'block';
            });
    };

    selectItineraire.addEventListener('change', function() {
        loadItineraire(this.value);
    });

    // Charger l'itinéraire sélectionné au chargement de la page
    if (selectItineraire.value) {
        loadItineraire(selectItineraire.value);
    }
});

</script>


                                    <!-- Montant -->
                                    {{-- <div class="col-md-6 mb-3">
                                        <label for="montant" class="form-label">Montant du voyage (F CFA)</label>
                                        <input type="text" name="montant" id="montant" class="form-control"
                                            value="{{ old('montant' ,$voyage) }}" required
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div> --}}
                               <div class="col-md-6 mb-3">
    <label for="heure_depart" class="form-label">Heure de départ</label>
    <input type="time" name="heure_depart" id="heure_depart" class="form-control" value="{{ old('heure_depart',$voyage) }}" required>
</div>

<div class="col-md-6 mb-3">
    <label for="date_depart" class="form-label">Date du départ</label>
    <input type="date" name="date_depart" id="date_depart" class="form-control" value="{{ old('date_depart',$voyage) }}" required>
</div>


                                    <!-- Bus -->
                                    <div class="col-md-6 mb-3">
                                        <label for="bus_id" class="form-label">Bus</label>
                                        {{-- <select name="bus_id" id="bus_id" class="form-control" required>
                                            <option value="">Sélectionner un bus</option>
                                            @foreach ($buses as $bus)
                                                <option value="{{ $bus->id }}">{{ $bus->nom_bus }}</option>
                                            @endforeach
                                        </select> --}}
                                        <select name="bus_id" id="bus_id" class="form-select">
        <option value="">-- Sélectionnez un bus --</option>
        @foreach($buses as $bus)
            <option value="{{ $bus->id }}" 
                {{ $voyage->bus_id == $bus->id ? 'selected' : '' }}>
                {{ $bus->nom_bus }}
            </option>
        @endforeach
    </select>
                                    </div>

                                    <!-- Chauffeur -->
                                    <div class="col-md-6 mb-3">
                                        <label for="chauffeur_id" class="form-label">Chauffeur</label>
                                        {{-- <select name="chauffeur_id" id="chauffeur_id" class="form-control" required>
                                            <option value="">Sélectionner un chauffeur</option>
                                            @foreach ($chauffeurs as $chauffeur)
                                                <option value="{{ $chauffeur->id }}">{{ $chauffeur->nom }}
                                                    {{ $chauffeur->prenom }}</option>
                                            @endforeach
                                        </select> --}}
                                         <select name="chauffeur_id" id="chauffeur_id" class="form-select">
        <option value="">-- Sélectionnez un chauffeur --</option>
        @foreach($chauffeurs as $chauffeur)
            <option value="{{ $chauffeur->id }}" 
                {{ $voyage->chauffeur_id == $chauffeur->id ? 'selected' : '' }}>
                {{ $chauffeur->nom }}
            </option>
        @endforeach
    </select>
                                    </div>
                                </div>

                                <hr>



                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary">Enregistrer le voyage</button>
                                </div>
                            </form>

                            <!-- Liste auto-complétion -->
                            <datalist id="liste-villes">
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->nom_ville }}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('compagnie.all_element.footer')

    </div>

    <!-- Jquery Page Js -->
    <script src="../assets/js/theme.js"></script>

    <!-- Plugin Js -->
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <script>
        let index = 1;

        // Ajouter un arrêt
        document.getElementById('add-arret').addEventListener('click', function() {
            const container = document.getElementById('arrets-container');
            const html = `
                <div class="row arret mb-3">
                    <div class="col-md-6">
                        <input type="text" name="arrets[${index}][nom]" class="form-control"
                            list="liste-villes" placeholder="Lieu d'arrêt" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-danger btn-remove-arret">Supprimer</button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            index++;
        });

        // Supprimer un arrêt
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('btn-remove-arret')) {
                e.target.closest('.arret').remove();
            }
        });
    </script>

</body>

</html>
