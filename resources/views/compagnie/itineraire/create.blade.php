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
            {{-- <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0 text-primary fw-bold">
                    <i class="fas fa-route me-2"></i>Créer un nouvel itinéraire
                </h5>
                <a href="{{ route('itineraire.index') }}" class="btn btn-outline-primary" title="Retour">
                    <i class="fa fa-arrow-left me-2"></i> Retour
                </a>
            </div> --}}

              <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="section-title mb-0">
                      {{-- Modifier l'utilisateur
                      Votre gare {{ $gares->nom_gare ?? '' }} --}}
                    </h4>
                    <a href="{{ route('itineraire.index') }}" class="btn" title="Retour">
                        <i class="fa fa-arrow-left me-2"></i> Retour à la liste
                    </a>
                </div>
            
            <div class="col-md-12 mt-4">
                <div class="card shadow-sm border-0">
                    {{-- <div class="card-header bg-primary text-white py-3">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Informations du trajet
                        </h6>
                    </div> --}}
                       <div class="info-badge">
                      <i class="fas fa-info-circle"></i>
                      Création d'un itinéraire
                     </div>
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
                                    <div class="border-start border-4 border-primary ps-3">
                                        <span class="badge  bg-opacity-10 text-primary fs-6 px-3 py-2">
                                            <i class="fas fa-user-shield me-2"></i>Profil Super admin
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="gare_id" class="form-label fw-semibold">
                                        <i class="fas fa-train me-2 text-primary"></i>Gare de départ
                                    </label>
                                    {{-- <select name="gare_id" id="gare_id" class="form-select form-select-lg shadow-sm">
                                        <option value="">-- Sélectionnez une gare --</option>
                                        @if($gars)
                                            @foreach($gars as $gare)
                                                <option value="{{ $gare->id }}" 
                                                    data-ville="{{ $gare->ville_id }}"
                                                    {{ old('gare_id') == $gare->id ? 'selected' : '' }}
                                                    class="option-gare">
                                                    <i class="fas fa-building me-2"></i>{{ $gare->nom_gare }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select> --}}
                                    <select name="gare_id" id="gare_id" class="form-select @error('gare_id') is-invalid @enderror" required>
    <option value="">Sélectionnez une gare</option>
    @foreach($gars as $gare)
        <option value="{{ $gare->id }}" 
                data-ville="{{ $gare->ville_id }}"
                {{ old('gare_id') == $gare->id ? 'selected' : '' }}>
            {{ $gare->nom_gare }}
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
                                <div class="col-md-6 mb-4">
                                    <label for="harriver" class="form-label fw-semibold">
                                        <i class="fas fa-clock me-2 text-primary"></i>Estimation du voyage
                                    </label>
                                    <input type="time" name="estimation" id="harriver" 
                                           class="form-control form-control-lg shadow-sm"
                                           value="{{ old('estimation') }}">
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Durée estimée du trajet
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="titre" class="form-label fw-semibold">
                                        <i class="fas fa-heading me-2 text-primary"></i>Titre du trajet
                                    </label>
                                    <textarea name="titre" id="titre" class="form-control shadow-sm" rows="3" 
                                              placeholder="Ex: Trajet Dakar - Thiès express">{{ old('titre') }}</textarea>
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Donnez un titre descriptif à votre trajet
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Arrêts -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <label class="form-label fw-semibold mb-0">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>Arrêts (gares)
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
                        {{ $gare->nom_gare }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 d-flex align-items-center gap-2">
            <button type="button" class="btn btn-outline-info btn-detail-gare">
                <i class="fas fa-info-circle me-1"></i>Détails
            </button>
            <button type="button" class="btn btn-outline-danger btn-remove-gare">
                <i class="fas fa-trash me-1"></i>Supprimer
            </button>
        </div>
    </div>
</div>


                                <button type="button" class="btn btn-success d-inline-flex align-items-center mt-2" id="add-gare">
                                    <i class="fas fa-plus-circle me-2"></i>
                                    Ajouter une gare
                                </button>
                            </div>

                            <div class="text-end mt-4 pt-3 border-top">
                                {{-- <button type="reset" class="btn btn-outline-secondary me-2">
                                    <i class="fas fa-undo me-2"></i>Réinitialiser
                                </button> --}}
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save me-2"></i>Enregistrer l'itinéraire
                                </button>
                            </div>
                        </form>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- ✅ Modal Détails Gare -->
    <div class="modal fade" id="gareDetailModal" tabindex="-1" aria-labelledby="gareDetailLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
          {{-- <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="gareDetailLabel">
             Détails de la gare
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
          </div> --}}
          <div class="modal-body">
            <div id="gare-details-content">
              <div class="text-center py-3 text-muted">Chargement des détails...</div>
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
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
                    <button type="button" class="btn btn-outline-danger btn-remove-gare">
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
                            <option value="{{ $gare->id }}">{{ $gare->nom_gare }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-outline-info btn-detail-gare">
                        <i class="fas fa-info-circle me-1"></i>Détails
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-remove-gare">
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
    //         modalBody.innerHTML = `<div class="text-center py-3 text-muted">Chargement...</div>`;

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
                <div class="spinner-border text-primary mb-3" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Chargement...</span>
                </div>
                <h5 class="text-primary">Chargement des détails</h5>
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
                            <div class="gare-header bg-primary text-white rounded-top p-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="fw-bold mb-1">
                                            <i class="fas fa-train me-2"></i>${data.nom_gare}
                                        </h3>
                                        <p class="mb-0 opacity-75">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            ${data.ville?.nom_ville || 'Non spécifiée'}
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row g-4">
                                <!-- Informations générales -->
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary mb-3">
                                                <i class="fas fa-info-circle me-2"></i>Informations générales
                                            </h5>
                                            <div class="row g-3">
                                               
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-start">
                                                        <i class="fas fa-city text-muted mt-1 me-3"></i>
                                                        <div>
                                                            <small class="text-muted d-block">Ville</small>
                                                            <strong>${data.ville?.nom_ville || 'Non spécifiée'}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-start">
                                                        <i class="fas fa-phone text-muted mt-1 me-3"></i>
                                                        <div>
                                                            <small class="text-muted d-block">Téléphone</small>
                                                            <strong>${data.telephone_gare || data.telephone || 'Non disponible'}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Services -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary mb-3">
                                                <i class="fas fa-concierge-bell me-2"></i>Services
                                            </h5>
                                            <div class="services-list">
                                                <div class="service-item ${data.wifi_disponible ? 'available' : 'unavailable'}">
                                                    <i class="fas fa-wifi me-2"></i>
                                                    <span>Wi-Fi</span>
                                                    <span class="status-indicator ${data.wifi_disponible ? 'available' : 'unavailable'}"></span>
                                                </div>
                                                <div class="service-item ${data.parking_disponible ? 'available' : 'unavailable'}">
                                                    <i class="fas fa-parking me-2"></i>
                                                    <span>Parking</span>
                                                    <span class="status-indicator ${data.parking_disponible ? 'available' : 'unavailable'}"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Horaires d'ouverture -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary mb-3">
                                                <i class="fas fa-clock me-2"></i>Horaires d'ouverture
                                            </h5>
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="time-slot bg-success bg-opacity-10 p-3 rounded text-center mb-2">
                                                        <small class="text-muted d-block">Ouverture</small>
                                                        <strong class="text-success fs-5">${data.heure_ouverture || '--:--'}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="time-slot bg-danger bg-opacity-10 p-3 rounded text-center">
                                                        <small class="text-muted d-block">Fermeture</small>
                                                        <strong class="text-danger fs-5">${data.heure_fermeture || '--:--'}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                              

                                <!-- Localisation sur la carte -->
                                ${data.latitude && data.longitude ? `
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary mb-3">
                                                    <i class="fas fa-map me-2"></i>Localisation sur la carte
                                                </h5>
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
    }
    
    .gare-header {
        margin: -1rem -1rem 2rem -1rem;
    }
    
    .service-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .service-item:last-child {
        border-bottom: none;
    }
    
    .status-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
    
    .status-indicator.available {
        background-color: #28a745;
    }
    
    .status-indicator.unavailable {
        background-color: #dc3545;
    }
    
    .time-slot {
        border: 1px solid #e0e0e0;
    }
    
    .gare-map {
        height: 300px;
        border: 1px solid #e0e0e0;
    }
    
    .card {
        border-radius: 10px;
    }
</style>
`;

document.head.insertAdjacentHTML('beforeend', additionalStyles);

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