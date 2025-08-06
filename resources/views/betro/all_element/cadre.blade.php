<div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item"><a class="text-secondary" href="index.html">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">

                @php
    $routeName = Route::currentRouteName();
@endphp

@switch($routeName)
    @case('dashboard')
        <span>DASHBOARD</span>
        @break

    @case('compagnies')
        <span>COMPAGNIE</span>
        @break

    @case('compagnies/create')
        <span>Ajouter une compagnie</span>
        @break

    @default
        <span></span> {{-- ou tu peux mettre "Titre inconnu" --}}
@endswitch


              </li>
            </ol>
          </div>
        </div> <!-- .row end -->

      </div>
