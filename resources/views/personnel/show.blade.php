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
                <!-- En-tête avec boutons d'action -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="page-title mb-0">
                        <i class="fas fa-user-circle me-2"></i>Détails du membre du personnel
                    </h1>
                    <div class="ms-auto">
                     
                        <a href="{{ route('personnel.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Colonne gauche : Photo et informations principales -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-id-card me-2"></i>Photo de profil
                                </h5>
                            </div>
                            <div class="card-body text-center">
                                <!-- Photo profil -->
                                <div class="profile-img-wrapper mb-4">
                                    <img src="{{ $personnel->photo ? asset($personnel->photo) : asset('assets/img/default-user.png') }}" 
                                         alt="Photo de {{ $personnel->prenom ?? '' }} {{ $personnel->nom ?? '' }}" 
                                         class="img-thumbnail rounded-circle"
                                         style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                                
                                <!-- Nom complet -->
                                <h3 class="mb-2">
                                    {{ $personnel->prenom ?? '' }} {{ $personnel->nom ?? '' }}
                                </h3>
                                
                                <!-- Rôle -->
                                <p class="text-muted mb-4">
                                    <i class="fas fa-briefcase me-2"></i>
                                    <span class="badge bg-primary">
                                        {{ $personnel->RolePersonnel->nom_role ?? 'Non défini' }}
                                    </span>
                                </p>
                                
                                <!-- Statut -->
                                <span class="badge {{ $personnel->status ? 'bg-success' : 'bg-danger' }} fs-6 py-2 px-4 mb-3">
                                    <i class="fa {{ $personnel->status ? 'fa-check-circle' : 'fa-times-circle' }} me-2"></i>
                                    {{ $personnel->status ? 'Actif' : 'Inactif' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Colonne droite : Détails -->
                    <div class="col-lg-8">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Informations personnelles
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th width="30%"><i class="fas fa-user me-2 text-muted"></i>Nom complet</th>
                                            <td>{{ $personnel->prenom ?? '' }} {{ $personnel->nom ?? 'Non renseigné' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="fas fa-phone me-2 text-muted"></i>Téléphone</th>
                                            <td>
                                                @if($personnel->telephone)
                                                    <a href="tel:{{ $personnel->telephone }}" class="text-decoration-none">
                                                        <i class="fas fa-phone-alt me-2"></i>{{ $personnel->telephone }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">Non renseigné</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><i class="fas fa-envelope me-2 text-muted"></i>Email</th>
                                            <td>
                                                @if($personnel->email)
                                                    <a href="mailto:{{ $personnel->email }}" class="text-decoration-none">
                                                        <i class="fas fa-envelope me-2"></i>{{ $personnel->email }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">Non renseigné</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><i class="fas fa-briefcase me-2 text-muted"></i>Fonction</th>
                                            <td>
                                                <span class="badge bg-primary">
                                                    {{ $personnel->RolePersonnel->nom_role ?? 'Non défini' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- <th><i class="fas fa-toggle-on me-2 text-muted"></i>Statut</th>
                                            <td>
                                                @if($personnel->est_actif)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i> Actif
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times-circle me-1"></i> Inactif
                                                    </span>
                                                @endif
                                            </td> --}}
                                        </tr>
                                        <tr>
                                            <th><i class="far fa-calendar-plus me-2 text-muted"></i>Date d'ajout</th>
                                            <td>
                                                {{ $personnel->created_at ? $personnel->created_at->format('d/m/Y H:i') : 'Non disponible' }}
                                                @if($personnel->created_at)
                                                    <small class="text-muted d-block">({{ $personnel->created_at->diffForHumans() }})</small>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><i class="far fa-calendar-check me-2 text-muted"></i>Dernière mise à jour</th>
                                            <td>
                                                {{ $personnel->updated_at ? $personnel->updated_at->format('d/m/Y H:i') : 'Non disponible' }}
                                                @if($personnel->updated_at && $personnel->updated_at != $personnel->created_at)
                                                    <small class="text-muted d-block">({{ $personnel->updated_at->diffForHumans() }})</small>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @include('compagnie.all_element.footer')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
    <script src="../assets/js/plugins/apexcharts.js"></script>
    
    <script>
        // Initialisation des tooltips Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Initialisation du modal de suppression
            var deleteModal = document.getElementById('deleteModal');
            if (deleteModal) {
                var modal = new bootstrap.Modal(deleteModal);
            }
        });
    </script>
</body>
</html>

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