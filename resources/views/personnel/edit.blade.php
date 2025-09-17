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
    <a href="{{ route('personnel.index') }}" class="btn btn-light" title="Retour">
        <i class="fa fa-arrow-left"></i> Retour
    </a>
  </div>

            <div class="col-md-12 mt-4">
  <div class="card">
    <div class="card-body">
      <h5 class="mb-4">Modifier l'utilisateur

      </h5>

<form action="{{ route('personnel.update' ,$personnel->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom' ,$personnel) }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="prenom" class="form-label">Prénoms</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom',$personnel) }}">
        </div>
    </div>

    <div class="row">
        {{-- <div class="col-md-6 mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') }}">
        </div> --}}

        <div class="col-md-6 mb-3">
    <label for="telephone" class="form-label">Téléphone</label>
    <div class="input-group">
        <span class="input-group-text">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Flag_of_C%C3%B4te_d%27Ivoire.svg" 
                 alt="CI" style="width:24px; height:16px; margin-right:5px;">
            +225
        </span>
        <input type="text" name="telephone" id="telephone" class="form-control" 
               value="{{ old('telephone',$personnel) }}" placeholder="0123456789">
    </div>
</div>


<div class="col-md-6 mb-3">
    <label for="email" class="form-label">Email</label>
    <input 
        type="email" 
        name="email" 
        id="email" 
        class="form-control" 
        value="{{ old('email' ,$personnel) }}"
        placeholder="exemple@domaine.com"
        required
        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
        title="Veuillez saisir une adresse email valide">
</div>

    </div>

    <div class="row">

<div class="col-md-6 mb-3">
    <label for="photo" class="form-label">Photo</label>

    {{-- Si une photo existe déjà, on l'affiche --}}
    @if(!empty($personnel->photo))
        <div class="mb-2">
            <img src="{{ asset($personnel->photo) }}" 
                 alt="Photo actuelle"
                 class="img-thumbnail rounded shadow-sm"
                 style="max-width: 150px; height: auto;">
        </div>
    @endif

    {{-- Champ upload --}}
    <input type="file" name="photo" id="photo" class="form-control">
</div>



        

      <div class="col-md-6 mb-3">
          <label for="fonction" class="form-label">Fonction</label>
          <select name="role_utilisateurs_id" id="role_utilisateurs_id" class="form-control">
              <option value="">-- Sélectionnez une fonction --</option>
              @foreach($rolepersonnels as $role)
                  <option value="{{ $role->id }}" 
                      data-description="{{ $role->description }}" 
                      {{ old('role_utilisateurs_id',$personnel) == $role->id ? 'selected' : '' }}>
                      {{ $role->nom_role }}
                  </option>
              @endforeach
          </select>
      </div>

      <!-- Zone pour afficher la description -->
      <div id="role-description" class="mt-2 text-muted" style="font-style: italic;">
          Sélectionnez un rôle pour voir sa description.
      </div>
      <script>
          document.addEventListener("DOMContentLoaded", function () {
              const select = document.getElementById("fonction");
              const descriptionBox = document.getElementById("role-description");

              select.addEventListener("change", function () {
                  const selectedOption = select.options[select.selectedIndex];
                  const description = selectedOption.getAttribute("data-description");

                  if (description) {
                      descriptionBox.textContent = description;
                  } else {
                      descriptionBox.textContent = "Sélectionnez un rôle pour voir sa description.";
                  }
              });

              // ✅ Afficher la description si une valeur est déjà sélectionnée (old input ou édition)
              if (select.value) {
                  const selectedOption = select.options[select.selectedIndex];
                  descriptionBox.textContent = selectedOption.getAttribute("data-description");
              }
          });
      </script>
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
