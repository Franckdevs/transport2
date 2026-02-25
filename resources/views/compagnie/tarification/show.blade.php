@php
    use App\Helpers\GlobalHelper;
@endphp

<style>
.label-width {
    display: inline-block;
    width: 180px;
    font-weight: 500;
}
</style>

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
                    <div class="ms-auto">
                     
                        <a href="{{ route('tarification.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <!-- Carte Informations principales -->
                                    <div class="col-md-6">
                                        <div class="card h-100">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">Informations de la tarification</h6>
                                            </div>
                                            <div class="card-body">
                                                 

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <span class="label-width">Itinéraire :</span> 
                                                        <span class="fw-medium me-3">{{ $tarification->villeDepart->nom_ville ?? 'N/A' }}</span>
                                                        <span class="mx-3 text-muted">→</span>
                                                        <span class="fw-medium me-3">{{ $tarification->villeArrivee->nom_ville ?? 'N/A' }}</span>
                                                        <span><i class="fas fa-map-marker-alt me-2"></i></span>
                                                    </div>
                                                    {{-- <h6 class="mb-1 mt-1">Itinéraire</h6> --}}
                                                </div>

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <span class="label-width">Classe :</span> 
                                                        <span class="fw-medium ms-3">{{ $tarification->classe->nom ?? 'N/A' }}</span>
                                                    </div>
                                                    {{-- <h6 class="mb-1 mt-1">Classe</h6> --}}
                                                </div>

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <span class="label-width">Montant :</span> 
                                                        <span class="h4 text-dark mb-0 ms-3">{{ number_format($tarification->montant, 0, ',', ' ') }} FCFA</span>
                                                    </div>
                                                    {{-- <h6 class="mb-1 mt-1">Montant</h6> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Carte Statut et métadonnées -->
                                    <div class="col-md-6">
                                        <div class="card h-100">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">Statut & Date</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <span class="label-width">Statut :</span> 
                                                        <span class="ms-3">
                                                            @if($tarification->est_actif)
                                                                <span class="badge bg-success">Activée</span>
                                                            @else
                                                                <span class="badge bg-danger">Désactivée</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    {{-- <h6 class="mb-1 mt-1">Statut</h6> --}}
                                                </div>

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <span class="label-width">Date de création :</span> 
                                                        <span class="text-muted ms-3">
                                                            {{ $tarification->created_at->format('d/m/Y à H:i') }}
                                                            <small class="d-block text-muted">({{ $tarification->created_at->diffForHumans() }})</small>
                                                        </span>
                                                    </div>
                                                    {{-- <h6 class="mb-1 mt-1">Date de création</h6> --}}
                                                </div>

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <span class="label-width">Dernière mise à jour :</span> 
                                                        <span class="text-muted ms-3">
                                                            {{ $tarification->updated_at->format('d/m/Y à H:i') }}
                                                            <small class="d-block text-muted">({{ $tarification->updated_at->diffForHumans() }})</small>
                                                        </span>
                                                    </div>
                                                    {{-- <h6 class="mb-1 mt-1">Dernière mise à jour</h6> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            
                            <!-- Boutons d'action en bas -->
                            <div class="d-flex justify-content-end pt-3 border-top mt-4">
                               
                                   <button type="button" 
                            class="btn btn-sm {{ $tarification->est_actif ? 'btn-success' : 'btn-secondary' }} toggle-status me-2" 
                            data-id="{{ $tarification->id }}"
                            title="{{ $tarification->est_actif ? 'Désactiver' : 'Activer' }}">
                            <i class="fa {{ $tarification->est_actif ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                        </button>
                        <a href="{{ route('tarification.edit', $tarification->id) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('compagnie.all_element.footer')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
    
    <script>
        // Gestion de l'activation/désactivation
        $(document).on('click', '.toggle-status', function(e) {
            e.preventDefault();
            const button = $(this);
            const tarificationId = button.data('id');
            const isActive = button.hasClass('btn-success');
            const action = isActive ? 'désactiver' : 'activer';
            const statusText = isActive ? 'désactivée' : 'activée';

            Swal.fire({
                title: `Voulez-vous vraiment ${action} cette tarification ?`,
                text: `La tarification sera ${statusText}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Oui, ${action}`,
                cancelButtonText: 'Annuler',
                allowOutsideClick: false,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch(`/tarification/status/${tarificationId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            est_actif: isActive ? 0 : 1
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => {
                                throw new Error(err.message || 'Erreur lors de la mise à jour du statut');
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Mettre à jour le bouton et le statut
                            if (isActive) {
                                button.removeClass('btn-success').addClass('btn-secondary').html('<i class="fa fa-toggle-off"></i>');
                                button.closest('.card-body').find('.badge')
                                    .removeClass('bg-success')
                                    .addClass('bg-danger')
                                    .html('Désactivée');
                                button.attr('title', 'Activer');
                            } else {
                                button.removeClass('btn-secondary').addClass('btn-success').html('<i class="fa fa-toggle-on"></i>');
                                button.closest('.card-body').find('.badge')
                                    .removeClass('bg-danger')
                                    .addClass('bg-success')
                                    .html('Activée');
                                button.attr('title', 'Désactiver');
                            }
                            
                            return data;
                        } else {
                            throw new Error(data.message || 'Erreur lors de la mise à jour du statut');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        Swal.showValidationMessage(
                            `Erreur: ${error.message || 'Une erreur est survenue'}` 
                        );
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Succès!',
                        text: `La tarification a été ${statusText} avec succès.`,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
</body>
</html>
