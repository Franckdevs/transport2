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
        <!-- En-tête avec bouton à droite -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          {{-- <h1 class="page-title mb-0">
            <i class="fas fa-edit me-2"></i>Modifier la configuration
          </h1> --}}
          <div class="ms-auto">
            <a href="{{ route('listeconfig.index') }}" class="btn btn-light">
              <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
          </div>
        </div>

        <div class="container py-3">
          <div class="card shadow-sm">
            {{-- <div class="card-header bg-light">
              <h5 class="mb-0">
                <i class="fas fa-edit me-2"></i>Modifier la configuration
              </h5>
            </div> --}}
            <div class="card-body p-4">
            <form id="configBusForm" method="POST" action="{{ route('config.update', $configuration->id) }}" novalidate>
              @csrf
              @method('PUT')
              <div class="row g-3">
                <!-- Première ligne : Configuration de base -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nom" class="form-label fw-bold">Nom de la configuration <span class="text-danger">*</span></label>
                        <input type="text" name="nom" id="nom" class="form-control form-control-lg" 
                               value="{{ old('nom', $configuration->nom) }}" required
                               placeholder="Ex: Bus VIP 40 places"
                               aria-describedby="nomHelp">
                        <small id="nomHelp" class="form-text text-muted">Donnez un nom clair à cette configuration</small>
                        @error('nom')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="colonne" class="form-label fw-bold">Colonnes <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-columns"></i></span>
                            <input type="number" name="colonne" id="colonne" class="form-control" 
                                   min="1" max="7" value="{{ old('colonne', $configuration->colonne) }}" required
                                   oninput="validateColumnCount(this)"
                                   aria-label="Nombre de colonnes">
                        </div>
                        <small class="form-text text-muted">Max: 7 colonnes</small>
                        <div id="colonneError" class="invalid-feedback">
                            Le nombre de colonnes ne peut pas dépasser 7.
                        </div>
                        @error('colonne')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="ranger" class="form-label fw-bold">Rangées <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-bars"></i></span>
                            <input type="number" name="ranger" id="ranger" class="form-control" 
                                   min="1" max="100" value="{{ old('ranger', $configuration->ranger) }}" required
                                   oninput="validateRowCount(this)"
                                   aria-label="Nombre de rangées">
                        </div>
                        <small class="form-text text-muted">Max: 100 rangées</small>
                        <div id="rangerError" class="invalid-feedback">
                            Le nombre de rangées ne peut pas dépasser 100.
                        </div>
                        @error('ranger')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="leftSeats" class="form-label fw-bold">Places côté chauffeur <span class="text-danger">*</span></label>
                        <select id="leftSeats" class="form-select" name="places_cote_chauffeur" aria-describedby="seatsHelp">
                            <option value="1" {{ old('places_cote_chauffeur', $configuration->places_cote_chauffeur) == 1 ? 'selected' : '' }}>1 place</option>
                            <option value="2" {{ old('places_cote_chauffeur', $configuration->places_cote_chauffeur) == 2 ? 'selected' : '' }}>2 places</option>
                            <option value="3" {{ old('places_cote_chauffeur', $configuration->places_cote_chauffeur) == 3 ? 'selected' : '' }}>3 places</option>
                        </select>
                        <small id="seatsHelp" class="form-text text-muted">Nombre de places côté conducteur</small>
                        @error('places_cote_chauffeur')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


            </div>

            <!-- Deuxième ligne : Description -->
            <div class="row g-3 mt-3">
            <div class="col-12">
                <div class="form-group">
                    <label for="description" class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" class="form-control" 
                              rows="2" placeholder="Décrivez cette configuration de bus..."
                              aria-describedby="descHelp">{{ old('description', $configuration->description) }}</textarea>
                    <small id="descHelp" class="form-text text-muted">Détails sur la disposition des sièges</small>
                    @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
           </div>

            <!-- Champ caché -->
            <input type="hidden" name="info_user_id" id="info_user_id" value="{{ auth()->user()->info_user->id }}" required>

            <div class="text-center my-3">

                <button type="button" id="generateSeats" class="btn btn-primary me-2">
                    <i class="fa fa-magic"></i> Générer les sièges
                </button>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
    const generateBtn = document.getElementById('generateSeats');
    if (generateBtn) {
        // Déclenche le clic sur le bouton après un court délai
        setTimeout(() => {
            generateBtn.click();

            // Met à jour l'apparence du bouton sans le désactiver
            generateBtn.innerHTML = '<i class="fa fa-sync-alt me-2"></i> Régénérer les sièges';
            generateBtn.classList.remove('btn-primary');
            generateBtn.classList.add('btn-info');
        }, 500);
    }
});
</script>


                <button type="button" id="resetSeats" class="btn btn-outline-danger" onclick="confirmReset()">
                    <i class="fa fa-eraser"></i> Réinitialiser
                </button>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <span class="badge bg-success">Disponible</span>
                    <span class="badge bg-danger ms-2">Indisponible</span>
                    <span class="badge bg-warning ms-2">Chauffeur</span>
                </div>
                <small class="text-muted">Chaque siège peut être activé/désactivé et son nom modifié</small>
            </div>

            <div id="seatsContainer" class="mb-4"></div>

            <input type="hidden" name="sieges" id="siegesInput">

            <div class="text-center">
                <button type="submit" id="submitBtn" class="btn btn-warning btn-lg">
                    <span class="d-flex align-items-center justify-content-center">
                        <span id="submitText">
                            <i class="fa fa-save me-2"></i> Enregistrer la configuration
                        </span>
                        <span id="submitSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                    </span>
                </button>
            </div>
        </form>

        <!-- Modal d'erreur -->
