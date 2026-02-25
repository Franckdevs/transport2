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

                    <!-- En-tête avec bouton de retour -->
             <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">

    <!-- Bloc gauche : Titre + villes -->
    <div>
        <h1 class="page-title mb-2">
            <i class="fas fa-route me-2"></i>Itinéraire
        </h1>

        @if($villeDepart && $villeArrivee)
            <div class="d-flex align-items-center text-muted flex-wrap">
                <span class="badge bg-primary text-white me-2" title="Ville de départ du voyage">Départ</span>
                <span class="fw-bold me-3" title="Ville de départ du voyage">{{ $villeDepart->nom_ville }}</span>

                <i class="fas fa-arrow-right text-primary mx-2"></i>

                <span class="badge bg-success text-white me-2" title="Ville d'arrvie du voyage">Arrivée</span>
                <span class="fw-bold" title="Ville d'arrvie du voyage">{{ $villeArrivee->nom_ville }}</span>
            </div>
        @endif
    </div>

    <!-- Bloc centre : Boutons d'action -->
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('itineraire.edit', $voyage->id) }}" class="btn btn-warning btn-sm" title="Modifier l'itinéraire">
            <i class="fa fa-edit"></i>
        </a>
        
        @if($voyage->status == 1)
            <button type="button"
            style="min-width: 180px;"
                class="btn btn-warning btn-sm"
                onclick="confirmBlock({{ $voyage->id }})"
                title="Bloquer l'itinéraire">
                <i class="fas fa-lock me-1"></i> Bloquer
            </button>

            <form id="block-form-{{ $voyage->id }}"
                action="{{ route('itineraire.destroy', $voyage->id) }}"
                method="POST"
                class="d-none">
                @csrf
                @method('DELETE')
            </form>

        @elseif($voyage->status == 3)
            <button type="button"
            style="min-width: 180px;"
                class="btn btn-success btn-sm"
                onclick="confirmUnblock({{ $voyage->id }})"
                title="Débloquer l'itinéraire">
                <i class="fas fa-unlock me-1"></i> Débloquer
            </button>

            <form id="unblock-form-{{ $voyage->id }}"
                action="{{ route('itineraire.reactivation', $voyage->id) }}"
                method="POST"
                class="d-none">
                @csrf
                @method('PUT')
            </form>
        @endif
    </div>

    <!-- Bloc droit : Retour -->
    <div>
        <a href="{{ route('itineraire.index') }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
        </a>
    </div>

</div>


                <!-- Carte des informations principales -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Informations générales</h5>

                        <div class="row g-4">
        <div class="col-md-6">
            <small class="text-muted d-block">Ville de départ</small>
            <strong class="fs-5">
                {{ $voyage->ville->nom_ville ?? 'Non défini' }}
            </strong>
        </div>

        <div class="col-md-6">
            <small class="text-muted d-block">Estimation du trajet (H:min)</small>
            <strong class="fs-5">
                {{ $voyage->estimation ?? 'Non défini' }}
            </strong>
        </div>

        <div class="col-md-6">
            <small class="text-muted d-block">Titre du trajet</small>
            <strong class="fs-5">
                {{ $voyage->titre ?? 'Non défini' }}
            </strong>
        </div>

        <div class="col-md-6">
            <small class="text-muted d-block">Date de création</small>
            <strong class="fs-5">
                {{ $voyage->created_at->format('d/m/Y H:i') }}
            </strong>
        </div>

        <div class="col-md-6">
            <small class="text-muted d-block">Statut</small>
            @if ($voyage->status == 1)
                <span class="badge bg-success">Actif</span>
            @else
                <span class="badge bg-danger">Désactivé</span>
            @endif
        </div>
    </div>
    </div>
</div>


                        <hr class="my-4">

                        <!-- Section Arrêts améliorée -->
                       <div class="card shadow-sm border-0">
    <div class="card-header bg-transparent border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
           <h5 class="fw-semibold mb-0 text-black">
    <i class="fas fa-route me-2"></i>
    Itinéraire complet
