/**
 * Gestion du formulaire de création de compagnie
 * Ce script gère la validation des champs et les interactions utilisateur
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des tooltips Bootstrap
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Gestion du sélecteur de pays pour le téléphone
    const countryList = document.getElementById('countryList');
    if (countryList) {
        countryList.addEventListener('click', function(e) {
            e.preventDefault();
            const target = e.target.closest('.dropdown-item');
            if (target) {
                const flag = target.getAttribute('data-flag');
                const code = target.getAttribute('data-code');
                
                document.getElementById('selectedFlag').textContent = flag;
                document.getElementById('selectedCode').textContent = code ? ` ${code}` : '';
                document.getElementById('countryCode').value = code;
                
                // Mettre à jour le placeholder en fonction du pays
                const phoneInput = document.getElementById('telephone');
                if (code === '+33') {
                    phoneInput.placeholder = '01 23 45 67 89';
                    phoneInput.pattern = '^0[1-9]([-. ]?[0-9]{2}){4}$';
                    phoneInput.title = 'Veuillez entrer un numéro de téléphone valide (ex: 01 23 45 67 89)';
                } else if (code === '+32') {
                    phoneInput.placeholder = '0470 12 34 56';
                    phoneInput.pattern = '^0[1-9]\d{1,2}[-. ]?\d{2}[-. ]?\d{2}[-. ]?\d{2}$';
                    phoneInput.title = 'Veuillez entrer un numéro de téléphone belge valide (ex: 0470 12 34 56)';
                } else if (code === '+41') {
                    phoneInput.placeholder = '078 123 45 67';
                    phoneInput.pattern = '^0[1-9]{2}[-. ]?\d{3}[-. ]?\d{2}[-. ]?\d{2}$';
                    phoneInput.title = 'Veuillez entrer un numéro de téléphone suisse valide (ex: 078 123 45 67)';
                } else if (code === '+1') {
                    phoneInput.placeholder = '(514) 555-1234';
                    phoneInput.pattern = '^\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$';
                    phoneInput.title = 'Veuillez entrer un numéro de téléphone nord-américain valide (ex: (514) 555-1234)';
                } else {
                    phoneInput.placeholder = 'Entrez le numéro avec l\'indicatif';
                    phoneInput.pattern = '^[0-9\s.\-()]{6,20}$';
                    phoneInput.title = 'Veuillez entrer un numéro de téléphone valide';
                }
                
                // Mettre à jour le texte d'aide
                const telHelp = document.getElementById('telHelp');
                if (code) {
                    telHelp.textContent = `Format pour ${target.textContent.trim().split(' ')[0]} : ${phoneInput.placeholder}`;
                } else {
                    telHelp.textContent = 'Entrez le numéro avec l\'indicatif du pays';
                }
            }
        });
    }
    
    // Formatage automatique du numéro de téléphone
    const phoneInput = document.getElementById('telephone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            const countryCode = document.getElementById('countryCode').value;
            let value = this.value.replace(/\D/g, ''); // Supprimer tout ce qui n'est pas un chiffre
            
            if (countryCode === '+225') {
                // Formatage pour la Côte d'Ivoire (10 chiffres)
                if (value.length > 10) {
                    value = value.substring(0, 10);
                }
                
                // Formater selon le format ivoirien (01 23 45 67 89 ou 012 34 56 78)
                if (value.length > 0) {
                    if (value.startsWith('01') || value.startsWith('02') || value.startsWith('03') || 
                        value.startsWith('04') || value.startsWith('05') || value.startsWith('06') || 
                        value.startsWith('07') || value.startsWith('09')) {
                        // Format 01 23 45 67 89
                        value = value.match(/(\d{0,2})(\d{0,2})(\d{0,2})(\d{0,2})(\d{0,2})/);
                        value = value[1] + 
                                (value[2] ? ' ' + value[2] : '') + 
                                (value[3] ? ' ' + value[3] : '') + 
                                (value[4] ? ' ' + value[4] : '') + 
                                (value[5] ? ' ' + value[5] : '');
                    } else {
                        // Format 012 34 56 78
                        value = value.match(/(\d{0,3})(\d{0,2})(\d{0,2})(\d{0,2})/);
                        value = value[1] + 
                                (value[2] ? ' ' + value[2] : '') + 
                                (value[3] ? ' ' + value[3] : '') + 
                                (value[4] ? ' ' + value[4] : '');
                    }
                    value = value.trim();
                }
            } else if (countryCode === '+33') {
                // Formatage pour la France
                if (value.length > 10) {
                    value = value.substring(0, 10);
                }
                
                if (value.length > 0) {
                    value = value.match(/(\d{0,2})(\d{0,2})(\d{0,2})(\d{0,2})(\d{0,2})/);
                    value = value[1] + 
                            (value[2] ? ' ' + value[2] : '') + 
                            (value[3] ? ' ' + value[3] : '') + 
                            (value[4] ? ' ' + value[4] : '') + 
                            (value[5] ? ' ' + value[5] : '');
                    value = value.trim();
                }
            }
            
            this.value = value;
        });
    }

    // Gestion du formatage du numéro de téléphone
    const telInputs = [
        document.getElementById('telephone'),
        document.getElementById('telephone_compagnies')
    ];

    telInputs.forEach(input => {
        if (input) {
            // Formatage à la saisie
            input.addEventListener('input', function(e) {
                // Ne garder que les chiffres
                let value = this.value.replace(/\D/g, '');
                
                // Limiter à 10 chiffres
                if (value.length > 10) {
                    value = value.substring(0, 10);
                }
                
                // Mettre à jour la valeur
                this.value = value;
                
                // Valider le champ
                validatePhoneInput(this);
            });

            // Validation à la perte du focus
            input.addEventListener('blur', function() {
                validatePhoneInput(this);
            });
        }
    });

    // Fonction de validation des numéros de téléphone
    function validatePhoneInput(input) {
        const isValid = /^[0-9]{10}$/.test(input.value);
        
        if (input.value && !isValid) {
            input.classList.add('is-invalid');
            const helpText = input.nextElementSibling;
            if (helpText && helpText.classList.contains('form-text')) {
                helpText.classList.add('text-danger');
            }
            return false;
        } else {
            input.classList.remove('is-invalid');
            const helpText = input.nextElementSibling;
            if (helpText && helpText.classList.contains('form-text')) {
                helpText.classList.remove('text-danger');
            }
            return true;
        }
    }

    // Validation du formulaire avant soumission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Valider les champs requis
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                }
            });

            // Valider les numéros de téléphone
            telInputs.forEach(input => {
                if (input && !validatePhoneInput(input)) {
                    isValid = false;
                }
            });

            // Valider les emails
            const emailInputs = [
                document.getElementById('email'),
                document.getElementById('email_compagnies')
            ];

            emailInputs.forEach(input => {
                if (input && !validateEmail(input)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
                // Faire défiler jusqu'au premier champ invalide
                const firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
            }
        });
    }

    // Fonction de validation d'email
    function validateEmail(input) {
        const emailRegex = /^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/i;
        const isValid = emailRegex.test(input.value.trim());
        
        if (input.value && !isValid) {
            input.classList.add('is-invalid');
            const helpText = input.nextElementSibling;
            if (helpText && helpText.classList.contains('form-text')) {
                helpText.classList.add('text-danger');
            }
            return false;
        } else {
            input.classList.remove('is-invalid');
            const helpText = input.nextElementSibling;
            if (helpText && helpText.classList.contains('form-text')) {
                helpText.classList.remove('text-danger');
            }
            return true;
        }
    }

    // Gestion de l'autocomplétion des adresses
    const searchInput = document.getElementById('searchInput');
    const addressDropdown = document.getElementById('addressDropdown');

    if (searchInput) {
        let autocomplete;
        
        // Initialisation de l'autocomplétion Google Maps
        function initAutocomplete() {
            if (typeof google !== 'undefined' && google.maps && google.maps.places) {
                autocomplete = new google.maps.places.Autocomplete(
                    searchInput,
                    {
                        types: ['address'],
                        componentRestrictions: { country: 'ci' }, // Restreindre à la Côte d'Ivoire
                        fields: ['address_components', 'geometry', 'formatted_address']
                    }
                );

                // Gérer la sélection d'une adresse
                autocomplete.addListener('place_changed', onPlaceChanged);
                
                // Gérer la saisie manuelle
                searchInput.addEventListener('input', handleAddressInput);
            } else {
                console.warn('Google Maps JavaScript API non chargée');
            }
        }

        // Gérer la saisie manuelle
        function handleAddressInput() {
            if (searchInput.value.length > 2) {
                // Afficher un indicateur de chargement
                const loadingItem = document.createElement('li');
                loadingItem.innerHTML = '<div class="dropdown-item text-muted"><i class="fas fa-spinner fa-spin me-2"></i> Recherche en cours...</div>';
                addressDropdown.innerHTML = '';
                addressDropdown.appendChild(loadingItem);
                
                // Simuler un délai pour la recherche
                setTimeout(() => {
                    // Ici, vous pourriez appeler une API de géocodage personnalisée
                    // Pour l'instant, nous utilisons simplement l'autocomplétion Google
                }, 500);
            } else if (searchInput.value.length === 0) {
                addressDropdown.innerHTML = '<li><div class="dropdown-item text-muted small">Commencez à taper pour rechercher une adresse</div></li>';
            }
        }

        // Gérer la sélection d'une adresse
        function onPlaceChanged() {
            const place = autocomplete.getPlace();
            
            if (!place.geometry) {
                // L'utilisateur a entré une adresse qui n'a pas été trouvée
                showStatus('Aucune correspondance trouvée pour cette adresse', 'warning');
                return;
            }

            // Mettre à jour la carte avec l'emplacement sélectionné
            if (window.updateMapLocation && typeof window.updateMapLocation === 'function') {
                window.updateMapLocation(
                    place.geometry.location.lat(),
                    place.geometry.location.lng(),
                    place.formatted_address
                );
            }

            // Cacher le menu déroulant
            const dropdown = bootstrap.Dropdown.getInstance(document.getElementById('addressDropdownButton'));
            if (dropdown) {
                dropdown.hide();
            }
        }

        // Initialiser l'autocomplétion lorsque Google Maps est chargé
        if (typeof google !== 'undefined' && google.maps && google.maps.places) {
            initAutocomplete();
        } else {
            // Si Google Maps n'est pas encore chargé, attendre qu'il le soit
            const checkGoogleMaps = setInterval(() => {
                if (typeof google !== 'undefined' && google.maps && google.maps.places) {
                    clearInterval(checkGoogleMaps);
                    initAutocomplete();
                }
            }, 500);
        }
    }

    // Gestion du sélecteur de ville personnalisé
    const villeSelect = document.getElementById('villes_id');
    const villeDropdown = document.querySelector('#villes_id').closest('.input-group').querySelector('.dropdown-menu');

    if (villeSelect && villeDropdown) {
        // Ajouter la classe pour le style personnalisé
        const inputGroup = villeSelect.closest('.input-group');
        inputGroup.classList.add('select-ville');
        
        // Gérer la sélection d'une ville depuis le menu déroulant
        villeDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            const target = e.target.closest('.dropdown-item');
            if (target && target.dataset.value) {
                const value = target.dataset.value;
                const text = target.textContent.trim();
                
                // Mettre à jour la valeur sélectionnée
                villeSelect.value = value;
                
                // Mettre à jour le texte affiché
                const selectedOption = villeSelect.querySelector(`option[value="${value}"]`);
                if (selectedOption) {
                    selectedOption.selected = true;
                }
                
                // Déclencher l'événement change
                const event = new Event('change');
                villeSelect.dispatchEvent(event);
                
                // Fermer le menu déroulant
                const dropdown = bootstrap.Dropdown.getInstance(inputGroup.querySelector('.dropdown-toggle'));
                if (dropdown) {
                    dropdown.hide();
                }
            }
        });
        
        // Mettre en surbrillance l'option sélectionnée dans le menu déroulant
        villeSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            const dropdownItems = villeDropdown.querySelectorAll('.dropdown-item');
            
            dropdownItems.forEach(item => {
                if (item.dataset.value === selectedValue) {
                    item.classList.add('active');
                    item.setAttribute('aria-current', 'true');
                } else {
                    item.classList.remove('active');
                    item.removeAttribute('aria-current');
                }
            });
        });
        
        // Initialiser l'état du menu déroulant
        if (villeSelect.value) {
            const event = new Event('change');
            villeSelect.dispatchEvent(event);
        }
    }

    // Gestion de la carte (si présente)
    if (typeof initMap === 'function') {
        initMap();
    }
});

// Fonction pour afficher la prévisualisation du logo
function previewLogo(input) {
    const preview = document.getElementById('logoPreview');
    const previewImg = document.getElementById('logoPreviewImg');
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}

// Fonction pour supprimer le logo
function removeLogo() {
    const fileInput = document.getElementById('logo_compagnies');
    const preview = document.getElementById('logoPreview');
    
    fileInput.value = ''; // Réinitialiser l'input file
    preview.style.display = 'none'; // Cacher la prévisualisation
}

// Fonction pour afficher les messages d'état
function showStatus(message, type = 'info') {
    const statusElement = document.getElementById('statusMessage');
    if (statusElement) {
        statusElement.textContent = message;
        statusElement.className = `status-message alert alert-${type}`;
        
        // Masquer le message après 5 secondes
        setTimeout(() => {
            statusElement.textContent = '';
            statusElement.className = 'status-message';
        }, 5000);
    }
}