<!-- Modal d'erreur remplacé par SweetAlert2 -->


    </div>
</div>



      </div>
    </div>
    <!-- start: page footer -->

    @include('compagnie.all_element.footer')
  </div>

    <!-- Jquery Page Js -->
  <script src="../assets/js/theme.js"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Plugin Js -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  <!-- Vendor Script -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Fonctions de validation
function validateColumnCount(input) {
    const maxColumns = 7;
    const errorElement = document.getElementById('colonneError');
    
    if (parseInt(input.value) > maxColumns) {
        input.classList.add('is-invalid');
        errorElement.style.display = 'block';
        input.value = maxColumns; // Réinitialiser à la valeur maximale
    } else {
        input.classList.remove('is-invalid');
        errorElement.style.display = 'none';
    }
}
    
function validateRowCount(input) {
    const maxRows = 100;
    const errorElement = document.getElementById('rangerError');
    
    if (parseInt(input.value) > maxRows) {
        input.classList.add('is-invalid');
        errorElement.style.display = 'block';
        input.value = maxRows; // Réinitialiser à la valeur maximale
    } else {
        input.classList.remove('is-invalid');
        errorElement.style.display = 'none';
    }
}

    // Désactive le double-clic sur le formulaire
document.addEventListener('DOMContentLoaded', () => {
    // Gestion de la soumission du formulaire
    const form = document.getElementById('configBusForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');
    const generateBtn = document.getElementById('generateSeats');
    const resetBtn = document.getElementById('resetSeats');
    const container = document.getElementById('seatsContainer');
    const siegesInput = document.getElementById('siegesInput');
    const leftSeatsSelect = document.getElementById('leftSeats');
    let sieges = {};

    if (form) {
        form.addEventListener('submit', function(e) {
            // Désactive le bouton et affiche le spinner
            if (submitBtn && submitText && submitSpinner) {
                submitBtn.disabled = true;
                submitText.textContent = 'Enregistrement en cours...';
                submitSpinner.classList.remove('d-none');
            }
        });
    }

    function save() {
        siegesInput.value = JSON.stringify(sieges);
    }

    // Fonction de confirmation de réinitialisation
    function confirmReset() {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: 'Voulez-vous vraiment réinitialiser la configuration des sièges ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, réinitialiser',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Réinitialiser les champs
                document.getElementById('colonne').value = '4';
                document.getElementById('ranger').value = '10';
                document.getElementById('leftSeats').value = '1';
                document.getElementById('nom').value = '';
                document.getElementById('description').value = '';

                // Vider le conteneur des sièges
                container.innerHTML = '';
                sieges = {};
                save();

                Swal.fire(
                    'Réinitialisation réussie !',
                    'La configuration a été réinitialisée avec succès.',
                    'success'
                );
            }
        });
    }

    function renderSeats(col, row) {
        container.innerHTML = '';
        sieges = {};
        let numero = 1;

        // PLACE DU CHAUFFEUR
       // PLACE DU CHAUFFEUR
const rowDiv = document.createElement('div');
rowDiv.classList.add('seats-row');

const chauffeurDiv = document.createElement('div');
chauffeurDiv.classList.add('seat-item', 'chauffeur', 'active');
chauffeurDiv.innerHTML = `
    <div class="seat-id">Chauffeur</div>
    <div class="seat-num">#0</div>
    <i class="fa-solid fa-user seat-icon"></i>
    <span class="badge bg-warning mt-1">Chauffeur</span>
`;
rowDiv.appendChild(chauffeurDiv);

// Places à gauche du chauffeur (Proche Chauffeur)
const leftSeats = parseInt(leftSeatsSelect.value);
for (let i = 1; i <= leftSeats; i++) {
    const seatId = `A${numero}`;
    sieges[seatId] = { numero: numero, disponible: true, nom: seatId, type: 'proche_chauffeur' };

    const seatDiv = document.createElement('div');
    seatDiv.classList.add('seat-item', 'active');
    seatDiv.innerHTML = `
        <div class="seat-id">${seatId}</div>
        <div class="seat-num">#${numero}</div>
        <i class="fa-solid fa-user seat-icon"></i>
        <input type="text" class="form-control form-control-sm seat-name mt-1" value="${seatId}" placeholder="Nom">
        <div class="error-text">Veuillez renseigner un nom</div>
        <label class="switch mt-2">
            <input type="checkbox" checked data-id="${seatId}">
            <span class="slider"></span>
        </label>
        <span class="badge bg-info mt-1">Proche Chauffeur</span>
    `;
    addSeatListeners(seatDiv, seatId);
    rowDiv.appendChild(seatDiv);
    numero++;
}

container.appendChild(rowDiv);

// Reste des sièges (Client)
for (let r = 1; r <= row; r++) {
    const rowDiv = document.createElement('div');
    rowDiv.classList.add('seats-row');
    for (let c = 1; c <= col; c++) {
        const seatId = `A${numero}`;
        sieges[seatId] = { numero: numero, disponible: true, nom: seatId, type: 'client' };

        const seatDiv = document.createElement('div');
        seatDiv.classList.add('seat-item', 'active');
        seatDiv.innerHTML = `
            <div class="seat-id">${seatId}</div>
            <div class="seat-num">#${numero}</div>
            <i class="fa-solid fa-user seat-icon"></i>
            <input type="text" class="form-control form-control-sm seat-name mt-1" value="${seatId}" placeholder="Nom">
            <div class="error-text">Veuillez renseigner un nom</div>
            <label class="switch mt-2">
                <input type="checkbox" checked data-id="${seatId}">
                <span class="slider"></span>
            </label>
            <span class="badge bg-secondary mt-1">Client</span>
        `;
        addSeatListeners(seatDiv, seatId);
        rowDiv.appendChild(seatDiv);
        numero++;
    }
    container.appendChild(rowDiv);
}

        save();
    }

    function addSeatListeners(seatDiv, seatId) {
        const checkbox = seatDiv.querySelector('input[type="checkbox"]');
        const nameInput = seatDiv.querySelector('input.seat-name');
        const seatHeader = seatDiv.querySelector('.seat-id');
        const errorText = seatDiv.querySelector('.error-text');

        checkbox.addEventListener('change', function() {
            sieges[seatId].disponible = this.checked;
            seatDiv.classList.toggle('active', this.checked);
            seatDiv.classList.toggle('inactive', !this.checked);
            save();
        });

        nameInput.addEventListener('input', function() {
            sieges[seatId].nom = this.value;
            seatHeader.textContent = this.value;
            if (this.value.trim() === '') {
                seatDiv.classList.add('invalid');
                errorText.style.display = 'block';
            } else {
                seatDiv.classList.remove('invalid');
                errorText.style.display = 'none';
            }
            save();
        });
    }

