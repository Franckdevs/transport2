<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur - Paiement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(239, 68, 68, 0.3); }
            50% { box-shadow: 0 0 40px rgba(239, 68, 68, 0.6); }
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
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
            
            button {
                display: none !important;
            }
            
            .min-h-[300px] {
                min-height: auto !important;
            }
            
            .transform {
                transform: none !important;
            }
            
            .shadow-xl {
                box-shadow: none !important;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-red-50 to-pink-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-4xl w-full">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center transform transition-all duration-500 hover:scale-105 min-h-[300px] mx-auto">
           
            <!-- Icône d'erreur animée -->
            <div class="mb-6">
                <div class="w-24 h-24 error-icon rounded-full flex items-center justify-center mx-auto float-animation">
                    <i class="fas fa-exclamation-triangle text-white text-4xl"></i>
                </div>
                <div class="mt-4 flex justify-center space-x-2">
                    <span class="inline-block w-2 h-2 bg-red-400 rounded-full animate-bounce" style="animation-delay: 0s"></span>
                    <span class="inline-block w-2 h-2 bg-red-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                    <span class="inline-block w-2 h-2 bg-red-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></span>
                </div>
            </div>
            
            <!-- Titre d'erreur -->
            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                Une erreur s'est produite
            </h1>
            
            <!-- Message d'erreur -->
            <p class="text-gray-600 mb-6 leading-relaxed">
                Nous sommes désolés, une erreur inattendue s'est produite lors du traitement de votre demande. 
                Veuillez réessayer ultérieurement ou contacter notre support technique si le problème persiste.
            </p>
            
            <!-- Badge d'erreur -->
            <div class="flex justify-center mt-4 mb-6">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-100 text-red-800 pulse-glow">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    Erreur Serveur
                </span>
            </div>
            
                    </div>
    </div>
</body>
</html>
