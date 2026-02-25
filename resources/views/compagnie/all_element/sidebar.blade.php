<div class="sidebar p-2 py-md-3 @@cardClass" id="sidebar">
    <div class="container-fluid">
        <!-- Logo de la compagnie -->
        <div class="text-center mb-4 mt-2">
            @if(Auth::user()->info_user && Auth::user()->info_user->compagnie && Auth::user()->info_user->compagnie->logo_compagnies)

                <img src="{{ asset(Auth::user()->info_user->compagnie->logo_compagnies) }}" 
                     alt="Logo {{ Auth::user()->info_user->compagnie->nom_complet_compagnies }}" 
                     class="sidebar-logo">

                <h6 class="text-dark mt-2 mb-0 fw-bold sidebar-title-text">{{ Auth::user()->info_user->compagnie->nom_complet_compagnies }}</h6>

                <small class="text-white-50 sidebar-subtitle">{{ Auth::user()->info_user->compagnie->type_compagnie }}</small>

            @elseif(Auth::user()->info_user && Auth::user()->info_user->gare && Auth::user()->info_user->gare->compagnie && Auth::user()->info_user->gare->compagnie->logo_compagnies)
                <img src="{{ asset(Auth::user()->info_user->gare->compagnie->logo_compagnies) }}" 
                     alt="Logo {{ Auth::user()->info_user->gare->compagnie->nom_complet_compagnies }}" 
                     class="sidebar-logo">
                <h6 class="text-dark mt-2 mb-0 fw-bold sidebar-title-text">{{ Auth::user()->info_user->gare->compagnie->nom_complet_compagnies }}</h6>
                <small class="text-white-50 sidebar-subtitle">{{ Auth::user()->info_user->gare->compagnie->type_compagnie }}</small>
            @else
                <div class="sidebar-logo-placeholder">
                    <i class="fas fa-building text-primary"></i>
                </div>
                <h6 class="text-dark mt-2 mb-0 fw-bold sidebar-title-text">
                    {{ Auth::user()->info_user->compagnie->nom_complet_compagnies ?? (Auth::user()->info_user->gare->compagnie->nom_complet_compagnies ?? 'Compagnie') }}
                </h6>
            @endif
        </div>
        <div class="divider-line mb-3"></div>
        
        <!-- sidebar: title-->
        {{-- <div class="title-text d-flex align-items-center mb-4 mt-1">
            <h4 class="sidebar-title mb-0 flex-grow-1 text-center w-100 d-flex justify-content-center">
                <span class="fw-bold text-uppercase text-white border-bottom border-2 border-warning pb-1 px-3 rounded-pill bg-primary bg-opacity-25">
                    @if (Auth::user()->info_user && Auth::user()->info_user->compagnie)
                        {{ Auth::user()->info_user->compagnie->nom_complet_compagnies }}
                    @else
                        {{ Auth::user()->info_user->gare->compagnie->nom_complet_compagnies }} <br>
                    @endif  
                </span>
            </h4>
        </div> --}}

        <hr>
        
        <!-- sidebar: menu list -->
        <div class="main-menu flex-grow-1">
            <ul class="menu-list">
                {{-- <li class="divider py-2 lh-sm mb-3">
                    <span class="small text-uppercase fw-bold text-primary">Menu Principal</span><br>
                    <small class="text-muted">Navigation du système</small>
                    <div class="divider-line mt-2"></div>
                </li> --}}

                @if (Auth::user()->can('tableau-de-bord-compagnies') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('dashboardcompagnie_name') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('dashboardcompagnie_name') }}">
                            <div class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
                                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/>
                                </svg>
                            </div>
                            <span class="menu-text">Tableau de Bord</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan

              

                <!-- BUS / CARS -->
                @if (Auth::user()->can('bus-cars') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('listeconfig.*') || request()->routeIs('creationConfig.*') || request()->routeIs('config.edit') || request()->routeIs('config.update') || request()->routeIs('config.show') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('listeconfig.index') }}">
                            <div class="menu-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <span class="menu-text">Configuration bus</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan
                
                  <!-- GESTION DES BUS -->
                @if (Auth::user()->can('bus-cars') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('liste.bus') 
                    || request()->has('bus')
                    || request()->routeIs('bus.*') ? 'active' : '' }}">
                    
                        <a class="m-link" href="{{ route('liste.bus') }}">
                            <div class="menu-icon">
                                <i class="fas fa-bus"></i>
                            </div>
                            <span class="menu-text">Gestion des bus</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan
                <!-- CHAUFFEURS -->
                @if (Auth::user()->can('chauffeurs') || Auth::user()->can('tout-les-permissions'))
                <li class="menu-item {{ request()->routeIs('chauffeur.*') ||request()->routeIs('voir.show') || request()->routeIs('modifier.edit') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('chauffeur.index') }}">
                            <div class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                </svg>
                            </div>
                            <span class="menu-text">Chauffeurs</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan

                <!-- CLASSES -->
                @if (Auth::user()->can('tarification') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('classe.*') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('classe.index') }}">
                            <div class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5a.5.5 0 0 1-.5-.5V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z"/>
                                </svg>
                            </div>
                            <span class="menu-text">Classes</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endif
                <!-- TARIFICATION -->
                @if (Auth::user()->can('tarification') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('tarification.*') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('tarification.index') }}">
                            <div class="menu-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                            <span class="menu-text">Tarification</span>
                        </a>
                    </li>
                @endif


                <!-- UTILISATEURS -->
                {{-- @if (Auth::user()->can('utilisateurs') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('personnel.*') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('personnel.index') }}">
                            <div class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                </svg>
                            </div>
                            <span class="menu-text">Personnel</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan --}}

                <!-- AGENTS -->
                @if (Auth::user()->can('agents') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('agents.*') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('agents.index') }}">
                            <div class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                                </svg>
                            </div>
                            <span class="menu-text">Gestion du personnel</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan

                <!-- ITINÉRAIRE -->
                @if (Auth::user()->can('itineraires') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('itineraire.*') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('itineraire.index') }}">
                            <div class="menu-icon">
                                <i class="fas fa-route"></i>
                            </div>
                            <span class="menu-text">Itinéraire</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan

                <!-- VOYAGE -->
                @if (Auth::user()->can('voyages') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('voyage.*') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('voyage.index') }}">
                            <div class="menu-icon">
                                <i class="fas fa-plane-departure"></i>
                            </div>
                            <span class="menu-text">Voyage</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan


                <!-- RESERVATION -->
                @if (Auth::user()->can('reservations') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('liste_reservation') || request()->routeIs('voir_detail_reservation.show') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('liste_reservation') }}">
                            <div class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                    <path d="M3 4.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1z"/>
                                </svg>
                            </div>
                            <span class="menu-text">Réservations</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan

                <!-- AJOUTER UNE GARE -->
                @if (Auth::user()->can('ajouter-une-gars') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('gares.*') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('gares.index.2') }}">
                            <div class="menu-icon">
                                <i class="fas fa-train"></i>
                            </div>
                            <span class="menu-text">Gares</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan

                  {{-- @if (Auth::user()->can('ajouter-une-gars') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('gares.*') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('gares.index.2') }}">
                            <div class="menu-icon">
                                <i class="fas fa-train"></i>
                            </div>
                            <span class="menu-text">Gestion admin gare</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan --}}

              

                <!-- MODIFIER ADMINISTRATEUR GARE -->
                @if (Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('modifier_admin_gare.*') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('modifier_admin_gare.index') }}">
                            <div class="menu-icon">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <span class="menu-text">Modifier Admin Gare</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan


                  <!-- PARAMÈTRES -->
                @if (Auth::user()->can('paramettre') || Auth::user()->can('tout-les-permissions'))
                <li class="menu-item {{ request()->routeIs('paramettre.*') ? 'active' : '' }}">
                    <a class="m-link" href="{{ route('paramettre.index') }}">
                        <div class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                            </svg>
                        </div>
                        <span class="menu-text">Paramètres</span>
                        <span class="menu-badge"></span>
                    </a>
                </li>
                 @endcan

            </ul>
            
            <!-- Logout Button -->
            <div class="mt-auto pt-3 border-top border-light">
                <ul class="menu-list">
                    <li class="menu-item">
                        <a class="m-link" href="#" 
                           onclick="event.preventDefault(); confirmLogout()">
                            <div class="menu-icon">
                                <i class="fas fa-sign-out-alt"></i>
                            </div>
                            <span class="menu-text">Déconnexion</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            window.confirmLogout = function() {
                Swal.fire({
                    title: 'Déconnexion',
                    text: 'Êtes-vous sûr de vouloir vous déconnecter ?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#ff0000',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui, se déconnecter',
                    cancelButtonText: 'Annuler',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            }

            // Script pour gérer le toggle du sidebar
            document.addEventListener('DOMContentLoaded', function() {
                // Chercher les boutons de toggle du sidebar spécifiques à votre projet
                const toggleBtnDesktop = document.querySelector('.sidebar-mini-btn');
                const toggleBtnMobile = document.querySelector('.menu-toggle');
                const sidebar = document.getElementById('sidebar');
                
                if (sidebar) {
                    // Restaurer l'état du sidebar AVANT que la page ne soit visible
                    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                    if (isCollapsed) {
                        sidebar.classList.add('collapsed');
                    }
                    
                    // Fonction pour toggle le sidebar
                    function toggleSidebar() {
                        sidebar.classList.toggle('collapsed');
                        
                        // Sauvegarder l'état dans localStorage
                        if (sidebar.classList.contains('collapsed')) {
                            localStorage.setItem('sidebarCollapsed', 'true');
                        } else {
                            localStorage.setItem('sidebarCollapsed', 'false');
                        }
                    }
                    
                    // Attacher l'événement au bouton desktop
                    if (toggleBtnDesktop) {
                        toggleBtnDesktop.addEventListener('click', toggleSidebar);
                    }
                    
                    // Attacher l'événement au bouton mobile
                    if (toggleBtnMobile) {
                        toggleBtnMobile.addEventListener('click', toggleSidebar);
                    }
                    
                    // Forcer l'application des styles au cas où
                    setTimeout(() => {
                        if (isCollapsed) {
                            sidebar.classList.add('collapsed');
                        }
                    }, 100);
                }
                
                // Gérer aussi les clics sur les liens qui pourraient fermer le sidebar
                const menuLinks = document.querySelectorAll('.m-link');
                menuLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        // Sur mobile, fermer le sidebar après avoir cliqué sur un lien
                        if (window.innerWidth <= 768) {
                            const sidebar = document.getElementById('sidebar');
                            if (sidebar) {
                                sidebar.classList.add('collapsed');
                                localStorage.setItem('sidebarCollapsed', 'true');
                            }
                        }
                    });
                });
            });

            // Script qui s'exécute immédiatement pour éviter le flash de déformation
            (function() {
                const sidebar = document.getElementById('sidebar');
                const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                
                if (sidebar && isCollapsed) {
                    sidebar.classList.add('collapsed');
                }
            })();
            </script>
        </div>
    </div>
