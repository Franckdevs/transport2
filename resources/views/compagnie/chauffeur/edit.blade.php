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
     
                            <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">

    </h5>
    <a href="{{ route('chauffeur.index') }}" class="btn btn-light" title="Retour">
        <i class="fa fa-arrow-left"></i>
    </a>
</div>

                    <div class="col-md-12 mt-4">
  <div class="card">
    <div class="card-body">
      <h5 class="mb-4">Cree un nouveau chauffeur

      </h5>

<form action="{{ route('modifier.update',$chauffeur->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">

        <!-- Nom -->
        <div class="col-md-6 mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control"
                   value="{{ old('nom',$chauffeur->nom) }}" required>
            @error('nom')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Prénom -->
        <div class="col-md-6 mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control"
                   value="{{ old('prenom', $chauffeur->prenom) }}" required>
            @error('prenom')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Adresse -->
        <div class="col-md-6 mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="form-control"
                   value="{{ old('adresse',$chauffeur) }}" required>
            @error('adresse')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Téléphone -->
        <div class="col-md-6 mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control"
                   value="{{ old('telephone',$chauffeur) }}" required>
            @error('telephone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Numéro de permis -->
        <div class="col-md-6 mb-3">
            <label for="numeros_permis" class="form-label">Numéro de permis</label>
            <input type="text" name="numeros_permis" id="numeros_permis" class="form-control"
                   value="{{ old('numeros_permis',$chauffeur) }}">
            @error('numeros_permis')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Date de naissance -->
        <div class="col-md-6 mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" class="form-control"
                   value="{{ old('date_naissance' ,$chauffeur) }}">
            @error('date_naissance')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Photo -->
        <div class="col-md-6 mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
            @error('photo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        <img src="{{ url($chauffeur->photo) }}" alt="Photo du chauffeur" width="150" height="150">
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>






    </div>
  </div>
</div>




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
