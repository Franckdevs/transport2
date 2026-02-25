<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Félicitations - Paiement Réussi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(34, 197, 94, 0.3); }
            50% { box-shadow: 0 0 40px rgba(34, 197, 94, 0.6); }
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        
        .gradient-border {
            background: linear-gradient(45deg, #f59e0b, #eab308, #f59e0b);
            background-size: 200% 200%;
            animation: gradient-shift 3s ease infinite;
        }
        
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .success-icon {
            background: linear-gradient(135deg, #10b981, #34d399);
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
        }
        
        .error-icon {
            background: linear-gradient(135deg, #ef4444, #f87171);
            box-shadow: 0 10px 30px rgba(239, 68, 68, 0.3);
        }
        
        /* Styles d'impression */
        @media print {
            body {
                background: white !important;
                padding: 20px !important;
            }
            
            .bg-white {
                background: white !important;
                box-shadow: none !important;
                border: 1px solid #ccc !important;
            }
            
            .bg-yellow-50, .bg-red-50 {
                background: #f9f9f9 !important;
                border: 1px solid #ddd !important;
            }
            
            .bg-gradient-to-r {
                background: #3b82f6 !important;
            }
            
            button {
                display: none !important;
            }
            
            .fixed {
                display: none !important;
            }
            
            .min-h-[200px] {
                min-height: auto !important;
            }
            
            .transform {
                transform: none !important;
            }
            
            .hover\\:scale-105 {
                transform: none !important;
            }
            
            .shadow-xl {
                box-shadow: none !important;
            }
            
            .text-4xl {
                font-size: 2rem !important;
            }
            
            .w-24 {
                width: 4rem !important;
            }
            
            .h-24 {
                height: 4rem !important;
            }
            
            .p-4 {
                padding: 16px !important;
            }
            
            .p-6 {
                padding: 24px !important;
            }
            
            .mb-6 {
                margin-bottom: 24px !important;
            }
            
            .mt-8 {
                margin-top: 32px !important;
            }
            
            .gap-3 {
                gap: 12px !important;
            }
            
            .grid {
                display: block !important;
            }
            
            .grid-cols-1 {
                grid-template-columns: 1fr !important;
            }
            
            .md\\:grid-cols-2 {
                grid-template-columns: 1fr !important;
            }
            
            .flex-col {
                flex-direction: column !important;
            }
            
            .sm\\:flex-row {
                flex-direction: column !important;
            }
            
            /* Forcer l'affichage des détails sur mobile */
            @media (max-width: 768px) {
                .bg-white {
                    page-break-inside: avoid;
                }
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-yellow-50 to-amber-100 min-h-screen flex items-center justify-center p-4">
@if($status_code_paiement == 200)
    <div class="max-w-4xl w-full">
        <div class="bg-white rounded-2xl shadow-xl p-4 text-center transform transition-all duration-500 hover:scale-105 min-h-[200px]">
            <!-- Icône de succès animée -->
            <div class="mb-6">
                <div class="w-24 h-24 success-icon rounded-full flex items-center justify-center mx-auto float-animation">
                    <i class="fas fa-check text-white text-4xl"></i>
                </div>
                <div class="mt-4 flex justify-center space-x-2">
                    <span class="inline-block w-2 h-2 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0s"></span>
                    <span class="inline-block w-2 h-2 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                    <span class="inline-block w-2 h-2 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></span>
                </div>
            </div>
            
            <!-- Titre principal -->
            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                Félicitations !
            </h1>
            
            <!-- Message de félicitation -->
            <p class="text-gray-600 mb-6 leading-relaxed">
                Votre paiement a été traité avec succès. Merci pour votre confiance !
            </p>
            
            <p class="text-sm text-gray-700 font-medium">
                <i class="fas fa-building mr-2 text-amber-600"></i>
                Compagnie {{ $paiement->compagnie->nom_complet_compagnies ?? 'N/A' }}
            </p>
            
            <!-- Détails supplémentaires -->
            <div class="bg-yellow-50 rounded-lg p-6 mb-6">
                <p class="text-sm text-yellow-700 mb-4">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Transaction sécurisée et confirmée
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Informations utilisateur -->
                    @if($paiement->utilisateur)
                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <p class="text-xs text-yellow-600 font-semibold mb-2">Informations client:</p>
                        
                        @if(!empty($paiement->nom_complet) && !empty($paiement->telephone_proprietaire))
                            <div class="space-y-3">
                                <div>
                                    <span class="block text-xs font-semibold text-gray-600 uppercase mb-1">Propriétaire</span>
                                    <div class="space-y-1">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Nom:</span>
                                            <span class="text-sm text-gray-700">{{ $paiement->nom_complet }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Téléphone:</span>
                                            <span class="text-sm text-gray-700">{{ $paiement->telephone_proprietaire }}7</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 border-t border-gray-200">
                                    <span class="block text-xs font-semibold text-gray-600 uppercase mb-1">Utilisateur attribution</span>
                                    <div class="space-y-1">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Nom:</span>
                                            <span class="text-sm text-gray-700">{{ $paiement->utilisateur->nom ?? '-' }} {{ $paiement->utilisateur->prenom ?? '-' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Email:</span>
                                            <span class="text-sm text-gray-700">{{ $paiement->utilisateur->email ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Nom:</span>
                                    <span class="text-sm text-gray-700">{{ $paiement->utilisateur->nom ?? '-' }} {{ $paiement->utilisateur->prenom ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Email:</span>
                                    <span class="text-sm text-gray-700">{{ $paiement->utilisateur->email ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Téléphone:</span>
                                    <span class="text-sm text-gray-700">{{ $paiement->telephone }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    @endif
                     
                    <!-- Informations réservation -->
                    @if($paiement->reservation)
                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <p class="text-xs text-yellow-600 font-semibold mb-2">Réservation & Paiement:</p>
                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Numéro:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->reservation->numero_reservation ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Place:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->numero_place ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Montant:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->montant ?? 'N/A' }} FCFA</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Moyen paiement:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->moyenPaiement ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Code paiement:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->code_paiement ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Code statut:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->code ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Date paiement:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->datePaiement ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Heure paiement:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->HeurePaiement ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
         
            <!-- Boutons d'action -->
            {{-- <div class="flex justify-center mt-8">
                <button onclick="window.print()" 
                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg flex items-center justify-center">
                    <i class="fas fa-print mr-2"></i>
                    Imprimer le reçu
                </button>
            </div> --}}
        </div>
        
        <!-- Animation de confettis (optionnel) -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-10 left-10 text-yellow-400 text-2xl animate-pulse">✨</div>
            <div class="absolute top-20 right-20 text-green-400 text-xl animate-pulse" style="animation-delay: 0.5s">🎉</div>
            <div class="absolute bottom-20 left-20 text-blue-400 text-2xl animate-pulse" style="animation-delay: 1s">🎊</div>
            <div class="absolute bottom-10 right-10 text-purple-400 text-xl animate-pulse" style="animation-delay: 1.5s">✨</div>
        </div>
    </div>
@else
    <div class="max-w-4xl w-full">
        <div class="bg-white rounded-2xl shadow-xl p-4 text-center transform transition-all duration-500 hover:scale-105 min-h-[200px]">
            <!-- Icône d'erreur -->
            <div class="mb-6">
                <div class="w-24 h-24 error-icon rounded-full flex items-center justify-center mx-auto float-animation">
                    <i class="fas fa-times text-white text-4xl"></i>
                </div>
                <div class="mt-4 flex justify-center space-x-2">
                    <span class="inline-block w-2 h-2 bg-red-400 rounded-full animate-bounce" style="animation-delay: 0s"></span>
                    <span class="inline-block w-2 h-2 bg-red-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                    <span class="inline-block w-2 h-2 bg-red-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></span>
                </div>
            </div>
            
            <!-- Titre d'erreur -->
            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                Erreur de paiement
            </h1>
            
            <!-- Message d'erreur -->
            <p class="text-gray-600 mb-6 leading-relaxed">
                Une erreur est survenue lors du traitement de votre paiement. Veuillez réessayer ou contacter le support.
            </p>
            
            <p class="text-sm text-gray-700 font-medium">
                <i class="fas fa-building mr-2 text-red-600"></i>
                Compagnie {{ $paiement->compagnie->nom_complet_compagnies ?? 'N/A' }}
            </p>
            
            
            <!-- Détails de l'erreur -->
            <div class="bg-red-50 rounded-lg p-4 mb-1">
                <p class="text-sm text-red-700">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Code d'erreur: {{ $status_code_paiement }}
                </p>
            </div>
            
            <!-- Informations client et paiement même en cas d'erreur -->
            <div class="bg-yellow-50 rounded-lg p-6 mb-6">
                <p class="text-sm text-yellow-700 mb-4">
                    <i class="fas fa-info-circle mr-2"></i>
                    Détails de la tentative de paiement
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Informations utilisateur -->
                    @if($paiement->utilisateur)
                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <p class="text-xs text-yellow-600 font-semibold mb-2">Informations client:</p>
                        
                        @if(!empty($paiement->nom_complet) && !empty($paiement->telephone_proprietaire))
                            <div class="space-y-3">
                                <div>
                                    <span class="block text-xs font-semibold text-gray-600 uppercase mb-1">Propriétaire</span>
                                    <div class="space-y-1">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Nom:</span>
                                            <span class="text-sm text-gray-700">{{ $paiement->nom_complet }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Téléphone:</span>
                                            <span class="text-sm text-gray-700">{{ $paiement->telephone_proprietaire }}7</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 border-t border-gray-200">
                                    <span class="block text-xs font-semibold text-gray-600 uppercase mb-1">Utilisateur attribution</span>
                                    <div class="space-y-1">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Nom:</span>
                                            <span class="text-sm text-gray-700">{{ $paiement->utilisateur->nom ?? '-' }} {{ $paiement->utilisateur->prenom ?? '-' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Email:</span>
                                            <span class="text-sm text-gray-700">{{ $paiement->utilisateur->email ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Nom:</span>
                                    <span class="text-sm text-gray-700">{{ $paiement->utilisateur->nom ?? '-' }} {{ $paiement->utilisateur->prenom ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Email:</span>
                                    <span class="text-sm text-gray-700">{{ $paiement->utilisateur->email ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Téléphone:</span>
                                    <span class="text-sm text-gray-700">{{ $paiement->telephone }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    @endif
                     
                    <!-- Informations réservation -->
                    @if($paiement->reservation)
                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <p class="text-xs text-yellow-600 font-semibold mb-2">Réservation & Paiement:</p>
                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Numéro:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->reservation->numero_reservation ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Place:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->numero_place ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Montant:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->montant ?? 'N/A' }} FCFA</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Moyen paiement:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->moyenPaiement ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Code paiement:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->code_paiement ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Code statut:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->code ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Date paiement:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->datePaiement ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Heure paiement:</span>
                                <span class="text-sm text-gray-700">{{ $paiement->HeurePaiement ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Boutons d'action en cas d'erreur -->
            {{-- <div class="flex flex-col sm:flex-row gap-3 justify-center mt-8">
               
                
                <button onclick="window.print()" 
                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg flex items-center justify-center">
                    <i class="fas fa-print mr-2"></i>
                    Imprimer les détails
                </button>
            </div> --}}
        </div>
    </div>
@endif
</body>
</html>
