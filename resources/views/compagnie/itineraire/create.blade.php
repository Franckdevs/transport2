@include('compagnie.all_element.header')

<body class="layout-1" data-luno="theme-blue">
@include('compagnie.all_element.sidebar')

<div class="wrapper">
    <header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
        <div class="container-fluid">
            <nav class="navbar">
                @include('compagnie.all_element.navbar')
            </nav>
        </div>
    </header>

    @include('compagnie.all_element.cadre')

    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">
    </h5>
    <a href="{{ route('itineraire.index') }}" class="btn btn-light" title="Retour">
        <i class="fa fa-arrow-left"></i> Retour
    </a>
  </div>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">

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
                        <form action="{{ route('itineraire.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                @if ($villeId)
                                <input type="hidden"  name="ville_id" value="{{ $villeId }}">
                                @else
                                {{-- <hr> --}}
                            {{-- <!-- Ville et Gare de départ -->
<p>
    <span class="badge bg-primary">Profil Super admin</span>
</p>

                            <div class="col-md-6 mb-3">
                            <label for="gare_id" class="form-label">Gare de départ </label>
                            <select name="gare_id" id="gare_id" class="form-control">
                                <option value="">-- Sélectionnez une gare --</option>
                                @if($gars)
                                    @foreach($gars as $gare)
                                        <option value="{{ $gare->id }}" {{ old('gare_id') == $gare->id ? 'selected' : '' }}>
                                            {{ $gare->nom_gare }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            </div> --}}
                            <hr>
    <p>
        <span class="badge bg-primary">Profil Super admin</span>
    </p>

    <div class="col-md-6 mb-3">
        <label for="gare_id" class="form-label">Gare de départ </label>
        <select name="gare_id" id="gare_id" class="form-control">
            <option value="">-- Sélectionnez une gare --</option>
            @if($gars)
                @foreach($gars as $gare)
                    <option value="{{ $gare->id }}"
                        data-ville="{{ $gare->ville_id }}"
                        {{ old('gare_id') == $gare->id ? 'selected' : '' }}>
                        {{ $gare->nom_gare }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>

    <!-- champ caché qui sera mis à jour dynamiquement -->
    <input type="hidden" name="ville_id" id="hidden-ville-id" value="{{ old('ville_id') ?? '' }}">
    <script>
document.getElementById('gare_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const villeId = selectedOption.dataset.ville || '';
    document.getElementById('hidden-ville-id').value = villeId;
});
</script>

                                @endif

                                <!-- Heure d'arrivée -->
                                <div class="col-md-6 mb-3">
                                    <label for="harriver" class="form-label">Estimation du voyage (en H)</label>
                                    <input type="time" name="estimation" id="harriver" class="form-control"
                                           value="{{ old('estimation') }}">
                                </div>

                                 {{-- <div class="col-md-6 mb-3">
                                    <label for="titre" class="form-label">titre du trajet a enregistrer</label>
                                    <input type="text" name="titre" id="titre" class="form-control"
                                           value="{{ old('titre') }}">
                                </div> --}}
                                <div class="col-md-6 mb-3">
                                    <label for="titre" class="form-label">Titre du trajet à enregistrer</label>
                                    <textarea name="titre" id="titre" class="form-control" rows="3">{{ old('titre') }}</textarea>
                                </div>


                            </div>

                            <hr>

                            <!-- Arrêts -->
                            {{-- <div class="mb-4">
                                <label class="form-label">Arrêts</label>
                                <small class="form-text text-muted">
                                        ⚠️ Le dernier arrêt indiqué sera considéré comme <strong>l’arrêt final</strong> du trajet.
                                </small>
                                <div id="arrets-container">
                                    <div class="row arret mb-3">
                                        <div class="col-md-6">
                                            <input type="text" name="arrets[0][nom]" class="form-control"
       list="liste-gares" placeholder="Lieu d'arrêt" required>

                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <button type="button" class="btn btn-danger btn-remove-arret">Supprimer</button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-secondary" id="add-arret">+ Ajouter un arrêt</button>
                            </div> --}}

                            <div class="mb-4">
    <label class="form-label">Arrêts (gares)</label>
<small class="form-text text-muted">
    ⚠️ Ajoutez les arrêts liés à chaque gare. Chaque arrêt est considéré comme une gare.
</small>


    <div id="gares-container">
        <div class="row gare-item mb-3">
            <div class="col-md-6">
                <select name="gares[0][id]" class="form-control" required>
                    <option value="">-- Choisir une gare --</option>
                    @foreach($gares as $gare)
                        <option value="{{ $gare->id }}">{{ $gare->nom_gare }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <button type="button" class="btn btn-danger btn-remove-gare">Supprimer</button>
            </div>
        </div>
    </div>

    {{-- <button type="button" class="btn btn-primary" id="add-gare">+ Ajouter une gare</button> --}}
    <button type="button" class="btn btn-primary d-flex align-items-center" id="add-gare" style="gap: 6px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
    </svg>
    Ajouter une gare
</button>


</div>
<script>
    let index = 1;

    // Ajouter une gare
    document.getElementById('add-gare').addEventListener('click', function () {
        const container = document.getElementById('gares-container');
        const html = `
            <div class="row gare-item mb-3">
                <div class="col-md-6">
                    <select name="gares[${index}][id]" class="form-control" required>
                        <option value="">-- Choisir une gare --</option>
                        @foreach($gares as $gare)
                            <option value="{{ $gare->id }}">{{ $gare->nom_gare }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-remove-gare">Supprimer</button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        index++;
    });

    // Supprimer une gare
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('btn-remove-gare')) {
            e.target.closest('.gare-item').remove();
        }
    });
</script>





                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Enregistrer le voyage</button>
                            </div>
                        </form>

                        <!-- Liste auto-complétion -->
                       <!-- Liste auto-complétion -->
{{-- <datalist id="liste-gares">
    @foreach ($gars as $gares)
        <option value="{{ $gare->nom_gare }}">
    @endforeach
</datalist> --}}

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('compagnie.all_element.footer')
</div>

<!-- Scripts -->
<script src="../assets/js/theme.js"></script>
<script src="../assets/js/bundle/apexcharts.bundle.js"></script>

{{-- <script>
    let index = 1;

    // Ajouter un arrêt
    document.getElementById('add-arret').addEventListener('click', function () {
        const container = document.getElementById('arrets-container');
      const html = `
    <div class="row arret mb-3">
        <div class="col-md-6">
            <input type="text" name="arrets[${index}][nom]" class="form-control"
                   list="liste-gares" placeholder="Lieu d'arrêt" required>
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
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('btn-remove-arret')) {
            e.target.closest('.arret').remove();
        }
    });
</script> --}}

</body>
</html>
