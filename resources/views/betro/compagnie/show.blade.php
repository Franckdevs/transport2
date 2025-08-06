@php
use App\Helpers\GlobalHelper;
@endphp
@include('betro.all_element.header')

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
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row g-3 row-deck">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Détails de la compagnie et de l'administrateur</h5>
              </div>

              <div class="card-body">
                <div class="row">
                  <!-- Infos Compagnie -->
                  <div class="col-md-6">
                    <h6>Informations Compagnie</h6>
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                            <tr>
  <th>Logo</th>
  <td>
    @if ($compagnies->logo_compagnies)
      <img src="{{ asset( 'logo_compagnie/' .$compagnies->logo_compagnies) }}" alt="Logo" style="max-height: 100px; max-width: 100%; object-fit: contain; border-radius: 5px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
    @else
      <div class="d-flex align-items-center text-muted" style="height: 100px;">
        <i class="bi bi-building" style="font-size: 3rem; margin-right: 10px;"></i>
        <span>Aucun logo disponible</span>
      </div>
    @endif
  </td>
</tr>
                          <th>Nom complet</th>
                          <td>{{ $compagnies->nom_complet_compagnies }}</td>
                        </tr>
                        <tr>
                          <th>Email</th>
                          <td>{{ $compagnies->email_compagnies }}</td>
                        </tr>
                        <tr>
                          <th>Téléphone</th>
                          <td>{{ $compagnies->telephone_compagnies }}</td>
                        </tr>
                        <tr>
                          <th>Adresse</th>
                          <td>{{ $compagnies->adresse_compagnies }}</td>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <td>{{ $compagnies->description_compagnies ?? 'Aucune description' }}</td>
                        </tr>

                        <tr>
                          <th>Date de création</th>
                          <td>{{ GlobalHelper::formatCreatedAt($compagnies->created_at) }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <!-- Infos Administrateur -->
                  <div class="col-md-6">
                    <h6>Informations Administrateur</h6>
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <th>Nom</th>
                          <td>{{ $users->nom }}</td>
                        </tr>
                        <tr>
                          <th>Prénom</th>
                          <td>{{ $users->prenom }}</td>
                        </tr>
                        <tr>
                          <th>Email</th>
                          <td>{{ $users->email }}</td>
                        </tr>
                        <tr>
                          <th>Téléphone</th>
                          <td>{{ $users->telephone }}</td>
                        </tr>
                        <tr>
                          <th>Date d'inscription</th>
                          <td>{{ GlobalHelper::formatCreatedAt($users->created_at) }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                {{-- <a href="{{ route('compagnies.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a> --}}

              </div>
            </div>
          </div>

        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page footer -->
    @include('betro.all_element.footer')
  </div>
</body>
