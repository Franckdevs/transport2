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
                <div class="stats-number">{{ number_format($somme ?? 0, 0, ',', ' ') }} FCFA</div>
                <div class="stats-label">Revenus</div>
                <div class="stats-subtext">FCFA ce mois</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @else
      <!-- Message de bienvenue -->
      <div class="container-fluid">
        <div class="card welcome-card">
          <div class="card-body">
            <h2>Bienvenue {{ Auth::user()->name }} 👋</h2>
            <p>Vous êtes connecté à votre espace personnel BETRO</p>
            <p class="mb-4">Contactez l'administrateur pour obtenir les permissions nécessaires</p>
            <div class="mt-4">
              <i class="fas fa-clock fa-2x text-muted"></i>
              <p class="mt-2 mb-0 text-muted">En attente d'activation</p>
            </div>
          </div>
        </div>
      </div>
      @endcanany
    </div>

    @include('compagnie.all_element.footer')
  </div>

  <script src="../assets/js/theme.js"></script>
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

  <script>
    // Animation simple au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.stats-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
  </script>
</body>
</html>