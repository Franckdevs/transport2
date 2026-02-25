    @include('compagnie.all_element.header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #ffc107;
            --primary-light: #ffecb3;
            --secondary: #6c757d;
            --success: #2ecc71;
            --warning: #f39c12;
            --danger: #e74c3c;
            --light: #f8f9fa;
            --dark: #2c3e50;
            --border: #e9ecef;
        }
        
        body {
            background: #f8f9fa;
            /* font-family: 'Segoe UI', system-ui, sans-serif; */
        }

        /* Carte principale */
        .profile-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            overflow: hidden;
            background: white;
        }

        .profile-sidebar {
            background: linear-gradient(135deg, var(--primary) 0%, #ffa000 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .profile-img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255,255,255,0.2);
            margin-bottom: 1rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
        }

        /* Contenu principal */
        .profile-content {
            padding: 2rem;
        }

        .section-title {
            color: var(--dark);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-light);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Cartes d'information */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-card {
            background: var(--light);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1.25rem;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            border-color: var(--primary);
        }

        .info-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .icon-phone { background: rgba(52, 152, 219, 0.1); color: var(--primary); }
        .icon-permis { background: rgba(243, 156, 18, 0.1); color: var(--warning); }
        .icon-calendar { background: rgba(46, 204, 113, 0.1); color: var(--success); }
        .icon-user { background: rgba(155, 89, 182, 0.1); color: #9b59b6; }
        .icon-location { background: rgba(52, 73, 94, 0.1); color: #34495e; }

        .info-label {
            color: var(--secondary);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: var(--dark);
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
        }

        /* Actions */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: #ffa000;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
            color: #212529;
        }

        .btn-outline-secondary {
            background: transparent;
            color: var(--secondary);
            border: 1px solid var(--secondary);
        }

        .btn-outline-secondary:hover {
            background: var(--secondary);
            color: white;
            transform: translateY(-2px);
        }

        /* Métadonnées */
        .metadata {
            background: var(--light);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 2rem;
            border-left: 4px solid var(--primary);
        }

        .metadata-text {
            color: var(--secondary);
            font-size: 0.9rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-sidebar {
                padding: 1.5rem;
            }
            
            .profile-content {
                padding: 1.5rem;
            }
            
            .profile-img {
                width: 120px;
                height: 120px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .profile-sidebar,
            .profile-content {
                padding: 1rem;
            }
        }
         .info-badge {
            background: rgba(52, 152, 219, 0.1);
            color: var(--primary);
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
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
            <div class="container-fluid">
                <!-- En-tête avec bouton à droite -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                   
                    <div class="ms-auto">
                        <a href="{{ route('chauffeur.index') }}" class="btn btn-light border">
              <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
                    </div>
                </div>

                <!-- Carte de profil -->
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="profile-card">
                            <div class="row g-0">

                                {{-- <div class="info-badge">
                                    <i class="fas fa-info-circle"></i>
                                    Vous modifiez les informations de 
                                </div> --}}
                                <!-- Sidebar avec photo -->
                                <div class="col-lg-4 profile-sidebar">
                                    <div class="d-flex flex-column align-items-center h-100">
                                        <img src="{{ $chauffeur->photo ? url($chauffeur->photo) : asset('assets/img/default-user.png') }}" 
                                             class="profile-img" 
                                             alt="Photo du chauffeur">
                                        
                                        <h3 class="h4 mb-2">{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</h3>
                                        
                                        <div class="status-badge">
                                            <i class="fas {{ $chauffeur->status == 1 ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                            {{ $chauffeur->status == 1 ? 'Activé' : 'Désactivé' }}
                                        </div>

                                        <div class="mt-3 text-center">
                                            <small class="opacity-75">
                                                <i class="fas fa-id-card me-1"></i>
                                                Chauffeur professionnel
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Contenu principal -->
                                <div class="col-lg-8 profile-content">
                                    <h4 class="section-title">
                                        <i class="fas fa-info-circle text-warning"></i>
                                        Informations personnelles
                                    </h4>
                                    
                                    <div class="info-grid">
                                        <!-- Téléphone -->
                                        <div class="info-card">
                                            <div class="info-icon icon-phone">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div class="info-label">Téléphone</div>
                                            <div class="info-value">{{ $chauffeur->telephone ?? 'Non renseigné' }}</div>
                                        </div>
                                        
                                        <!-- Numéro de permis -->
                                        <div class="info-card">
                                            <div class="info-icon icon-permis">
                                                <i class="fas fa-id-card"></i>
                                            </div>
                                            <div class="info-label">Numéro de permis</div>
                                            <div class="info-value">{{ $chauffeur->numeros_permis ?? 'Non renseigné' }}</div>
                                        </div>
                                        
                                        <!-- Date de naissance -->
                                        <div class="info-card">
                                            <div class="info-icon icon-calendar">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="info-label">Date de naissance</div>
                                            <div class="info-value">
                                                {{ $chauffeur->date_naissance ? \Carbon\Carbon::parse($chauffeur->date_naissance)->format('d/m/Y') : 'Non renseignée' }}
                                            </div>
                                        </div>
                                        
                                        <!-- Âge -->
                                        <div class="info-card">
                                            <div class="info-icon icon-user">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="info-label">Âge</div>
                                            <div class="info-value">
                                                @if($chauffeur->date_naissance)
                                                    {{ \Carbon\Carbon::parse($chauffeur->date_naissance)->age }} ans
                                                @else
                                                    Non renseigné
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Adresse -->
                                    {{-- <div class="info-card">
                                        <div class="d-flex align-items-start">
                                            <div class="info-icon icon-location me-3">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="info-label">Adresse</div>
                                                <div class="info-value">{{ $chauffeur->adresse ?? 'Non renseignée' }}</div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!-- Métadonnées -->
                                    <div class="metadata">
                                        <p class="metadata-text">
                                            <i class="fas fa-clock text-warning"></i>
                                            Créé le : {{ $chauffeur->created_at->format('d/m/Y à H:i') }}
                                        </p>
                                    </div>

                                    <!-- Actions -->
                                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">
                                        <div class="d-flex gap-2">
                                            @if($chauffeur->status == 3)
                                                <!-- Bouton Réactiver avec SweetAlert2 -->
                                                <form id="reactivateForm{{ $chauffeur->id }}" action="{{ route('activer.destroy', $chauffeur->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="button" onclick="confirmReactivation(event, {{ $chauffeur->id }}, '{{ addslashes($chauffeur->nom) }} {{ addslashes($chauffeur->prenom) }}')" class="btn btn-success">
                                                        <i class="fa fa-undo me-2"></i>Réactiver le chauffeur
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Bouton Désactiver avec SweetAlert2 -->
                                                <form id="deleteForm{{ $chauffeur->id }}" action="{{ route('activer.destroy', $chauffeur->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="button" onclick="confirmDelete(event, {{ $chauffeur->id }}, '{{ addslashes($chauffeur->nom) }} {{ addslashes($chauffeur->prenom) }}')" class="btn btn-warning" title="Désactiver le chauffeur">
                                                        <i class="fas fa-user-slash me-2"></i>Désactiver
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <a href="{{ route('modifier.edit', $chauffeur->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit me-2"></i>Modifier
                                            </a>
                                        </div>
                                        
                                       
                                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Fonction de confirmation de suppression avec SweetAlert2
        function confirmDelete(event, id, name) {
            event.preventDefault(); // Empêche la soumission directe du formulaire
            
            Swal.fire({
                title: 'Confirmer la désactivation',
                text: `Êtes-vous sûr de vouloir désactiver le chauffeur : ${name} ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, désactiver',
                cancelButtonText: 'Annuler',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-danger mx-2',
                    cancelButton: 'btn btn-secondary mx-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire de suppression
                    document.getElementById(`deleteForm${id}`).submit();
                }
            });
        }

        // Fonction de confirmation de réactivation avec SweetAlert2
        function confirmReactivation(event, id, name) {
            event.preventDefault(); // Empêche la soumission directe du formulaire
            
            Swal.fire({
                title: 'Confirmer la réactivation',
                text: `Voulez-vous vraiment réactiver le chauffeur : ${name} ?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, réactiver',
                cancelButtonText: 'Annuler',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-secondary mx-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire de réactivation
                    document.getElementById(`reactivateForm${id}`).submit();
                }
            });
        }

        // Gestion des messages de session (succès/erreur)
        @if(session('success'))
            Swal.fire({
                title: 'Succès !',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Erreur !',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif

        // Animation simple au chargement
        document.addEventListener('DOMContentLoaded', function() {
            const infoCards = document.querySelectorAll('.info-card');
            infoCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>