</div>

<style>
/* Style pour le séparateur sous le logo */
.divider-line {
    height: 1px;
    background: rgba(255, 255, 255, 0.2);
    margin: 1rem 0;
}

/* Styles pour le logo adaptatif */
.sidebar-logo {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.sidebar-logo-placeholder {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    transition: all 0.3s ease;
}

.sidebar-logo-placeholder i {
    font-size: 2.5rem;
    transition: all 0.3s ease;
}

/* Styles pour les textes du sidebar */
.sidebar-title-text {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 200px;
    transition: all 0.3s ease;
}

.sidebar-subtitle {
    display: block;
    transition: all 0.3s ease;
}

/* Quand le sidebar est réduit (collapsed) */
.sidebar.collapsed .sidebar-logo {
    width: 50px;
    height: 50px;
}

.sidebar.collapsed .sidebar-logo-placeholder {
    width: 50px;
    height: 50px;
}

.sidebar.collapsed .sidebar-logo-placeholder i {
    font-size: 1.8rem;
}

.sidebar.collapsed .sidebar-title-text {
    max-width: 60px;
    font-size: 0.8rem;
}

.sidebar.collapsed .sidebar-subtitle {
    display: none;
}

.sidebar {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    min-height: 100vh;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.sidebar-title {
    font-size: 1.1rem;
    color: white;
}

.menu-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.menu-item {
    margin-bottom: 8px;
    border-radius: 12px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.menu-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background: linear-gradient(135deg, #ffd000, #ffeb3b);
    transform: scaleY(0);
    transition: transform 0.3s ease;
}

.menu-item:hover::before {
    transform: scaleY(1);
}

.menu-item.active::before {
    transform: scaleY(1);
}

.m-link {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    text-decoration: none;
    color: #e9ecef;
    border-radius: 12px;
    transition: all 0.3s ease;
    position: relative;
    background: transparent;
}

.menu-item:hover .m-link {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    transform: translateX(5px);
}

.menu-item.active .m-link {
    background: linear-gradient(135deg, rgba(255, 208, 0, 0.2), rgba(255, 235, 59, 0.1));
    color: #ffd000;
    box-shadow: 0 4px 15px rgba(255, 208, 0, 0.3);
}

.menu-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    margin-right: 12px;
    transition: all 0.3s ease;
}

.menu-item:hover .menu-icon {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

.menu-item.active .menu-icon {
    background: linear-gradient(135deg, #ffd000, #ffeb3b);
    color: #000000;
    box-shadow: 0 4px 10px rgba(255, 208, 0, 0.4);
}

.menu-text {
    font-weight: 500;
    font-size: 0.95rem;
    flex: 1;
    transition: all 0.3s ease;
}

.menu-badge {
    width: 8px;
    height: 8px;
    background: #ffd000;
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.menu-item.active .menu-badge {
    opacity: 1;
}

.divider {
    position: relative;
    padding-left: 0 !important;
}

.divider-line {
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    margin-top: 8px;
}

/* Animation pour les nouveaux éléments */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.menu-item {
    animation: slideIn 0.3s ease forwards;
}

.menu-item:nth-child(2) { animation-delay: 0.1s; }
.menu-item:nth-child(3) { animation-delay: 0.2s; }
.menu-item:nth-child(4) { animation-delay: 0.3s; }
.menu-item:nth-child(5) { animation-delay: 0.4s; }
.menu-item:nth-child(6) { animation-delay: 0.5s; }
.menu-item:nth-child(7) { animation-delay: 0.6s; }
.menu-item:nth-child(8) { animation-delay: 0.7s; }
.menu-item:nth-child(9) { animation-delay: 0.8s; }

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        min-height: auto;
    }
    
    .m-link {
        padding: 10px 12px;
    }
    
    .menu-icon {
        width: 35px;
        height: 35px;
        margin-right: 10px;
    }
    
    .menu-text {
        font-size: 0.9rem;
    }
    
    .sidebar-logo {
        width: 60px;
        height: 60px;
    }
    
    .sidebar-logo-placeholder {
        width: 60px;
        height: 60px;
    }
    
    .sidebar-logo-placeholder i {
        font-size: 2rem;
    }
}
</style>