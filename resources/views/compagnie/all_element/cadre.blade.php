  <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
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
    @case('dashboardcompagnie')
        <span>TABLEAU DE BORD</span>
@endswitch


            </li>
            </ol>
          </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">


        </div> <!-- .row end -->
      </div>
    </div>
