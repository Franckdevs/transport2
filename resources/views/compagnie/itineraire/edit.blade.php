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
                        <form action="{{ route('itineraire.update' , $itineraire->id ) }}" method="POST">
                              @csrf
                              @method('PUT')

                            <div class="row">
                                @if ($villeId)
                                <input type="hidden"  name="ville_id" value="{{ $villeId }}">
                                @else
                                <hr>
                            <!-- Ville et Gare de départ -->
                            <p>Profil Super admin</p>
                            <div class="col-md-6 mb-3">
                                <label for="ville_id" class="form-label">Ville de départ (optionnelle)</label>
                                <select name="ville_id" id="ville_id" class="form-control">
                                    <option value="">-- Sélectionnez une ville --</option>
                                    @foreach($villes as $ville)
                                        <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>
                                            {{ $ville->nom_ville }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="gare_id" class="form-label">Gare de départ (optionnelle)</label>
                                <select name="gare_id" id="gare_id" class="form-control">
                                    <option value="">-- Sélectionnez une gare --</option>
                                   @foreach($gars as $gare)
    <option value="{{ $gare->id }}" 
        {{ old('gare_id', $itineraire->gare_id ?? null) == $gare->id ? 'selected' : '' }}>
        {{ $gare->nom_gare }}
    </option>
@endforeach

                                </select>
                                @error('gare_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                                @endif

                                <!-- Heure d'arrivée -->
                                <div class="col-md-6 mb-3">
                                    <label for="harriver" class="form-label">Estimation du voyage (en H)</label>
                                    <input type="time" name="estimation" id="harriver" class="form-control"
                                           value="{{ old('estimation' , $itineraire->estimation) }}">
                                </div>

                                 {{-- <div class="col-md-6 mb-3">
                                    <label for="titre" class="form-label">titre du trajet a enregistrer</label>
                                    <input type="text" name="titre" id="titre" class="form-control"
                                           value="{{ old('titre') }}">
                                </div> --}}
                                <div class="col-md-6 mb-3">
                                    <label for="titre" class="form-label">Titre du trajet à enregistrer</label>
                                    <textarea name="titre" id="titre" class="form-control" rows="3">{{ old('titre' ,$itineraire) }}</textarea>
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
                                                   list="liste-villes" placeholder="Lieu d'arrêt" required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <button type="button" class="btn btn-danger btn-remove-arret">Supprimer</button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-secondary" id="add-arret">+ Ajouter un arrêt</button>
                            </div> --}}

                            <div class="mb-4">
    <label class="form-label">Arrêts</label>
    <small class="form-text text-muted">
        ⚠️ Le dernier arrêt indiqué sera considéré comme <strong>l’arrêt final</strong> du trajet.
    </small>

    <div id="arrets-container">
        @forelse ($itineraire->arrets as $i => $arret)
            <div class="row arret mb-3">
                <div class="col-md-6">
                    <input type="text" name="arrets[{{ $i }}][nom]" 
                           class="form-control"
                           value="{{ $arret->nom }}"
                           list="liste-villes"
                           placeholder="Lieu d'arrêt" required>
                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-remove-arret">Supprimer</button>
                </div>
            </div>
        @empty
            <div class="row arret mb-3">
                <div class="col-md-6">
                    <input type="text" name="arrets[0][nom]" 
                           class="form-control"
                           list="liste-villes" 
                           placeholder="Lieu d'arrêt" required>
                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-remove-arret">Supprimer</button>
                </div>
            </div>
        @endforelse
    </div>

    <button type="button" class="btn btn-secondary" id="add-arret">+ Ajouter un arrêt</button>
</div>


                            <div class="text-end">
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

<!-- Scripts -->
<script src="../assets/js/theme.js"></script>
<script src="../assets/js/bundle/apexcharts.bundle.js"></script>

<script>
  //  let index = 1;
let index = {{ $itineraire->arrets->count() ?? 1 }};

    // Ajouter un arrêt
    document.getElementById('add-arret').addEventListener('click', function () {
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
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('btn-remove-arret')) {
            e.target.closest('.arret').remove();
        }
    });
</script>

</body>
</html>
