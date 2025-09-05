        <div class="sidebar p-2 py-md-3 @@cardClass">
            <div class="container-fluid">
                <!-- sidebar: title-->
                <div class="title-text d-flex align-items-center mb-4 mt-1">
                    <h4 class="sidebar-title mb-0 flex-grow-1 text-center w-100 d-flex justify-content-center">
                        <span class="fw-bold text-uppercase text-primary border-bottom border-2 border-primary pb-1">
                            @if (Auth::user()->info_user && Auth::user()->info_user->compagnie)
                                {{ Auth::user()->info_user->compagnie->nom_complet_compagnies }}
                            @else
                                {{ Auth::user()->info_user->gare->compagnie->nom_complet_compagnies }} <br>
                                {{-- {{ Auth::user()->info_user->gare->nom_gare }} --}}
                            @endif
                        </span>

                    </h4>
                </div>
                <!-- sidebar: menu list -->
                <div class="main-menu flex-grow-1">
                    <ul class="menu-list">
                        <li class="divider py-2 lh-sm">
                            <span class="small">MENU</span><br>
                            <small class="text-muted">NAVIGATION</small>
                        </li>

                        @if (Auth::user()->can('tableau-de-bord-compagnies') || Auth::user()->can('tout-les-permissions'))
                            <li class="{{ request()->routeIs('dashboardcompagnie_name') ? 'active' : '' }}">
                                <a class="m-link" href="{{ route('dashboardcompagnie_name') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                        <path class="fill-secondary" fill-rule="evenodd"
                                            d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                                    </svg>
                                    <span class="ms-2">TABLEAU DE BORD</span>
                                </a>
                            </li>
                        @endcan

                        <!-- BUS / CARS -->
                        @if (Auth::user()->can('bus-cars') || Auth::user()->can('tout-les-permissions'))
                            <li class="{{ request()->routeIs('dashboardcompagnie_name') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('compagnie.bus') ? 'active' : '' }}">
                                <a class="m-link" href="{{ route('compagnie.bus') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M4 0a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v9H3V2a1 1 0 0 1 1-1zm1 11a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm6 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                    <span class="ms-2">BUS / CARS</span>
                                </a>
                            </li>
                        @endcan

                        <!-- CHAUFFEURS -->
                        @if (Auth::user()->can('chauffeurs') || Auth::user()->can('tout-les-permissions'))
                            <li class="{{ request()->routeIs('chauffeur.*') ? 'active' : '' }}">
                                <a class="m-link" href="{{ route('chauffeur.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a3 3 0 0 1 3 3v1a3 3 0 1 1-6 0V3a3 3 0 0 1 3-3zm4 14c0 1.105-.895 2-2 2H6a2 2 0 0 1-2-2v-1c0-1.104.895-2 2-2h4c1.105 0 2 .896 2 2v1z" />
                                    </svg>
                                    <span class="ms-2">CHAUFFEURS</span>
                                </a>
                            </li>
                        @endcan

                        <!-- UTILISATEURS -->
                        @if (Auth::user()->can('utilisateurs') || Auth::user()->can('tout-les-permissions'))
                            <li class="{{ request()->routeIs('personnel.*') ? 'active' : '' }}">
                                <a class="m-link" href="{{ route('personnel.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                        fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg>
                                    <span class="ms-2">UTILISATEURS</span>
                                </a>
                            </li>
                        @endcan

                        <!-- ITINÉRAIRE -->
                        @if (Auth::user()->can('itineraires') || Auth::user()->can('tout-les-permissions'))
                            <li class="{{ request()->routeIs('itineraire.*') ? 'active' : '' }}">
                                <a class="m-link" href="{{ route('itineraire.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                        fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a8 8 0 1 0 8 8A8 8 0 0 0 8 0zm3.5 9.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V6.707L6.354 8.56a.5.5 0 0 0 .707 0l2.793-2.793V9.5z" />
                                        <path fill-rule="evenodd"
                                            d="M0 8a8 8 0 1 0 8 8 8 8 0 0 0-8-8zm1 0h6v5H1V8zm7 5h6V8H8v5z" />
                                    </svg>
                                    <span class="ms-3">ITINÉRAIRE</span>
                                </a>
                            </li>
                        @endcan

                        <!-- VOYAGE -->
                        @if (Auth::user()->can('voyages') || Auth::user()->can('tout-les-permissions'))
                            <li class="{{ request()->routeIs('voyage.*') ? 'active' : '' }}">
                                <a class="m-link" href="{{ route('voyage.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                        fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M1 2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H1zM1 4h14v8H1V4z" />
                                        <path d="M3 12a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1h-10z" />
                                    </svg>
                                    <span class="ms-3">VOYAGE</span>
                                </a>
                            </li>
                        @endcan

                          @if (Auth::user()->can('voyages') || Auth::user()->can('tout-les-permissions'))
                            <li class="{{ request()->routeIs('liste_reservation.*') ? 'active' : '' }}">
                                <a class="m-link" href="{{ route('liste_reservation') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                        fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M1 2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H1zM1 4h14v8H1V4z" />
                                        <path d="M3 12a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1h-10z" />
                                    </svg>
                                    <span class="ms-3">Liste reservation</span>
                                </a>
                            </li>
                        @endcan

                        <!-- AJOUTER UNE GARE -->
                        @if (Auth::user()->can('ajouter-une-gars') || Auth::user()->can('tout-les-permissions'))
                            <li class="{{ request()->routeIs('gares.*') ? 'active' : '' }}">
                                <a class="m-link" href="{{ route('gares.index.2') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor"
                                        class="bi bi-bus-front" viewBox="0 0 16 16">
                                        <path
                                            d="M5 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0m8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-6-1a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2zm1-6c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9s3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44 44 0 0 0 8 4m0-1c-1.837 0-3.353.107-4.448.22a.5.5 0 1 1-.104-.994A44 44 0 0 1 8 2c1.876 0 3.426.109 4.552.226a.5.5 0 1 1-.104.994A43 43 0 0 0 8 3" />
                                        <path
                                            d="M15 8a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1V2.64c0-1.188-.845-2.232-2.064-2.372A44 44 0 0 0 8 0C5.9 0 4.208.136 3.064.268 1.845.408 1 1.452 1 2.64V4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v3.5c0 .818.393 1.544 1 2v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5V14h6v1.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2c.607-.456 1-1.182 1-2zM8 1c2.056 0 3.71.134 4.822.261.676.078 1.178.66 1.178 1.379v8.86a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 11.5V2.64c0-.72.502-1.301 1.178-1.379A43 43 0 0 1 8 1" />
                                    </svg>
                                    <span class="ms-2">AJOUTER UNE GARE</span>
                                </a>
                            </li>
                        @endcan

                        <!-- Voyage 2 -->
                        <li class="{{ request()->routeIs('voyages.*') ? 'active' : '' }}">
                            <a class="m-link" href="{{ route('voyages.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor"
                                    class="bi bi-luggage-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2 1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V5h.5A1.5 1.5 0 0 1 8 6.5V7H7v-.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5H4v1H2.5v.25a.75.75 0 0 1-1.5 0v-.335A1.5 1.5 0 0 1 0 13.5v-7A1.5 1.5 0 0 1 1.5 5H2zM3 5h2V2H3z" />
                                    <path
                                        d="M2.5 7a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0v-5a.5.5 0 0 1 .5-.5m10 1v-.5A1.5 1.5 0 0 0 11 6h-1a1.5 1.5 0 0 0-1.5 1.5V8H8v8h5V8zM10 7h1a.5.5 0 0 1 .5.5V8h-2v-.5A.5.5 0 0 1 10 7M5 9.5A1.5 1.5 0 0 1 6.5 8H7v8h-.5A1.5 1.5 0 0 1 5 14.5zm9 6.5V8h.5A1.5 1.5 0 0 1 16 9.5v5a1.5 1.5 0 0 1-1.5 1.5z" />
                                </svg>
                                <span class="ms-2">VOYAGE 2</span>
                            </a>
                        </li>

                        <li
                            class="
                {{-- {{ request()->routeIs('voyages.*') ? 'active' : '' }} --}}
                 ">
                            <a class="m-link"
                                href="
                    {{-- {{ route('voyages.index') }} --}}
                     ">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-luggage-fill" viewBox="0 0 16 16">
                            <path d="M2 1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V5h.5A1.5 1.5 0 0 1 8 6.5V7H7v-.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5H4v1H2.5v.25a.75.75 0 0 1-1.5 0v-.335A1.5 1.5 0 0 1 0 13.5v-7A1.5 1.5 0 0 1 1.5 5H2zM3 5h2V2H3z"/>
                            <path d="M2.5 7a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0v-5a.5.5 0 0 1 .5-.5m10 1v-.5A1.5 1.5 0 0 0 11 6h-1a1.5 1.5 0 0 0-1.5 1.5V8H8v8h5V8zM10 7h1a.5.5 0 0 1 .5.5V8h-2v-.5A.5.5 0 0 1 10 7M5 9.5A1.5 1.5 0 0 1 6.5 8H7v8h-.5A1.5 1.5 0 0 1 5 14.5zm9 6.5V8h.5A1.5 1.5 0 0 1 16 9.5v5a1.5 1.5 0 0 1-1.5 1.5z"/>
                        </svg> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor"
                                    class="bi bi-gear-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                                </svg>
                                <span class="ms-2">Parametre</span>
                            </a>

                        </li>

</ul>

<!-- CSS pour l'item actif -->
<style>
/* état normal */
.menu-list>li>a {
color: #6c757d;
/* gris par défaut */
text-decoration: none;
transition: color 0.3s;
}

/* état hover */
.menu-list>li>a:hover {
color: #0d6efd;
/* bleu bootstrap */
}

/* état actif */
.menu-list>li.active>a {
color: #91E3AF !important;
/* ta couleur verte */
font-weight: bold;
}

/* appliquer aussi aux icônes et spans */
.menu-list>li.active>a i,
.menu-list>li.active>a span {
color: #91E3AF !important;
}
</style>

</div>
</div>
</div>
