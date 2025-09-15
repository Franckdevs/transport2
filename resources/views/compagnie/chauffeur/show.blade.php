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

        <div class="container my-4">
            <h2 class="mb-4 text-center text-primary">🚖 Détails du Chauffeur</h2>
            
            <div class="card shadow-lg border-0 rounded-3">
                <div class="row g-0 align-items-center">
                    
                    <!-- Photo chauffeur -->
                    <div class="col-md-4 text-center p-4 border-end">
                        <img src="{{ $chauffeur->photo ? url($chauffeur->photo) : asset('assets/img/default-user.png') }}" 
                             class="img-fluid rounded-circle shadow-sm border" 
                             alt="Photo du chauffeur" 
                             style="width: 180px; height: 180px; object-fit: cover;">
                        <h5 class="mt-3">{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</h5>
                        {{-- <span class="badge 
                            {{ $chauffeur->status == 'disponible' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($chauffeur->status) }}
                        </span> --}}
                        <span class="badge {{ $chauffeur->status == 1 ? 'bg-success' : 'bg-danger' }}">
                            {{ $chauffeur->status == 1 ? 'Activé' : 'Désactivé' }}
                        </span>

                    </div>
                    
                    <!-- Infos chauffeur -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Téléphone :</strong> {{ $chauffeur->telephone }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Adresse :</strong> {{ $chauffeur->adresse ?? '-' }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Numéro de permis :</strong> {{ $chauffeur->numeros_permis ?? '-' }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Date de naissance :</strong> 
                                    {{ $chauffeur->date_naissance ?? '-' }}
                                </li>
                            </ul>

                            <div class="mt-4 d-flex justify-content-between">
                                {{-- <a href="{{ route('chauffeur.index') }}" class="btn btn-outline-primary">
                                    <i class="fa fa-arrow-left"></i> Retour à la liste
                                </a> --}}
                                <a href="{{ route('modifier.edit', $chauffeur->id) }}" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> Modifier
                                </a>
                            </div>
                        </div>
                    </div>
                    
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
