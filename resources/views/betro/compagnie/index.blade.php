@php
use App\Helpers\GlobalHelper;
$nombre = 20;
@endphp

@include('betro.all_element.header')

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<style>
    /* Style pour le bouton flottant */
    .floating-add-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }

    .floating-add-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.3);
    }
</style>

<body class="layout-1" data-luno="theme-black">
  <!-- start: sidebar -->
@include('betro.all_element.sidebar')
  <!-- start: body area -->
  <div class="wrapper">
    <!-- start: page header -->
   @include('betro.all_element.navbar')
    <!-- start: page toolbar -->
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      @include('betro.all_element.cadre')
    </div>
    <!-- start: page body -->
    <div class="page-body px-xl-2 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row g-3 row-deck">

           <!-- Filtre par date -->
          <form id="filterForm" class="row g-3 mb-2" method="GET" action="{{ route('compagnies') }}">
    <div class="col-md-3">
        <label for="start_date" class="form-label">Date début</label>
        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
    </div>
    <div class="col-md-3">
        <label for="end_date" class="form-label">Date fin</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
    </div>
    <div class="col-md-4 align-self-end">
        <button type="submit" id="filterButton" class="btn btn-primary mt-2">
            <span id="filterText">
                <i class="fa fa-filter"></i> Filtrer
            </span>
            <span id="filterSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        </button>
        <a href="{{ route('compagnies') }}" id="resetButton" class="btn btn-secondary mt-2">
            <span id="resetText">
                <i class="fa fa-refresh"></i> Réinitialiser
            </span>
            <span id="resetSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('filterForm');
            const filterButton = document.getElementById('filterButton');
            const filterText = document.getElementById('filterText');
            const filterSpinner = document.getElementById('filterSpinner');

            const resetButton = document.getElementById('resetButton');
            const resetText = document.getElementById('resetText');
            const resetSpinner = document.getElementById('resetSpinner');

            // Gestion du bouton Filtrer
            if (filterForm) {
                filterForm.addEventListener('submit', function() {
                    // Désactiver le bouton Filtrer
                    filterButton.disabled = true;
                    // Afficher le spinner et masquer le texte
                    filterText.classList.add('d-none');
                    filterSpinner.classList.remove('d-none');
                    // Empêcher les clics multiples
                    filterButton.classList.add('pe-none');
                });
            }

            // Gestion du bouton Réinitialiser
            if (resetButton) {
                resetButton.addEventListener('click', function(e) {
                    // Si le bouton est déjà en cours d'utilisation, ne rien faire
                    if (resetButton.classList.contains('pe-none')) {
                        e.preventDefault();
                        return false;
                    }

                    // Désactiver le bouton Réinitialiser
                    resetButton.classList.add('pe-none');
                    // Afficher le spinner et masquer le texte
                    resetText.classList.add('d-none');
                    resetSpinner.classList.remove('d-none');

                    // La redirection se fera automatiquement via le lien
                });
            }
        });
    </script>
