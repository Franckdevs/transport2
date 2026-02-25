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
        <!-- En-tête avec bouton à droite -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          {{-- <h1 class="page-title mb-0">
            <i class="fas fa-bus me-2"></i>Détails du bus
          </h1> --}}
          <div class="ms-auto">
            <a href="{{ route('liste.bus') }}" class="btn btn-light">
              <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
          </div>
        </div>

        </div>
            
            <style>
                .reduced-margin {
                    margin-top: -1.5rem !important; /* Réduit davantage la marge supérieure */
                }
            </style>
            
            <div class="card-body reduced-margin">
    <div class="row">

        
        <!-- En-tête avec bouton retour -->
    

        <!-- Section informations détaillées -->
    <style>
.info-section {
    background: #fff;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.section-title {
    color: #2c3e50;
    font-weight: 600;
    border-bottom: 2px solid #4facfe;
    padding-bottom: 0.5rem;
}

.info-card {
    display: flex;
    align-items: flex-start;
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
    /* border-left: 4px solid #4facfe; */
    transition: all 0.3s ease;
    height: 100%;
    min-height: 80px;
}

.info-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.info-icon {
    /* background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); */
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
}

.info-content {
    flex: 1;
    min-width: 0; /* Important pour le text-overflow */
}

.info-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #6c757d;
    margin-bottom: 0.3rem;
    display: block;
}

.info-value {
    font-size: 0.9rem;
    color: #2c3e50;
    font-weight: 500;
    margin: 0;
    word-wrap: break-word;
    overflow-wrap: break-word;
    /* Gestion du texte long */
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Limite à 3 lignes maximum */
    -webkit-box-orient: vertical;
    line-height: 1.4;
    max-height: 4.2em; /* 3 lignes * 1.4 line-height */
}

/* Style spécifique pour la description qui peut être plus longue */
.info-card:has(.info-label:contains("Description")) .info-value,
.info-card:last-child .info-value {
    -webkit-line-clamp: 5; /* 5 lignes pour la description */
    max-height: 7em; /* 5 lignes * 1.4 line-height */
}

/* Pour les URLs et textes très longs */
.info-value:contains("http") {
    word-break: break-all;
    font-family: 'Courier New', monospace;
    font-size: 0.8rem;
}

.metadata-section {
    background: #e9ecef;
    border-radius: 8px;
    padding: 1rem;
    margin-top: 1rem;
}

.metadata-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
}

.metadata-label {
    font-size: 0.8rem;
    color: #6c757d;
    font-weight: 500;
}

.metadata-value {
    font-size: 0.9rem;
    color: #2c3e50;
    font-weight: 600;
}

.status-badge {
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-active {
    background: #d4edda;
    color: #155724;
}

.status-inactive {
    background: #f8d7da;
    color: #721c24;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .info-card {
        flex-direction: column;
        text-align: center;
        height: auto;
        min-height: 100px;
    }
    
    .info-icon {
        margin-right: 0;
        margin-bottom: 0.5rem;
    }
    
    .metadata-item {
        flex-direction: column;
        text-align: center;
        gap: 0.3rem;
    }
    
    .info-value {
        -webkit-line-clamp: 2; /* Moins de lignes sur mobile */
        max-height: 2.8em;
    }
}

/* Alternative avec scroll pour les textes très longs */
.info-card.scrollable .info-value {
    overflow-y: auto;
    max-height: 100px;
    -webkit-line-clamp: unset;
    padding-right: 5px;
}

/* Style pour la scrollbar */
.info-card.scrollable .info-value::-webkit-scrollbar {
    width: 4px;
}

.info-card.scrollable .info-value::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 2px;
}

.info-card.scrollable .info-value::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 2px;
}

.info-card.scrollable .info-value::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

  <div class="page-header-custom">
          <h1 class="page-title">
            {{-- Ajouter un nouveau bus --}}
          </h1>
          {{-- <a href="{{ route('liste.bus') }}" class="btn">
            ← Retour à la liste
          </a> --}}
        </div>

