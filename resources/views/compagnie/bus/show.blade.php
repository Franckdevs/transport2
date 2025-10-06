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
    {{-- @include('compagnie.all_element.cadre') --}}

    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-1">
    <h5 class="mb-0">

    </h5>
    {{-- <a href="{{ route('liste.bus') }}" class="btn btn-light" title="Retour">
        <i class="fa fa-arrow-left"></i> Retour
    </a> --}}

           {{-- <div class="page-header-custom">
          <a href="{{ route('liste.bus') }}" class="btn btn-light">
            ← Retour à la liste
          </a>
        </div> --}}
</div>

            <div class="card-body">
    <div class="row">
        <!-- En-tête avec bouton retour -->
    

        <!-- Section informations détaillées -->
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
                                <i class="fas fa-copyright"></i>
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
                                <i class="fas fa-cog"></i>
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
                                <i class="fas fa-id-card"></i>
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
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-content">
                                <label class="info-label">Localisation</label>
                                <p class="info-value">{{ $bus->localisation_bus ?? 'Non spécifié' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-chair"></i>
                            </div>
                            <div class="info-content">
                                <label class="info-label">Configuration</label>
                                <p class="info-value">
                                    {{ $configuration->nom_complet ?? 'Non spécifié' }} 
                                    <small class="text-muted d-block">{{ $configuration->disposition ?? '' }}</small>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-12 mb-3">
                        <div class="info-card">
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
                    <div class="col-12">
                        <div class="metadata-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="metadata-item">
                                        <span class="metadata-label">Statut</span>
                                        <span class="status-badge {{ $bus->statut_bus ? 'status-active' : 'status-inactive' }}">
                                            {{ $bus->statut_bus ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="metadata-item">
                                        <span class="metadata-label">Créé le</span>
                                        <span class="metadata-value">{{ $bus->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="metadata-item">
                                        <span class="metadata-label">Modifié le</span>
                                        <span class="metadata-value">{{ $bus->updated_at->format('d/m/Y') }}</span>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
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
                    <div class="d-grid gap-2">
                        <a href="{{ route('bus.edit', $bus->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Modifier les informations
                        </a>
                        <a href="{{ route('liste.bus') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i>Retour à la liste des bus
                        </a>
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
    color: #2c3e50;
    font-weight: 600;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

/* Cartes d'information */
.info-card {
    display: flex;
    align-items: flex-start;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #3498db;
    transition: all 0.3s ease;
}

.info-card:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.info-icon {
    width: 40px;
    height: 40px;
    background: #3498db;
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