</form>


             <div class="col-md-12 mt-2">
            <div class="card">
              <div class="card-body">

                 <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                <h5 class="mb-0">Liste des compagnies</h5>
                <!-- Bouton flottant pour ajouter une compagnie -->
                <a href="{{ route('compagnies.create') }}" class="btn btn-success btn-lg rounded-circle floating-add-btn" title="Ajouter une compagnie">
                    <i class="fas fa-plus fs-4"></i>
                </a>
            </div>
                <table id="myTable" class="table display dataTable table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>Logo</th>
                      <th>Nom complet</th>
                      <th>Email</th>
                      <th>Telephone</th>
                      <th>Adresse</th>
                      <th>Date</th>
                      <th>Statut</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($compagnies as $compagnie)

                    <tr>

                      <td>
                        @if($compagnie->logo_compagnies)
                          <div class="logo-circle">
                            <img src="{{ asset($compagnie->logo_compagnies) }}" alt="Logo" width="50" height="50">
                          </div>
                        @else
                          <span>Aucun</span>
                        @endif
                      </td>
                      <style>
                        .logo-circle {
                            width: 50px;
                            height: 50px;
                            border-radius: 50%;
                            overflow: hidden;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background-color: #f8f9fa;
                            border: 1px solid #dee2e6;
                        }
                        .logo-circle img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }
                      </style>
                      <td>{{ \Illuminate\Support\Str::limit($compagnie->nom_complet_compagnies, $nombre) }}</td>
                      <td>{{ \Illuminate\Support\Str::limit($compagnie->email_compagnies, $nombre) }}</td>
                      <td>{{ \Illuminate\Support\Str::limit($compagnie->telephone_compagnies, $nombre) }}</td>
                      <td>{{ \Illuminate\Support\Str::limit($compagnie->adresse_compagnies, $nombre) }}</td>

                      <td>{{ GlobalHelper::formatCreatedAt($compagnie->created_at) }}</td>
                      <td>
                        @if($compagnie->status == 1)
                          <span class="badge bg-success">Validé en activité</span>
                        @elseif($compagnie->status == 2)
                          <span class="badge bg-warning text-dark">En attente de validation</span>
                        @elseif($compagnie->status == 3)
                          <span class="badge bg-danger">Désactivation</span>
                        @else
                          <span class="badge bg-secondary">Inconnu</span>
                        @endif
                      </td>
                      <td>
                        @if($compagnie->status == 2)
                          <!-- Actions validation / refus -->
                          <form action="{{ route('compagnies.approve', $compagnie->id) }}" method="POST" style="display:inline;" class="approve-form">
                            @csrf
                            <button type="submit" class="btn btn-success btn-approve" title="Valider la demande">
                              <i class="fa fa-check"></i>
                            </button>
                          </form>
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuseModal{{ $compagnie->id }}" title="Refuser la demande">
                            <i class="fa fa-times"></i>
                          </button>

                        @else
                          <a href="{{ route('compagnies.edit', $compagnie->id) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                          </a>
                          <a href="{{ route('compagnies.show', $compagnie->id) }}" class="btn btn-info">
                            <i class="fa fa-eye"></i>
                          </a>

                          <!-- Bouton de suppression / réactivation -->
                          @if($compagnie->status == 1)
                            <form id="deleteForm{{ $compagnie->id }}" action="{{ route('compagnies.destroy', $compagnie->id) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $compagnie->id }}, '{{ addslashes($compagnie->nom_complet_compagnies) }}')">
                                <i class="fa fa-trash"></i>
                              </button>
                            </form>
                          @else
                            <form id="reactivateForm{{ $compagnie->id }}" action="{{ route('compagnies.reactivate', $compagnie->id) }}" method="POST" style="display:inline;">
                              @csrf
                              <button type="button" class="btn btn-success" onclick="confirmReactivate({{ $compagnie->id }}, '{{ addslashes($compagnie->nom_complet_compagnies) }}')">
                                <i class="fa fa-refresh"></i>
                              </button>
                            </form>
                          @endif
                        @endif
                      </td>


                    @endforeach


                  </tbody>
                </table>
                <!-- Modals rendus en dehors du tableau pour éviter les problèmes de rendu -->
                @foreach ($compagnies as $c)
                  @if($c->status == 2)
                  <div class="modal fade" id="refuseModal{{ $c->id }}" tabindex="-1" aria-labelledby="refuseLabel{{ $c->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="refuseLabel{{ $c->id }}">Refuser la demande</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <form action="{{ route('compagnies.refuse', $c->id) }}" method="POST" class="refuse-form">
                          @csrf
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">Motif / Modifications demandées</label>
                              <textarea name="reason" class="form-control" rows="4" required placeholder="Expliquez le motif de refus ou les corrections à apporter..."></textarea>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-danger">Envoyer le refus</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  @endif
                @endforeach
              </div>
            </div>
          </div>


            <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function() {
      $('#myTable').addClass('nowrap').dataTable({
        responsive: true,
        language: {
          url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
        }
      });

      // Confirmation SweetAlert2 pour validation
      document.querySelectorAll('.approve-form').forEach(function(form){
        form.addEventListener('submit', function(e){
          e.preventDefault();
          Swal.fire({
            title: 'Confirmer la validation',
            text: 'Valider cette demande ? Un email de confirmation sera envoyé.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, valider',
            cancelButtonText: 'Annuler'
          }).then((result)=>{ if(result.isConfirmed){ form.submit(); } });
        });
      });

      // Confirmation SweetAlert2 pour refus
      document.querySelectorAll('.refuse-form').forEach(function(form){
        form.addEventListener('submit', function(e){
          e.preventDefault();
          Swal.fire({
            title: 'Confirmer le refus',
            text: 'Envoyer le motif de refus à la compagnie ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, refuser',
            cancelButtonText: 'Annuler'
          }).then((result)=>{ if(result.isConfirmed){ form.submit(); } });
        });
      });
    });

    // Fonction pour confirmer la suppression
    function confirmDelete(id, companyName) {
      Swal.fire({
        title: 'Confirmer la désactivation',
        html: `
          <p>Attention ! En bloquant <strong>${companyName}</strong> :</p>
          <ul style="text-align: left; padding-left: 20px;">
            <li>Toutes les gares associées seront désactivées</li>
            <li>Les utilisateurs ne pourront plus se connecter</li>
            <li>La compagnie sera marquée comme inactive</li>
          </ul>
          <p>Voulez-vous continuer ?</p>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, désactiver',
        cancelButtonText: 'Annuler'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('deleteForm' + id).submit();
        }
      });
    }

    // Fonction pour confirmer la réactivation
    function confirmReactivate(id, companyName) {
      Swal.fire({
        title: 'Confirmer la réactivation',
        html: `
          <p>Voulez-vous réactiver la compagnie <strong>${companyName}</strong> ?</p>
          <p class="text-muted">Cela permettra à nouveau l'accès aux utilisateurs de cette compagnie.</p>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, réactiver',
        cancelButtonText: 'Annuler'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('reactivateForm' + id).submit();
        }
      });
    }
  </script>

        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page footer -->
    @include('betro.all_element.footer')

