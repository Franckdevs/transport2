<div class="sidebar p-2 py-md-3 @@cardClass">
    <div class="container-fluid">
        <!-- Logo de la compagnie -->
        <div class="text-center mb-4 mt-2">
            @if(Auth::user()->info_user && Auth::user()->info_user->compagnie && Auth::user()->info_user->compagnie->logo_compagnies)
                <img src="{{ asset(Auth::user()->info_user->compagnie->logo_compagnies) }}" 
                     alt="Logo {{ Auth::user()->info_user->compagnie->nom_complet_compagnies }}" 
                     class="img-fluid rounded-circle" 
                     style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <h6 class="text-dark mt-2 mb-0 fw-bold">{{ Auth::user()->info_user->compagnie->nom_complet_compagnies }}</h6>
                <small class="text-white-50">{{ Auth::user()->info_user->compagnie->type_compagnie }}</small>
            @elseif(Auth::user()->info_user && Auth::user()->info_user->gare && Auth::user()->info_user->gare->compagnie && Auth::user()->info_user->gare->compagnie->logo_compagnies)
                <img src="{{ asset(Auth::user()->info_user->gare->compagnie->logo_compagnies) }}" 
                     alt="Logo {{ Auth::user()->info_user->gare->compagnie->nom_complet_compagnies }}" 
                     class="img-fluid rounded-circle" 
                     style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <h6 class="text-dark mt-2 mb-0 fw-bold">{{ Auth::user()->info_user->gare->compagnie->nom_complet_compagnies }}</h6>
                <small class="text-white-50">{{ Auth::user()->info_user->gare->compagnie->type_compagnie }}</small>
            @else
                <div class="d-flex align-items-center justify-content-center mx-auto rounded-circle bg-white" 
                     style="width: 80px; height: 80px; border: 3px solid #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <i class="fas fa-building text-primary" style="font-size: 2.5rem;"></i>
                </div>
                <h6 class="text-dark mt-2 mb-0 fw-bold">
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
                    <li class="menu-item {{ request()->routeIs('compagnie.bus') || request()->routeIs('bus.*') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('compagnie.bus') }}">
                            <div class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1.5a.5.5 0 0 0 .5-.5V2a.5.5 0 0 0-.5-.5H3Zm4 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1.5a.5.5 0 0 0 .5-.5V2a.5.5 0 0 0-.5-.5H7Zm4 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1.5a.5.5 0 0 0 .5-.5V2a.5.5 0 0 0-.5-.5H11Z"/>
                                    <path d="M2 6a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6Zm1 0v6h10V6H3Z"/>
                                    <path d="M4.5 12.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Zm7 0a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Z"/>
                                </svg>
                            </div>
                            <span class="menu-text">Bus / Cars</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan

                <!-- BUS / CARS -->
                @if (Auth::user()->can('bus-cars') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('listeconfig.index') || request()->routeIs('activation.bus') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('listeconfig.index') }}">
                            <div class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1.5a.5.5 0 0 0 .5-.5V2a.5.5 0 0 0-.5-.5H3Zm4 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1.5a.5.5 0 0 0 .5-.5V2a.5.5 0 0 0-.5-.5H7Zm4 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1.5a.5.5 0 0 0 .5-.5V2a.5.5 0 0 0-.5-.5H11Z"/>
                                    <path d="M2 6a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6Zm1 0v6h10V6H3Z"/>
                                    <path d="M4.5 12.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Zm7 0a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Z"/>
                                </svg>
                            </div>
                            <span class="menu-text">Configuration bus</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan
                
                <!-- CHAUFFEURS -->
                @if (Auth::user()->can('chauffeurs') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('chauffeur.*') ? 'active' : '' }}">
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

                <!-- UTILISATEURS -->
                @if (Auth::user()->can('utilisateurs') || Auth::user()->can('tout-les-permissions'))
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
                @endcan

                <!-- ITINÉRAIRE -->
                @if (Auth::user()->can('itineraires') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('itineraire.*') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('itineraire.index') }}">
                            <div class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM1 8a7 7 0 0 1 7-7 3.5 3.5 0 1 1 0 7 3.5 3.5 0 1 0 0 7 7 7 0 0 1-7-7Zm7 4.5a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Z"/>
                                </svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M6 1a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V1Zm3 4a1 1 0 0 0-1 1v10.5a1.5 1.5 0 1 0 3 0V6a1 1 0 0 0-1-1h-1Z"/>
                                    <path d="M4.5 6h-1a1 1 0 0 0-1 1v8.5a1.5 1.5 0 1 0 3 0V7a1 1 0 0 0-1-1Z"/>
                                </svg>
                            </div>
                            <span class="menu-text">Voyage</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan

                <!-- RESERVATION -->
                @if (Auth::user()->can('voyages') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('liste_reservation') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('liste_reservation') }}">
                            <div class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                    <path d="M3 4.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1z"/>
                                </svg>
                            </div>
                            <span class="menu-text">Réservation</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan

                <!-- AJOUTER UNE GARE -->
                @if (Auth::user()->can('ajouter-une-gars') || Auth::user()->can('tout-les-permissions'))
                    <li class="menu-item {{ request()->routeIs('gares.*') ? 'active' : '' }}">
                        <a class="m-link" href="{{ route('gares.index.2') }}">
                            <div class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-3Zm7 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-3Z"/>
                                    <path d="M2.5 5a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-11Zm0 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-11Zm0 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-11Z"/>
                                </svg>
                            </div>
                            <span class="menu-text">Gares & Arrêts</span>
                            <span class="menu-badge"></span>
                        </a>
                    </li>
                @endcan

                <!-- PARAMÈTRES -->
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
            </ul>
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

/* Style pour le texte du nom de la compagnie */
.sidebar h6 {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 200px;
}

.sidebar {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    min-height: 100vh;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
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
}
</style>