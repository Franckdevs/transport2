@include('compagnie.all_element.header')
<body class="layout-1" data-luno="theme-blue">

@include('compagnie.all_element.sidebar')

<div class="wrapper">

    <!-- Page header -->
    <header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
        <div class="container-fluid">
            <nav class="navbar">
                @include('compagnie.all_element.navbar')
            </nav>
        </div>
    </header>

    @include('compagnie.all_element.cadre')

    <!-- Page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">
                    Détails du personnel
                </h4>
                <a href="{{ route('personnel.index') }}" class="btn btn-light" title="Retour">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-header  text-white">
                    <h5 class="mb-0">
                        {{ $personnel->nom ?? '-' }} {{ $personnel->prenom ?? '-' }}
                    </h5>
                </div>
                <div class="card-body row">

                    {{-- Photo --}}
                    @if($personnel->photo)
                        <div class="col-md-3 text-center mb-3">
                            <img src="{{ asset($personnel->photo) }}" alt="Photo du personnel" 
                                 class="img-fluid rounded" style="max-height:200px;">
                        </div>
                    @endif

                    <div class="col-md-9">
                        <p><strong>Nom :</strong> {{ $personnel->nom ?? '-' }}</p>
                        <p><strong>Prénom :</strong> {{ $personnel->prenom ?? '-' }}</p>
                        <p><strong>Email :</strong> {{ $personnel->email ?? '-' }}</p>
                        <p><strong>Téléphone :</strong> {{ $personnel->telephone ?? '-' }}</p>
                        <p><strong>Adresse :</strong> {{ $personnel->adresse ?? '-' }}</p>

                        <p>
                            <strong>Rôle :</strong>
                            <span class="badge bg-success">
                                {{ $personnel->RolePersonnel->nom_role ?? 'Non défini' }}
                            </span>
                        </p>
                        <p><strong>Description du rôle :</strong> {{ $personnel->RolePersonnel->description ?? 'Aucune description' }}</p>

                        {{-- Entreprise --}}
                        {{-- <p><strong>Entreprise :</strong> {{ $personnel->infoUser->nom ?? 'Non défini' }}</p> --}}
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
