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
                            <form action="{{ route('voyage.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <!-- Itinéraire -->
                         <div class="col-md-6 mb-3">
    <label for="itineraire_id" class="form-label">Itinéraire</label>
    <select name="itineraire_id" id="itineraire_id" class="form-control" required>
        <option value="">Sélectionner un itinéraire</option>
        @foreach ($itineraires as $itineraire)
            <option value="{{ $itineraire->id }}">{{ $itineraire->titre }}</option>
        @endforeach
    </select>
</div>

<!-- Zone pour afficher les infos -->
<div id="itineraire-info" class="mt-3"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectItineraire = document.getElementById('itineraire_id');
    const infoDiv = document.getElementById('itineraire-info');

    if (!selectItineraire) return;

    selectItineraire.addEventListener('change', function() {
        const itineraireId = this.value;

        if (!itineraireId) {
            infoDiv.innerHTML = "";
            return;
        }

        fetch(`/itineraire/${itineraireId}`)
            .then(response => {
                if (!response.ok) throw new Error('Itinéraire non trouvé');
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    infoDiv.innerHTML = `<p class="text-danger">${data.error}</p>`;
                    return;
                }

                // Création du HTML pour les arrêts avec champ montant
                let arretsHtml = '';
                if (data.arrets && data.arrets.length > 0) {
                    arretsHtml = `<ul class="list-group list-group-flush mb-0">
                        ${data.arrets.map(arret => `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${arret.nom}</span>
                                <input type="number" class="form-control form-control-sm w-25" placeholder="Montant" name="montant[${arret.id}]" min="0" step="0.01">
                            </li>
                        `).join('')}
                    </ul>`;
                } else {
                    arretsHtml = '<p>Aucun arrêt pour cet itinéraire.</p>';
                }

                // Affichage des informations dans une carte
                infoDiv.innerHTML = `
                    <div class="card shadow-sm p-3 mb-3">
                        <div class="card-body">
                            <h4 class="card-title mb-3">${data.titre}</h4>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>Estimation:</strong> ${data.estimation}</div>
                                <div class="col-md-4"><strong>Ville:</strong> <span class="badge bg-primary">${data.ville ? data.ville.nom : 'N/A'}</span></div>
                            </div>
                           
                            <h5 class="mt-3">Arrêts et montants:</h5>
                            ${arretsHtml}
                        </div>
                    </div>
                `;
            })
            .catch(error => {
                infoDiv.innerHTML = `<p class="text-danger">Impossible de récupérer les informations de l'itinéraire.</p>`;
                console.error(error);
            });
    });
});
</script>





                                    <!-- Montant -->
                                    {{-- <div class="col-md-6 mb-3">
                                        <label for="montant" class="form-label">Montant du voyage (FCFA)</label>
                                        <input type="text" name="montant" id="montant" class="form-control"
                                            value="{{ old('montant') }}" required
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div> --}}
                               <div class="col-md-6 mb-3">
    <label for="heure_depart" class="form-label">Heure de départ</label>
    <input type="time" name="heure_depart" id="heure_depart" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
    <label for="date_depart" class="form-label">Date du départ</label>
    <input type="date" name="date_depart" id="date_depart" class="form-control" value="{{ old('date_depart') }}" required>
</div>


                                    <!-- Bus -->
                                    <div class="col-md-6 mb-3">
                                        <label for="bus_id" class="form-label">Bus</label>
                                        <select name="bus_id" id="bus_id" class="form-control" required>
                                            <option value="">Sélectionner un bus</option>
                                            @foreach ($buses as $bus)
                                                <option value="{{ $bus->id }}">{{ $bus->nom_bus }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Chauffeur -->
                                    <div class="col-md-6 mb-3">
                                        <label for="chauffeur_id" class="form-label">Chauffeur</label>
                                        <select name="chauffeur_id" id="chauffeur_id" class="form-control" required>
                                            <option value="">Sélectionner un chauffeur</option>
                                            @foreach ($chauffeurs as $chauffeur)
                                                <option value="{{ $chauffeur->id }}">{{ $chauffeur->nom }}
                                                    {{ $chauffeur->prenom }}</option>
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
