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
                
                <!-- Bouton retour -->
                <div class="mb-3 text-end">
    <a href="{{ route('personnel.index') }}" class="btn">
        <i class="fa fa-arrow-left me-2"></i>Retour à la liste
    </a>
</div>


                <!-- Carte principale -->
                <div class="row g-3">
                    <!-- Colonne gauche : Photo et actions -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <!-- Photo profil -->
                                <div class="profile-img-wrapper mb-3">
                                    <img src="{{ $personnel->photo ? asset($personnel->photo) : asset('assets/img/default-user.png') }}" 
                                         alt="Photo de {{ $personnel->prenom ?? '' }} {{ $personnel->nom ?? '' }}" 
                                         class="profile-img">
                                </div>
                                
                                <!-- Nom complet -->
                                <h4 class="mb-2">
                                    {{ $personnel->prenom ?? '' }} {{ $personnel->nom ?? '' }}
                                </h4>
                                
                                <!-- Rôle -->
                                <p class="text-muted mb-3">
                                    <i class="fa fa-briefcase me-2"></i>
                                    {{ $personnel->RolePersonnel->nom_role ?? 'Non défini' }}
                                </p>
                                
                                <!-- Statut -->
                                <span class="badge {{ $personnel->status ? 'bg-success' : 'bg-danger' }} fs-6 py-2 px-4 mb-3">
                                    <i class="fa {{ $personnel->status ? 'fa-check-circle' : 'fa-times-circle' }} me-2"></i>
                                    {{ $personnel->status ? 'Actif' : 'Inactif' }}
                                </span>

                                <!-- Bouton modifier -->
                                <div class="d-grid mt-3">
                                    <a href="{{ route('personnel.edit', $personnel->id) }}" class="btn btn-primary">
                                        <i class="fa fa-edit me-2"></i>Modifier
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Colonne droite : Informations détaillées -->
                    <div class="col-lg-8">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title mb-4">
                                    <i class="fa fa-info-circle text-primary me-2"></i>
                                    Informations personnelles
                                </h5>
                                
                                <div class="row g-3">
                                    <!-- Nom -->
                                    <div class="col-md-6">
                                        <div class="info-box">
                                            <div class="info-icon bg-primary">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="info-content">
                                                <small class="text-muted">Nom</small>
                                                <strong class="d-block">{{ $personnel->nom ?? 'Non renseigné' }}</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Prénom -->
                                    <div class="col-md-6">
                                        <div class="info-box">
                                            <div class="info-icon bg-primary">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="info-content">
                                                <small class="text-muted">Prénom</small>
                                                <strong class="d-block">{{ $personnel->prenom ?? 'Non renseigné' }}</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="info-box">
                                            <div class="info-icon bg-warning">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <div class="info-content">
                                                <small class="text-muted">Email</small>
                                                <strong class="d-block text-break">{{ $personnel->email ?? 'Non renseigné' }}</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Téléphone -->
                                    <div class="col-md-6">
                                        <div class="info-box">
                                            <div class="info-icon bg-success">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <div class="info-content">
                                                <small class="text-muted">Téléphone</small>
                                                <strong class="d-block">(+225) {{ $personnel->telephone ?? 'Non renseigné' }}</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rôle -->
                                    <div class="col-12">
                                        <div class="info-box">
                                            <div class="info-icon bg-info">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="info-content">
                                                <small class="text-muted">Rôle</small>
                                                <strong class="d-block">{{ $personnel->RolePersonnel->nom_role ?? 'Non défini' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Métadonnées -->
                                <div class="mt-4 pt-3 border-top">
                                    <small class="text-muted">
                                        <i class="fa fa-calendar me-2"></i>
                                        Créé le : {{ $personnel->created_at ? $personnel->created_at->format('d/m/Y à H:i') : 'N/A' }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @include('compagnie.all_element.footer')
    </div>

    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

    <style>
        /* Image profil */
        .profile-img-wrapper {
            position: relative;
            display: inline-block;
        }

        .profile-img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #f8f9fa;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.05);
        }

        /* Conteneurs d'information */
        .info-box {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.3s ease;
            height: 100%;
        }

        .info-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            background: #fff;
        }

        /* Icônes */
        .info-icon {
            width: 45px;
            height: 45px;
            min-width: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            margin-right: 1rem;
            color: white;
        }

        .info-content {
            flex: 1;
            min-width: 0;
        }

        .info-content strong {
            word-wrap: break-word;
        }

        /* Cartes */
        .card {
            border: none;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.12) !important;
        }

        /* Badge statut */
        .badge {
            font-weight: 500;
        }

        /* Boutons */
        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-img {
                width: 150px;
                height: 150px;
            }

            .info-box {
                padding: 0.75rem;
            }

            .info-icon {
                width: 38px;
                height: 38px;
                min-width: 38px;
                margin-right: 0.75rem;
            }
        }

        @media print {
            .btn {
                display: none !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #dee2e6 !important;
            }
        }
    </style>

</body>
</html>