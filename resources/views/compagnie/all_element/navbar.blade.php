
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
            {{ Auth::user()->info_user->compagnie->nom_complet_compagnies ?? '' }}
            </a>
          </div>

       <ul class="header-right justify-content-end d-flex align-items-center mb-0">
            <!-- start: User dropdown-menu -->
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
                    <a href="{{ route('logout') }}" class="btn bg-secondary text-light text-uppercase rounded-0">Deconnexion</a>
                  </div>
                </div>
              </div>
            </li>
          </ul>


