  <script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            Toastify({
                text: "{{ $error }}",
                duration: 5000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#f44336", // rouge
                stopOnFocus: true,
            }).showToast();
        @endforeach
    @endif

    @if (session('error'))
        Toastify({
            text: "{{ session('error') }}",
            duration: 5000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#f44336",
            stopOnFocus: true,
        }).showToast();
    @endif

    @if (session('success'))
        Toastify({
            text: "{{ session('success') }}",
            duration: 5000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#4CAF50", // vert
            stopOnFocus: true,
        }).showToast();
    @endif
</script>
  <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              {{-- <li class="breadcrumb-item"><a class="text-secondary" href="index.html">Home</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">

                @php
    $routeName = Route::currentRouteName();
@endphp

@switch($routeName)
    @case('dashboardcompagnie')
        {{-- <span>TABLEAU DE BORD</span> --}}
@endswitch


            </li>
            </ol>
          </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">


        </div> <!-- .row end -->
      </div>
    </div>


