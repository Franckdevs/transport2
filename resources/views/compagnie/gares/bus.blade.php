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
        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-xl-3 g-2 mb-3">


<!-- Bouton pour ouvrir la modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ajoutBusModal">
    <i class="fa fa-bus"></i> Ajouter un Bus
</button>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="ajoutBusModal" tabindex="-1" aria-labelledby="ajoutBusLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="ajoutBusLabel">
          <i class="fa fa-bus"></i> Enregistrer un Bus (Disposition personnalisée)
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="#" method="POST" id="busForm">
        @csrf
        <div class="modal-body">

          <div class="mb-3">
            <label for="numero_bus" class="form-label">Numéro du Bus</label>
            <input type="text" class="form-control" id="numero_bus" name="numero_bus" required>
          </div>

          <div class="mb-3">
            <label for="marque" class="form-label">Marque</label>
            <input type="text" class="form-control" id="marque" name="marque" required>
          </div>

          <div class="mb-3">
            <label for="disposition" class="form-label">Disposition des sièges par rangée</label>
            <select id="disposition" class="form-select" aria-label="Choisir disposition sièges">
              <option value="3-3" selected>3 sièges à gauche - 3 sièges à droite</option>
              <option value="3-1">3 sièges à gauche - 1 siège à droite</option>
              <option value="2-2">2 sièges à gauche - 2 sièges à droite</option>
              <option value="2-1">2 sièges à gauche - 1 siège à droite</option>
              <option value="1-1">1 siège à gauche - 1 siège à droite</option>
              <option value="1-0">1 siège à gauche - 0 siège à droite</option>
              <option value="0-1">0 siège à gauche - 1 siège à droite</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Disposition des sièges (cliquez pour sélectionner)</label>

            <div class="d-flex justify-content-center mb-2 gap-2">
              <button type="button" id="btnAddRow" class="btn btn-sm btn-primary" title="Ajouter une rangée">
                <i class="fa fa-plus"></i> Ajouter une rangée
              </button>
              <button type="button" id="btnRemoveRow" class="btn btn-sm btn-danger" title="Supprimer une rangée">
                <i class="fa fa-minus"></i> Supprimer une rangée
              </button>
            </div>

            <div id="seat-map" style="
              display: grid;
              grid-template-columns: repeat(7, 50px);
              grid-gap: 8px;
              justify-content: center;
              background: #f0f0f0;
              padding: 10px;
              border-radius: 8px;
              user-select: none;
              max-width: 400px;
              margin: auto;
            ">
              <!-- Sièges + couloir (vide) générés par JS -->
            </div>

            <p class="mt-3 text-center">Nombre de sièges sélectionnés : <strong id="seat-count">0</strong></p>
            <input type="hidden" name="capacite" id="capacite" value="0">
            <input type="hidden" id="nombre_lignes" value="1">
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fa fa-times"></i> Annuler
          </button>
          <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Enregistrer
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

<style>
  .seat {
    width: 48px;
    height: 48px;
    background-color: #ddd;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #333;
    box-shadow: 0 0 3px #aaa;
    transition: background-color 0.3s, color 0.3s;
    user-select: none;
  }
  .seat.selected {
    background-color: #28a745;
    color: white;
  }
  .seat:hover {
    background-color: #a6e1a6;
  }
  .seat.empty {
    background: transparent;
    cursor: default;
    box-shadow: none;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const seatMap = document.getElementById("seat-map");
    const seatCount = document.getElementById("seat-count");
    const capaciteInput = document.getElementById("capacite");
    const nombreLignesInput = document.getElementById("nombre_lignes");
    const dispositionSelect = document.getElementById("disposition");

    let rows = parseInt(nombreLignesInput.value); // = 1
    let disposition = dispositionSelect.value;

    function parseDisposition(str) {
      const parts = str.split("-");
      return [parseInt(parts[0]), parseInt(parts[1])];
    }

    function buildSeats(rows, dispositionStr) {
      seatMap.innerHTML = '';
      const [leftSeats, rightSeats] = parseDisposition(dispositionStr);
      const totalCols = leftSeats + 1 + rightSeats;

      seatMap.style.gridTemplateColumns = `repeat(${totalCols}, 50px)`;

      let seatNumber = 1;
      for(let r = 0; r < rows; r++) {
        for(let i = 0; i < leftSeats; i++) createSeat(seatNumber++);
        createEmpty();
        for(let i = 0; i < rightSeats; i++) createSeat(seatNumber++);
      }

      function createSeat(num) {
        const seat = document.createElement('div');
        seat.classList.add('seat');
        seat.textContent = num;
        seat.addEventListener('click', () => {
          seat.classList.toggle('selected');
          updateCount();
        });
        seatMap.appendChild(seat);
      }

      function createEmpty() {
        const empty = document.createElement('div');
        empty.classList.add('seat', 'empty');
        seatMap.appendChild(empty);
      }

      updateCount();
    }

    function updateCount() {
      const selectedSeats = document.querySelectorAll('.seat.selected').length;
      seatCount.textContent = selectedSeats;
      capaciteInput.value = selectedSeats;
    }

    document.getElementById("btnAddRow").addEventListener('click', () => {
      if (rows < 25) {
        rows++;
        nombreLignesInput.value = rows;
        buildSeats(rows, disposition);
      }
    });

    document.getElementById("btnRemoveRow").addEventListener('click', () => {
      if (rows > 1) {
        rows--;
        nombreLignesInput.value = rows;
        buildSeats(rows, disposition);
      }
    });

    dispositionSelect.addEventListener('change', () => {
      disposition = dispositionSelect.value;
      buildSeats(rows, disposition);
    });

    buildSeats(rows, disposition);
  });
</script>




        </div> <!-- .row end -->



      </div>
    </div>
    <!-- start: page footer -->

    @include('compagnie.all_element.footer')
  </div>

    <!-- Jquery Page Js -->
  <script src="../assets/js/theme.js"></script>
  <!-- Plugin Js -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  <!-- Vendor Script -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

</body>

</html>
