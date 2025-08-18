  <div class="sidebar p-2 py-md-3 @@cardClass">
    <div class="container-fluid">
      <!-- sidebar: title-->
      <div class="title-text d-flex align-items-center mb-4 mt-1">
        <h4 class="sidebar-title mb-0 flex-grow-1"><span class="sm-txt">F</span><span>itness Admin</span></h4>

      </div>
      <!-- sidebar: menu list -->
      <div class="main-menu flex-grow-1">
        <ul class="menu-list">
          <li class="divider py-2 lh-sm"><span class="small">MENU</span><br> <small class="text-muted"> NAVIGTION</small></li>
          <li>
            <a class="m-link active" href="index.html">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                <path class="fill-secondary" fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
              </svg>
              <span class="ms-2">TABLEAU DE BORD</span>
            </a>
          </li>

          <li>
            <a class="m-link active" href="index.html">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                <path class="fill-secondary" fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
              </svg>
              <span class="ms-2">GARE</span>
            </a>
          </li>

          <li class="collapsed">
            <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-Applications" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                <path d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z" />
                <path class="fill-secondary" d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
              </svg>
              <span class="ms-2">GARE</span>
              <span class="arrow fa fa-angle-right ms-auto text-end"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="menu-Applications">
              <li><a class="ms-link" href="{{ route('compagnie.bus') }}">BUS / CARS</a></li>
            </ul>

             <ul class="sub-menu collapse" id="menu-Applications">
              <li><a class="ms-link" href="{{ route('gares.index') }}">GARE</a></li>
            </ul>

             <ul class="sub-menu collapse" id="menu-Applications">
              <li><a class="ms-link" href="{{ route('personnel.index') }}">UTILISATEUR</a></li>
            </ul>
          </li>

          </li>
        </ul>

      </div>
      <!-- sidebar: footer link -->

    </div>
  </div>
