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
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body">
                <i class="fa fa-user fa-lg position-absolute top-0 end-0 p-3"></i>
                <div class="mb-2 text-uppercase">NEW EMPLOYEE</div>
                <div><span class="h4">51</span> <span class="small text-muted"><i class="fa fa-level-up"></i> 13%</span></div>
              </div>

            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body">
                <i class="fa fa-group fa-lg position-absolute top-0 end-0 p-3"></i>
                <div class="mb-2 text-uppercase">TOTAL EMPLOYEE</div>
                <div><span class="h4">372</span> <span class="small text-muted"><i class="fa fa-level-up"></i> 8%</span></div>
              </div>

            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body">
                <i class="fa fa-credit-card fa-lg position-absolute top-0 end-0 p-3"></i>
                <div class="mb-2 text-uppercase">TOTAL SALARY</div>
                <div><span class="h4">$25 k</span> <span class="small text-muted"><i class="fa fa-level-up"></i> 4.26%</span></div>
              </div>

            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body">
                <i class="fa fa-pie-chart fa-lg position-absolute top-0 end-0 p-3"></i>
                <div class="mb-2 text-uppercase">AVG. SALARY</div>
                <div><span class="h4">$1050</span> <span class="small text-muted"><i class="fa fa-level-up"></i> 11.2%</span></div>
              </div>

            </div>
          </div>


        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page footer -->
    @include('betro.all_element.footer')

