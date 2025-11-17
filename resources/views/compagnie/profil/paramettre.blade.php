<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres du Compte - BETRO</title>
    @include('compagnie.all_element.header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Styles de base */
        body {
            background-color: #f8f9fa;
            color: #333;
        }

        .page-header {
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            padding: 1rem 0;
        }

        .page-body {
            background: #fff;
            padding: 2rem 0;
        }

        .container-fluid {
            max-width: 1200px;
            padding: 0 15px;
        }

        /* Titre principal */
        .page-body h3 {
            font-weight: 500;
            color: #444;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e0e0e0;
        }

        /* Cartes */
        .card {
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            margin-bottom: 2rem;
            background: #fff;
        }

        .card-header {
            background: #f5f5f5;
            border-bottom: 1px solid #e0e0e0;
            padding: 1rem 1.25rem;
        }

        .card-header h5 {
            font-weight: 500;
            margin: 0;
            font-size: 1.1rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Formulaires */
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #555;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 0.5rem 0.75rem;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.1);
        }

        /* Boutons */
        .btn {
            border-radius: 4px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-outline-secondary {
            border: 1px solid #ddd;
            color: #555;
            background: white;
        }

        .btn-outline-secondary:hover {
            background: #f8f9fa;
            border-color: #ccc;
        }

        .btn-warning:hover {
            background: #e67e22;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(243, 156, 18, 0.3);
        }

        /* Grille */
        .row {
            gap: 20px 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 20px;
            }
            
            .card-header {
                padding: 15px 20px;
            }
            
            .btn {
                width: 100%;
            }
        }

        /* Messages d'alerte */
        .alert {
            border: none;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: rgba(39, 174, 96, 0.1);
            color: #27ae60;
            border-left: 4px solid #27ae60;
        }

        .alert-warning {
            background: rgba(243, 156, 18, 0.1);
            color: #f39c12;
            border-left: 4px solid #f39c12;
        }
    </style>
</head>

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
        {{-- <h3 class="mb-4 text-uppercase">
          <i class="fas fa-cogs me-2"></i>Paramètres du compte
        </h3> --}}

        @if(session('success'))
        <div class="alert alert-success" role="alert">
          <i class="fas fa-check-circle me-2"></i>
          {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-warning" role="alert">
          <i class="fas fa-exclamation-triangle me-2"></i>
          {{ $errors->first() }}
        </div>
        @endif

        <div class="row">
          <!-- Informations utilisateur -->
          <div class="col-lg-6 mb-4">
            <div class="card">
              <div class="card-header">
                <h5>
                  <i class="fas fa-user-edit"></i>
                  Mes informations administrateur
                </h5>
              </div>
              <div class="card-body">
                <form action="{{ route('paramettre.updateInfos') }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" 
                           value="{{ auth()->user()->nom }}" placeholder="Votre nom">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" 
                           value="{{ auth()->user()->prenom }}" placeholder="Votre prénom">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" 
                           value="{{ auth()->user()->telephone }}" placeholder="Votre téléphone">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" 
                           value="{{ auth()->user()->email }}" placeholder="Votre email">
                  </div>

                  <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-2"></i>Mettre à jour
                  </button>
                </form>
              </div>
            </div>
          </div>

          <!-- Changer le mot de passe -->
          <div class="col-lg-6 mb-4">
            <div class="card">
              <div class="card-header">
                <h5>
                  <i class="fas fa-lock"></i>
                  Changer le mot de passe
                </h5>
              </div>
              <div class="card-body">
                <form action="{{ route('paramettre.updatePassword') }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="mb-3">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="new_password" class="form-control" required 
                           placeholder="Saisir le nouveau mot de passe">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="new_password_confirmation" class="form-control" required 
                           placeholder="Confirmer le nouveau mot de passe">
                  </div>

                  <button type="submit" class="btn btn-warning">
                    <i class="fas fa-lock me-2"></i>Modifier le mot de passe
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('compagnie.all_element.footer')
  </div>

  <script src="../assets/js/theme.js"></script>
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
</body>
</html>