<div class="col-md-7">
    <div class="info-section">
        <h5 class="section-title mb-4">
            <i class="fas fa-info-circle me-2"></i>Informations Générales
        </h5>
        
        <div class="row">
            <!-- Identité du bus -->
            <div class="col-md-6 mb-3">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="info-content">
                        <label class="info-label">Nom du bus</label>
                        <p class="info-value">{{ $bus->nom_bus ?? 'Non spécifié' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-industry"></i>
                    </div>
                    <div class="info-content">
                        <label class="info-label">Marque</label>
                        <p class="info-value">{{ $bus->marque_bus ?? 'Non spécifié' }}</p>
                    </div>
                </div>
            </div>

            <!-- Caractéristiques techniques -->
            <div class="col-md-6 mb-3">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="info-content">
                        <label class="info-label">Modèle</label>
                        <p class="info-value">{{ $bus->modele_bus ?? 'Non spécifié' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-id-card-alt"></i>
                    </div>
                    <div class="info-content">
                        <label class="info-label">Immatriculation</label>
                        <p class="info-value">{{ $bus->immatriculation_bus ?? 'Non spécifié' }}</p>
                    </div>
                </div>
            </div>

            <!-- Localisation et statut -->
            <div class="col-md-6 mb-3">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-chair"></i>
                    </div>
                    <div class="info-content">
                        <label class="info-label">Nombre de sièges</label>
                        <p class="info-value">{{ $bus->nombre_places ?? 'Non spécifié' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-th-large"></i>
                    </div>
                    <div class="info-content">
                        <label class="info-label">Configuration</label>
                        <p class="info-value">
                            {{ $configuration->nom ?? 'Non spécifié' }} 
                            <small class="text-muted d-block">{{ $configuration->disposition ?? '' }}</small>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Description - Version avec scroll -->
            <div class="col-12 mb-3">
                <div class="info-card scrollable">
                    <div class="info-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="info-content">
                        <label class="info-label">Description</label>
                        <p class="info-value">{{ $bus->description_bus ?? 'Aucune description' }}</p>
                    </div>
                </div>
            </div>

            <!-- Statut et métadonnées -->
            @if($bus->status == 1 || $bus->status == 3)
<div class="col-12">
    <div class="metadata-section">
        <div class="row">
            <div class="col-md-6">
                <div class="metadata-item">
                    <span class="metadata-label">Statut</span>
                    @if($bus->status == 1)
                        <span class="badge bg-success">Actif</span>
                    @elseif($bus->status == 3)
                        <span class="badge bg-danger">Inactif</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6 border-start border-2 border-dark">
                <div class="metadata-item ps-3">
                    <span class="metadata-label">Créé le</span>
                    <span class="metadata-value">{{ $bus->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
            
            <!-- Boutons d'activation/désactivation -->
            <div class="col-12 mt-3">
                <div class="d-flex gap-2">
                    {{-- @if($bus->status == 3)
                        <form action="{{ route('activation.bus', $bus->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle me-2"></i>Activer le bus
                            </button>
                        </form>
                    @else
                        <form action="{{ route('bus.destroy', $bus) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir désactiver ce bus ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times-circle me-2"></i>Désactiver le bus
                            </button>
                        </form>
                    @endif --}}


                        {{-- @if($bus->status == 1)
    <!-- Bouton Blocage avec SweetAlert2 -->
    <form action="{{ route('bus.destroy', $bus->id) }}" method="POST" class="status-change-form" style="display:inline;">
        @csrf
        <button type="button" class="btn btn-warning btn-sm block-bus" 
                data-bus-name="{{ $bus->nom_bus }}"
                data-action="bloquer">
            <i class="fas fa-ban"></i> Bloqué
        </button>
    </form>
@else
    <!-- Bouton Débloquer avec SweetAlert2 -->
    <form action="{{ route('activation.bus', $bus->id) }}" method="POST" class="status-change-form" style="display:inline;">
        @csrf
        <button type="button" class="btn btn-success btn-sm unblock-bus" 
                data-bus-name="{{ $bus->nom_bus }}"
                data-action="débloquer">
            <i class="fas fa-check-circle"></i> Débloqué
        </button>
    </form>
@endif --}}
                </div>
            </div>
        </div>
    </div>
@endif
            </div> 
        </div>
    </div>


</div>




        <!-- Section photo -->
        <div class="col-md-5">
            <div class="photo-section">
                <h5 class="section-title mb-4">
                    <i class="fas fa-camera me-2"></i>Photo du Bus
                </h5>
                
                <div class="photo-container">
                    @if($bus->photo_bus)
                        <img src="{{ asset($bus->photo_bus) }}" 
                             alt="Photo du bus {{ $bus->nom_bus }}"
                             class="bus-photo img-fluid rounded">
                        <div class="photo-overlay">
                            <button class="btn btn-light btn-sm" onclick="openImageModal('{{ asset($bus->photo_bus) }}')">
                                <i class="fas fa-expand me-1"></i>Agrandir
                            </button>
                        </div>
                    @else
                        <div class="no-photo-placeholder">
                            <i class="fas fa-bus fa-4x text-muted mb-3"></i>
                            <p class="text-muted mb-2">Aucune photo disponible</p>
                            <small class="text-muted">Ajoutez une photo depuis la modification</small>
                        </div>
                    @endif
                </div>

                <!-- Actions rapides -->
                <div class="quick-actions mt-4">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('bus.edit', $bus->id) }}" class="btn btn-warning btn-sm px-5">
                            <i class="fa fa-edit"></i> Modifier
                        </a>
                        {{-- <a href="{{ route('bus.show', $bus->id) }}" class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i>
                        </a>
                        @if($bus->status == 1)
                            <form action="{{ route('bus.destroy', $bus->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-warning btn-sm block-bus" 
                                        data-bus-name="{{ $bus->nom_bus }}"
                                        data-action="bloquer">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('activation.bus', $bus->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="button" class="btn btn-success btn-sm unblock-bus" 
                                        data-bus-name="{{ $bus->nom_bus }}"
                                        data-action="débloquer">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </form>
                        @endif --}}
    @if($bus->status == 1)
    <!-- Bouton Blocage avec SweetAlert2 -->
    <form action="{{ route('bus.destroy', $bus->id) }}" method="POST" class="status-change-form" style="display:inline;">
        @csrf
        <button type="button" class="btn btn-warning btn-sm block-bus px-5" 
                data-bus-name="{{ $bus->nom_bus }}"
                data-action="bloquer">
            <i class="fas fa-ban"></i> Bloqué
        </button>
    </form>
@else
    <!-- Bouton Débloquer avec SweetAlert2 -->
    <form action="{{ route('activation.bus', $bus->id) }}" method="POST" class="status-change-form" style="display:inline;">
        @csrf
        <button type="button" class="btn btn-success btn-sm unblock-bus px-5" 
                data-bus-name="{{ $bus->nom_bus }}"
                data-action="débloquer">
            <i class="fas fa-check-circle"></i> Débloqué
        </button>
    </form>
@endif

<script>
// Optionnel : Ajouter une classe scrollable automatiquement pour les textes très longs
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.info-value').forEach(function(element) {
        if (element.scrollHeight > element.clientHeight) {
            element.closest('.info-card').classList.add('scrollable');
        }
    });
});
</script>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    console.log('JS OK');

    function handleStatusChange(button, action) {
        const form = button.closest('form');
        const busName = button.dataset.busName || 'ce bus';

        Swal.fire({
            title: action === 'bloquer' ? 'Bloquer le bus ?' : 'Débloquer le bus ?',
            text: `Voulez-vous vraiment ${action} le bus ${busName} ?`,
            icon: action === 'bloquer' ? 'warning' : 'info',
            showCancelButton: true,
            confirmButtonText: 'Oui',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    document.body.addEventListener('click', function (e) {
        const blockBtn = e.target.closest('.block-bus');
        const unblockBtn = e.target.closest('.unblock-bus');

        if (blockBtn) {
            e.preventDefault();
            handleStatusChange(blockBtn, 'bloquer');
        }

        if (unblockBtn) {
            e.preventDefault();
            handleStatusChange(unblockBtn, 'débloquer');
        }
    });
});
</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Styles pour les sections */
.info-section, .photo-section {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    height: 100%;
}

.section-title {
    color: #333;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 3px solid #ffc107;
    display: inline-block;
    padding-right: 1.5rem;
    position: relative;
}

.section-title:after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 100%;
    height: 3px;
    background-color: #ffc107;
}

/* Cartes d'information */
.info-card {
    display: flex;
    align-items: flex-start;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    /* border-left: 4px solid #3498db; */
    transition: all 0.3s ease;
}

.info-card:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.info-icon {
    width: 40px;
    height: 40px;
    background: #FFC107; /* jaune */
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: white;
    flex-shrink: 0;
}


.info-content {
    flex: 1;
}

.info-label {
    font-weight: 600;
    color: #495057;
    font-size: 0.85rem;
    margin-bottom: 5px;
    display: block;
}

.info-value {
    color: #2c3e50;
    font-weight: 500;
    margin: 0;
    font-size: 1rem;
}

/* Section photo */
.photo-container {
    position: relative;
    border: 2px dashed #dee2e6;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    background: #f8f9fa;
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bus-photo {
    max-width: 100%;
    max-height: 280px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.photo-overlay {
    position: absolute;
    top: 10px;
    right: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.photo-container:hover .photo-overlay {
    opacity: 1;
}

.no-photo-placeholder {
    color: #6c757d;
    padding: 40px 20px;
}

/* Métadonnées */
.metadata-section {
    background: #e9ecef;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

.metadata-item {
    text-align: center;
}

.metadata-label {
    display: block;
    font-size: 0.8rem;
    color: #6c757d;
    margin-bottom: 5px;
}

.metadata-value {
    font-weight: 600;
    color: #2c3e50;
}

/* Badges de statut */
.status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-active {
    background: #d4edda;
    color: #155724;
}

.status-inactive {
    background: #f8d7da;
    color: #721c24;
}

/* Actions rapides */
.quick-actions {
    border-top: 1px solid #e9ecef;
    padding-top: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .info-card {
        flex-direction: column;
        text-align: center;
    }
    
    .info-icon {
        margin-right: 0;
        margin-bottom: 10px;
    }
    
    .photo-container {
        min-height: 250px;
    }
    
    .metadata-section .row {
        gap: 15px 0;
    }
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.info-section, .photo-section {
    animation: fadeIn 0.6s ease;
}
</style>

<script>
function openImageModal(imageUrl) {
    // Créer une modale simple pour agrandir l'image
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        cursor: pointer;
    `;
    
    modal.innerHTML = `
        <img src="${imageUrl}" style="max-width: 90%; max-height: 90%; border-radius: 10px; cursor: default;">
        <button onclick="this.parentElement.remove()" 
                style="position: absolute; top: 20px; right: 20px; background: #fff; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 20px; cursor: pointer;">
            ×
        </button>
    `;
    
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.remove();
        }
    });
    
    document.body.appendChild(modal);
}
</script>
    </div> <!-- .page-body -->

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
