@php
    use App\Helpers\GlobalHelper;
@endphp
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
<!-- Ajout de la bibliothèque de validation côté client -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

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
                
                <div class="row g-xl-3 g-2 mb-3">
                    <div class="col-12">
                        <div class="card shadow-sm">
                          
                            <div class="card-body p-4">

                                <!-- Messages d'alerte -->
                               

                                {{-- @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>Des erreurs ont été détectées :</strong>
                                        <ul class="mb-0 mt-2">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif --}}

                    <form id="tarificationForm" action="{{ route('tarification.update', $tarification->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="classe_id" class="form-label">Classe <span class="text-danger">*</span></label>
                                    <select name="classe_id" id="classe_id" class="form-select select2 @error('classe_id') is-invalid @enderror" required>
                                        <option value="">Sélectionner une classe</option>
                                        @foreach($classes as $classe)
                                            <option value="{{ $classe->id }}" {{ old('classe_id', $tarification->classe_id) == $classe->id ? 'selected' : '' }}>
                                                {{ $classe->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('classe_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="montant" class="form-label">Montant (FCFA) <span class="text-danger">*</span></label>
                                    <input type="number" min="0" step="1" class="form-control @error('montant') is-invalid @enderror" 
                                           id="montant" name="montant" value="{{ old('montant', (int)$tarification->montant) }}" required>
                                    @error('montant')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="ville_depart_id" class="form-label">Ville de départ <span class="text-danger">*</span></label>
                                    <select name="ville_depart_id" id="ville_depart_id" class="form-select select2 @error('ville_depart_id') is-invalid @enderror" required>
                                        <option value="">Sélectionner une ville</option>
                                        @foreach($villes as $ville)
                                            <option value="{{ $ville->id }}" {{ old('ville_depart_id', $tarification->ville_depart_id) == $ville->id ? 'selected' : '' }}>
                                                {{ $ville->nom_ville }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ville_depart_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="ville_arrivee_id" class="form-label">Ville d'arrivée <span class="text-danger">*</span></label>
                                    <select name="ville_arrivee_id" id="ville_arrivee_id" class="form-select select2 @error('ville_arrivee_id') is-invalid @enderror" required>
                                        <option value="">Sélectionner une ville</option>
                                        @foreach($villes as $ville)
                                            <option value="{{ $ville->id }}" {{ old('ville_arrivee_id', $tarification->ville_arrivee_id) == $ville->id ? 'selected' : '' }}>
                                                {{ $ville->nom_ville }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ville_arrivee_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="est_actif" id="est_actif" 
                                   value="1" {{ old('est_actif', $tarification->est_actif) ? 'checked' : '' }}>
                            <label class="form-check-label" for="est_actif">
                                Activer cette tarification
                            </label>
                        </div>

                        <div class="d-flex justify-content-end pt-3 border-top mt-4">
                            <button type="submit" id="submitBtn" class="btn btn-warning text-white d-flex align-items-center">
                                <i class="fas fa-save me-2"></i>
                                <span id="submitText" class="me-2">Mettre à jour</span>
                                <span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </form>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Gestion de la soumission du formulaire
            $('#tarificationForm').on('submit', function() {
                const submitBtn = $('#submitBtn');
                const spinner = $('#submitSpinner');
                const submitText = $('#submitText');
                
                // Désactiver le bouton et afficher le spinner
                submitBtn.prop('disabled', true);
                spinner.removeClass('d-none');
                submitText.text('Mise à jour...');
            });

            // Styles personnalisés pour les champs de formulaire
            const formStyles = `
                /* Styles généraux des champs */
                .form-control, .form-select, .select2-container .select2-selection--single {
                    min-height: 45px;
                    padding: 0.5rem 1rem;
                    font-size: 1rem;
                    line-height: 1.5;
                    border: 1px solid #ced4da;
                    border-radius: 0.5rem;
                    transition: all 0.2s ease-in-out;
                    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
                }

                /* Style spécifique pour les champs de sélection */
                .select2-container .select2-selection--single {
                .form-group {
                    margin-bottom: 1.25rem;
                }

                .form-label {
                    font-weight: 500;
                    margin-bottom: 0.5rem;
                    color: #495057;
                    font-size: 0.9375rem;
                }

                .form-control:focus, .form-select:focus, .select2-container--default.select2-container--focus .select2-selection--single {
                    border-color: #86b7fe;
                    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
                    outline: 0;
                }

                .select2-container--default .select2-selection--single .select2-selection__arrow {
                    height: 43px;
                    right: 8px;
                }
                .select2-container--default .select2-selection--single .select2-selection__rendered {
                    line-height: 30px;
                }
                .select2-container--default .select2-search--dropdown .select2-search__field {
                    padding: 8px 12px;
                    font-size: 1rem;
                }
                .select2-results__option {
                    padding: 0.5rem 1rem;
                    font-size: 0.9375rem;
                }

                .select2-dropdown {
                    border: 1px solid #dee2e6;
                    border-radius: 0.5rem;
                    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
                }

                .select2-container--default .select2-results__option--highlighted[aria-selected] {
                    background-color: #f8f9fa;
                    color: #000;
                }

                .select2-container--default .select2-results__option[aria-selected=true] {
                    background-color: #e9ecef;
                }

                /* Amélioration du bouton de soumission */
                #submitBtn {
                    padding: 0.625rem 1.5rem;
                    font-weight: 500;
                    transition: all 0.2s ease-in-out;
                }

                #submitBtn:hover {
                    transform: translateY(-1px);
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }
            `;
            $('<style>').text(formStyles).appendTo('head');

            // Initialisation de Select2 avec recherche
            $('.select2').select2({
                placeholder: 'Rechercher...',
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Aucun résultat trouvé";
                    },
                    searching: function() {
                        return "Recherche en cours...";
                    }
                }
            });

            // Validation côté client
            $("#tarificationForm").validate({
                rules: {
                    classe_id: "required",
                    ville_depart_id: "required",
                    ville_arrivee_id: {
                        required: true,
                        notEqual: "#ville_depart_id"
                    },
                    montant: {
                        required: true,
                        min: 0
                    }
                },
                messages: {
                    classe_id: "Veuillez sélectionner une classe",
                    ville_depart_id: "Veuillez sélectionner une ville de départ",
                    ville_arrivee_id: {
                        required: "Veuillez sélectionner une ville d'arrivée",
                        notEqual: "Les villes de départ et d'arrivée doivent être différentes"
                    },
                    montant: {
                        required: "Veuillez saisir un montant",
                        min: "Le montant ne peut pas être négatif"
                    }
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            // Ajout d'une méthode de validation personnalisée pour vérifier que les villes sont différentes
            $.validator.addMethod("notEqual", function(value, element, param) {
                return this.optional(element) || value !== $(param).val();
            }, "Les villes de départ et d'arrivée doivent être différentes");

            // Réinitialisation du formulaire
            $('button[type="reset"]').on('click', function() {
                const form = $('#tarificationForm');
                form.trigger('reset');
                $('.select2').val(null).trigger('change');
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                // Réactiver le bouton et cacher le spinner si le formulaire est réinitialisé
                $('#submitBtn').prop('disabled', false);
                $('#submitSpinner').addClass('d-none');
                $('#submitText').text('Mettre à jour');
            });
        });
    </script>
</body>
</html>
