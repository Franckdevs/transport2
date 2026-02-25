@php
use App\Helpers\GlobalHelper;
@endphp
@include('compagnie.all_element.header')

<body class="layout-1" data-luno="theme-blue">
    @include('compagnie.all_element.sidebar')
    <div class="wrapper">
        <header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
            <div class="container-fluid">
                <nav class="navbar">
                    @include('compagnie.all_element.navbar')
                </nav>
            </div>
        </header>

        @include('compagnie.all_element.cadre')

        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
            <div class="container-fluid">
                <!-- En-tête avec bouton à droite -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    {{-- <h1 class="page-title mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Nouvelle classe
                    </h1> --}}
                    <div class="ms-auto">
                        <a href="{{ route('classe.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                
                            </div>
                            <div class="card-body p-4">

                        {{-- @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif --}}

                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
<form id="classeForm" action="{{ route('classe.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nom" class="form-label">Nom de la classe <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                           id="nom" name="nom" value="{{ old('nom') }}" required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="8">{{ old('description') }} </textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="est_actif" name="est_actif" value="1" checked>
                                        <label class="form-check-label" for="est_actif">Activer cette classe</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end pt-3 border-top mt-4">
                                <div class="position-relative" style="min-width: 120px;">
                                    {{-- <button type="submit" id="submitBtn" class="btn btn-warning w-100">
                                        <i class="fas fa-save me-2"></i>
                                        <span>Enregistrer</span>
                                    </button> --}}
<button type="submit" id="submitBtn" class="btn btn-warning w-100">
    <i class="fas fa-save me-2"></i>
    <span id="btnText">Enregistrer</span>
    <span id="loader" class="spinner-border spinner-border-sm text-dark ms-2 d-none" role="status"></span>
</button>
                                </div>
                            </div>
                            
                           @push('styles')
<style>
    #submitBtn {
        transition: all 0.3s ease;
        position: relative;
    }
    #loader {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }
    #submitBtn:disabled {
        opacity: 0.8;
    }
</style>
@endpush


                            <script>
    $(document).ready(function() {
        $('#classeForm').on('submit', function() {
            // Désactiver le bouton pour éviter les doubles clics
            $('#submitBtn').attr('disabled', true);

            // Cacher le texte et afficher le loader
            $('#btnText').text('Enregistrement...');
            $('#loader').removeClass('d-none');
        });
    });
</script>

                            
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('compagnie.all_element.footer')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
    <script src="../assets/js/plugins/apexcharts.js"></script>

  

</body>
</html>
