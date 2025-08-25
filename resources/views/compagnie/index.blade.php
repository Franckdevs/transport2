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


  <!-- start: search area -->

<!-- end: search area -->

    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
    <div class="container-fluid">

    <form class="d-flex align-items-center ms-2 mb-5" action="" method="GET" >
    <input type="date" name="date_debut" class="form-control me-2" placeholder="Date début">
    <input type="date" name="date_fin" class="form-control me-2" placeholder="Date fin">
    <input type="submit" class="btn btn-primary" >
    </form>

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
            <div class="text-muted">GARE</div>
            <div><span class="h4">104</span> <small class="text-muted">places</small></div>
        </div>
        </div>
    </div>
    </div>


<div class="col-lg-5">
  <div class="card">
    <div class="card-body d-flex align-items-center">
      <div class="avatar lg rounded-circle no-thumbnail d-flex justify-content-center align-items-center bg-secondary text-white" style="width: 64px; height: 64px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="30" fill="currentColor" class="bi bi-bus-front" viewBox="0 0 16 16">
        <path d="M5 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0m8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-6-1a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2zm1-6c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9s3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44 44 0 0 0 8 4m0-1c-1.837 0-3.353.107-4.448.22a.5.5 0 1 1-.104-.994A44 44 0 0 1 8 2c1.876 0 3.426.109 4.552.226a.5.5 0 1 1-.104.994A43 43 0 0 0 8 3"/>
        <path d="M15 8a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1V2.64c0-1.188-.845-2.232-2.064-2.372A44 44 0 0 0 8 0C5.9 0 4.208.136 3.064.268 1.845.408 1 1.452 1 2.64V4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v3.5c0 .818.393 1.544 1 2v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5V14h6v1.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2c.607-.456 1-1.182 1-2zM8 1c2.056 0 3.71.134 4.822.261.676.078 1.178.66 1.178 1.379v8.86a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 11.5V2.64c0-.72.502-1.301 1.178-1.379A43 43 0 0 1 8 1"/>
        </svg>
        </div>
        <div class="flex-fill ms-3 text-truncate">
            <div class="text-muted">Nombre de bus</div>
            <div><span class="h4">25</span> <small class="text-muted">cars</small></div>
        </div>
        </div>
    </div>
    </div>

    <div class="col-lg-5">
  <div class="card">
    <div class="card-body d-flex align-items-center">
      <div class="avatar lg rounded-circle no-thumbnail d-flex justify-content-center align-items-center bg-secondary text-white" style="width: 64px; height: 64px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="30" fill="currentColor" class="bi bi-bus-front" viewBox="0 0 16 16">
        <path d="M5 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0m8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-6-1a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2zm1-6c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9s3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44 44 0 0 0 8 4m0-1c-1.837 0-3.353.107-4.448.22a.5.5 0 1 1-.104-.994A44 44 0 0 1 8 2c1.876 0 3.426.109 4.552.226a.5.5 0 1 1-.104.994A43 43 0 0 0 8 3"/>
        <path d="M15 8a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1V2.64c0-1.188-.845-2.232-2.064-2.372A44 44 0 0 0 8 0C5.9 0 4.208.136 3.064.268 1.845.408 1 1.452 1 2.64V4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v3.5c0 .818.393 1.544 1 2v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5V14h6v1.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2c.607-.456 1-1.182 1-2zM8 1c2.056 0 3.71.134 4.822.261.676.078 1.178.66 1.178 1.379v8.86a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 11.5V2.64c0-.72.502-1.301 1.178-1.379A43 43 0 0 1 8 1"/>
        </svg>
        </div>
        <div class="flex-fill ms-3 text-truncate">
            <div class="text-muted">Réservations</div>
            <div><span class="h4">25</span> <small class="text-muted">cars</small></div>
        </div>
        </div>
    </div>
    </div>


          <div class="col-lg-5">
            <div class="card">
              <div class="card-body d-flex align-items-center">
                <div class="avatar lg rounded-circle no-thumbnail d-flex justify-content-center align-items-center bg-secondary text-white" style="width: 64px; height: 64px;">
                   <svg xmlns="http://www.w3.org/2000/svg" width="70" height="30" fill="currentColor" class="bi bi-bus-front" viewBox="0 0 16 16">
        <path d="M5 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0m8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-6-1a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2zm1-6c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9s3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44 44 0 0 0 8 4m0-1c-1.837 0-3.353.107-4.448.22a.5.5 0 1 1-.104-.994A44 44 0 0 1 8 2c1.876 0 3.426.109 4.552.226a.5.5 0 1 1-.104.994A43 43 0 0 0 8 3"/>
        <path d="M15 8a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1V2.64c0-1.188-.845-2.232-2.064-2.372A44 44 0 0 0 8 0C5.9 0 4.208.136 3.064.268 1.845.408 1 1.452 1 2.64V4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v3.5c0 .818.393 1.544 1 2v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5V14h6v1.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2c.607-.456 1-1.182 1-2zM8 1c2.056 0 3.71.134 4.822.261.676.078 1.178.66 1.178 1.379v8.86a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 11.5V2.64c0-.72.502-1.301 1.178-1.379A43 43 0 0 1 8 1"/>
        </svg>
                </div>
                <div class="flex-fill ms-3 text-truncate">
                  <div class="text-muted">Réservations</div>
                  <div><span class="h4">94</span> <small class="text-muted">mg/dl</small></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="card">
              <div class="card-body d-flex align-items-center">
                <div class="avatar lg rounded-circle no-thumbnail d-flex justify-content-center align-items-center bg-secondary text-white" style="width: 64px; height: 64px;">
                   <svg xmlns="http://www.w3.org/2000/svg" width="70" height="30" fill="currentColor" class="bi bi-bus-front" viewBox="0 0 16 16">
        <path d="M5 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0m8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-6-1a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2zm1-6c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9s3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44 44 0 0 0 8 4m0-1c-1.837 0-3.353.107-4.448.22a.5.5 0 1 1-.104-.994A44 44 0 0 1 8 2c1.876 0 3.426.109 4.552.226a.5.5 0 1 1-.104.994A43 43 0 0 0 8 3"/>
        <path d="M15 8a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1V2.64c0-1.188-.845-2.232-2.064-2.372A44 44 0 0 0 8 0C5.9 0 4.208.136 3.064.268 1.845.408 1 1.452 1 2.64V4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v3.5c0 .818.393 1.544 1 2v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5V14h6v1.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2c.607-.456 1-1.182 1-2zM8 1c2.056 0 3.71.134 4.822.261.676.078 1.178.66 1.178 1.379v8.86a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 11.5V2.64c0-.72.502-1.301 1.178-1.379A43 43 0 0 1 8 1"/>
        </svg>
                </div>
                <div class="flex-fill ms-3 text-truncate">
                  <div class="text-muted">Réservations</div>
                  <div><span class="h4">94</span> <small class="text-muted">mg/dl</small></div>
                </div>
              </div>
            </div>
          </div>


        </div> <!-- .row end -->
        <div class="row mb-5">
          <div class="col-12">
            <div class="card py-3 bg-primary-gradient text-light">
              <div class="card-body d-flex align-items-center flex-column flex-md-row">
