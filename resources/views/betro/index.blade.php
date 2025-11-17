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

            {{-- <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body">
                <i class="fa fa-user fa-lg position-absolute top-0 end-0 p-3"></i>
                <div class="mb-2 text-uppercase">NOMBRE DE COMPAGNIE</div>
                <div><span class="h4">{{ $nombres_compagnie ?? 0 }}</span>
                    <span class="small text-muted">
                     
                  </span>
                </div>
              </div>
            </div>
          </div> --}}

  <div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card overflow-hidden">
    <div class="card-body text-center">
<i class="fa fa-train fa-lg position-absolute top-0 end-0 p-3"></i>
      <div class="mb-2 text-uppercase">NOMBRE DE COMPAGNIE</div>
      <div>
        <span class="h4">{{ $nombres_compagnie ?? 0 }}</span>
      </div>
    </div>
  </div>
</div>


          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body text-center">
<i class="fa-solid fa-train-subway fa-lg position-absolute top-0 end-0 p-3 text-primary"></i>
                <div class="mb-2 text-uppercase">NOMBRE DE GARE</div>
                <div><span class="h4">{{$nombre_de_gare ?? 0}}</span> <span class="small text-muted">
                </span></div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body text-center">
                <i class="fa fa-road fa-lg position-absolute top-0 end-0 p-3 "></i>
                <div class="mb-2 text-uppercase">ITINERAIRE</div>
                <div><span class="h4">{{$itineraie_de_gare ?? 0}}</span> <span class="small text-muted">
                </span></div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body text-center">
<i class="fa-solid fa-route fa-lg position-absolute top-0 end-0 p-3 "></i>
                <div class="mb-2 text-uppercase">VOYAGES</div>
                <div><span class="h4">{{$voyages_de_gare ?? 0}}</span> <span class="small text-muted">
                </span></div>
              </div>

            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body text-center">
<i class="fa fa-ticket-alt fa-lg position-absolute top-0 end-0 p-3"></i>
                <div class="mb-2 text-uppercase">RESERVATION</div>
                <div><span class="h4">{{$reservation_de_gare ?? 0}}</span> <span class="small text-muted">
                  {{-- <i class="fa fa-level-up"></i> 11.2% --}}
                </span></div>
              </div>

            </div>
          </div>


           <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body text-center">
