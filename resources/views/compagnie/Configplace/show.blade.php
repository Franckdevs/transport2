@include('compagnie.all_element.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
        <!-- En-tête avec bouton à droite -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          {{-- <h1 class="page-title mb-0">
            <i class="fas fa-cog me-2"></i>Détails de la configuration : {{ $configuration->nom }}
          </h1> --}}
          <div class="ms-auto">
            <a href="{{ route('listeconfig.index') }}" class="btn btn-light">
              <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
          </div>
        </div>

        <div class="container py-3">
          <div class="card shadow-sm mb-4">
            {{-- <div class="card-header bg-light d-flex justify-content-between align-items-center">
              <h5 class="mb-0">
                <i class="fas fa-info-circle me-2"></i>Détails de la configuration
              </h5>
            </div> --}}
            <div class="card-body p-4">
            <div class="row g-3">
              <div class="col-md-3">
                <label class="form-label fw-bold">Nombre de colonnes</label>
                <p class="form-control-plaintext border-bottom pb-2">{{ $configuration->colonne }}</p>
              </div>
              <div class="col-md-3">
                <label class="form-label fw-bold">Nombre de rangées</label>
                <p class="form-control-plaintext border-bottom pb-2">{{ $configuration->ranger }}</p>
              </div>
              <div class="col-md-3">
                <label class="form-label fw-bold">Total des sièges</label>
                <p class="form-control-plaintext border-bottom pb-2">{{ $configuration->placeconfigbussave->count() }}</p>
              </div>
            </div>

            <div class="row g-3 mt-2">
              <div class="col-md-6">
                <label class="form-label fw-bold">Nom de la configuration</label>
                <p class="form-control-plaintext border-bottom pb-2">{{ $configuration->nom }}</p>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">Description</label>
                <p class="form-control-plaintext border-bottom pb-2">{{ $configuration->description }}</p>
              </div>
            </div>
          </div>

          <!-- Ligne avec légende, statut et bouton -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Légende -->
            <div>
              <span class="badge bg-success">Disponible</span>
              <span class="badge bg-danger ms-2">Indisponible</span>
              <span class="badge bg-warning ms-2">Chauffeur</span>
            </div>
            
            <!-- Statut de la configuration -->
            <div class="text-center">
              @if($configuration->status == 1)
                <span class="badge bg-success">
                  <i class="fas fa-check-circle me-1"></i> Configuration Active
                </span>
              @elseif($configuration->status == 3)
                <span class="badge bg-danger">
                  <i class="fas fa-times-circle me-1"></i> Configuration Inactive
                </span>
              @else
                <span class="badge bg-secondary">
                  <i class="fas fa-question-circle me-1"></i> Statut Inconnu
                </span>
              @endif
            </div>
            
            <!-- Bouton d'action -->
            <div class="d-flex align-items-center">
              <a href="{{ route('config.edit', $configuration->id) }}" class="btn btn-sm btn-warning btn-action me-2">
                <i class="fa fa-edit"></i> Modifier
              </a>
              @if($configurationUtilisee == false)
                @if($configuration->status == 1)
                  <form id="deactivateForm-{{ $configuration->id }}" action="{{ route('config.desactivation', $configuration->id) }}" method="POST" class="d-inline">
                      @csrf
                      <button type="button" class="btn btn-sm btn-danger btn-action" onclick="confirmDeactivation({{ $configuration->id }})">
                          <i class="fas fa-ban"></i> Bloquer
                      </button>
                  </form>
                @else
                  <form id="activateForm-{{ $configuration->id }}" action="{{ route('config.activation', $configuration->id) }}" method="POST" class="d-inline">
                      @csrf
                      <button type="button" class="btn btn-sm btn-success btn-action" onclick="confirmActivation({{ $configuration->id }})">
                          <i class="fa fa-check"></i> Débloquer
                      </button>
                  </form>
                @endif
              @else
                <span class="badge bg-warning">
                  <i class="fas fa-exclamation-triangle me-1"></i> Configuration est déjà utilisée vous ne pouvez pas la modifier
                </span>
              @endif
            </div>
          </div>
              </span>

               <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://cdn.datatables.net/responsive/3.0.7/js/dataTables.responsive.js"></script>
    <script src='https://cdn.datatables.net/responsive/3.0.7/js/dataTables.responsive.js'></script>

    <script>
 

        // Fonction pour soumettre le formulaire en AJAX
        function submitForm(formId) {
            const form = document.getElementById(formId);
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Recharger la page pour voir les changements
                    window.location.reload();
                } else {
                    Swal.fire('Erreur', data.message || 'Une erreur est survenue', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Erreur', 'Une erreur est survenue lors de la mise à jour', 'error');
            });
        }

        // Fonction de confirmation de désactivation
        function confirmDeactivation(configId) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: 'Voulez-vous vraiment bloquer cette configuration ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, bloquer',
                cancelButtonText: 'Annuler',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm('deactivateForm-' + configId);
                }
            });
            return false;
        }

        // Fonction de confirmation d'activation
        function confirmActivation(configId) {
            Swal.fire({
                title: 'Confirmer l\'activation',
                text: 'Voulez-vous  débloquer cette configuration ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, débloquer',
                cancelButtonText: 'Annuler',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm('activateForm-' + configId);
                }
            });
            return false;
        }
    </script>

            </div>
            <small class="text-muted">Les sièges sont affichés dans l'ordre de leur configuration</small>
          </div>

        

          <!-- Sièges -->
          <div class="card shadow-sm mt-4">
            <div class="card-header bg-light">
              <h5 class="mb-0">
                <i class="fas fa-chair me-2"></i>Disposition des sièges ({{ $configuration->placeconfigbussave->count() }} sièges)
              </h5>
            </div>
            <div class="card-body">
              <div id="seatsContainer" class="mb-4"></div>
            </div>
          </div>
            </div> <!-- Fin du card-body -->
          </div> <!-- Fin de la carte principale -->
        </div>
      </div>
    </div>

    @include('compagnie.all_element.footer')
  </div>

  <!-- Scripts -->
  <script src="../assets/js/theme.js"></script>
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const container = document.getElementById('seatsContainer');
      const seats = @json($configuration->placeconfigbussave);
      const colonnes = {{ $configuration->colonne }};
      const rangees = {{ $configuration->ranger }};

      function renderSeats() {
        container.innerHTML = '';

        // Séparer les sièges proche_chauffeur et client
        const procheChauffeurSeats = seats.filter(seat => seat.type === 'proche_chauffeur');
        const clientSeats = seats.filter(seat => seat.type === 'client');

        // Ligne du chauffeur et proche chauffeur
        const driverRow = document.createElement('div');
        driverRow.classList.add('seats-row', 'driver-row');

        // Ajouter le siège chauffeur
        const driverSeat = document.createElement('div');
        const isDriverActive = @json($configuration->chauffeur_disponible ?? true);
        driverSeat.classList.add('seat-item', 'chauffeur', isDriverActive ? 'active' : 'inactive');
        driverSeat.innerHTML = `
          <div class="seat-id">Chauffeur</div>
          <div class="seat-num">#0</div>
          <i class="fa-solid fa-user-seat seat-icon"></i>
          <span class="badge bg-warning mt-1">Chauffeur</span>
        `;
        driverRow.appendChild(driverSeat);

        // Ajouter les sièges proche_chauffeur sur la même ligne
        procheChauffeurSeats.forEach(seat => {
          const seatDiv = document.createElement('div');
          seatDiv.classList.add('seat-item', 'proche-chauffeur', seat.disponible ? 'active' : 'inactive');
          seatDiv.innerHTML = `
            <div class="seat-id">${seat.nom}</div>
            <div class="seat-num">#${seat.numero}</div>
            <i class="fa-solid fa-user seat-icon"></i>
            <span class="badge mt-1 bg-info">Proche Chauffeur</span>
          `;
          driverRow.appendChild(seatDiv);
        });

        container.appendChild(driverRow);

        // Container pour les sièges clients
        const clientGrid = document.createElement('div');
        clientGrid.classList.add('seats-grid', 'client-grid');
        container.appendChild(clientGrid);

        let clientIndex = 0;

        // Générer les sièges clients selon la configuration
        for (let rang = 1; rang <= rangees; rang++) {
          const rowDiv = document.createElement('div');
          rowDiv.classList.add('seats-row', 'client-row');

          for (let col = 1; col <= colonnes; col++) {
            if (clientIndex < clientSeats.length) {
              const seat = clientSeats[clientIndex];
              const seatDiv = document.createElement('div');
              seatDiv.classList.add('seat-item', 'client', seat.disponible ? 'active' : 'inactive');

              seatDiv.innerHTML = `
                <div class="seat-id">${seat.nom}</div>
                <div class="seat-num">#${seat.numero}</div>
                <i class="fa-solid fa-user seat-icon"></i>
                <span class="badge mt-1 ${seat.disponible ? 'bg-success' : 'bg-danger'}">Client</span>
              `;
              rowDiv.appendChild(seatDiv);
              clientIndex++;
            }
          }
          clientGrid.appendChild(rowDiv);
        }
      }

      renderSeats();
    });
  </script>

  <style>
    body { background: #f8f9fa; }
    .btn-action {
        min-width: 120px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }
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
        margin: 5px;
    }
    .seat-item.active { 
        border-color: #28a745; 
        box-shadow: 0 4px 10px rgba(40,167,69,0.15); 
    }
    .seat-item.inactive { 
        border-color: #dc3545 !important; 
        box-shadow: 0 4px 10px rgba(220,53,69,0.15);
        opacity: 0.8;
    }
    .seat-item.chauffeur { 
        background: #ffc107; 
        border-color: #e0a800; 
    }
    .seat-item.chauffeur.inactive {
        background: #e0a800;
        border-color: #d39e00 !important;
        opacity: 0.7;
    }
    .seat-item.proche-chauffeur {
        background-color: #d1ecf1;
        border-color: #0dcaf0;
    }
    .seat-id { font-weight: bold; font-size: 1rem; }
    .seat-num { font-size: 0.8rem; color: #6c757d; }
    .seats-row { 
        display: flex; 
        justify-content: center; 
        gap: 10px; 
        flex-wrap: wrap; 
        margin-bottom: 12px; 
    }
    .driver-row {
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px dashed #dee2e6;
    }
    .client-row {
        margin-bottom: 15px;
    }
    .seats-grid {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .seat-icon { 
        font-size: 1.2rem; 
        margin-top: 5px; 
        color: #007bff; 
    }
    .form-control-plaintext {
      min-height: auto;
      padding: 0;
    }
  </style>
</body>
</html>
