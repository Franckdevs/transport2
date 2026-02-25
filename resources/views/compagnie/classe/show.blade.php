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
                        <i class="fas fa-layer-group me-2"></i>Détails de la classe
                    </h1> --}}
                    <div class="ms-auto">
                        {{-- <a href="{{ route('classe.edit', $classe->id) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a> --}}
                        <a href="{{ route('classe.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                   
                                <div class="d-flex justify-content-between pt-4 mt-1 mb-4">
                            <div>
                                <a href="{{ route('classe.edit', $classe->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit me-2"></i>Modifier
                                </a>
                            </div>

                            <button onclick="toggleStatus({{ $classe->id }}, {{ $classe->est_actif ? 'true' : 'false' }})" 
                                class="btn {{ $classe->est_actif ? 'btn-danger' : 'btn-success' }}">
                                <i class="fas {{ $classe->est_actif ? 'fa-ban' : 'fa-check' }}"></i>
                                {{ $classe->est_actif ? 'Désactiver' : 'Activer' }}
                            </button>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations principales</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                        
                                            <tr>
                                                <th>Nom :</th>
                                                <td>{{ $classe->nom }}</td>
                                            </tr>
                                            <tr>
                                                <th>Statut :</th>
                                                <td>
                                                    <span class="badge bg-{{ $classe->est_actif ? 'success' : 'danger' }}">
                                                        {{ $classe->est_actif ? 'Actif' : 'Inactif' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="fas fa-align-left me-2"></i>Description</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-0">{{ $classe->description ?? 'Aucune description fournie.' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Boutons d'action en bas -->
                     
                    </div>
                </div>
            </div>
        </div>
        @include('compagnie.all_element.footer')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
    <script src="../assets/js/plugins/apexcharts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleStatus(classeId, currentStatus) {
            const action = currentStatus ? 'désactiver' : 'activer';
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
            const url = `/classes/${classeId}/toggle-status`;
            
            // Créer un formulaire pour la soumission
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            
            // Ajouter le jeton CSRF
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            
            // Ajouter la méthode spoofing pour PUT
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            
            // Afficher la confirmation
            Swal.fire({
                title: 'Confirmation',
                text: `Voulez-vous vraiment ${action} cette classe ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Oui, ${action}`,
                cancelButtonText: 'Annuler',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire
                    form.submit();
                } else {
                    // Supprimer le formulaire si l'utilisateur annule
                    document.body.removeChild(form);
                }
            });
        }
    </script>
</body>
</html>
