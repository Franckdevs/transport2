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
          <!-- start: toggle btn -->
          <!-- start: search area -->
        @include('compagnie.all_element.navbar')
          <!-- start: link -->

        </nav>
      </div>
    </header>
    <!-- start: page toolbar -->
  @include('compagnie.all_element.cadre')

    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">

            <div class="col-md-12 mt-4">
  <div class="card">
    <div class="card-body">
      <h5 class="mb-4">Cree un nouveau utilisateur

      </h5>

<form action="{{ route('personnel.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="prenom" class="form-label">Prénoms</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom') }}">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label for="fonction" class="form-label">Fonction</label>
            <select name="fonction" id="fonction" class="form-control">
                <option value="">-- Sélectionnez une fonction --</option>
                <option value="controleur" {{ old('fonction') == 'controleur' ? 'selected' : '' }}>Contrôleur</option>
                <option value="gestionnaire" {{ old('fonction') == 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
                <option value="administrateur" {{ old('fonction') == 'administrateur' ? 'selected' : '' }}>Administrateur</option>
                <option value="gerant" {{ old('fonction') == 'gerant' ? 'selected' : '' }}>Gérant</option>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>





    </div>
  </div>
</div>



        </div> <!-- .row end -->


      </div>
    </div>
    <!-- start: page footer -->

    @include('compagnie.all_element.footer')
  </div>

    <!-- Jquery Page Js -->
  <script src="../assets/js/theme.js"></script>
  <!-- Plugin Js -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  <!-- Vendor Script -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

</body>

</html>
