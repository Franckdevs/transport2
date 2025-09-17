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
                <a href="{{ route('liste_reservation') }}" class="btn btn-light" title="Retour">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </div>

        <h4 class="mb-4">📌 Détails de la réservation</h4>

        <div class="row g-4">
          <!-- Infos Utilisateur -->
          <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
              <div class="card-header bg-primary text-white fw-bold">
                👤 Informations de l’utilisateur
              </div>
              <div class="card-body">
                <p><strong>Nom :</strong> {{ $detail_reservation->utilisateur->nom ?? 'N/A' }}</p>
                <p><strong>Prénom :</strong> {{ $detail_reservation->utilisateur->prenom ?? 'N/A' }}</p>
                <p><strong>Email :</strong> {{ $detail_reservation->utilisateur->email ?? 'N/A' }}</p>
                <p><strong>Téléphone :</strong> {{ $detail_reservation->utilisateur->telephone ?? 'N/A' }}</p>
                <p><strong>Status :</strong> 
                  @if(($detail_reservation->utilisateur->status ?? 0) == 1)
                    <span class="badge bg-success">Actif</span>
                  @else
                    <span class="badge bg-danger">Inactif</span>
                  @endif
                </p>
              </div>
            </div>
          </div>

          <!-- Infos Réservation -->
          <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
              <div class="card-header bg-warning fw-bold">
                🎟️ Informations de la réservation
              </div>
              <div class="card-body">
                <p><strong>Numéro de place :</strong> {{ $detail_reservation->numero_place }} (reserver)</p>
                <p><strong>Statut :</strong>
                  @if($detail_reservation->status == 1)
                    <span class="badge bg-success">Confirmée</span>
                  @elseif($detail_reservation->status == 2)
                    <span class="badge bg-warning text-dark">En attente</span>
                  @else
                    <span class="badge bg-danger">Annulée</span>
                  @endif
                </p>
              </div>
            </div>
          </div>

          <!-- Infos Voyage -->
          <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
              <div class="card-header bg-info text-white fw-bold">
                🚌 Informations du voyage
              </div>
              <div class="card-body row g-3">
                <div class="col-md-4">
                  <p><strong>Itinéraire :</strong> {{ $detail_reservation->voyage->itineraire->titre ?? 'Non défini' }}</p>
                </div>
                <div class="col-md-4">
                  <p><strong>Date départ :</strong> {{ $detail_reservation->voyage->date_depart ?? 'N/A' }}</p>
                </div>
                <div class="col-md-4">
                  <p><strong>Heure départ :</strong> {{ $detail_reservation->voyage->heure_depart ?? 'N/A' }}</p>
                </div>

                <div class="col-md-4">
                  <p><strong>Montant :</strong> {{ $detail_reservation->voyage->montant ?? 'N/A' }} FCFA</p>
                </div>
                <div class="col-md-4">
                  <p><strong>Bus :</strong> {{ $detail_reservation->voyage->bus->nom_bus ?? 'N/A' }}</p>
                </div>
                <div class="col-md-4">
                  <p><strong>Chauffeur :</strong> {{ $detail_reservation->voyage->chauffeur->nom ?? 'N/A' }}</p>
                </div>


                <hr>

                   <div class="col-md-4">
                  <p><strong>Nom de la compagnie :</strong> {{ $detail_reservation->voyage->compagnie->nom_complet_compagnies ?? 'N/A' }}</p>
                </div>


                                <div class="col-md-4">
                  <p><strong>Ville de la compagnie :</strong> {{ $detail_reservation->voyage->compagnie->ville->nom_ville ?? 'N/A' }}</p>
                </div>


                                <div class="col-md-4">
                  <p><strong>Email compagnies :</strong> {{ $detail_reservation->voyage->compagnie->email_compagnies ?? 'N/A' }}</p>
                </div>

                                <div class="col-md-4">
                  <p><strong>Telephone compagnies :</strong> {{ $detail_reservation->voyage->compagnie->telephone_compagnies ?? 'N/A' }}</p>
                </div>

                                   <div class="col-md-4">
                  <p><strong>Adresse compagnies :</strong> {{ $detail_reservation->voyage->compagnie->adresse_compagnies ?? 'N/A' }}</p>
                </div>

                                      <div class="col-md-4">
                  <p><strong>Description compagnies :</strong> {{ $detail_reservation->voyage->compagnie->description_compagnies ?? 'N/A' }}</p>
                </div>

                                       <div class="col-md-4">
                  <p><strong>Adresse :</strong> {{ $detail_reservation->voyage->compagnie->adresse ?? 'N/A' }}</p>
                </div>

                



              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    @include('compagnie.all_element.footer')
  </div>

  <script src="../assets/js/theme.js"></script>
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
</body>
</html>
