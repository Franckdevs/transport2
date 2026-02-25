<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BETRO - Plateforme de Gestion de Transport</title>
        <link rel="icon" href="{{ asset('log.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #ffd000;
            --secondary-color: #000000;
            --accent-color: #ffeb3b;
            --light-color: #ffffff;
            --dark-color: #000000;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --info-color: #000000;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
            background: linear-gradient(120deg, #ffffff 0%, #ffffff 100%);
        }
        
        .navbar {
            background: rgba(255,255,255,0.95)!important;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        }
        
        .navbar-brand {
            font-size: 2rem;
            letter-spacing: 2px;
            font-weight: 700;
            color: var(--primary-color) !important;
        }
        
        .navbar-nav .nav-link {
            font-weight: 500;
            transition: color 0.2s;
            color: var(--primary-color) !important;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--secondary-color) !important;
        }
        
        .btn-connexion {
            animation: bounceIn 1.2s;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border: none;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
        }
        
        @keyframes bounceIn {
            0% { transform: scale(0.7);}
            60% { transform: scale(1.1);}
            100% { transform: scale(1);}
        }
        
        .header-bg {
            background-image: url('{{ $imageAcceuilWeb ?? asset('all_image/bus_route.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 480px;
            width: 100%;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeInDown 1.2s;
            margin-top: 2rem;
            position: relative;
        }
        
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-40px);}
            to { opacity: 1; transform: translateY(0);}
        }
        
        .header-overlay {
            background: rgba(255,255,255,0.9);
            padding: 2.5rem 3rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 600px;
            margin: auto;
        }
        
        .header-avatars {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .header-avatars img {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border: 2px solid var(--primary-color);
            background: #fff;
        }
        
        .section-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 30px;
            font-weight: 700;
            color: var(--dark-color);
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }
        
        .section-title.center:after {
            left: 50%;
            transform: translateX(-50%);
        }
        
        /* Animation d'apparition */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }
        
        .fade-in.delay-1 { animation-delay: 0.2s; }
        .fade-in.delay-2 { animation-delay: 0.4s; }
        .fade-in.delay-3 { animation-delay: 0.6s; }
        
        /* Section À propos améliorée */
        #apropos {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-top: 40px;
            margin-bottom: 40px;
            overflow: hidden;
            position: relative;
        }
        
        #apropos::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, var(--accent-color) 0%, transparent 70%);
            opacity: 0.1;
            border-radius: 50%;
            transform: translate(100px, -100px);
        }
        
        #apropos .img-container {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        #apropos .img-container:hover {
            transform: translateY(-5px);
        }
        
        #apropos .img-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255,208,0,0.12) 0%, rgba(255,235,59,0.08) 100%);
        }
        
        .feature-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            margin: 5px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .feature-badge:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
        
        .feature-badge i {
            margin-right: 8px;
        }
        
        .user-avatars {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-left: -12px;
            transition: all 0.3s ease;
        }
        
        .user-avatar:hover {
            transform: translateY(-5px);
            z-index: 10;
        }
        
        .user-avatar:first-child {
            margin-left: 0;
        }
        
        .stats-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-top: 30px;
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            line-height: 1;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 5px;
        }
        
        /* Section Comment ça marche */
        #processus {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-top: 40px;
            margin-bottom: 40px;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }
        
        #processus::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }
        
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 15px;
            width: 3px;
            background: linear-gradient(to bottom, var(--primary-color), var(--accent-color));
            border-radius: 3px;
        }
        
        .timeline-step {
            position: relative;
            margin-bottom: 40px;
            padding: 25px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }
        
        .timeline-step:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-left: 4px solid var(--accent-color);
        }
        
        .timeline-icon {
            position: absolute;
            left: -45px;
            top: 25px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            z-index: 10;
        }
        
        .timeline-content h5 {
            color: var(--dark-color);
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .timeline-content p {
            color: #6c757d;
            margin-bottom: 0;
        }
        
        .process-illustration {
            position: absolute;
            right: -50px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.05;
            width: 300px;
            height: 300px;
        }
        
        /* Section Services */
        #services {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-top: 40px;
            margin-bottom: 40px;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }
        
        #services::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }
        
        .card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            height: 100%;
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(255,208,0,0.25);
        }
        
        .card-body {
            padding: 25px;
        }
        
        .card-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 15px;
        }
        
        .card-text {
            color: #6c757d;
        }
        
        .service-icon {
            width: 64px;
            height: 64px;
            border-radius: 15px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(255,208,0,0.2);
        }
        
        .service-icon i {
            font-size: 1.8rem;
            color: white;
        }
        
        /* Section Partenaires */
        #partenaires {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-top: 40px;
            margin-bottom: 40px;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }
        
        #partenaires::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, var(--accent-color) 0%, transparent 70%);
            opacity: 0.1;
            border-radius: 50%;
            transform: translate(-100px, 100px);
        }
        
        .partner-logo {
            width: 100px;
            height: 100px;
            border-radius: 15px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 15px;
        }
        
        .partner-logo img {
            max-width: 100%;
            max-height: 100%;
        }
        
        /* Section Contact */
        #contact {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-top: 40px;
            margin-bottom: 40px;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }
        
        #contact::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, var(--accent-color) 0%, transparent 70%);
            opacity: 0.1;
            border-radius: 50%;
            transform: translate(100px, -100px);
        }
        
        .contact-form input, .contact-form textarea {
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .contact-form input:focus, .contact-form textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255,208,0,0.15);
        }
        
        /* Style pour le bouton avec loader */
        .btn-with-loader {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-loader {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .contact-form button {
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .contact-form button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255,208,0,0.35);
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 30px 0;
            text-align: center;
            margin-top: 40px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .timeline::before {
                left: 10px;
            }
            
            .timeline-icon {
                left: -35px;
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
            
            .timeline {
                padding-left: 20px;
            }
            
            .process-illustration {
                display: none;
            }
            
            .section-title.center:after {
                left: 0;
                transform: none;
            }
            
            .header-overlay {
                padding: 1.5rem;
            }
            
            .header-avatars img {
                width: 48px;
                height: 48px;
            }
        }
        /* Overrides to replace Bootstrap blue with white */
        .text-primary, .text-info {
            color: #ffffff !important;
        }
        .bg-primary, .bg-info {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
        .btn-primary {
            background-color: #ffffff !important;
            border-color: #ffffff !important;
            color: #000000 !important;
        }
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: #f8f9fa !important;
            border-color: #f8f9fa !important;
            color: #000000 !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                {{-- BETRO  --}}
                <img src="{{ asset('log.png') }}" alt="" style="height: 45px; width: auto;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse fade-in" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#apropos">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#processus">Comment ça marche</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Nos services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#partenaires">Partenaires</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact-section">Contact</a></li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-connexion text-white ms-lg-3">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a href="#inscription-section" class="btn btn-connexion text-white ms-lg-2">S'inscrire</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<header class="container-fluid header-bg">
    <div class="header-overlay fade-in" style="background: rgba(255,255,255,0.18); backdrop-filter: blur(8px); animation: headerPulse 3s infinite alternate;">
        <h1 class="display-5 fw-bold text-primary mb-3 ">Bienvenue chez BETRO</h1>
        <p class="lead mb-4">La solution moderne, intuitive et collaborative pour la gestion de votre compagnie de transport.</p>
        <div class="d-flex gap-2 justify-content-center">
            <a href="{{ route('login') }}" class="btn btn-connexion text-white">Se connecter</a>
            {{-- <a href="{{ url('/register') }}" class="btn btn-connexion text-white">S'inscrire</a> --}}
        </div>
    </div>
</header>
<style>
@keyframes headerPulse {
    0% { background: rgba(255,255,255,0.18); }
    50% { background: rgba(255,255,255,0.28); }
    100% { background: rgba(255,255,255,0.18); }
}
</style>

    <!-- Section À propos améliorée -->
    <section id="apropos" class="container py-5 fade-in">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h2 class="section-title">À propos de BETRO</h2>
                <p class="lead mb-4">
                    BETRO est une plateforme innovante dédiée à la gestion efficace des compagnies de transport. Notre mission est de simplifier la gestion, optimiser les opérations et offrir une expérience fluide à nos clients.
                </p>
                
                <div class="mb-4">
                    <span class="feature-badge bg-primary text-white">
                        <i class="fas fa-check-circle"></i> +3 compagnies utilisent BETRO
                    </span>
                </div>
                
                <div class="d-flex flex-wrap mb-4">
                    <span class="feature-badge bg-info text-white">
                        <i class="fas fa-shield-alt"></i> Sécurité des données
                    </span>
                    <span class="feature-badge bg-info text-white">
                        <i class="fas fa-headset"></i> Support 24/7
                    </span>
                    <span class="feature-badge bg-info text-white">
                        <i class="fas fa-rocket"></i> Innovation continue
                    </span>
                </div>
                
                <div class="row mt-4">
                    <div class="col-4">
                        <div class="stats-container fade-in delay-1">
                            <div class="stat-number">+3</div>
                            <div class="stat-label">Compagnies</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stats-container fade-in delay-2">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Support</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stats-container fade-in delay-3">
                            <div class="stat-number">100%</div>
                            <div class="stat-label">Satisfaction</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 text-center">
                <div class="img-container mb-4 fade-in">
                    <img src="{{ $sousImageAcceuilWeb ?? asset('all_image/bus_route.jpg') }}" alt="BETRO équipe" class="img-fluid rounded">
                </div>
                
                    {{-- <div class="user-avatars">
                        <img src="https://randomuser.me/api/portraits/men/12.jpg" class="user-avatar" alt="user">
                        <img src="https://randomuser.me/api/portraits/women/23.jpg" class="user-avatar" alt="user">
                        <img src="https://randomuser.me/api/portraits/men/34.jpg" class="user-avatar" alt="user">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" class="user-avatar" alt="user">
                        <div class="user-avatar bg-primary text-white d-flex align-items-center justify-content-center">
                            <span class="fw-bold">+50</span>
                        </div>
                    </div> --}}
                <p class="text-muted mt-2">Notre équipe dédiée à votre succès</p>
            </div>
        </div>
    </section>

    <!-- Section Processus : Comment ça marche -->
    <section id="processus" class="container py-5 fade-in">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title center">Comment ça marche</h2>
                <p class="lead">Découvrez notre processus simple et efficace pour gérer votre compagnie de transport</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="timeline">
                    <div class="timeline-step">
                        <div class="timeline-icon bg-primary">
                            <span>1</span>
                        </div>
                        <div class="timeline-content">
                            <h5>Déclaration de la compagnie</h5>
                            <p>Un représentant de la compagnie contacte BETRO pour la création de son espace entreprise sur la plateforme. Notre équipe vous accompagne dans cette première étape.</p>
                        </div>
                    </div>
                    
                    <div class="timeline-step">
                        <div class="timeline-icon bg-primary">
                            <span>2</span>
                        </div>
                        <div class="timeline-content">
                            <h5>Connexion administrateur</h5>
                            <p>Après validation, le représentant se connecte en tant qu'administrateur de la compagnie avec des identifiants sécurisés et un accès complet à toutes les fonctionnalités.</p>
                        </div>
                    </div>
                    
                    <div class="timeline-step">
                        <div class="timeline-icon bg-primary">
                            <span>3</span>
                        </div>
                       <div class="timeline-content">
    <h5>Création des gares et arrêts</h5>
    <p>
        L'administrateur crée les gares dans chaque ville desservie avec une interface intuitive et des outils de géolocalisation avancés.<br>
        Il attribue également les permissions spécifiques à chaque administrateur local pour la gestion des gares et arrêts de leur ville.
    </p>
</div>
                    </div>
                    
                    <div class="timeline-step">
                        <div class="timeline-icon bg-primary">
                            <span>4</span>
                        </div>
                        <div class="timeline-content">
    <h5>Gestion des bus, chauffeurs , personnel , itinéraires , voyages , réservations</h5>
    <p>
        <strong>Gestion des bus :</strong><br>
        L'administrateur peut créer un nouveau bus en renseignant le libellé, la marque, le modèle, l'immatriculation, la localisation, le nombre de places, la configuration des sièges et ajouter une photo du bus.<br>
        Chaque bus est associé à une gare et peut être affecté à un itinéraire ou à un voyage.<br><br>
        <strong>Gestion des chauffeurs :</strong><br>
        Pour chaque chauffeur, l'administrateur renseigne le nom, prénom, adresse, téléphone, numéro de permis, date de naissance et photo.<br>
        Les chauffeurs sont ensuite affectés aux bus et aux voyages selon les besoins de la compagnie.<br><br>
        <strong>Gestion du personnel :</strong><br>
        L'administrateur peut ajouter des membres du personnel en précisant leur nom, prénom, téléphone, email, fonction et photo.<br>
        Chaque membre du personnel se voit attribuer un rôle spécifique (gestionnaire, agent de gare, etc.) pour faciliter la gestion et la sécurité.<br><br>
        <strong>Gestion des itinéraires et voyages :</strong><br>
        Création des itinéraires en sélectionnant les gares de départ, arrêts, estimation du voyage et titre du trajet.<br>
        Pour chaque voyage, l'administrateur choisit l'itinéraire, le bus, le chauffeur, la date et l'heure de départ.<br><br>
        <strong>Gestion des réservations :</strong><br>
        Suivi des réservations en ligne, gestion des places disponibles, statut de paiement et accès aux détails des clients.<br>
        Toutes ces opérations sont accessibles via une interface claire, sécurisée et adaptée à chaque rôle dans la compagnie.
    </p>
</div>
                    </div>
                    
                    <div class="timeline-step">
                        <div class="timeline-icon bg-primary">
                            <span>5</span>
                        </div>
                        <div class="timeline-content">
                            <h5>Suivi et optimisation</h5>
                            <p>Suivi des opérations, paiements et optimisation continue via BETRO. Accédez à des rapports détaillés et des analyses pour améliorer votre performance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Illustration décorative -->
        <svg class="process-illustration" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <path d="M50,10 A40,40 0 1,1 50,90 A40,40 0 1,1 50,10 Z" fill="none" stroke="var(--primary-color)" stroke-width="2"/>
            <circle cx="50" cy="50" r="30" fill="none" stroke="var(--accent-color)" stroke-width="1.5"/>
            <circle cx="50" cy="50" r="20" fill="none" stroke="var(--primary-color)" stroke-width="1"/>
            <circle cx="50" cy="50" r="10" fill="var(--primary-color)" opacity="0.5"/>
        </svg>
    </section>

    <!-- Section Services -->
    <section id="services" class="container py-5 fade-in">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title center">Nos services</h2>
                <p class="lead">Découvrez toutes les fonctionnalités conçues pour optimiser votre gestion de transport</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon mx-auto">
                            <i class="fas fa-bus"></i>
                        </div>
                        <h5 class="card-title">Gestion des bus</h5>
                        <p class="card-text">Ajoutez, suivez et gérez tous les bus de votre flotte avec efficacité.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon mx-auto">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h5 class="card-title">Gestion des paiements</h5>
                        <p class="card-text">Suivi des paiements, facturation et gestion des transactions sécurisées.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon mx-auto">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h5 class="card-title">Gestion des chauffeurs</h5>
                        <p class="card-text">Organisation des équipes, suivi des horaires et gestion des compétences des chauffeurs.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon mx-auto">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5 class="card-title">Gestion du personnel</h5>
                        <p class="card-text">Gestion des employés.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon mx-auto">
                            <i class="fas fa-route"></i>
                        </div>
                        <h5 class="card-title">Gestion des itinéraires</h5>
                        <p class="card-text">Création, optimisation et suivi des itinéraires pour tous vos trajets.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon mx-auto">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h5 class="card-title">Gestion des voyages</h5>
                        <p class="card-text">Planification, organisation et suivi des voyages pour chaque compagnie.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon mx-auto">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h5 class="card-title">Gestion des réservations</h5>
                        <p class="card-text">Réservation en ligne, gestion des places et suivi des clients.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon mx-auto">
                            <i class="fas fa-map-pin"></i>
                        </div>
                        <h5 class="card-title">Gestion de création de gare et arrêt</h5>
                        <p class="card-text">Ajoutez et gérez les gares et arrêts pour chaque compagnie selon vos besoins.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Partenaires -->
    <section id="partenaires" class="container py-5 fade-in">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title center">Nos services partenaires</h2>
                <p class="lead">Nous collaborons avec les meilleurs pour vous offrir une expérience complète</p>
            </div>
        </div>
        
        <div class="row justify-content-center g-4">
           <div class="col-md-5">
            <div class="card h-100 shadow-sm text-center">
                <div class="card-body">
                    <div class="partner-logo">
                        <img src="{{ asset('all_image/image_bmi.jpg') }}" alt="Logo BMI" style="max-width:80px; max-height:80px;">
                    </div>
                    <h5 class="card-title text-primary">BMI-WFS</h5>
                    <p class="card-text">Partenaire international pour la gestion et l'optimisation du transport.</p>
                </div>
            </div>
        </div>
            <div class="col-md-5">
                <div class="card h-100 shadow-sm text-center">
                    <div class="card-body">
                        <div class="partner-logo">
                <img src="{{ asset('all_image/image_tresormoney.png') }}" alt="Logo BMI" style="max-width:80px; max-height:80px;">
                        </div>
                        <h5 class="card-title text-primary">TrésorMoney</h5>
                        <p class="card-text">Solution de paiement et de gestion financière dédiée au systeme.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Contact -->
    <section id="contact-section" class="container py-5 fade-in">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title center">Contactez-nous</h2>
                <p class="lead">Une question ? Notre équipe est là pour vous aider</p>
            </div>
        </div>

          @if(session('successs'))
            <div class="alert alert-success">
                {{ session('successs') }}
            </div>
        @endif
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form class="contact-form" action="{{ route('contact.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Votre nom" name="nom_complet" value="{{ old('nom_complet') }}" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Votre email" name="votre_email" value="{{ old('votre_email') }}" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Votre message" name="votre_message" value="{{ old('votre_message') }}" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary text-white" id="contact-submit-btn">
                            <span id="submit-text">Envoyer</span>
                            <div id="submit-loader" class="spinner-border spinner-border-sm text-light ms-2 d-none" role="status">
                                <span class="visually-hidden">Chargement...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Section Inscription (Création d'entreprise et administrateur) -->
    @php
        use App\Models\Ville;
        $villes = Ville::all();
    @endphp
    <section id="inscription-section" class="container py-5 fade-in">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2 class="section-title center">Créer une compagnie</h2>
                <p class="lead">Inscrivez votre compagnie et son administrateur en quelques étapes</p>
            </div>
        </div>
        {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Veuillez corriger les erreurs ci-dessous.</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
            <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <!-- Partie Compagnie -->
                                <div class="col-lg-6">
                                    <h5 class="mb-3"><i class="fas fa-arrow-right me-2"></i> COMPAGNIE</h5>
                                    <div class="mb-3">
                                        <label for="nom_complet_compagnies" class="form-label">Nom de la compagnie <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nom_complet_compagnies" name="nom_complet_compagnies" required minlength="2" maxlength="100" value="{{ old('nom_complet_compagnies') }}">
                                        @error('nom_complet_compagnies')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email_compagnies" class="form-label">Email compagnie <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email_compagnies" name="email_compagnies" required value="{{ old('email_compagnies') }}">
                                        @error('email_compagnies')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="telephone_compagnies" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><span aria-hidden="true">🇨🇮 +225</span><span class="visually-hidden">Indicatif téléphonique de la Côte d'Ivoire</span></span>
                                            <input type="tel" class="form-control" id="telephone_compagnies_home" name="telephone_compagnies" required pattern="[0-9]{10}" maxlength="10" inputmode="numeric" placeholder="0700000000" oninput="this.value=this.value.replace(/\D/g,'').slice(0,10)" value="{{ old('telephone_compagnies') }}">
                                        </div>
                                        @error('telephone_compagnies')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="adresse_compagnies" class="form-label">Adresse (Facultatif)</label>
                                        <input type="text" class="form-control" id="adresse_compagnies" name="adresse_compagnies" value="{{ old('adresse_compagnies') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description_compagnies" class="form-label">Description (Facultatif)</label>
                                        <textarea class="form-control" id="description_compagnies" name="description_compagnies" rows="3">{{ old('description_compagnies') }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="villes_id" class="form-label">Ville <span class="text-danger">*</span></label>
                                        <select class="form-select" id="villes_id" name="villes_id" required>
                                            <option value="">Sélectionner une ville</option>
                                            @foreach($villes as $ville)
                                                <option value="{{ $ville->id }}" {{ old('villes_id') == $ville->id ? 'selected' : '' }}>{{ $ville->nom_ville }}</option>
                                            @endforeach
                                        </select>
                                        @error('villes_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="logo_compagnies" class="form-label">Logo  (Formats : JPG, JPEG, PNG, GIF – Taille max : 10 Mo)</label>
                                        <input type="file" class="form-control" id="logo_compagnies" name="logo_compagnies" accept="image/*" onchange="previewLogoHome(this); updateFileInfo(this);">
                                        <div id="logoPreviewHome" class="mt-2 text-center" style="display: none;">
                                            <img id="logoPreviewImgHome" src="#" alt="Aperçu du logo" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                        </div>
                                        <div id="fileInfo" class="small text-muted mt-1"></div>
                                        @error('logo_compagnies')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>

                                     <div class="mt-2">
                                        <h6 class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Localisation de la compagnie</h6>
                                        <div class="input-group mb-2">
                                            <input type="text" name="adresse" id="searchInputHome" class="form-control" placeholder="Rechercher une adresse..." autocomplete="off">
                                            <button type="button" id="locateBtnHome" class="btn btn-connexion d-flex align-items-center">
                                                <i class="fas fa-location-arrow me-1"></i>
                                                <span>Me localiser</span>
                                            </button>
                                        </div>
                                        <div id="statusMessageHome" class="status-message small mb-2"></div>
                                        <div id="mapHome" style="height: 260px; border-radius: 8px;" aria-label="Carte de localisation"></div>
                                        <input type="hidden" id="latitudeHome" name="latitude">
                                        <input type="hidden" id="longitudeHome" name="longitude">
                                    </div>
                                    
                                </div>

                                <!-- Séparateur (desktop) -->
                                <div class="col-lg-1 d-none d-lg-flex align-items-stretch">
                                    <div style="width:1px; background:#ddd; height:100%"></div>
                                </div>

                                <!-- Partie Administrateur -->
                                <div class="col-lg-5">
                                    <h5 class="mb-3"><i class="fas fa-arrow-right me-2"></i> ADMINISTRATEUR DE LA COMPAGNIE</h5>
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom administrateur  <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nom" name="nom" required pattern="[A-Za-zÀ-ÿ\s-]+" value="{{ old('nom') }}">
                                        @error('nom')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="prenom" class="form-label">Prénom administrateur  <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" required pattern="[A-Za-zÀ-ÿ\s-]+" value="{{ old('prenom') }}">
                                        @error('prenom')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="telephone" class="form-label">Téléphone administrateur  <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="countryCodeBtnHome">
                                                <span>🇨🇮</span>
                                                <span>+225</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item active" href="#">🇨🇮 Côte d'Ivoire (+225)</a></li>
                                            </ul>
                                            <input type="hidden" name="country_code" value="+225">
                                            <input type="tel" class="form-control" id="telephone_home" name="telephone" required pattern="[0-9]{10}" maxlength="10" inputmode="numeric" placeholder="0700000000" oninput="this.value=this.value.replace(/\D/g,'').slice(0,10)" value="{{ old('telephone') }}">
                                        </div>
                                        @error('telephone')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                        <div class="form-text">10 chiffres uniquement</div>
                                    </div>
                                    <div class="mb-3">
                                        {{-- <label for="email" class="form-label">Email administrateur <span class="text-danger">*</span></label> --}}

                                    <label for="email" class="form-label">
                                        Email administrateur <span class="text-danger">*</span>
                                        <small class="text-muted d-block">
                                            C’est à cette adresse que sera envoyé l’email de confirmation.
                                        </small>
                                    </label>
                                        <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                                        @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>

                                    {{-- <div class="mt-2">
                                        <h6 class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Localisation de la compagnie</h6>
                                        <div class="input-group mb-2">
                                            <input type="text" name="adresse" id="searchInputHome" class="form-control" placeholder="Rechercher une adresse..." autocomplete="off">
                                            <button type="button" id="locateBtnHome" class="btn btn-connexion d-flex align-items-center">
                                                <i class="fas fa-location-arrow me-1"></i>
                                                <span>Me localiser</span>
                                            </button>
                                        </div>
                                        <div id="statusMessageHome" class="status-message small mb-2"></div>
                                        <div id="mapHome" style="height: 260px; border-radius: 8px;" aria-label="Carte de localisation"></div>
                                        <input type="hidden" id="latitudeHome" name="latitude">
                                        <input type="hidden" id="longitudeHome" name="longitude">
                                    </div> --}}
                                 
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" id="submitBtn" class="btn btn-connexion text-white px-4 py-2">
                                    <span class="btn-loader" id="submitLoader"></span>
                                    <span id="submitText">Créer la compagnie</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
<footer class="footer text-white text-center py-5 fade-in" style="min-height: 120px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 mb-3 mb-md-0 d-flex align-items-center justify-content-center justify-content-md-start">
                <span class="fw-bold fs-5">BETRO</span>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <small class="d-block fs-6">&copy; 2025 BETRO. Tous droits réservés.</small>
                <a href="mailto:contact@betro.com" class="text-white-50 text-decoration-none fs-6">contact@betro.com</a>
            </div>
            <div class="col-md-4 text-md-end text-center">
                <a href="#" class="text-white-50 me-3 fs-3"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white-50 me-3 fs-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white-50 fs-3"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Gestion du formulaire de contact
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.querySelector('.contact-form');
            
            if (contactForm) {
                contactForm.addEventListener('submit', function() {
                    const submitBtn = document.getElementById('contact-submit-btn');
                    const submitText = document.getElementById('submit-text');
                    const submitLoader = document.getElementById('submit-loader');
                    
                    // Désactiver le bouton et afficher le loader
                    submitBtn.disabled = true;
                    submitText.textContent = 'Envoi...';
                    submitLoader.classList.remove('d-none');
                });
            }
        });
        // Animation au défilement
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');
            
            const fadeInOnScroll = function() {
                fadeElements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const elementVisible = 150;
                    
                    if (elementTop < window.innerHeight - elementVisible) {
                        element.style.opacity = "1";
                        element.style.transform = "translateY(0)";
                    }
                });
            };
            
            window.addEventListener('scroll', fadeInOnScroll);
            fadeInOnScroll(); // Vérifier au chargement initial
        });
    </script>
    <script>
        // Logo preview handlers for home registration form
        function previewLogoHome(input) {
            const file = input.files && input.files[0];
            const wrap = document.getElementById('logoPreviewHome');
            const img = document.getElementById('logoPreviewImgHome');
            if (!wrap || !img) return;
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e){
                    img.src = e.target.result;
                    wrap.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                wrap.style.display = 'none';
                img.src = '#';
            }
        }
        function removeLogoHome() {
            const input = document.getElementById('logo_compagnies');
            const wrap = document.getElementById('logoPreviewHome');
            const img = document.getElementById('logoPreviewImgHome');
            if (input) input.value = '';
            if (wrap) wrap.style.display = 'none';
            if (img) img.src = '#';
        }
    </script>
    <script>
        // Fonction pour afficher les informations du fichier sélectionné
        // function updateFileInfo(input) {
        //     const fileInfo = document.getElementById('fileInfo');
        //     if (input.files && input.files[0]) {
        //         const file = input.files[0];
        //         const fileSize = (file.size / 1024 / 1024).toFixed(2); // Taille en Mo
        //         const fileName = file.name;
        //         const fileExtension = fileName.split('.').pop().toUpperCase();
                
        //         fileInfo.textContent = `Fichier: ${fileName} (${fileSize} Mo) - Format: ${fileExtension}`;
        //         fileInfo.style.display = 'block';
        //     } else {
        //         fileInfo.textContent = '';
        //         fileInfo.style.display = 'none';
        //     }
        // }
        function updateFileInfo(input) {
    const fileInfo = document.getElementById('fileInfo');
    const submitBtn = document.getElementById('submitBtn');
    const maxSize = 10; // Taille maximale en Mo
    const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileSize = (file.size / 1024 / 1024).toFixed(2); // Taille en Mo
        const fileName = file.name;
        const fileExtension = fileName.split('.').pop().toLowerCase();
        const isValidExtension = allowedExtensions.includes(fileExtension);
        const isValidSize = file.size <= maxSize * 1024 * 1024; // Conversion en octets
        
        // Mise en forme du message avec les parties problématiques en rouge
        let message = `Fichier: ${fileName} `;
        
        // Vérification de la taille
        if (!isValidSize) {
            message += `<span style="color: red;">(${fileSize} Mo - Taille maximale dépassée)</span>`;
        } else {
            message += `(${fileSize} Mo)`;
        }
        
        message += ` - Format: `;
        
        // Vérification de l'extension
        if (!isValidExtension) {
            message += `<span style="color: red;">${fileExtension.toUpperCase()} (Format non supporté)</span>`;
        } else {
            message += fileExtension.toUpperCase();
        }
        
        fileInfo.innerHTML = message;
        fileInfo.style.display = 'block';
        
        // Désactiver le bouton de soumission si le fichier n'est pas valide
        if (submitBtn) {
            submitBtn.disabled = !(isValidExtension && isValidSize);
        }
    } else {
        fileInfo.textContent = '';
        fileInfo.style.display = 'none';
        if (submitBtn) {
            submitBtn.disabled = false;
        }
    }
}

        // Google Maps for home registration form
        let mapHomeInst, markerHome, autocompleteHome, circleHome;
        let isMapsLoadedHome = false;

        function showStatus(message, type = 'info') {
            const statusDiv = document.getElementById('statusMessageHome');
            if (!statusDiv) return;
            
            statusDiv.innerHTML = message;
            statusDiv.className = `status-message ${type}`;
            
            // Cacher le message après 5 secondes pour les messages d'info
            if (type === 'info' || type === 'success') {
                setTimeout(() => {
                    statusDiv.innerHTML = '';
                    statusDiv.className = 'status-message';
                }, 5000);
            }
        }

        window.initMapHome = function () {
            isMapsLoadedHome = true;
            const mapEl = document.getElementById('mapHome');
            if (!mapEl) return;
            
            const defaultLoc = { lat: 5.345317, lng: -4.024429 };
            
            // Initialiser la carte
            mapHomeInst = new google.maps.Map(mapEl, {
                center: defaultLoc,
                zoom: 13,
                streetViewControl: false,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.TOP_RIGHT
                }
            });

            // Créer le marqueur
            markerHome = new google.maps.Marker({
                position: defaultLoc,
                map: mapHomeInst,
                draggable: true,
                icon: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
                    scaledSize: new google.maps.Size(40, 40)
                },
                title: "Déplacez-moi pour ajuster la position"
            });

            // Ajouter un cercle de précision autour du marqueur
            circleHome = new google.maps.Circle({
                map: mapHomeInst,
                radius: 100, // 100 mètres
                fillColor: '#AA0000',
                fillOpacity: 0.2,
                strokeColor: '#AA0000',
                strokeOpacity: 0.8,
                strokeWeight: 1
            });
            circleHome.bindTo('center', markerHome, 'position');

            // Initialiser l'autocomplétion des adresses
            initAutocompleteHome();

            // Événements
            markerHome.addListener('dragend', function() {
                setHomeLocation(markerHome.getPosition());
            });

            // Gestion du bouton de localisation
            const locateBtn = document.getElementById('locateBtnHome');
            if (locateBtn) {
                locateBtn.addEventListener('click', locateUserHome);
            }

            // Initialiser les champs cachés
            updateHomeCoords(defaultLoc.lat, defaultLoc.lng);
        };

        function initAutocompleteHome() {
            if (!isMapsLoadedHome) return;

            const input = document.getElementById('searchInputHome');
            if (!input) return;

            autocompleteHome = new google.maps.places.Autocomplete(input, {
                types: ['geocode', 'establishment'],
                componentRestrictions: { country: 'ci' }
            });

            autocompleteHome.bindTo('bounds', mapHomeInst);
            autocompleteHome.addListener('place_changed', function() {
                const place = autocompleteHome.getPlace();
                if (!place.geometry || !place.geometry.location) {
                    showStatus("Lieu non trouvé !", "error");
                    return;
                }
                setHomeLocation(place.geometry.location);
            });
        }

        function locateUserHome() {
            const locateBtn = document.getElementById('locateBtnHome');
            
            if (!navigator.geolocation) {
                showStatus("La géolocalisation n'est pas supportée par ce navigateur.", "error");
                return;
            }

            showStatus("Localisation en cours... ", "info");
            
            // Désactiver le bouton pendant la localisation
            locateBtn.disabled = true;
            locateBtn.innerHTML = "<i class='fas fa-spinner fa-spin me-1'></i> Localisation...";

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    setHomeLocation(userLocation);
                    locateBtn.disabled = false;
                    locateBtn.innerHTML = "<i class='fas fa-location-arrow me-1'></i> Me localiser";
                },
                function(error) {
                    let errorMessage = "Impossible de récupérer votre position.";
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage = "Vous avez refusé l'accès à votre position. Veuillez autoriser la localisation dans les paramètres de votre navigateur.";
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = "Votre position n'a pas pu être déterminée. Vérifiez votre connexion Internet ou le signal GPS.";
                            break;
                        case error.TIMEOUT:
                            errorMessage = "La requête a expiré. Veuillez réessayer.";
                            break;
                    }
                    showStatus(errorMessage, "error");
                    locateBtn.disabled = false;
                    locateBtn.innerHTML = "<i class='fas fa-location-arrow me-1'></i> Me localiser";
                },
                {
                    timeout: 15000,
                    enableHighAccuracy: true,
                    maximumAge: 60000
                }
            );
        }

        function setHomeLocation(latlng) {
            const lat = typeof latlng.lat === 'function' ? latlng.lat() : latlng.lat;
            const lng = typeof latlng.lng === 'function' ? latlng.lng() : latlng.lng;

            // Mettre à jour la position de la carte et du marqueur
            mapHomeInst.setCenter({ lat, lng });
            mapHomeInst.setZoom(16);
            markerHome.setPosition({ lat, lng });

            // Mettre à jour les champs cachés
            updateHomeCoords(lat, lng);

            // Mettre à jour l'adresse dans le champ de recherche
            showStatus("Récupération de l'adresse...", "info");
            
            // Utiliser le géocodage de Google Maps
            if (isMapsLoadedHome) {
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({ location: { lat, lng } }, function(results, status) {
                    if (status === "OK" && results[0]) {
                        const searchInput = document.getElementById('searchInputHome');
                        if (searchInput) {
                            searchInput.value = results[0].formatted_address;
                            showStatus("Position mise à jour avec succès", "success");
                        }
                    } else {
                        // Si Google échoue, essayer avec Nominatim
                        useNominatimHome(lat, lng);
                    }
                });
            } else {
                // Si Google Maps n'est pas chargé, utiliser Nominatim
                useNominatimHome(lat, lng);
            }
        }

        function useNominatimHome(lat, lng) {
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
                .then(response => {
                    if (!response.ok) throw new Error("Erreur réseau");
                    return response.json();
                })
                .then(data => {
                    const searchInput = document.getElementById('searchInputHome');
                    if (searchInput && data.display_name) {
                        searchInput.value = data.display_name;
                        showStatus("Position mise à jour avec succès", "success");
                    }
                })
                .catch(error => {
                    console.error("Erreur lors de la récupération de l'adresse:", error);
                    showStatus("Impossible de récupérer l'adresse exacte", "warning");
                });
        }

        function updateHomeCoords(lat, lng) {
            const latI = document.getElementById('latitudeHome');
            const lngI = document.getElementById('longitudeHome');
            if (latI) latI.value = lat;
            if (lngI) lngI.value = lng;
            
            // Mettre à jour l'affichage des coordonnées si nécessaire
            const latValue = document.getElementById('latValueHome');
            const lngValue = document.getElementById('lngValueHome');
            if (latValue) latValue.textContent = lat.toFixed(6);
            if (lngValue) lngValue.textContent = lng.toFixed(6);
        }
    </script>
    <script>
        // Gestion du loader sur le bouton de soumission
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action="{{ route('register.store') }}"]');
            const submitBtn = document.getElementById('submitBtn');
            const submitLoader = document.getElementById('submitLoader');
            const submitText = document.getElementById('submitText');
            
            if (form) {
                form.addEventListener('submit', function() {
                    // Désactiver le bouton et afficher le loader
                    submitBtn.disabled = true;
                    submitLoader.style.display = 'inline-block';
                    submitText.textContent = 'Création en cours...';
                });
            }
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiw_DCMqoSQ5MoxmNqwbMKN_JEy-qQAS0&libraries=places&callback=initMapHome" async defer></script>
</body>
</html>