<img src="../svg.jpg" alt="" class="w40 img-fluid" style="width:170px; height:125px;">
                <div class="media-body ms-md-5 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
                  {{-- <h4 class="px-xl-4 px-3 fw-bold">Your yesterday activity</h4>
                  <div class="px-xl-4 px-3 mb-4">Don't stop and improve your activity</div> --}}
                  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start">
                    <div class="py-2 px-xl-4 px-3">
                      <h5 class="mb-1">900 kcal</h5>
                      <div>Burned calories</div>
                    </div>
                    <div class="py-2 px-xl-4 px-3">
                      <h5 class="mb-1">80:20:09 min</h5>
                      <div>Training</div>
                    </div>
                    <div class="py-2 px-xl-4 px-3">
                      <h5 class="mb-1">11:21:10 min</h5>
                      <div>On legs</div>
                    </div>
                    <div class="py-2 px-xl-4 px-3">
                      <h5 class="mb-1">12,900</h5>
                      <div>Steps</div>
                    </div>
                    <div class="py-2 px-xl-4 px-3">
                      <h5 class="mb-1">12 km</h5>
                      <div>Distance</div>
                    </div>
                    <div class="py-2 px-xl-4 px-3">
                      <h5 class="mb-1">18</h5>
                      <div>Floors</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
