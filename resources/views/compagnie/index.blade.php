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

  @canany(['tableau-de-bord-compagnie', 'tout-les-permissions'])

<div class="container-fluid">
    <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-xl-3 g-2 mb-3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <div class="col-lg-5">
    <div class="card">
        <div class="card-body d-flex align-items-center">
        <div class="avatar lg rounded-circle no-thumbnail d-flex justify-content-center align-items-center bg-secondary text-white" style="width: 64px; height: 64px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="30" fill="currentColor" class="bi bi-ev-station-fill" viewBox="0 0 16 16">
            <path d="M1 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v8a2 2 0 0 1 2 2v.5a.5.5 0 0 0 1 0V9c0-.258-.104-.377-.357-.635l-.007-.008C13.379 8.096 13 7.71 13 7V4a.5.5 0 0 1 .146-.354l.5-.5a.5.5 0 0 1 .708 0l.5.5A.5.5 0 0 1 15 4v8.5a1.5 1.5 0 1 1-3 0V12a1 1 0 0 0-1-1v4h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1zm2 .5v5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 .5-.5v-5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0-.5.5m2.631 9.96H4.14v-.893h1.403v-.505H4.14v-.855h1.49v-.54H3.485V13h2.146zm1.316.54h.794l1.106-3.333h-.733l-.74 2.615h-.031l-.747-2.615h-.764z"/>
            </svg>
            <!-- ou <i class="fa-solid fa-bus fa-2x"></i> pour gare bus -->
        </div>
        <div class="flex-fill ms-3 text-truncate">
            <div class="text-muted">GARES</div>
            <div><span class="h4">{{ $nombregars ?? 0 }}</span> <small class="text-muted">
                {{-- places --}}
            </small></div>
        </div>
        </div>
    </div>
    </div>


    <div class="col-lg-6">
    <div class="card">
        <div class="card-body d-flex align-items-center">
        <div class="avatar lg rounded-circle no-thumbnail d-flex justify-content-center align-items-center bg-secondary text-white" style="width: 64px; height: 64px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="30" fill="currentColor" class="bi bi-bus-front" viewBox="0 0 16 16">
            <path d="M5 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0m8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-6-1a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2zm1-6c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9s3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44 44 0 0 0 8 4m0-1c-1.837 0-3.353.107-4.448.22a.5.5 0 1 1-.104-.994A44 44 0 0 1 8 2c1.876 0 3.426.109 4.552.226a.5.5 0 1 1-.104.994A43 43 0 0 0 8 3"/>
            <path d="M15 8a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1V2.64c0-1.188-.845-2.232-2.064-2.372A44 44 0 0 0 8 0C5.9 0 4.208.136 3.064.268 1.845.408 1 1.452 1 2.64V4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v3.5c0 .818.393 1.544 1 2v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5V14h6v1.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2c.607-.456 1-1.182 1-2zM8 1c2.056 0 3.71.134 4.822.261.676.078 1.178.66 1.178 1.379v8.86a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 11.5V2.64c0-.72.502-1.301 1.178-1.379A43 43 0 0 1 8 1"/>
            </svg>
            </div>
            <div class="flex-fill ms-3 text-truncate">
                <div class="text-muted">BUS</div>
                <div><span class="h4">{{ $nombres_bus ?? 0 }}</span> <small class="text-muted">cars / bus</small></div>
            </div>
            </div>
        </div>
        </div>

    <div class="col-lg-5">
  <div class="card">
    <div class="card-body d-flex align-items-center">
      <div class="avatar lg rounded-circle no-thumbnail d-flex justify-content-center align-items-center bg-secondary text-white" style="width: 64px; height: 64px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="30" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg>
        </div>
        <div class="flex-fill ms-3 text-truncate">
            <div class="text-muted">CHAUFFEURS</div>
            <div><span class="h4">{{ $nombres_chauffeur ?? 0 }}</span> <small class="text-muted">cars</small></div>
        </div>
        </div>
    </div>
    </div>


          <div class="col-lg-5">
            <div class="card">
              <div class="card-body d-flex align-items-center">
                <div class="avatar lg rounded-circle no-thumbnail d-flex justify-content-center align-items-center bg-secondary text-white" style="width: 64px; height: 64px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="30" fill="currentColor" class="bi bi-sign-turn-slight-right-fill" viewBox="0 0 16 16">
  <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098zm1.385 6.547.8 1.386a.25.25 0 0 0 .451-.039l1.06-2.882a.25.25 0 0 0-.192-.333l-3.026-.523a.25.25 0 0 0-.26.371l.667 1.154-.621.373A2.5 2.5 0 0 0 6 8.632V11h1V8.632a1.5 1.5 0 0 1 .728-1.286z"/>
</svg>
                </div>
                <div class="flex-fill ms-3 text-truncate">
                  <div class="text-muted">ITINERAIRE</div>
                  <div><span class="h4">{{ $nombres_itineraire }}</span> <small class="text-muted"> </small></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="card">
              <div class="card-body d-flex align-items-center">
                <div class="avatar lg rounded-circle no-thumbnail d-flex justify-content-center align-items-center bg-secondary text-white" style="width: 64px; height: 64px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="30" fill="currentColor" class="bi bi-cone-striped" viewBox="0 0 16 16">
  <path d="m9.97 4.88.953 3.811C10.159 8.878 9.14 9 8 9s-2.158-.122-2.923-.309L6.03 4.88C6.635 4.957 7.3 5 8 5s1.365-.043 1.97-.12m-.245-.978L8.97.88C8.718-.13 7.282-.13 7.03.88L6.275 3.9C6.8 3.965 7.382 4 8 4s1.2-.036 1.725-.098m4.396 8.613a.5.5 0 0 1 .037.96l-6 2a.5.5 0 0 1-.316 0l-6-2a.5.5 0 0 1 .037-.96l2.391-.598.565-2.257c.862.212 1.964.339 3.165.339s2.303-.127 3.165-.339l.565 2.257z"/>
</svg>
                </div>
                <div class="flex-fill ms-3 text-truncate">
                  <div class="text-muted">VOYAGE</div>
                  <div><span class="h4">{{ $nombres_voyage }}</span> <small class="text-muted"> </small></div>
                </div>
              </div>
            </div>
          </div>


        </div> <!-- .row end -->
        <div class="row mb-5">
          <div class="col-12">


          </div>
        </div> <!-- .row end -->


      </div>
  @else
          {{-- Message de bienvenue si pas de permission --}}
      <div class="container-fluid">
          <div class="card border-0 shadow-lg p-5 text-center">
              <h2 class="fw-bold text-primary">Bienvenue {{ Auth::user()->name }} 👋</h2>
              <p class="mt-3 text-muted">
                  Vous êtes connecté à votre espace, mais vous n’avez pas encore accès au tableau de bord.
              </p>
              <p class="text-muted">
                  Contactez l’administrateur pour obtenir les permissions nécessaires.
              </p>
          </div>
      </div>
  @endcanany




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
