    <div class="d-flex">
                <button type="button" class="btn btn-link d-none d-xl-block sidebar-mini-btn p-0 text-primary">
                  <span class="hamburger-icon">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                  </span>
                </button>
                <button type="button" class="btn btn-link d-block d-xl-none menu-toggle p-0 text-primary">
                  <span class="hamburger-icon">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                  </span>
                </button>
                <a href="../index.html" class="brand-icon d-flex align-items-center mx-2 mx-sm-3 text-primary" style="font-size: 22px; font-weight: bold;">
                {{-- {{ Auth::user()->info_user->compagnie->nom_complet_compagnies ?? '' }} --}}
                </a>
              </div>

          <ul class="header-right justify-content-end d-flex align-items-center mb-0">
                <!-- start: User dropdown-menu -->
            <!-- Badge dans le header -->
    @if(Auth::check())
        @php
            $role = Auth::user()->getRoleNames()->first();
            $roleLabels = [
                'super-admin-betro'      => 'Super admin Betro',
                'sous-admin-betro'       => 'Sous admin Betro',
                'super-admin-compagnie'  => 'Admin Compagnie',
                'super-admin-gare'       => 'Admin Gare',
                'sous-admin-compagnie'   => 'Sous admin Compagnie',
                'sous-admin-gare'        => 'Sous admin Gare',
                'chauffeur'              => 'Chauffeur',
                'hotesse'                => 'Hôtesse',
                'agent'                  => 'Agent',
                'client'                 => 'Client',
            ];
            $roleText = $roleLabels[$role] ?? $role;

            $permissionsList = Auth::user()->getAllPermissions()->pluck('name')->toArray();
            $permissionsText = empty($permissionsList) ? 'Aucune permission' : implode(", ", $permissionsList);
        @endphp

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <!-- Badge pour le rôle -->
            <span class="badge bg-primary rounded-pill px-3 py-2">
                <i class="fas fa-user-tag me-1"></i>
                <strong>{{ $roleText }}</strong>
            </span>

            <!-- Badge pour la gare -->
            @if(Auth::user()->info_user && Auth::user()->info_user->gare)
                <span class="badge bg-secondary rounded-pill px-3 py-2"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Gare associée">
                    <i class="fas fa-train me-1"></i>
                    <strong>{{ Auth::user()->info_user->gare->nom_gare }}</strong>
                </span>
            @endif
        </div>

        <!-- Initialiser les tooltips -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
        </script>
        @endif



                <!-- Fin du badge dans le header -->

                <li>
                  <div class="dropdown morphing scale-left user-profile mx-lg-3 mx-2">
                    <a class="nav-link dropdown-toggle rounded-circle after-none p-0" href="#" role="button" data-bs-toggle="dropdown">
                      <img class="avatar img-thumbnail rounded-circle shadow" src="../assets/img/profile_av.png" alt="">
                    </a>
                    <div class="dropdown-menu border-0 rounded-4 shadow p-0">
                      <div class="card border-0 w240">
                        <div class="card-body border-bottom d-flex">
                          <img class="avatar rounded-circle" src="../assets/img/profile_av.png" alt="">
                          <div class="flex-fill ms-3">
                            <h6 class="card-title mb-0">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</h6>
                            <span class="text-muted">{{ Auth::user()->email }}</span>
                          </div>
                        </div>
                        <div class="list-group m-2 mb-3">
                          <a class="list-group-item list-group-item-action border-0" href="page-profile.html"><i class="w30 fa fa-user"></i>Profil</a>
                        </div>
                        <a href="{{ route('page_connexion') }}" class="btn bg-secondary text-light text-uppercase rounded-0">Deconnexion</a>
                      </div>
                    </div>
                  </div>
                </li>


              </ul>


