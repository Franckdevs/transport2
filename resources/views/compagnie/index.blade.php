<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - BETRO</title>
    @include('compagnie.all_element.header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <style>
        /* body {
            background: #f8f9fa;
            font-family: 'Segoe UI', system-ui, sans-serif;
        } */

        .page-header {
            background: #ffffff;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .page-body {
            background: #f8f9fa;
        }

        /* Cartes de statistiques */
        .stats-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background: white;
            overflow: hidden;
            position: relative;
            height: 100%;
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
        }

        .stats-card.gares::before { background: #667eea; }
        .stats-card.bus::before { background: #f5576c; }
        .stats-card.chauffeurs::before { background: #4facfe; }
        .stats-card.itineraires::before { background: #43e97b; }
        .stats-card.voyages::before { background: #fa709a; }
        .stats-card.paiements::before { background: #ff9a9e; }

        .stats-card .card-body {
            padding: 25px 20px;
            text-align: center;
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 15px;
            color: white;
        }

        .stats-card.gares .stats-icon { background: #667eea; }
        .stats-card.bus .stats-icon { background: #f5576c; }
        .stats-card.chauffeurs .stats-icon { background: #4facfe; }
        .stats-card.itineraires .stats-icon { background: #43e97b; }
        .stats-card.voyages .stats-icon { background: #fa709a; }
        .stats-card.paiements .stats-icon { background: #ff9a9e; }

        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
            line-height: 1;
        }

        .stats-label {
            color: #6c757d;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .stats-subtext {
            color: #adb5bd;
            font-size: 0.85rem;
        }

        /* Section de bienvenue */
        .welcome-card {
            border: none;
            border-radius: 15px;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .welcome-card .card-body {
            padding: 40px;
            text-align: center;
        }

        .welcome-card h2 {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .welcome-card p {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-card .card-body {
                padding: 20px 15px;
            }
            
            .stats-number {
                font-size: 1.8rem;
            }
            
            .stats-icon {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stats-card {
            animation: fadeInUp 0.6s ease forwards;
        }
    </style>
</head>

<body class="layout-1" data-luno="theme-blue">
  @include('compagnie.all_element.sidebar')

  <div class="wrapper">
    <header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
      <div class="container-fluid">
        <nav class="navbar">
          @include('compagnie.all_element.navbar')
        </nav>
      </div>
    </header>

    @include('compagnie.all_element.cadre')

    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      @canany(['tableau-de-bord-compagnie', 'tout-les-permissions'])
      <div class="container-fluid">
        <!-- Formulaire de filtre par date -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('dashboardcompagnie_name') }}" method="GET" class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="date_debut" class="form-label">Date de début</label>
                                <input type="date" class="form-control" id="date_debut" name="date_debut" 
                                       value="{{ $dateDebut ?? now()->startOfMonth()->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="date_fin" class="form-label">Date de fin</label>
                                <input type="date" class="form-control" id="date_fin" name="date_fin" 
                                       value="{{ $dateFin ?? now()->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    <span class="btn-text">Filtrer</span>
                                </button>
                                <a href="{{ route('dashboardcompagnie_name') }}" class="btn btn-secondary">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    <span class="btn-text">Rénitialiser</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Première ligne - 3 cartes -->
        <div class="row g-4 mb-4">
          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card stats-card gares">
              <div class="card-body">
                <div class="stats-icon">
                  <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="stats-number">{{ $nombregars ?? 0 }}</div>
                <div class="stats-label">Gares</div>
                <div class="stats-subtext">Points d'arrêt actifs</div>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card stats-card bus">
              <div class="card-body">
                <div class="stats-icon">
                  <i class="fas fa-bus"></i>
                </div>
                <div class="stats-number">{{ $nombres_bus ?? 0 }}</div>
                <div class="stats-label">Bus & Cars</div>
                <div class="stats-subtext">Véhicules en service</div>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card stats-card chauffeurs">
              <div class="card-body">
                <div class="stats-icon">
                  <i class="fas fa-user-tie"></i>
                </div>
                <div class="stats-number">{{ $nombres_chauffeur ?? 0 }}</div>
                <div class="stats-label">Chauffeurs</div>
                <div class="stats-subtext">Personnel conducteur</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Deuxième ligne - 3 cartes -->
        <div class="row g-4">
          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card stats-card itineraires">
              <div class="card-body">
                <div class="stats-icon">
                  <i class="fas fa-route"></i>
                </div>
                <div class="stats-number">{{ $nombres_itineraire ?? 0 }}</div>
                <div class="stats-label">Itinéraires</div>
                <div class="stats-subtext">Trajets définis</div>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card stats-card voyages">
              <div class="card-body">
                <div class="stats-icon">
                  <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="stats-number">{{ $nombres_voyage ?? 0 }}</div>
                <div class="stats-label">Voyages</div>
                <div class="stats-subtext">Programmés ce mois</div>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card stats-card paiements">
              <div class="card-body">
                <div class="stats-icon">
                  <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stats-number">{{ isset($somme) ? number_format($somme, 0, ',', ' ') : '0' }} FCFA</div>
                <div class="stats-label">Revenus</div>
                <div class="stats-subtext">FCFA</div>
              </div>
            </div>
          </div>

            <!-- Section des graphiques -->
            <div class="container-fluid mt-4">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
                        <h5 class="card-title mb-0">Statistiques des réservations</h5>
                        {{-- <form method="GET" class="d-flex">
                            <div class="input-group input-group-sm me-2" style="width: 200px;">
                                <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                <input type="date" name="date_debut" class="form-control form-control-sm" value="{{ $dateDebut }}">
                            </div>
                            <div class="input-group input-group-sm me-2" style="width: 200px;">
                                <span class="input-group-text">au</span>
                                <input type="date" name="date_fin" class="form-control form-control-sm" value="{{ $dateFin }}">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-filter"></i> Filtrer
                            </button>
                        </form> --}}
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-1">Total des réservations</h6>
                                        <h3 class="mb-0 text-primary">{{ number_format($chartData['total_reservations'], 0, ',', ' ') }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-1">Réservations confirmées</h6>
                                        <h3 class="mb-0 text-success">{{ number_format($chartData['reservations_confirmees'], 0, ',', ' ') }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-1">Réservations annulées</h6>
                                        <h3 class="mb-0 text-danger">{{ number_format($chartData['reservations_annulees'], 0, ',', ' ') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart-container" style="position: relative; height: 400px;">
                                    <canvas id="reservationsChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-white">
                                        <h5 class="card-title mb-0">Chiffre d'affaires</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container" style="position: relative; height: 300px;">
                                            <canvas id="caChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  
        </div>
      </div>
      @else




      <!-- Message de bienvenue -->
      <div class="container-fluid">
         <div class="row mb-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('dashboardcompagnie_name') }}" method="GET" class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="date_debut" class="form-label">Date de début</label>
                                <input type="date" class="form-control" id="date_debut" name="date_debut" 
                                       value="{{ $dateDebut ?? now()->startOfMonth()->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="date_fin" class="form-label">Date de fin</label>
                                <input type="date" class="form-control" id="date_fin" name="date_fin" 
                                       value="{{ $dateFin ?? now()->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    <span class="btn-text">Filtrer</span>
                                </button>
                                <a href="{{ route('dashboardcompagnie_name') }}" class="btn btn-secondary">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    <span class="btn-text">Rénitialiser</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Première ligne - 3 cartes -->
        
          {{-- <div class="card-body">
            <h2>Bienvenue {{ Auth::user()->name }} 👋</h2>
            <p>Vous êtes connecté à votre espace personnel BETRO</p>
            <p class="mb-4">Contactez l'administrateur pour obtenir les permissions nécessaires</p>
            <div class="mt-4">
              <i class="fas fa-clock fa-2x text-muted"></i>
              <p class="mt-2 mb-0 text-muted">En attente d'activation</p>
            </div>
          </div> --}}

          

          <div class="row g-4">
          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card stats-card itineraires">
              <div class="card-body">
                <div class="stats-icon">
                  <i class="fas fa-route"></i>
                </div>
                <div class="stats-number">{{ $nombres_itineraire ?? 0 }}</div>
                <div class="stats-label">Itinéraires</div>
                <div class="stats-subtext">Trajets définis</div>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card stats-card voyages">
              <div class="card-body">
                <div class="stats-icon">
                  <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="stats-number">{{ $nombres_voyage ?? 0 }}</div>
                <div class="stats-label">Voyages</div>
                <div class="stats-subtext">Programmés ce mois</div>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card stats-card paiements">
              <div class="card-body">
                <div class="stats-icon">
                  <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stats-number">{{ isset($somme) ? number_format($somme, 0, ',', ' ') : '0' }} FCFA</div>
                <div class="stats-label">Revenus</div>
                <div class="stats-subtext">FCFA</div>
              </div>
            </div>
          </div>

            <!-- Section des graphiques -->
            <div class="container-fluid mt-4">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
                        <h5 class="card-title mb-0">Statistiques des réservations</h5>
                        {{-- <form method="GET" class="d-flex">
                            <div class="input-group input-group-sm me-2" style="width: 200px;">
                                <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                <input type="date" name="date_debut" class="form-control form-control-sm" value="{{ $dateDebut }}">
                            </div>
                            <div class="input-group input-group-sm me-2" style="width: 200px;">
                                <span class="input-group-text">au</span>
                                <input type="date" name="date_fin" class="form-control form-control-sm" value="{{ $dateFin }}">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-filter"></i> Filtrer
                            </button>
                        </form> --}}
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-1">Total des réservations</h6>
                                        <h3 class="mb-0 text-primary">{{ number_format($chartData['total_reservations'], 0, ',', ' ') }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-1">Réservations confirmées</h6>
                                        <h3 class="mb-0 text-success">{{ number_format($chartData['reservations_confirmees'], 0, ',', ' ') }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-1">Réservations annulées</h6>
                                        <h3 class="mb-0 text-danger">{{ number_format($chartData['reservations_annulees'], 0, ',', ' ') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart-container" style="position: relative; height: 400px;">
                                    <canvas id="reservationsChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-white">
                                        <h5 class="card-title mb-0">Chiffre d'affaires</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container" style="position: relative; height: 300px;">
                                            <canvas id="caChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  
        </div>
        <div class="card welcome-card">

        </div>
      </div>



      @endcanany
    </div>

    @include('compagnie.all_element.footer')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../assets/js/theme.js"></script>
  <script>
    // Gestion des spinners pour les boutons
    document.addEventListener('DOMContentLoaded', function() {
        // Gérer le formulaire de filtre
        const filterForms = document.querySelectorAll('form[action="{{ route('dashboardcompagnie_name') }}"]');
        
        filterForms.forEach(form => {
            const submitBtn = form.querySelector('button[type="submit"]');
            const resetBtn = form.querySelector('a.btn-secondary');
            
            // Spinner pour le bouton Filtrer
            if (submitBtn) {
                form.addEventListener('submit', function() {
                    const spinner = submitBtn.querySelector('.spinner-border');
                    const btnText = submitBtn.querySelector('.btn-text');
                    
                    if (spinner && btnText) {
                        spinner.classList.remove('d-none');
                        btnText.textContent = 'Chargement...';
                        submitBtn.disabled = true;
                    }
                });
            }
            
            // Spinner pour le bouton Réinitialiser
            if (resetBtn) {
                resetBtn.addEventListener('click', function(e) {
                    const spinner = resetBtn.querySelector('.spinner-border');
                    const btnText = resetBtn.querySelector('.btn-text');
                    
                    if (spinner && btnText) {
                        spinner.classList.remove('d-none');
                        btnText.textContent = 'Chargement...';
                        resetBtn.style.pointerEvents = 'none';
                    }
                });
            }
        });
    });

    // Données passées depuis le contrôleur
    const chartData = @json($chartData);
    
    // Fonction pour formater les nombres
    function formatNumber(number) {
        return new Intl.NumberFormat('fr-FR').format(number);
    }
    
    // Fonction pour formater les montants en FCFA
    function formatMoney(amount) {
        return formatNumber(amount) + ' FCFA';
    }
    
    // Initialisation des graphiques au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        // Graphique des réservations
        const ctxReservations = document.getElementById('reservationsChart').getContext('2d');
        const reservationsChart = new Chart(ctxReservations, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Nombre de réservations',
                    data: chartData.reservations,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Évolution des réservations par jour',
                        font: {
                            size: 16
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${formatNumber(context.raw)}`;
                            }
                        }
                    },
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return formatNumber(value);
                            }
                        }
                    }
                }
            }
        });

        // Graphique du chiffre d'affaires
        const ctxCA = document.getElementById('caChart').getContext('2d');
        const caChart = new Chart(ctxCA, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: "Chiffre d'affaires (FCFA)",
                    data: chartData.ca,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: "Évolution du chiffre d'affaires par jour",
                        font: {
                            size: 16
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Benefice: ${formatMoney(context.raw)}`;
                            }
                        }
                    },
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return formatMoney(value);
                            }
                        }
                    }
                }
            }
        });
    });
    // Données de démonstration (à remplacer par des données réelles)
    const demoData = {
        '2024-01-01': { reservations: 5, ca: 25000, couts: 15000 },
        '2024-01-02': { reservations: 8, ca: 40000, couts: 22000 },
        '2024-01-03': { reservations: 12, ca: 60000, couts: 32000 },
        '2024-01-04': { reservations: 6, ca: 30000, couts: 18000 },
        '2024-01-05': { reservations: 15, ca: 75000, couts: 40000 },
        '2024-01-06': { reservations: 9, ca: 45000, couts: 25000 },
        '2024-01-07': { reservations: 11, ca: 55000, couts: 30000 },
        '2024-01-08': { reservations: 7, ca: 35000, couts: 20000 },
        '2024-01-09': { reservations: 14, ca: 70000, couts: 38000 },
        '2024-01-10': { reservations: 10, ca: 50000, couts: 28000 }
    };

    // Fonction pour formater la date au format YYYY-MM-DD
    function formatDate(date) {
        return date.toISOString().split('T')[0];
    }
    
    // Fonction pour formater un nombre en devise
    function formatMoney(amount) {
        return new Intl.NumberFormat('fr-FR', { style: 'decimal' }).format(amount) + ' FCFA';
    }

    // Fonction pour obtenir les 7 derniers jours
    function getLast7Days() {
        const result = [];
        for (let i = 6; i >= 0; i--) {
            const d = new Date();
            d.setDate(d.getDate() - i);
            result.push(formatDate(d));
        }
        return result;
    }

    // Initialisation des dates par défaut (7 derniers jours)
    const endDate = new Date();
    const startDate = new Date();
    startDate.setDate(startDate.getDate() - 6);

    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation des champs de date
        const dateDebut = document.getElementById('dateDebut');
        const dateFin = document.getElementById('dateFin');
        const btnFiltrer = document.getElementById('btnFiltrer');
        
        // Définir les dates par défaut
        dateDebut.value = formatDate(startDate);
        dateFin.value = formatDate(endDate);

        // Animation des cartes
        const cards = document.querySelectorAll('.stats-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Initialisation des graphiques
        const ctxReservations = document.getElementById('reservationsChart').getContext('2d');
        const ctxBenefices = document.getElementById('beneficesChart').getContext('2d');
        let reservationsChart = null;
        let beneficesChart = null;

        // Fonction pour mettre à jour les graphiques
        function updateCharts(start, end) {
            // Ici, vous devriez faire un appel AJAX pour récupérer les données réelles
            // Pour l'instant, nous utilisons des données de démonstration
            const labels = [];
            const reservationsData = [];
            const caData = [];
            const coutsData = [];
            const beneficesData = [];
            
            // Variables pour les totaux
            let totalCA = 0;
            let totalCout = 0;
            let totalBenefice = 0;
            
            // Générer les dates entre start et end
            const currentDate = new Date(start);
            while (currentDate <= new Date(end)) {
                const dateStr = formatDate(currentDate);
                const dateLabel = new Intl.DateTimeFormat('fr-FR', { weekday: 'short', day: 'numeric' }).format(currentDate);
                
                // Utiliser les données de démonstration ou des valeurs par défaut
                const dataPoint = demoData[dateStr] || { 
                    reservations: Math.floor(Math.random() * 10) + 1,
                    ca: Math.floor(Math.random() * 50000) + 10000,
                    couts: Math.floor(Math.random() * 30000) + 5000
                };
                
                const benefice = dataPoint.ca - dataPoint.couts;
                
                labels.push(dateLabel);
                reservationsData.push(dataPoint.reservations);
                caData.push(dataPoint.ca);
                coutsData.push(dataPoint.couts);
                beneficesData.push(benefice);
                
                // Mettre à jour les totaux
                totalCA += dataPoint.ca;
                totalCout += dataPoint.couts;
                totalBenefice += benefice;
                
                currentDate.setDate(currentDate.getDate() + 1);
            }

            // Mettre à jour les totaux dans l'interface
            document.getElementById('totalCA').textContent = formatMoney(totalCA);
            document.getElementById('totalCout').textContent = formatMoney(totalCout);
            document.getElementById('beneficeNet').textContent = formatMoney(totalBenefice);

            // Détruire les graphiques existants s'ils existent
            if (reservationsChart) {
                reservationsChart.destroy();
            }
            if (beneficesChart) {
                beneficesChart.destroy();
            }

            // Créer le graphique des réservations
            reservationsChart = new Chart(ctxReservations, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Réservations',
                        data: reservationsData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: 'white',
                        pointBorderColor: 'rgba(54, 162, 235, 1)',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: getChartOptions(`Réservations du ${new Date(start).toLocaleDateString('fr-FR')} au ${new Date(end).toLocaleDateString('fr-FR')}`, 'nombre')
            });

            // Créer le graphique des bénéfices
            beneficesChart = new Chart(ctxBenefices, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Chiffre d\'affaires',
                            data: caData,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Coûts',
                            data: coutsData,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Bénéfice net',
                            data: beneficesData,
                            type: 'line',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 2,
                            fill: false,
                            pointBackgroundColor: 'white',
                            pointBorderColor: 'rgba(153, 102, 255, 1)',
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            yAxisID: 'y'
                        }
                    ]
                },
                options: getChartOptions(`Bénéfices du ${new Date(start).toLocaleDateString('fr-FR')} au ${new Date(end).toLocaleDateString('fr-FR')}`, 'argent')
            });
        }
        
        // Fonction pour obtenir les options des graphiques
        function getChartOptions(title, dataType) {
            return {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: title,
                        font: {
                            size: 16
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (dataType === 'argent') {
                                    label += formatMoney(context.raw);
                                } else {
                                    label += context.raw;
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return dataType === 'argent' ? formatMoney(value) : value;
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            };
        }

        // Mettre à jour les graphiques avec les dates par défaut
        updateCharts(dateDebut.value, dateFin.value);

        // Gérer le clic sur le bouton de filtre
        btnFiltrer.addEventListener('click', function() {
            if (new Date(dateDebut.value) > new Date(dateFin.value)) {
                alert('La date de début doit être antérieure à la date de fin');
                return;
            }
            updateCharts(dateDebut.value, dateFin.value);
        });
        
        // Initialiser les onglets
        const triggerTabList = [].slice.call(document.querySelectorAll('#statsTabs button'));
        triggerTabList.forEach(triggerEl => {
            const tabTrigger = new bootstrap.Tab(triggerEl);
            
            triggerEl.addEventListener('click', function (event) {
                event.preventDefault();
                tabTrigger.show();
                // Redessiner les graphiques pour s'assurer qu'ils s'affichent correctement
                setTimeout(() => {
                    if (reservationsChart) reservationsChart.resize();
                    if (beneficesChart) beneficesChart.resize();
                }, 200);
            });
        });
    });
  </script>
  
  <!-- Inclure Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
</html>