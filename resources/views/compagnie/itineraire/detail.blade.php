@include('compagnie.all_element.header')

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
            <div class="container-fluid">


                <div class="row">
                    <div class="col-12 animate-fadeInUp">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="section-title mb-0">
                      Détails de l'itinéraire
                    </h4>
                    <a href="{{ route('itineraire.index') }}" class="btn" title="Retour">
                        <i class="fa fa-arrow-left me-2"></i> Retour à la liste
                    </a>
                </div>

                        <!-- Carte des informations principales -->
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <i class="fas fa-city text-primary me-2"></i>
                                            <label class="form-label text-muted fw-semibold">Ville de départ</label>
                                            <p class="fs-5 fw-bold text-dark mb-0">{{ $voyage->ville->nom_ville ?? 'Non défini' }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <i class="fas fa-clock text-success me-2"></i>
                                            <label class="form-label text-muted fw-semibold">Estimation du trajet (H:min)</label>
                                            <p class="fs-5 fw-bold text-dark mb-0">{{ $voyage->estimation ?? 'Non défini' }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <i class="fas fa-heading text-info me-2"></i>
                                            <label class="form-label text-muted fw-semibold">Titre du trajet</label>
                                            <p class="fs-5 fw-bold text-dark mb-0">{{ $voyage->titre ?? 'Non défini' }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <i class="fas fa-calendar text-warning me-2"></i>
                                            <label class="form-label text-muted fw-semibold">Date de création</label>
                                            <p class="fs-5 fw-bold text-dark mb-0">{{ $voyage->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <i class="fas  text me-2"></i>
                                            <label class="form-label text-muted fw-semibold">Statut</label>
                                            <div>
                                                @if ($voyage->status == 1)
                                                <span class="badge bg-success">Actif</span>
                                                @else
                                                <span class="badge bg-danger">Désactiver</span>
                                                @endif
                                                {{-- <span class="badge  {{ $voyage->status == 1 ? 'active' : 'inactive' }} "> --}}
                                                    {{-- {{ $voyage->status == 1 ? '🟢 Actif' : '🔴 Inactif' }} --}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Section Arrêts améliorée -->
                       <div class="card shadow-sm border-0">
    <div class="card-header bg-transparent border-0 py-3">
        <h5 class="fw-semibold mb-0 text-primary">
            <i class="fas fa-map-marker-alt me-2"></i>Arrêts du voyage
            <span class="badge bg-primary ms-2">{{ $voyage->arrets->count() ?? 0 }}</span>
        </h5>
    </div>
    <div class="card-body">
        @if ($voyage->arrets && $voyage->arrets->count() > 0)
            <div class="voyage-stops">
                @foreach ($voyage->arrets as $index => $arret)
                    @php
                        $gare = $arret->gare->nom_gare ?? 'Gare non définie';
                        $ville = $arret->gare->ville->nom_ville ?? 'Ville non définie';
                        $isLast = $index == $voyage->arrets->count() - 1;
                        $isSingle = $voyage->arrets->count() == 1;
                    @endphp
                    <div class="stop-item animate-slideInLeft" style="animation-delay: {{ $index * 0.1 }}s;">
                        <div class="stop-marker">
                            <div class="marker-dot {{ $index == 0 ? 'first' : ($isLast ? 'last' : 'middle') }}">
                                @if($isLast && $isSingle)
                                    <i class="fas fa-flag-checkered"></i>
                                @else
                                    {{ $index + 1 }}
                                @endif
                            </div>
                        </div>
                        <div class="stop-content">
                            <div class="stop-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">{{ $gare }}</h6>
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-city me-1"></i>{{ $ville }}
                                        </p>
                                    </div>
                                    <span class="badge {{ $isLast ? 'bg-success' : 'bg-light' }} text-dark">
                                        @if($isLast)
                                            🏁 Destination finale
                                        @else
                                            Arrêt {{ $index + 1 }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-route text-muted mb-3" style="font-size: 3rem;"></i>
                <p class="text-muted fst-italic mb-0">Aucun arrêt défini pour ce voyage.</p>
            </div>
        @endif
    </div>
</div>

                    </div>
                </div>
            </div>
        </div>

        @include('compagnie.all_element.footer')
    </div>

    <!-- Scripts -->
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        /* Animations légères */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes slideInLeft {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slideInLeft {
            animation: slideInLeft 0.5s ease forwards;
        }

        /* Badge statut amélioré */
        .statut-badge.active {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
            border: none;
        }

        .statut-badge.inactive {
            background: linear-gradient(135deg, #dc3545, #e83e8c);
            color: #fff;
            border: none;
        }

        /* Bouton hover */
        .btn-hover {
            transition: all 0.3s ease;
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        /* Items d'information */
        .info-item {
            padding: 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background-color: #f8f9fa;
        }

        /* Timeline des arrêts */
        .voyage-stops {
            position: relative;
            padding-left: 3rem;
        }

        .voyage-stops::before {
            content: '';
            position: absolute;
            left: 1.5rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, #007bff, #28a745);
            border-radius: 2px;
        }

        .stop-item {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .stop-marker {
            position: absolute;
            left: -3rem;
            top: 0;
        }

        .marker-dot {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .marker-dot.first {
            background: linear-gradient(135deg, #007bff, #0056b3);
        }

        .marker-dot.middle {
            background: linear-gradient(135deg, #6c757d, #495057);
        }

        .marker-dot.last {
            background: linear-gradient(135deg, #28a745, #1e7e34);
        }

        .stop-content {
            margin-left: 0;
        }

        .stop-card {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .stop-card:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-left: 3px solid #007bff;
        }

        /* Cartes améliorées */
        .card {
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .voyage-stops {
                padding-left: 2.5rem;
            }
            
            .voyage-stops::before {
                left: 1.25rem;
            }
            
            .stop-marker {
                left: -2.5rem;
            }
            
            .marker-dot {
                width: 2rem;
                height: 2rem;
                font-size: 0.8rem;
            }
        }
    </style>
</body>
</html>