</h5>

        </div>
    </div>
    <div class="card-body p-0">
        @if ($voyage->arrets && $voyage->arrets->count() > 0)
            <div class="voyage-stops">
                <!-- Point de départ -->
                <div class="stop-item">
                    <div class="stop-marker">
                        <div class="marker-dot first">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="stop-content">
                        <div class="stop-card active">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="me-3">
                                    <h6 class="fw-bold text-dark mb-1">{{ $voyage->gare->nom_gare ?? 'Gare de départ' }}</h6>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-map-marker-alt me-1 text-primary"></i>
                                        {{ $villeDepart->nom_ville ?? 'Ville de départ' }}
                                    </p>
                                </div>
                                <div class="text-end">
                                    <span class="badge  bg-opacity-10 text-black  p-2">
                                        <i class="fas fa-flag-checkered me-1"></i>Départ
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Arrêts intermédiaires -->
                @foreach ($voyage->arrets as $index => $arret)
                    @php
                        $gare = $arret->gare->nom_gare ?? 'Gare non définie';
                        $ville = $arret->gare->ville->nom_ville ?? 'Ville non définie';
                        $isLast = $index == $voyage->arrets->count() - 1;
                        $montant = $arret->montant ?? 0;
                        $isActive = $loop->last;
                    @endphp
                    <div class="stop-item">
                        <div class="stop-marker">
                            <div class="marker-dot {{ $isLast ? 'last' : 'middle' }}">
                                {{ $index + 1 }}
                            </div>
                        </div>
                        <div class="stop-content">
                            <div class="stop-card {{ $isActive ? 'active' : '' }}">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <div class="me-3">
                                        <h6 class="fw-bold text-dark mb-1">{{ $gare }}</h6>
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-city me-1"></i>{{ $ville }}
                                        </p>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-opacity-10 text-dark p-2">
                                            <i class="fas {{ $isLast ? 'fa-flag-checkered' : 'fa-tag' }} me-1"></i>
                                            {{ number_format($montant, 0, ',', ' ') }} FCFA
                                            @if($isLast)
                                                <span class="ms-2">(Arrivée)</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                <div class="stop-connection">
                                    <div class="connection-line"></div>
                                    <div class="connection-arrow">
                                        <i class="fas fa-arrow-down"></i>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-route text-muted mb-3" style="font-size: 3rem;"></i>
                <p class="text-muted fst-italic mb-0">Aucun arrêt intermédiaire défini pour ce voyage.</p>
            </div>
        @endif
    </div>
</div>

<hr class="my-4">

                <!-- Actions -->
   
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Fonction de confirmation de blocage
    function confirmBlock(voyageId) {
        Swal.fire({
            title: 'Confirmer le blocage',
            text: 'Voulez-vous vraiment bloquer cet itinéraire ? Il ne sera plus disponible pour les réservations.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, bloquer',
            cancelButtonText: 'Annuler',
            customClass: {
                confirmButton: 'btn btn-warning me-2',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('block-form-' + voyageId).submit();
            }
        });
    }

    // Fonction de confirmation de déblocage
    function confirmUnblock(voyageId) {
        Swal.fire({
            title: 'Confirmer le déblocage',
            text: 'Voulez-vous débloquer cet itinéraire ? Il sera à nouveau disponible pour les réservations.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, débloquer',
            cancelButtonText: 'Annuler',
            customClass: {
                confirmButton: 'btn btn-success me-2',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('unblock-form-' + voyageId).submit();
            }
        });
    }
</script>

<style>
.voyage-stops {
    position: relative;
    padding: 1rem 0;
}
.stop-item {
    position: relative;
    padding: 1rem 0;
}
.stop-marker {
    position: absolute;
    left: 1.5rem;
    top: 1.5rem;
    z-index: 2;
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
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.1);
}
.marker-dot.first {
    background-color: #4e73df;
}
.marker-dot.middle {
    background-color: #6c757d;
    width: 2rem;
    height: 2rem;
    font-size: 0.875rem;
}
.marker-dot.last {
    background-color: #1cc88a;
}
.stop-content {
    margin-left: 4.5rem;
    position: relative;
}
.stop-card {
    background: #fff;
    border-radius: 0.5rem;
    padding: 1.25rem;
    box-shadow: 0 0.15rem 0.5rem rgba(0,0,0,0.05);
    border: 1px solid #e3e6f0;
    transition: all 0.3s ease;
}
.stop-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
}
.stop-card.active {
    border-left: 4px solid #4e73df;
    background-color: #f8f9fc;
}
.stop-connection {
    position: relative;
    height: 2rem;
    margin-left: 4.5rem;
}
.connection-line {
    position: absolute;
    left: 1.5rem;
    top: 0;
    bottom: 0;
    width: 2px;
    background-color: #e3e6f0;
    margin-left: -0.25rem;
}
.connection-arrow {
    position: absolute;
    left: 1.5rem;
    top: 50%;
    transform: translate(-50%, -50%);
    color: #b7b9cc;
    background: #f8f9fc;
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
}
</style>

                    </div>
                </div>

                <!-- Boutons d'action -->
                
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
            background: linear-gradient(135deg, #ffc107, #e0a800);
            border-radius: 2px;
        }

        .stop-item {
            position: relative;
            margin-bottom: 1.5rem;
            max-width: 1090px;
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
            background: linear-gradient(135deg, #ffc107, #e0a800);
        }

        .marker-dot.middle {
            background: linear-gradient(135deg, #6c757d, #495057);
        }

        .marker-dot.last {
            background: linear-gradient(135deg, #ffc107, #e0a800);
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
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
            border-left: 3px solid #ffc107;
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