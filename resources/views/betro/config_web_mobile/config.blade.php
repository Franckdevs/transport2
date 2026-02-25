@include('betro.all_element.header')

<body class="layout-1" data-luno="theme-black">
@include('betro.all_element.sidebar')
  <!-- start: body area -->
  <div class="wrapper">
    <!-- start: page header -->
   @include('betro.all_element.navbar')
    <!-- start: page toolbar -->
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      @include('betro.all_element.cadre')
    </div>
    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row g-3 row-deck">
          <div class="col-md-12 mt-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                  <h5 class="mb-0">Configuration Web/Mobile</h5>
                  @if($configWebMobile->id)
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                      <i class="fas fa-trash"></i> Supprimer
                    </button>
                  @endif
                </div>

                @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>
                @endif

                @if($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                <!-- FORMULAIRE DE CONFIGURATION -->
                <form action="{{ $configWebMobile->id ? route('config_web_mobile.update', $configWebMobile) : route('config_web_mobile.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @if($configWebMobile->id)
                    @method('PUT')
                  @endif
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="image_acceuil_mobile" class="form-label">
                          <i class="fas fa-mobile-alt me-1"></i> Image Accueil Mobile
                        </label>
                        <input type="file" class="form-control" id="image_acceuil_mobile" 
                               name="image_acceuil_mobile" accept="image/*">
                        @if($configWebMobile->image_acceuil_mobile)
                          <div class="mt-2">
                            <img src="{{ $configWebMobile->image_acceuil_mobile }}" alt="Actuelle" 
                                 class="img-thumbnail" style="max-width: 200px;">
                            <div class="form-text">Image actuelle</div>
                          </div>
                        @endif
                        <div class="form-text">Format: JPEG, PNG, GIF, SVG (Max: 100MB)</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="sous_image_acceuil_mobile" class="form-label">
                          <i class="fas fa-image me-1"></i> Sous Image Accueil Mobile
                        </label>
                        <input type="file" class="form-control" id="sous_image_acceuil_mobile" 
                               name="sous_image_acceuil_mobile" accept="image/*">
                        @if($configWebMobile->sous_image_acceuil_mobile)
                          <div class="mt-2">
                            <img src="{{ $configWebMobile->sous_image_acceuil_mobile }}" alt="Actuelle" 
                                 class="img-thumbnail" style="max-width: 200px;">
                            <div class="form-text">Image actuelle</div>
                          </div>
                        @endif
                        <div class="form-text">Format: JPEG, PNG, GIF, SVG (Max: 100MB)</div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="image_acceuil_web" class="form-label">
                          <i class="fas fa-desktop me-1"></i> Image Accueil Web
                        </label>
                        <input type="file" class="form-control" id="image_acceuil_web" 
                               name="image_acceuil_web" accept="image/*">
                        @if($configWebMobile->image_acceuil_web)
                          <div class="mt-2">
                            <img src="{{ $configWebMobile->image_acceuil_web }}" alt="Actuelle" 
                                 class="img-thumbnail" style="max-width: 200px;">
                            <div class="form-text">Image actuelle</div>
                          </div>
                        @endif
                        <div class="form-text">Format: JPEG, PNG, GIF, SVG (Max: 100MB)</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="sous_image_acceuil_web" class="form-label">
                          <i class="fas fa-image me-1"></i> Sous Image Accueil Web
                        </label>
                        <input type="file" class="form-control" id="sous_image_acceuil_web" 
                               name="sous_image_acceuil_web" accept="image/*">
                        @if($configWebMobile->sous_image_acceuil_web)
                          <div class="mt-2">
                            <img src="{{ $configWebMobile->sous_image_acceuil_web }}" alt="Actuelle" 
                                 class="img-thumbnail" style="max-width: 200px;">
                            <div class="form-text">Image actuelle</div>
                          </div>
                        @endif
                        <div class="form-text">Format: JPEG, PNG, GIF, SVG (Max: 100MB)</div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="image_connexion_web" class="form-label">
                          <i class="fas fa-sign-in-alt me-1"></i> Image Connexion Web
                        </label>
                        <input type="file" class="form-control" id="image_connexion_web" 
                               name="image_connexion_web" accept="image/*">
                        @if($configWebMobile->image_connexion_web)
                          <div class="mt-2">
                            <img src="{{ $configWebMobile->image_connexion_web }}" alt="Actuelle" 
                                 class="img-thumbnail" style="max-width: 200px;">
                            <div class="form-text">Image actuelle</div>
                          </div>
                        @endif
                        <div class="form-text">Format: JPEG, PNG, GIF, SVG (Max: 100MB)</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                          <i class="fas fa-save me-1"></i> 
                          {{ $configWebMobile->id ? 'Mettre à jour' : 'Enregistrer' }}
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page footer -->
    @include('betro.all_element.footer')
  </div>
</div>

<script>
function confirmDelete() {
  if (confirm('Êtes-vous sûr de vouloir supprimer cette configuration ?')) {
    // Créer et soumettre un formulaire de suppression
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/config_web_mobile/1`;
    form.style.display = 'none';
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);
    
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'DELETE';
    form.appendChild(methodInput);
    
    document.body.appendChild(form);
    form.submit();
  }
}
</script>

{{-- @include('betro.all_element.scripts') --}}
</body>
</html>