generateBtn.addEventListener('click', () => {
    let colInput = document.getElementById('colonne');
    let rowInput = document.getElementById('ranger');
    let col = parseInt(colInput.value);
    let row = parseInt(rowInput.value);

    // Reset styles
    colInput.classList.remove('input-error');
    rowInput.classList.remove('input-error');

    let messages = [];

    if (col > 7) {
        colInput.classList.add('input-error');
        messages.push('Le nombre de colonnes ne peut pas dépasser 7.');
        col = 7;
        colInput.value = 7;
    }
    if (row > 100) {
        rowInput.classList.add('input-error');
        messages.push('Le nombre de rangées ne peut pas dépasser 100.');
        row = 100;
        rowInput.value = 100;
    }
    if (col < 1) {
        colInput.classList.add('input-error');
        messages.push('Le nombre de colonnes doit être au moins 1.');
        col = 1;
        colInput.value = 1;
    }
    if (row < 1) {
        rowInput.classList.add('input-error');
        messages.push('Le nombre de rangées doit être au moins 1.');
        row = 1;
        rowInput.value = 1;
    }

    if (messages.length > 0) {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: messages.join('<br>'),
            confirmButtonColor: '#d33',
            confirmButtonText: 'Fermer'
        });
        return;
    }

    renderSeats(col, row);
});

    // Gestion de la réinitialisation avec SweetAlert2
    resetBtn.addEventListener('click', () => {
        Swal.fire({
            title: 'Confirmer la réinitialisation',
            text: 'Voulez-vous vraiment réinitialiser la configuration ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, réinitialiser',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                container.innerHTML = '';
                sieges = {};
                save();
                Swal.fire(
                    'Réinitialisé !',
                    'La configuration a été réinitialisée avec succès.',
                    'success'
                );
            }
        });
    });

    form.addEventListener('submit', function(e) {
        let valid = true;
        const nameInputs = container.querySelectorAll('input.seat-name');
        nameInputs.forEach(input => {
            const seatDiv = input.closest('.seat-item');
            const errorText = seatDiv.querySelector('.error-text');
            if (input.value.trim() === '') {
                seatDiv.classList.add('invalid');
                errorText.style.display = 'block';
                valid = false;
            } else {
                seatDiv.classList.remove('invalid');
                errorText.style.display = 'none';
            }
        });
        if (!valid) {
            e.preventDefault();
            alert('Veuillez renseigner tous les noms de sièges.');
        }
    });
});

