<!-- Script des notifications Toast améliorées -->
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<style>
/* Styles personnalisés pour Toastify */
.toastify {
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    padding: 16px 20px;
    font-family: 'Segoe UI', system-ui, sans-serif;
    font-weight: 500;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.toastify-success {
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
}

.toastify-error {
    background: linear-gradient(135deg, #f44336, #d32f2f);
    color: white;
}

.toastify-warning {
    background: linear-gradient(135deg, #ff9800, #f57c00);
    color: white;
}

.toastify-info {
    background: linear-gradient(135deg, #2196F3, #1976D2);
    color: white;
}

.toastify-close {
    color: white;
    opacity: 0.8;
    font-weight: bold;
    font-size: 16px;
}

.toastify-close:hover {
    opacity: 1;
    transform: scale(1.1);
}

/* Animation personnalisée */
@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

/* Breadcrumb amélioré */
.breadcrumb-premium {
    background: transparent;
    padding: 0;
    margin: 0;
}

.breadcrumb-premium .breadcrumb-item {
    font-size: 0.9rem;
}

.breadcrumb-premium .breadcrumb-item a {
    color: #6c757d;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.breadcrumb-premium .breadcrumb-item a:hover {
    color: #667eea;
    transform: translateY(-1px);
}

.breadcrumb-premium .breadcrumb-item.active {
    color: #2c3e50;
    font-weight: 600;
}

.breadcrumb-premium .breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: #adb5bd;
    font-size: 1.2rem;
    margin: 0 8px;
}

/* Page toolbar amélioré */
.page-toolbar-premium {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 1px solid #e9ecef;
    backdrop-filter: blur(10px);
}

.toolbar-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.page-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.page-title i {
    color: #667eea;
}

.toolbar-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

/* Responsive */
@media (max-width: 768px) {
    .toolbar-content {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .toolbar-actions {
        width: 100%;
        justify-content: flex-start;
    }
    
    .page-title {
        font-size: 1.3rem;
    }
}
</style>

<script>
// Configuration globale de Toastify
const toastConfig = {
    duration: 4000,
    close: true,
    gravity: "top",
    position: "right",
    stopOnFocus: true,
    style: {
        fontFamily: "'Segoe UI', system-ui, sans-serif",
        fontWeight: "500",
        borderRadius: "12px",
        boxShadow: "0 8px 25px rgba(0, 0, 0, 0.15)",
        backdropFilter: "blur(10px)",
        border: "1px solid rgba(255, 255, 255, 0.1)"
    },
    onClick: function() {
        this.hideToast();
    }
};

// Fonction helper pour les notifications
const showNotification = (message, type = 'info', duration = 4000) => {
    const config = {
        ...toastConfig,
        text: message,
        duration: duration
    };

    switch(type) {
        case 'success':
            config.backgroundColor = "linear-gradient(135deg, #4CAF50, #45a049)";
            break;
        case 'error':
            config.backgroundColor = "linear-gradient(135deg, #f44336, #d32f2f)";
            break;
        case 'warning':
            config.backgroundColor = "linear-gradient(135deg, #ff9800, #f57c00)";
            break;
        case 'info':
            config.backgroundColor = "linear-gradient(135deg, #2196F3, #1976D2)";
            break;
        default:
            config.backgroundColor = "linear-gradient(135deg, #2196F3, #1976D2)";
    }

    Toastify(config).showToast();
};

// Notifications automatiques depuis Laravel
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des erreurs de validation
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            showNotification("{{ $error }}", 'error', 6000);
        @endforeach
    @endif

    // Gestion des messages de session
    @if (session('error'))
        showNotification("{{ session('error') }}", 'error', 6000);
    @endif

    @if (session('success'))
        showNotification("{{ session('success') }}", 'success', 4000);
    @endif

    @if (session('warning'))
        showNotification("{{ session('warning') }}", 'warning', 5000);
    @endif

    @if (session('info'))
        showNotification("{{ session('info') }}", 'info', 4000);
    @endif
});

// Fonction exportée pour utilisation globale
window.showToast = showNotification;
</script>

<!-- Page Toolbar Amélioré -->
<div class="page-toolbar page-toolbar-premium px-xl-4 px-sm-2 px-0 py-3">
    <div class="container-fluid">
        <div class="toolbar-content">
            <div class="toolbar-main">
                <!-- Breadcrumb amélioré -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-premium mb-2">
                        {{-- <li class="breadcrumb-item">
                            <a href="{{ route('dashboardcompagnie_name') }}">
                                <i class="fas fa-home me-1"></i>
                                Accueil
                            </a>
                        </li> --}}
                        @php
                            $routeName = Route::currentRouteName();
                            $routeLabels = [
                                'dashboardcompagnie_name' => 'Tableau de Bord',
                                'compagnie.bus' => 'Gestion des Bus',
                                'chauffeur.index' => 'Chauffeurs',
                                'personnel.index' => 'Personnel',
                                'itineraire.index' => 'Itinéraires',
                                'voyage.index' => 'Voyages',
                                'liste_reservation' => 'Réservations',
                                'gares.index.2' => 'Gares & Arrêts',
                                'paramettre.index' => 'Paramètres'
                            ];
                            $currentLabel = $routeLabels[$routeName] ?? 'Tableau de Bord';
                        @endphp
                        
                        @if($routeName !== 'dashboardcompagnie_name')
                            <li class="breadcrumb-item active" aria-current="page">
                                <i class="fas fa-chevron-right me-1"></i>
                                {{ $currentLabel }}
                            </li>
                        @endif
                    </ol>
                </nav>
                
                <!-- Titre de page dynamique -->
                <h1 class="page-title">
                    @switch($routeName)
                        @case('dashboardcompagnie_name')
                            <i class="fas fa-chart-line"></i>
                            Tableau de Bord
                            @break
                        @case('compagnie.bus')
                            <i class="fas fa-bus"></i>
                            Gestion des Bus
                            @break
                        @case('chauffeur.index')
                            <i class="fas fa-user-tie"></i>
                            Chauffeurs
                            @break
                        @case('personnel.index')
                            <i class="fas fa-users"></i>
                            Personnel
                            @break
                        @case('itineraire.index')
                            <i class="fas fa-route"></i>
                            Itinéraires
                            @break
                        @case('voyage.index')
                            <i class="fas fa-map-marked-alt"></i>
                            Voyages
                            @break
                        @case('liste_reservation')
                            <i class="fas fa-ticket-alt"></i>
                            Réservations
                            @break
                        @case('gares.index.2')
                            <i class="fas fa-map-marker-alt"></i>
                            Gares & Arrêts
                            @break
                        @case('paramettre.index')
                            <i class="fas fa-cogs"></i>
                            Paramètres
                            @break
                        @default
                            <i class="fas fa-chart-line"></i>
                            Tableau de Bord
                    @endswitch
                </h1>
            </div>
            
            <!-- Actions contextuelles -->
            <div class="toolbar-actions">
                @if($routeName === 'dashboardcompagnie_name')
                    <button class="btn btn-outline-primary btn-sm" onclick="showNotification('Rafraîchissement des données...', 'info', 2000)">
                        <i class="fas fa-sync-alt me-1"></i>
                        Actualiser
                    </button>
                @endif
                
                {{-- <button class="btn btn-outline-secondary btn-sm" onclick="showNotification('Aide en ligne disponible', 'info', 3000)">
                    <i class="fas fa-question-circle me-1"></i>
                    Aide
                </button> --}}
            </div>
        </div>
    </div>
</div>