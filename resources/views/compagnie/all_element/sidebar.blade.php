  <div class="sidebar p-2 py-md-3 @@cardClass">
      <div class="container-fluid">
          <!-- sidebar: title-->
          <div class="title-text d-flex align-items-center mb-4 mt-1">
              <h4 class="sidebar-title mb-0 flex-grow-1"><span class="sm-txt">F</span><span>itness Admin</span></h4>

          </div>
          <!-- sidebar: menu list -->
          <div class="main-menu flex-grow-1">
              <ul class="menu-list">
                  <li class="divider py-2 lh-sm">
                      <span class="small">MENU</span><br> <small class="text-muted">NAVIGATION</small>
                  </li>
                  <li>
                      <a class="m-link active" href="index.html">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor"
                              viewBox="0 0 16 16">
                              <path fill-rule="evenodd"
                                  d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                              <path class="fill-primary" fill-rule="evenodd"
                                  d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                          </svg>
                          <span class="ms-2">TABLEAU DE BORD</span>
                      </a>
                  </li>

                  <!-- BUS / CARS -->
                  <li>
                      <a class="m-link" href="{{ route('compagnie.bus') }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor"
                              viewBox="0 0 16 16">
                              <path
                                  d="M4 0a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v9H3V2a1 1 0 0 1 1-1zm1 11a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm6 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                          </svg>
                          <span class="ms-2">BUS / CARS</span>
                      </a>
                  </li>

                  <!-- CHAUFFEURS -->
                  <li>
                      <a class="m-link" href="{{ route('chauffeur.index') }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor"
                              viewBox="0 0 16 16">
                              <path
                                  d="M8 0a3 3 0 0 1 3 3v1a3 3 0 1 1-6 0V3a3 3 0 0 1 3-3zm4 14c0 1.105-.895 2-2 2H6a2 2 0 0 1-2-2v-1c0-1.104.895-2 2-2h4c1.105 0 2 .896 2 2v1z" />
                          </svg>
                          <span class="ms-2">CHAUFFEURS</span>
                      </a>
                  </li>



                  <!-- UTILISATEURS -->
                  <li>
                      <a class="m-link" href="{{ route('personnel.index') }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor"
                              viewBox="0 0 16 16">
                              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                          </svg>
                          <span class="ms-2">UTILISATEURS</span>
                      </a>
                  </li>

                  <!-- VOYAGE -->
                  <li>
                      <a class="m-link" href="{{ route('itineraire.index') }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor"
                              viewBox="0 0 16 16">
                              <path
                                  d="M8 0a8 8 0 1 0 8 8A8 8 0 0 0 8 0zm3.5 9.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V6.707L6.354 8.56a.5.5 0 0 0 .707 0l2.793-2.793V9.5z" />
                              <path fill-rule="evenodd"
                                  d="M0 8a8 8 0 1 0 8 8 8 8 0 0 0-8-8zm1 0h6v5H1V8zm7 5h6V8H8v5z" />
                          </svg>
                          <span class="ms-3">ITINÉRAIRE</span>
                      </a>
                  </li>

                  <!-- VOYAGE 2 -->
                  <li>
                      <a class="m-link" href="{{ route('voyage.index') }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor"
                              viewBox="0 0 16 16">
                              <path
                                  d="M1 2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H1zM1 4h14v8H1V4z" />
                              <path d="M3 12a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1h-10z" />
                          </svg>
                          <span class="ms-3">VOYAGE</span>
                      </a>
                  </li>


          </div>
          <!-- sidebar: footer link -->

      </div>
  </div>
