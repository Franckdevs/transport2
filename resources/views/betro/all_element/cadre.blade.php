<div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item"><a class="text-secondary" href="index.html">ACCEUIL</a></li>
              <li class="breadcrumb-item active" aria-current="page">

                @php
    $routeName = Route::currentRouteName();
@endphp

@switch($routeName)
    @case('dashboard')
        <span>TABLEAU DE BORD</span>
        @break

    @case('compagnies')
        <span>COMPAGNIE</span>
        @break

    @case('compagnies.create')
        <span>CREATION COMPAGNIE</span>
        @break
    @case('compagnies.show')
        <span>DETAILS COMPAGNIE</span>
        @break

    @case('paiement.index')
    <span>LISTE PAIEMENT</span>
    @break

    @default
        <span></span> {{-- ou tu peux mettre "Titre inconnu" --}}
@endswitch


              </li>
            </ol>
          </div>
        </div> <!-- .row end -->

      </div>