<i class="fa fa-credit-card fa-lg position-absolute top-0 end-0 p-3"></i>
                <div class="mb-2 text-uppercase">PAIEMENT</div>
                <div><span class="h4">0</span> FCFA <span class="small text-muted">
                  {{-- <i class="fa fa-level-up"></i> 11.2% --}}
                </span></div>
              </div>

            </div>
          </div>



           <div class="col-xl-12 col-lg-12">
            <div class="card">
              <div class="card-body d-flex flex-wrap flex-row align-items-center border-bottom">
                <div>
                  <div class="d-flex align-items-center">
                    {{-- ajoute un champs de filtre par date  --}}
                    <i class="fas fa-chart-line"></i>


                    <div class="flex-fill ms-3 text-truncate">
                      <div>Graphique des voyages</div>
                      <div><span class="h6 fw-bold">315</span> <small class="text-muted">Hours</small></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="apexcharts-canvas" id="apex-WorkoutStatistic"></div>
              </div>
            </div> <!-- .card end -->
          </div>


          <script src="../assets/js/theme.js"></script>
  <!-- Plugin Js -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  <!-- Vendor Script -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  <script>
    $(function() {
      "use strict";
      // Workout Statistic
      var options = {
        series: [{
          name: "Running",
          data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
        }, {
          name: "Cycling",
          data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
        }, {
          name: 'Yoga',
          data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35]
        }],
        chart: {
          height: 345,
          type: 'line', // line, bar, area
          toolbar: {
            show: false,
          },
          zoom: {
            enabled: false
          },
        },
        colors: ['var(--chart-color1)', 'var(--chart-color5)', 'var(--chart-color2)'],
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: [2, 2, 2],
          curve: 'smooth', // straight, smooth
          dashArray: [0, 8, 5]
        },
        legend: {
          tooltipHoverFormatter: function(val, opts) {
            return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
          }
        },
        markers: {
          size: 0,
          hover: {
            sizeOffset: 6
          }
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'March', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
        },
        tooltip: {
          y: [{
            title: {
              formatter: function(val) {
                return val + " (Hours)"
              }
            }
          }, {
            title: {
              formatter: function(val) {
                return val + " (Hours)"
              }
            }
          }, {
            title: {
              formatter: function(val) {
                return val + " (Session)"
              }
            }
          }]
        },
      };
      var chart = new ApexCharts(document.querySelector("#apex-WorkoutStatistic"), options);
      chart.render();
      // Sleep analysis
      var options = {
        series: [{
          name: 'Current Week',
          data: [8.5, 7, 6, 7, 6.5, 6, 7]
        }, {
          name: 'Last Week',
          data: [7, 6.5, 5, 7.5, 8, 9, 8]
        }],
        chart: {
          height: 120,
          type: 'area',
          toolbar: {
            show: false,
          },
          zoom: {
            enabled: false
          },
          sparkline: {
            enabled: true,
          },
        },
        tooltip: {
          y: [{
            title: {
              formatter: function(val) {
                return val + " Hours-"
              }
            }
          }, {
            title: {
              formatter: function(val) {
                return val + " Hours-"
              }
            }
          }]
        },
        fill: {
          type: "gradient",
          gradient: {
            gradientToColors: ['var(--chart-color1)', 'var(--chart-color5)'],
            shadeIntensity: 4,
            opacityFrom: 0.5,
            opacityTo: 0.1,
            stops: [0, 100]
          },
        },
        colors: ['var(--chart-color1)', 'var(--chart-color5)'],
        stroke: {
          curve: 'smooth',
          width: 1
        },
        xaxis: {
          categories: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
        }
      };
      var chart = new ApexCharts(document.querySelector("#apex-Sleepanalysis"), options);
      chart.render();
      // Energy balance
      var options = {
        series: [{
          name: "Low",
          data: [
            [21.7, 3],
            [23.6, 3.5],
            [24.6, 3],
            [29.9, 3],
            [21.7, 20],
            [23, 2],
            [10.9, 3],
            [28, 4],
            [27.1, 0.3],
            [16.4, 4],
            [13.6, 0],
            [19, 5],
            [22.4, 3],
            [24.5, 3],
            [32.6, 3],
            [27.1, 4],
            [29.6, 6],
            [31.6, 8],
            [21.6, 5],
            [20.9, 4],
            [22.4, 0],
            [32.6, 10.3],
            [29.7, 20.8],
            [24.5, 0.8],
            [21.4, 0],
            [21.7, 6.9],
            [28.6, 7.7],
            [15.4, 0],
            [18.1, 0],
            [33.4, 0],
            [16.4, 0]
          ]
        }, {
          name: "High",
          data: [
            [36.4, 13.4],
            [1.7, 11],
            [5.4, 8],
            [9, 17],
            [1.9, 4],
            [3.6, 12.2],
            [1.9, 14.4],
            [1.9, 9],
            [1.9, 13.2],
            [1.4, 7],
            [6.4, 8.8],
            [3.6, 4.3],
            [1.6, 10],
            [9.9, 2],
            [7.1, 15],
            [1.4, 0],
            [3.6, 13.7],
            [1.9, 15.2],
            [6.4, 16.5],
            [0.9, 10],
            [4.5, 17.1],
            [10.9, 10],
            [0.1, 14.7],
            [9, 10],
            [12.7, 11.8],
            [2.1, 10],
            [2.5, 10],
            [27.1, 10],
            [2.9, 11.5],
            [7.1, 10.8],
            [2.1, 12]
          ]
        }],
        chart: {
          height: 120,
          type: 'scatter',
          toolbar: {
            show: false,
          },
          sparkline: {
            enabled: true,
          }
        },
        colors: ['var(--chart-color2)', 'var(--chart-color5)'],
        xaxis: {
          tickAmount: 10,
          labels: {
            formatter: function(val) {
              return parseFloat(val).toFixed(1)
            }
          }
        },
        yaxis: {
          tickAmount: 0
        },
        markers: {
          size: [3, 3]
        }
      };
      var chart = new ApexCharts(document.querySelector("#apex-Energybalance"), options);
      chart.render();
    });
  </script>
          


        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page footer -->
    @include('betro.all_element.footer')
