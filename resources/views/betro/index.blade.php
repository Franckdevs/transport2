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

<!-- Filtre de date -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('dashboard') }}" method="GET">
                  <div class="row align-items-center">
                    <div class="col-auto">
                        <label class="form-label mb-0">Période :</label>
                    </div>
                    <div class="col-auto">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">Du</span>
                            <input type="date" class="form-control" id="dateDebut" name="date_debut" value="{{ $dateDebut }}">
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">au</span>
                            <input type="date" class="form-control" id="dateFin" name="date_fin" value="{{ $dateFin }}">
                        </div>
                    </div>
                    <div class="col-auto me-4">
                        <div class="input-group input-group-sm" style="min-width: 300px;">
                            <span class="input-group-text">Compagnie</span>
                            <select class="form-select form-select-sm select2" name="compagnie_id" id="compagnieSelect">
                                <option value="">Toutes les compagnies</option>
                                @foreach($compagnies as $compagnie)
                                    <option value="{{ $compagnie->id }}" {{ $compagnieId == $compagnie->id ? 'selected' : '' }}>
                                        {{ $compagnie->nom_complet_compagnies }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm" id="btnFiltrer">
                            <i class="fas fa-filter me-1"></i>
                            <span class="btn-text">Filtrer</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm" id="btnReset" title="Réinitialiser les filtres sur le mois actuel (du 1er jour au jour actuel)">
                            <i class="fas fa-sync-alt me-1"></i>
                            <span class="btn-text">Réinitialiser</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
                <div><span class="h4">{{ $total_paiements ?? 0 }} FCFA</span><span class="small text-muted">
                  {{-- <i class="fa fa-level-up"></i> 11.2% --}}
                </span></div>
              </div>

            </div>
          </div>



           <div class="col-xl-12 col-lg-12">
            <div class="card">
              <div class="card-header  text-white d-flex justify-content-between align-items-center">
                <div>
                  <h6 class="card-title mb-0"><i class="fas fa-chart-line me-2"></i>Statistiques des Réservations et Paiements</h6>
                  <small class="text-black-50">Période du {{ \Carbon\Carbon::parse($dateDebut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($dateFin)->format('d/m/Y') }}</small>
                </div>
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-light" id="export-png">
                    <i class="fas fa-download me-1"></i> PNG
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-light" id="export-csv">
                    <i class="fas fa-file-csv me-1"></i> CSV
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="statistics-chart" style="min-height: 400px;">
                  <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                      <span class="visually-hidden">Chargement...</span>
                    </div>
                    <p class="mt-2 text-muted">Chargement des données...</p>
                  </div>
                </div>
                <div class="mt-3 text-end">
                  <small class="text-muted">Dernière mise à jour : {{ now()->format('d/m/Y H:i') }}</small>
                </div>
              </div>
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Animation de chargement
                    const chartContainer = document.getElementById('statistics-chart');
                    
                    // Options du graphique
                    var options = {
                        series: [{
                            name: 'Réservations',
                            type: 'column',
                            data: @json($reservationsData)
                        }, {
                            name: 'Paiements (FCFA)',
                            type: 'line',
                            data: @json($paiementsData)
                        }],
                        chart: {
                            height: 400,
                            type: 'line',
                            stacked: false,
                            animations: {
                                enabled: true,
                                easing: 'easeinout',
                                speed: 800,
                                animateGradually: {
                                    enabled: true,
                                    delay: 150
                                },
                                dynamicAnimation: {
                                    enabled: true,
                                    speed: 350
                                }
                            },
                            toolbar: {
                                show: true,
                                tools: {
                                    download: false, // On désactive le téléchargement par défaut pour utiliser notre propre bouton
                                    selection: true,
                                    zoom: true,
                                    zoomin: true,
                                    zoomout: true,
                                    pan: true,
                                    reset: true
                                },
                                export: {
                                    csv: {
                                        filename: 'statistiques-' + new Date().toISOString().split('T')[0],
                                        columnDelimiter: ';',
                                        headerCategory: 'Date',
                                        headerValue: 'Valeur',
                                    },
                                    svg: {
                                        filename: 'statistiques-' + new Date().toISOString().split('T')[0],
                                    },
                                    png: {
                                        filename: 'statistiques-' + new Date().toISOString().split('T')[0],
                                    }
                                }
                            },
                            zoom: {
                                enabled: true,
                                type: 'x',
                                autoScaleYaxis: true,
                                zoomedArea: {
                                    fill: {
                                        color: '#90CAF9',
                                        opacity: 0.4
                                    },
                                    stroke: {
                                        color: '#0D47A1',
                                        opacity: 0.4,
                                        width: 1
                                    }
                                }
                            },
                            fontFamily: 'Nunito, sans-serif',
                            foreColor: '#373d3f',
                            toolbar: {
                                show: true,
                                offsetX: 0,
                                offsetY: 0,
                                tools: {
                                    download: false,
                                    selection: true,
                                    zoom: true,
                                    zoomin: true,
                                    zoomout: true,
                                    pan: true,
                                    reset: true
                                },
                                autoSelected: 'zoom'
                            },
                            events: {
                                mounted: function(chartContext, config) {
                                    // Masquer le spinner de chargement une fois le graphique chargé
                                    const loadingElement = chartContainer.querySelector('.spinner-border');
                                    if (loadingElement) {
                                        loadingElement.style.display = 'none';
                                        chartContainer.querySelector('p').style.display = 'none';
                                    }
                                },
                                animationEnd: function(chartContext, config) {
                                    // Animation terminée
                                }
                            }
                        },
                        stroke: {
                            width: [1, 4]
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '50%'
                            }
                        },
                        xaxis: {
                            categories: @json($categories),
                            labels: {
                                rotate: -45,
                                style: {
                                    fontSize: '12px'
                                }
                            }
                        },
                        yaxis: [{
                            axisTicks: {
                                show: true,
                            },
                            axisBorder: {
                                show: true,
                                color: '#008FFB'
                            },
                            labels: {
                                style: {
                                    colors: '#008FFB',
                                }
                            },
                            title: {
                                text: "Nombre de Réservations",
                                style: {
                                    color: '#008FFB',
                                }
                            },
                        },
                        {
                            opposite: true,
                            axisTicks: {
                                show: true,
                            },
                            axisBorder: {
                                show: true,
                                color: '#00E396'
                            },
                            labels: {
                                style: {
                                    colors: '#00E396',
                                }
                            },
                            title: {
                                text: "Montant des Paiements (FCFA)",
                                style: {
                                    color: '#00E396',
                                }
                            }
                        }],
                        tooltip: {
                            enabled: true,
                            theme: 'light',
                            style: {
                                fontSize: '12px',
                                fontFamily: 'Nunito, sans-serif'
                            },
                            x: {
                                show: true,
                                format: 'dd MMM yyyy',
                                formatter: undefined,
                            },
                            y: {
                                formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                                    if (seriesIndex === 0) {
                                        return value + ' réservation' + (value > 1 ? 's' : '');
                                    } else {
                                        return new Intl.NumberFormat('fr-FR', { 
                                            style: 'currency', 
                                            currency: 'XOF',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0
                                        }).format(value).replace('XOF', '') + ' FCFA';
                                    }
                                }
                            },
                            marker: {
                                show: true,
                            },
                            fixed: {
                                enabled: true,
                                position: 'topLeft',
                                offsetY: 30,
                                offsetX: 60
                            }
                        },
                        legend: {
                            horizontalAlign: 'center',
                            offsetX: 40
                        },
                        colors: ['#5e72e4', '#2dce89'],
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            width: [2, 3],
                            curve: 'smooth'
                        },
                        markers: {
                            size: [4, 6],
                            strokeWidth: [2, 2],
                            strokeColors: ['#fff', '#fff'],
                            hover: {
                                size: 6,
                                sizeOffset: 2
                            }
                        },
                        grid: {
                            borderColor: '#f1f3f9',
                            strokeDashArray: 4,
                            padding: {
                                top: 0,
                                right: 20,
                                bottom: 0,
                                left: 20
                            }
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: 'light',
                                type: 'vertical',
                                shadeIntensity: 0.4,
                                inverseColors: false,
                                opacityFrom: 0.8,
                                opacityTo: 0.1,
                                stops: [0, 100]
                            }
                        },
                        noData: {
                            text: 'Aucune donnée disponible',
                            align: 'center',
                            verticalAlign: 'middle',
                            offsetX: 0,
                            offsetY: 0,
                            style: {
                                color: '#6c757d',
                                fontSize: '14px',
                                fontFamily: 'Nunito, sans-serif'
                            }
                        }
                    };

                    // Initialisation du graphique
                    var chart = new ApexCharts(document.querySelector("#statistics-chart"), options);
                    chart.render();
                    
                    // Gestion des boutons d'export
                    document.getElementById('export-png').addEventListener('click', function() {
                        chart.dataURI().then(({ imgURI }) => {
                            const link = document.createElement('a');
                            link.download = 'statistiques-' + new Date().toISOString().split('T')[0] + '.png';
                            link.href = imgURI;
                            link.click();
                        });
                    });
                    
                    document.getElementById('export-csv').addEventListener('click', function() {
                        const data = [
                            ['Date', 'Réservations', 'Paiements (FCFA)'],
                            ...options.series[0].data.map((value, index) => [
                                options.xaxis.categories[index],
                                value,
                                options.series[1].data[index]
                            ])
                        ];
                        
                        let csvContent = 'data:text/csv;charset=utf-8,';
                        data.forEach(row => {
                            csvContent += row.map(cell => `"${cell}"`).join(';') + '\r\n';
                        });
                        
                        const encodedUri = encodeURI(csvContent);
                        const link = document.createElement('a');
                        link.setAttribute('href', encodedUri);
                        link.setAttribute('download', 'statistiques-' + new Date().toISOString().split('T')[0] + '.csv');
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    });
                    
                    // Redimensionnement réactif
                    window.addEventListener('resize', function() {
                        chart.updateOptions({
                            chart: {
                                width: chartContainer.offsetWidth
                            }
                        });
                    });
                });
              </script>
            </div> <!-- .card end -->
          </div>


          <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
  
  <script src="../assets/js/theme.js"></script>
  <!-- Plugin Js -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
        // Initialisation de Select2
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '300px',
            placeholder: 'Rechercher une compagnie...',
            allowClear: true,
            language: {
                noResults: function() {
                    return "Aucun résultat trouvé";
                },
                searching: function() {
                    return "Recherche en cours...";
                },
                inputTooShort: function(args) {
                    return "Saisissez au moins " + args.minimum + " caractères";
                }
            }
        });

        // Fermer le sélecteur après sélection sur mobile
        if ($(window).width() < 768) {
            $('.select2').on('select2:select', function() {
                $(this).select2('close');
            });
        }

        // Gestion des spinners pour les boutons
        $('#btnFiltrer').on('click', function() {
            var $this = $(this);
            var $btnText = $this.find('.btn-text');
            var $spinner = $this.find('.spinner-border');
            
            // Afficher le spinner et cacher le texte
            $btnText.addClass('d-none');
            $spinner.removeClass('d-none');
            
            // Désactiver le bouton après un court délai pour permettre la soumission
            setTimeout(function() {
                $this.prop('disabled', true);
            }, 100);
        });

        $('#btnReset').on('click', function(e) {
            var $this = $(this);
            var $btnText = $this.find('.btn-text');
            var $spinner = $this.find('.spinner-border');
            
            // Afficher le spinner et cacher le texte
            $btnText.addClass('d-none');
            $spinner.removeClass('d-none');
            
            // Désactiver le bouton après un court délai pour permettre la navigation
            setTimeout(function() {
                $this.prop('disabled', true);
            }, 100);
        });
    });
  </script>
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