//  @if($errors->any())
//             Swal.fire({
//                 title: 'Erreur !',
//                 html: '{!! implode('<br>', $errors->all()) !!}',
//                 icon: 'error',
//                 confirmButtonText: 'OK'
//             });
//         @endif
</script>

<style>
  <style>
    body { background: #f5f7fb; }
    .seat-item {
        width: 90px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        user-select: none;
        background: white;
        border: 2px solid #dee2e6;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: all 0.2s ease;
    }
    .seat-item.active { border-color: #28a745; box-shadow: 0 4px 10px rgba(40,167,69,0.15); }
    .seat-item.inactive { border-color: #dc3545; box-shadow: 0 4px 10px rgba(220,53,69,0.15); }
    .seat-item.chauffeur { background: #ffd700; border-color: #ffc107; }
    .seat-id { font-weight: bold; font-size: 1rem; }
    .seat-num { font-size: 0.8rem; color: #6c757d; }
    .seat-item.invalid { border-color: #dc3545; }
    .switch { position: relative; display: inline-block; width: 40px; height: 20px; }
    .switch input { display: none; }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #dc3545;
        transition: .3s;
        border-radius: 34px;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 16px; width: 16px;
        left: 2px; bottom: 2px;
        background-color: white;
        transition: .3s;
        border-radius: 50%;
    }
    input:checked + .slider { background-color: #28a745; }
    input:checked + .slider:before { transform: translateX(20px); }
    .seats-row { display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; margin-bottom: 12px; }
    .seat-icon { font-size: 1.2rem; margin-top: 5px; color: #007bff; }
    .seat-name { font-size: 0.75rem; margin-top: 3px; text-align: center; width: 100%; }
    .error-text { color: #dc3545; font-size: 0.75rem; margin-top: 2px; display: none; }
    .input-error {
    border-color: #dc3545 !important;
    background-color: #f8d7da;
}

</style>

</body>

</html>



{{-- <!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Configuration du Bus</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"> --}}






