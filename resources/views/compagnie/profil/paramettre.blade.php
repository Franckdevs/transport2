@include('compagnie.all_element.header')
<body class="layout-1" data-luno="theme-blue">
  <!-- start: sidebar -->
  @include('compagnie.all_element.sidebar')

  <!-- start: body area -->
  <div class="wrapper">
    <!-- start: page header -->
    <header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
      <div class="container-fluid">
        <nav class="navbar">
          @include('compagnie.all_element.navbar')
        </nav>
      </div>
    </header>

    @include('compagnie.all_element.cadre')

    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <h3 class="mb-4 text-uppercase">Paramètres du compte</h3>

        <div class="row">
          <!-- Informations utilisateur -->
          <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0">
              <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Mes informations</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('paramettre.updateInfos') }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" 
                           value="{{ auth()->user()->nom }}">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" 
                           value="{{ auth()->user()->prenom }}">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" 
                           value="{{ auth()->user()->telephone }}">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" 
                           value="{{ auth()->user()->email }}">
                  </div>

                  <button type="submit" class="btn btn-success">Mettre à jour</button>
                </form>
              </div>
            </div>
          </div>

          <!-- Changer le mot de passe -->
        <div class="col-lg-6 mb-4">
  <div class="card shadow-sm border-0">
    <div class="card-header bg-warning text-dark">
      <h5 class="mb-0">Changer le mot de passe</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('paramettre.updatePassword') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">Nouveau mot de passe</label>
          <input type="password" name="new_password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Confirmer le mot de passe</label>
          <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-warning">Modifier le mot de passe</button>
      </form>
    </div>
  </div>
</div>


        </div>

      </div>
    </div>

    @include('compagnie.all_element.footer')
  </div>

  <!-- Scripts -->
  <script src="../assets/js/theme.js"></script>
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
</body>
</html>
