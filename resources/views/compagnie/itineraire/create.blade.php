@include('compagnie.all_element.header')

<body class="layout-1" data-luno="theme-blue">
@include('compagnie.all_element.sidebar')
<style>
    .info-badge {
        background: rgba(25, 135, 84, 0.1);
        color: #198754;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 1rem 0 1.5rem;
        border-left: 3px solid #198754;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .btn-outline-primary {
        border-color: #198754;
        color: #198754;
        background-color: transparent;
    }
    
    .btn-outline-primary:hover {
        background-color: #198754;
        color: #fff;
    }
    
    .btn-outline-primary:not(:hover) {
        background-color: transparent;
        color: #198754;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #a3cfbb;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }
    
    .btn-primary {
        background-color: #198754;
        border-color: #198754;
    }
    
    .btn-primary:hover {
        background-color: #157347;
        border-color: #146c43;
        opacity: 0.9;
    }
    
    .btn-primary:not(:hover) {
        background-color: #198754;
        border-color: #198754;
    }
    
    .card {
        border: 1px solid rgba(0,0,0,.125);
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
    }
    
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,.125);
        padding: 1rem 1.25rem;
    }
</style>
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
            <!-- En-tête avec bouton de retour -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- <h1 class="page-title mb-0">
                    <i class="fas fa-plus-circle me-2"></i>Créer un nouvel itinéraire
                </h1> --}}
                <div class="ms-auto">
                    <a href="{{ route('itineraire.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
            
                        <!-- Affichage des erreurs -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Veuillez corriger les erreurs suivantes :</strong>
                                </div>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Formulaire de création -->
                        <form action="{{ route('itineraire.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                @if ($villeId)
                                <input type="hidden" name="ville_id" value="{{ $villeId }}">
                                @else
                                <div class="col-12 mb-4">
                                    <div class="border-start border-4 border-warning ps-3">
                                        <span class="badge  bg-opacity-10 text-black fs-6 px-3 py-2">
                                            <i class="fas fa-user-shield me-2 text-warning"></i>Profil Super admin
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="gare_id" class="form-label fw-semibold">
                                        <i class="fas fa-train me-2 text-warning"></i>Gare de départ
                                    </label>
                                    <select name="gare_id" id="gare_id" class="form-select @error('gare_id') is-invalid @enderror" required>
                                        <option value="">Sélectionnez une gare</option>
                                        @foreach($gars as $gare)
                                            <option value="{{ $gare->id }}" 
                                                    data-ville="{{ $gare->ville_id }}"
                                                    {{ old('gare_id') == $gare->id ? 'selected' : '' }}>
                                                {{ $gare->nom_gare }} - {{ $gare->ville->nom_ville ?? 'Ville inconnue' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gare_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Sélectionnez la gare de départ du trajet
                                    </div>
                                </div>
                                

                                <input type="hidden" name="ville_id" id="hidden-ville-id" value="{{ old('ville_id') ?? '' }}">
                                @endif

                                <script>
                                document.getElementById('gare_id').addEventListener('change', function() {
                                const selectedOption = this.options[this.selectedIndex];
                                const villeId = selectedOption.getAttribute('data-ville');
                                document.getElementById('hidden-ville-id').value = villeId || '';
                                
                                // Validation visuelle
                                if (!villeId) {
                                    this.classList.add('is-invalid');
                                } else {
                                    this.classList.remove('is-invalid');
                                }
                            });

                            // Validation côté client avant soumission
                            document.querySelector('form').addEventListener('submit', function(e) {
                                const gareSelect = document.getElementById('gare_id');
                                const villeId = document.getElementById('hidden-ville-id').value;
                                
                                if (!gareSelect.value && !villeId) {
                                    e.preventDefault();
                                    alert('Veuillez sélectionner une gare de départ');
                                    gareSelect.focus();
                                }
                            });
                                </script>

                                <!-- Heure d'arrivée -->
                                @if(Auth::user()->info_user && Auth::user()->info_user->compagnie)
                                <div class="col-md-2 mb-4">
                                    <label for="harriver" class="form-label fw-semibold">
                                        <i class="fas fa-clock me-2 text-warning"></i>Estimation
                                    </label>
                                    <input type="time" name="estimation" id="harriver" 
                                           class="form-control form-control-lg shadow-sm"
                                           value="{{ old('estimation') }}" required>
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Durée estimée du trajet
                                    </div>
                                </div>
                                @else
                                <div class="col-md-6 mb-4">
                                    <label for="harriver" class="form-label fw-semibold">
                                        <i class="fas fa-clock me-2 text-warning"></i>Estimation
                                    </label>
                                    <input type="time" name="estimation" id="harriver" 
                                           class="form-control form-control-lg shadow-sm"
                                           value="{{ old('estimation') }}">
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Durée estimée du trajet
                                    </div>
                                </div>
                                @endif

                                @if(Auth::user()->info_user && Auth::user()->info_user->compagnie)
                                <div class="col-md-6 mb-4">
                                    <label for="titre" class="form-label fw-semibold">
                                        <i class="fas fa-heading me-2 text-warning"></i>Titre du trajet
                                    </label>
                                    <textarea name="titre" id="titre" class="form-control shadow-sm" rows="8" 
                                              placeholder="Exemple: Abidjan san pedro" required>{{ old('titre') }}</textarea>
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Donnez un titre descriptif à votre trajet
                                    </div>
                                </div>
                                @else
                                <div class="col-md-6 mb-4">
                                    <label for="titre" class="form-label fw-semibold">
                                        <i class="fas fa-heading me-2 text-warning"></i>Titre du trajet
                                    </label>
                                    <textarea name="titre" id="titre" class="form-control shadow-sm" rows="3" 
                                              placeholder="Ex: Trajet Dakar - Thiès express" required>{{ old('titre') }}</textarea>
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Donnez un titre descriptif à votre trajet
                                    </div>
                                </div>
                                @endif
                            </div>

                            <hr class="my-4">

                            <!-- Arrêts -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <label class="form-label fw-semibold mb-0">
                                        <i class="fas fa-map-marker-alt me-2 text-warning"></i>Arrêts (gares)
                                    </label>
                                    <span class="badge bg-warning bg-opacity-10 text-warning ms-2">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Important
                                    </span>
                                </div>
                                
                                <div class="alert alert-info bg-info bg-opacity-10 border-0 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle text-info me-2"></i>
                                        <small>
                                            Ajoutez les arrêts liés à chaque gare. Chaque arrêt est considéré comme une gare.
                                        </small>
                                    </div>
                                </div>

                              <div id="gares-container">
                                    <div class="row gare-item mb-3 align-items-center">
                                        <div class="col-md-6">
                                            <!-- NOTE: class="gare-select" nécessaire pour que le JS récupère la valeur -->
                                            <select name="gares[0][id]" class="form-select shadow-sm gare-select" required>
                                                <option value="">-- Choisir une gare --</option>
                                                @foreach($gares as $gare)
                                                    <option value="{{ $gare->id }}">
                                                        {{ $gare->nom_gare }} - {{ $gare->ville->nom_ville ?? 'Ville inconnue' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4 d-flex align-items-center gap-2">
                                            <button type="button" class="btn btn-warning text-dark btn-detail-gare">
                                                <i class="fas fa-info-circle me-1 text-white"></i>Détails
                                            </button>
                                            <button type="button" class="btn btn-warning text-dark btn-remove-gare">
                                                <i class="fas fa-trash me-1 text-white"></i>Supprimer
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                {{-- <button type="button" class="btn btn-warning d-inline-flex align-items-center mt-2 text-white" id="add-gare">
                                    <i class="fas fa-plus-circle me-2"></i>
                                    Ajouter une gare
                                </button> --}}
                            </div>

                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-between pt-3 border-top mt-4">
                                <a href="{{ route('itineraire.index') }}" class="btn btn-light">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                                <div>
                                    <button type="submit" class="btn btn-warning px-4 text-white" id="createItineraireBtn" style="min-width: 200px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-save me-2" id="createIcon"></i>
                                        <span id="createText">Créer l'itinéraire</span>
                                        <div class="spinner-border spinner-border-sm ms-2 d-none" id="createSpinner" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

     <!-- ✅ Modal Détails Gare -->
    <div class="modal fade" id="gareDetailModal" tabindex="-1" aria-labelledby="gareDetailLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-body">
            <div id="gare-details-content">
              <div class="text-center py-3 text-muted">Chargement des détails...</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ✅ Fin Modal Détails Gare -->

    @include('compagnie.all_element.footer')
</div>

<!-- Scripts -->
<script src="../assets/js/theme.js"></script>
<script src="../assets/js/bundle/apexcharts.bundle.js"></script>

{{-- <script>
    let index = 1;
    // Ajouter une gare
    document.getElementById('add-gare').addEventListener('click', function () {
        const container = document.getElementById('gares-container');
        const html = `
            <div class="row gare-item mb-3">
                <div class="col-md-6">
                    <select name="gares[${index}][id]" class="form-select shadow-sm" required>
                        <option value="">-- Choisir une gare --</option>
                        @foreach($gares as $gare)
                            <option value="{{ $gare->id }}">{{ $gare->nom_gare }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <button type="button" class="btn btn-warning text-dark btn-remove-gare">
                        <i class="fas fa-trash me-1"></i>Supprimer
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        
        // Animation d'apparition
        const newItem = container.lastElementChild;
        newItem.style.opacity = '0';
        newItem.style.transform = 'translateY(-10px)';
        
        setTimeout(() => {
            newItem.style.transition = 'all 0.3s ease';
            newItem.style.opacity = '1';
            newItem.style.transform = 'translateY(0)';
        }, 10);
        
        index++;
    });

    // Supprimer une gare
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('btn-remove-gare')) {
            const item = e.target.closest('.gare-item');
            item.style.transition = 'all 0.3s ease';
            item.style.opacity = '0';
            item.style.transform = 'translateX(-10px)';
            
            setTimeout(() => {
                item.remove();
            }, 300);
        }
    });

    // Script pour la gare de départ
    document.getElementById('gare_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const villeId = selectedOption.dataset.ville || '';
        document.getElementById('hidden-ville-id').value = villeId;
        
        // Animation de feedback
        this.style.transition = 'all 0.3s ease';
        this.style.boxShadow = '0 0 0 3px rgba(25, 118, 210, 0.2)';
        
        setTimeout(() => {
            this.style.boxShadow = '';
        }, 1000);
    });

    // Amélioration des interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Focus sur le premier champ
        const firstInput = document.querySelector('select, input, textarea');
        if (firstInput) {
            firstInput.focus();
        }
        
        // Animation des cartes
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = `all 0.5s ease ${index * 0.1}s`;
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });
    });
</script> --}}

<script>
    let index = 1;

    // Ajouter une gare
    document.getElementById('add-gare').addEventListener('click', function () {
        const container = document.getElementById('gares-container');
        const html = `
            <div class="row gare-item mb-3 align-items-center">
                <div class="col-md-6">
                    <select name="gares[${index}][id]" class="form-select shadow-sm gare-select" required>
                        <option value="">-- Choisir une gare --</option>
                        @foreach($gares as $gare)
                            <option value="{{ $gare->id }}">{{ $gare->nom_gare }} - {{ $gare->ville->nom_ville ?? 'Ville inconnue' }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-warning text-dark btn-detail-gare">
                        <i class="fas fa-info-circle me-1"></i>Détails
                    </button>
                    <button type="button" class="btn btn-warning text-dark btn-remove-gare">
                        <i class="fas fa-trash me-1"></i>Supprimer
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        index++;
    });

    // Supprimer une gare
    document.addEventListener('click', function (e) {
        if (e.target.closest('.btn-remove-gare')) {
            const item = e.target.closest('.gare-item');
            item.remove();
        }
    });

    // Bouton Détails (avec modal AJAX)
    // document.addEventListener('click', async function (e) {
    //     if (e.target.closest('.btn-detail-gare')) {
    //         const parent = e.target.closest('.gare-item');
    //         const select = parent.querySelector('.gare-select');
    //         const gareId = select.value;

    //         if (!gareId) {
    //             alert("Veuillez d'abord choisir une gare avant de voir les détails.");
    //             return;
    //         }

    //         const modalBody = document.getElementById('gare-details-content');
    //         modalBody.innerHTML = `<div class="text-center py-3 text-muted">Chargement des détails...</div>`;

    //         const modal = new bootstrap.Modal(document.getElementById('gareDetailModal'));
    //         modal.show();

    //         try {
    //             const response = await fetch(`/gares/${gareId}`);
    //             const data = await response.json();

    //             if (data && data.nom_gare) {
    //                 modalBody.innerHTML = `
    //                     <div class="row">
    //                         <div class="col-md-6 mb-3">
    //                             <h6 class="fw-bold text-primary">${data.nom_gare}</h6>
    //                             <p><i class="fas fa-map-marker-alt me-2"></i>${data.adresse_gare}</p>
    //                             <p><i class="fas fa-city me-2"></i><strong>Ville de la gare :</strong> ${data.ville?.nom_ville || 'Non spécifiée'}</p>
    //                         </div>
    //                         <div class="col-md-6 mb-3">
    //                             <p><i class="fas fa-phone me-2"></i>${data.telephone_gare || data.telephone}</p>
    //                             <p><i class="fas fa-envelope me-2"></i>${data.email || 'Aucun email'}</p>
    //                             <p><i class="fas fa-clock me-2"></i><strong>Horaires :</strong> ${data.heure_ouverture} → ${data.heure_fermeture}</p>
    //                         </div>
    //                         <div class="col-md-12 mt-3">
    //                             <p><strong>Description :</strong></p>
    //                             <p class="text-muted">${data.description || 'Aucune description disponible.'}</p>
    //                         </div>
    //                         <div class="col-md-12 mt-3">
    //                             <p><i class="fas fa-wifi me-2"></i>Wi-Fi : ${data.wifi_disponible ? '✅ Disponible' : '❌ Non disponible'}</p>
    //                             <p><i class="fas fa-parking me-2"></i>Parking : ${data.parking_disponible ? '✅ Disponible' : '❌ Non disponible'}</p>
    //                         </div>
    //                     </div>
    //                 `;
    //             }
    //              else {
    //                 modalBody.innerHTML = `<div class="text-center text-danger py-3">Impossible de charger les détails de la gare.</div>`;
    //             }
    //         } catch (error) {
    //             console.error(error);
    //             modalBody.innerHTML = `<div class="text-center text-danger py-3">Erreur lors du chargement des données.</div>`;
    //         }
    //     }
    // });

   document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("btn-detail-gare")) {
        const parent = e.target.closest(".gare-item");
        const select = parent.querySelector(".gare-select");
        const gareId = select?.value;

        if (!gareId) {
            Swal.fire({
                icon: 'warning',
                title: 'Sélection requise',
                text: 'Veuillez d\'abord sélectionner une gare.',
                confirmButtonColor: '#1976d2',
                confirmButtonText: 'OK'
            });
            return;
        }

        const modal = new bootstrap.Modal(document.getElementById("gareDetailModal"));
        const modalBody = document.getElementById("gare-details-content");
        
        // Loading state
        modalBody.innerHTML = `
            <div class="loading-state text-center py-5">
                <div class="spinner-border text-warning mb-3" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Chargement...</span>
                </div>
                <h5 class="text-warning">Chargement des détails</h5>
            </div>
        `;
        
        modal.show();

        fetch(`/gares/${gareId}`)
            .then(res => res.json())
            .then(data => {
                if (data && data.nom_gare) {
                    modalBody.innerHTML = `
                        <div class="gare-details-container">
                            <!-- En-tête -->
                            <div class="gare-header bg-warning text-dark rounded-top p-3 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fw-bold mb-1">${data.nom_gare}</h4>
                                        <p class="mb-0 opacity-75 small">
                                            ${data.ville?.nom_ville || 'Non spécifiée'}
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row g-2">
                                <!-- Informations générales -->
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm mb-3">
                                        <div class="card-body p-3">
                                            <h6 class="card-title text-dark mb-2">Informations générales</h6>
                                            <div class="row g-2">
                                                
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-start">
                                                        <div>
                                                            <small class="text-muted d-block">Ville</small>
                                                            <strong class="small">${data.ville?.nom_ville || 'Non spécifiée'}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-start">
                                                        <div>
                                                            <small class="text-muted d-block">Téléphone</small>
                                                            <strong class="small">${data.telephone_gare || data.telephone || 'Non disponible'}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Services -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm mb-3">
                                        <div class="card-body p-3">
                                            <h6 class="card-title text-dark mb-2">Services</h6>
                                            <div class="services-list">
                                                <div class="service-item">
                                                    <div class="d-flex align-items-center">
                                                        <span class="small">Wi-Fi</span>
                                                    </div>
                                                    <span class="small fw-bold ${data.wifi_disponible ? 'text-success' : 'text-danger'}">
                                                        ${data.wifi_disponible ? 'Oui' : 'Non'}
                                                    </span>
                                                </div>
                                                <div class="service-item">
                                                    <div class="d-flex align-items-center">
                                                        <span class="small">Parking</span>
                                                    </div>
                                                    <span class="small fw-bold ${data.parking_disponible ? 'text-success' : 'text-danger'}">
                                                        ${data.parking_disponible ? 'Oui' : 'Non'}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Horaires d'ouverture -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm mb-3">
                                        <div class="card-body p-3">
                                            <h6 class="card-title text-dark mb-2">Horaires d'ouverture</h6>
                                            <div class="d-flex gap-2">
                                                <div class="time-slot bg-warning bg-opacity-10 p-2 rounded text-center flex-fill">
                                                    <small class="text-muted d-block">Ouverture</small>
                                                    <strong class="text-dark">${data.heure_ouverture || '--:--'}</strong>
                                                </div>
                                                <div class="time-slot bg-warning bg-opacity-10 p-2 rounded text-center flex-fill">
                                                    <small class="text-muted d-block">Fermeture</small>
                                                    <strong class="text-dark">${data.heure_fermeture || '--:--'}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Localisation sur la carte -->
                                ${data.latitude && data.longitude ? `
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body p-3">
                                                <h6 class="card-title text-dark mb-2">Localisation sur la carte</h6>
                                                <div id="map" class="gare-map rounded"></div>
                                            </div>
                                        </div>
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                    `;

                    // Initialiser la carte
                    if (data.latitude && data.longitude) {
                        setTimeout(() => {
                            initMap(parseFloat(data.latitude), parseFloat(data.longitude), data.nom_gare);
                        }, 100);
                    }
                } else {
                    modalBody.innerHTML = `
                        <div class="error-state text-center py-5">
                            <i class="fas fa-exclamation-triangle text-warning mb-3" style="font-size: 3rem;"></i>
                            <h5 class="text-warning">Aucune donnée trouvée</h5>
                            <button class="btn btn-outline-primary mt-2" data-bs-dismiss="modal">
                                Fermer
                            </button>
                        </div>
                    `;
                }
            })
            .catch((error) => {
                modalBody.innerHTML = `
                    <div class="error-state text-center py-5">
                        <i class="fas fa-times-circle text-danger mb-3" style="font-size: 3rem;"></i>
                        <h5 class="text-danger">Erreur de chargement</h5>
                        <button class="btn btn-outline-primary mt-2" data-bs-dismiss="modal">
                            Fermer
                        </button>
                    </div>
                `;
            });
    }
});

// Fonction pour initialiser Google Maps
function initMap(lat, lng, gareName) {
    const mapElement = document.getElementById("map");
    if (!mapElement) return;

    const map = new google.maps.Map(mapElement, {
        center: { lat: lat, lng: lng },
        zoom: 15,
        mapTypeControl: false,
        streetViewControl: false
    });

    new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map: map,
        title: gareName
    });

    setTimeout(() => {
        google.maps.event.trigger(map, 'resize');
        map.setCenter({ lat: lat, lng: lng });
    }, 300);
}

// Styles CSS
const additionalStyles = `
<style>
    .gare-details-container {
        font-family: 'Segoe UI', system-ui, sans-serif;
        font-size: 0.9rem;
    }
    
    .gare-header {
        margin: -1rem -1rem 1rem -1rem;
    }
    
    .service-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .service-item:last-child {
        border-bottom: none;
    }
    
    .status-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }
    
    .status-indicator.available {
        background-color: #ffc107;
        border: 1px solid #ffc107;
    }
    
    .status-indicator.unavailable {
        background-color: #6c757d;
        border: 1px solid #6c757d;
    }
    
    .time-slot {
        border: 1px solid #ffc107;
    }
    
    .gare-map {
        height: 200px;
        border: 1px solid #ffc107;
    }
    
    .card {
        border-radius: 8px;
    }

</style>
`;

document.head.insertAdjacentHTML('beforeend', additionalStyles);

// Spinner pour le bouton "Créer l'itinéraire"
document.addEventListener('DOMContentLoaded', function() {
    const createBtn = document.getElementById('createItineraireBtn');
    const createSpinner = document.getElementById('createSpinner');
    const createIcon = document.getElementById('createIcon');
    const createText = document.getElementById('createText');
    
    if (createBtn) {
        // Écouter la soumission du formulaire à la place du clic
        const form = createBtn.closest('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Afficher le spinner
                createSpinner.classList.remove('d-none');
                createBtn.disabled = true;
                createBtn.style.opacity = '0.65';
                
                // Garder l'icône et le texte visibles
                createIcon.style.display = 'inline';
                createText.style.display = 'inline';
            });
        }
    }
});

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&libraries=places" async defer></script>

<style>
    .modal-content {
    border-radius: 12px;
}
.modal-header {
    border-bottom: none;
}
.modal-footer {
    border-top: none;
}
#gare-details-content p {
    margin-bottom: 0.5rem;
}
#gare-details-content i {
    color: #1976d2;
}

/* ///////////////////////////////////////////////////////////////////////// */
    .card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #1976d2;
        box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
        transform: translateY(-1px);
    }
    
    .btn {
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #1976d2, #0d47a1);
        border: none;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(25, 118, 210, 0.3);
    }
    
    .gare-item {
        transition: all 0.3s ease;
    }
    
    .badge {
        border-radius: 6px;
        font-weight: 500;
    }
    
    .alert {
        border-radius: 10px;
    }
</style>

</body>
</html>