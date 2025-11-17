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
        <div class="container py-5">
          <h2 class="text-center mb-4">Détails de la configuration : {{ $configuration->nom }}</h2>

          <div class="card shadow-sm p-4 mb-4">
            <div class="mb-3">
              <a href="{{ route('listeconfig.index') }}" class="btn btn-outline-secondary">
                <i class="fa fa-arrow-left me-2"></i>Retour à la liste
              </a>
            </div>
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

          <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
              <span class="badge bg-success">Disponible</span>
              <span class="badge bg-danger ms-2">Indisponible</span>
              <span class="badge bg-warning ms-2">Chauffeur</span>
            </div>
            <small class="text-muted">Chaque siège peut être activé/désactivé et son nom modifié</small>
          </div>

          <!-- Sièges -->
          <div class="card shadow-sm p-4">
            <h5 class="mb-3">Disposition des sièges ({{ $configuration->placeconfigbussave->count() }} sièges)</h5>
            <div id="seatsContainer" class="mb-4"></div>
          </div>
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
        driverSeat.classList.add('seat-item', 'chauffeur', 'active');
        driverSeat.innerHTML = `
          <div class="seat-id">CHAUFFEUR</div>
          <div class="seat-num">#0</div>
          <i class="fa-solid fa-user-seat seat-icon"></i>
          <span class="badge mt-1 bg-warning">Chauffeur</span>
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
    body { background: #f5f7fb; }
    .seat-item {
      width: 100px;
      height: 100px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background: white;
      border: 2px solid #dee2e6;
      border-radius: 10px;
      padding: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      text-align: center;
      margin: 5px;
    }
    .seat-item.active { border-color: #28a745; }
    .seat-item.inactive { border-color: #dc3545; opacity: 0.6; }
    .seat-item.chauffeur {
      background-color: #fff3cd;
      border-color: #ffc107;
    }
    .seat-item.proche-chauffeur {
      background-color: #d1ecf1;
      border-color: #0dcaf0;
    }
    .seat-id { font-weight: bold; font-size: 1rem; }
    .seat-num { font-size: 0.8rem; color: #6c757d; }
    .seats-row {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
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
    .seat-icon { font-size: 1.2rem; margin-top: 5px; color: #007bff; }
    .form-control-plaintext {
      min-height: auto;
      padding: 0;
    }
  </style>
</body>
</html>
