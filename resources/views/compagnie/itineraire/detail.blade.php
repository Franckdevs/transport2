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

                    <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">
                </h5>
                <a href="{{ route('itineraire.index') }}" class="btn btn-light" title="Retour">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </div>


                <div class="row">
                    <div class="col-12 animate-fadeInUp">

                        <h3 class="mb-4 text-primary fw-bold border-start border-5 border-primary ps-3"
                            style="letter-spacing: 1.2px;">
                            Détails du voyage
                        </h3>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Ville de départ</label>
                                <p class="fs-5 mb-0">{{ $voyage->ville->nom_ville ?? 'Non défini' }}</p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Estimation du trajet (H:min)</label>
                                <p class="fs-5 mb-0">{{ $voyage->estimation ?? 'Non défini' }}</p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Titre du trajet</label>
                                <p class="fs-5 mb-0">{{ $voyage->titre ?? 'Non défini' }}</p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Date de création</label>
                                <p class="fs-5 mb-0">{{ $voyage->created_at->format('d/m/Y H:i') }}</p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted fw-semibold">Statut</label>
                                <div>
                                    <span
                                        class="badge statut-badge {{ $voyage->statut == 1 ? 'active' : 'inactive' }} fs-6 px-3 py-2 rounded-pill">
                                        {{ $voyage->statut == 1 ? 'Actif' : 'Inactif' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-semibold mb-3 text-secondary">Arrêts du voyage</h5>

                    @if ($voyage->arrets && $voyage->arrets->count() > 0)
    <ul class="list-group list-group-flush">
        @foreach ($voyage->arrets as $index => $arret)
            @php
                $total = $voyage->arrets->count();
                if ($index == 0) {
                    $label = 'Ville de départ';
                } elseif ($index == $total - 1) {
                    $label = 'Ville d\'arrivée';
                } else {
                    $label = 'Arrêt';
                }
            @endphp
            <li class="list-group-item d-flex align-items-center border-0 px-0 py-2 animate-slideInLeft">
                <i class="fas fa-map-marker-alt text-primary fs-5 me-3"></i>
                <span class="fs-6 text-dark">
                    <strong>{{ $label }} :</strong> {{ $arret->nom ?? 'Nom non défini' }}
                </span>
            </li>
        @endforeach
    </ul>
@else
    <p class="text-muted fst-italic">Aucun arrêt défini pour ce voyage.</p>
@endif


                        {{-- <a href="{{ route('itineraire.index') }}" class="btn btn-primary mt-4 shadow-sm btn-hover-scale">
                            <i class="fas fa-arrow-left me-2"></i> Retour à la liste
                        </a> --}}

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
        /* Animations */
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
            animation: fadeInUp 0.7s ease forwards;
        }

        @keyframes slideInLeft {
            0% {
                opacity: 0;
                transform: translateX(-30px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slideInLeft {
            animation: slideInLeft 0.5s ease forwards;
        }

        /* Badge dynamique */
        .statut-badge.active {
            background: linear-gradient(45deg, #007bff, #007bffff);
            color: #fff;
            box-shadow: 0 0 8px #007bffaa;
            animation: pulse 2s infinite;
        }

        .statut-badge.inactive {
            background: #6c757d;
            color: #fff;
            opacity: 0.8;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 8px #007bffaa;
            }
            50% {
                box-shadow: 0 0 20px #007bffff;
            }
        }

        /* Hover retour */
        .btn-hover-scale:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px #007bff;
        }

        .btn-hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
    </style>
</body>

</html>
