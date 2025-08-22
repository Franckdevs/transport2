 <header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
      <div class="container-fluid">
        <nav class="navbar">
          <!-- start: toggle btn -->
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
            BETRO
            </a>

          </div>
          <!-- start: search area -->

          <!-- start: link -->
          <ul class="header-right justify-content-end d-flex align-items-center mb-0">
            <!-- start: notifications dropdown-menu -->


            <!-- start: My notes toggle modal -->
            <li class="d-none d-sm-inline-block d-xl-none">
              <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#MynotesModal">
                <svg viewBox="0 0 16 16" width="18px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path class="fill-secondary" d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1H1.5z" />
                  <path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2h-11zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293L10 14.793z" />
                </svg>
              </a>
            </li>
            <!-- start: Recent Chat toggle modal -->
            <li class="d-none d-sm-inline-block d-xl-none">
              <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#RecentChat">
                <svg viewBox="0 0 16 16" width="18px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                  <path class="fill-secondary" d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                </svg>
              </a>
            </li>
            <!-- start: quick light dark -->

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
                        <h6 class="card-title mb-0">Allie Grater</h6>
                        <span class="text-muted">alliegrater@luno.com</span>
                      </div>
                    </div>
                    <div class="list-group m-2 mb-3">
                      <a class="list-group-item list-group-item-action border-0" href="page-profile.html"><i class="w30 fa fa-user"></i>Profile</a>

                    </div>
                    <a href="{{ route('logout') }}" class="btn bg-secondary text-light text-uppercase rounded-0">Déconnexion</a>
                  </div>
                </div>
              </div>
            </li>
            <!-- start: Settings toggle modal -->

          </ul>
        </nav>
      </div>
    </header>
