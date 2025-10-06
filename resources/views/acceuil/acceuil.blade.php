<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BETRO - Plateforme de Gestion de Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1976d2;
            --secondary-color: #0d47a1;
            --accent-color: #42a5f5;
            --light-color: #e3f2fd;
            --dark-color: #0a2c5e;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --info-color: #2196f3;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
            background: linear-gradient(120deg, #f0f4ff 0%, #eaf6fb 100%);
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
            background-image: url('all_image/bus_route.jpg');
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
            background: linear-gradient(45deg, rgba(25,118,210,0.1) 0%, rgba(66,165,245,0.05) 100%);
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
            box-shadow: 0 10px 25px rgba(25,118,210,0.15);
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
            box-shadow: 0 4px 10px rgba(25,118,210,0.2);
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
            box-shadow: 0 0 0 3px rgba(25,118,210,0.1);
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
            box-shadow: 0 5px 15px rgba(25,118,210,0.3);
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">BETRO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse fade-in" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#apropos">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#processus">Comment ça marche</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Nos services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#partenaires">Partenaires</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-connexion text-white ms-lg-3">Connexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header avec image de fond, avatars et animation -->
    {{-- <header class="container-fluid header-bg">
        <div class="header-overlay fade-in">
            <h1 class="display-5 fw-bold text-primary mb-3">Bienvenue chez BETRO</h1>
            <p class="lead mb-4">La solution moderne, intuitive et collaborative pour la gestion de votre compagnie de transport.</p>
            <a href="{{ route('login') }}" class="btn btn-connexion text-white">Se connecter</a>
        </div>
    </header> --}}

<header class="container-fluid header-bg">
    <div class="header-overlay fade-in" style="background: rgba(255,255,255,0.18); backdrop-filter: blur(8px); animation: headerPulse 3s infinite alternate;">
        <h1 class="display-5 fw-bold text-primary mb-3">Bienvenue chez BETRO</h1>
        <p class="lead mb-4">La solution moderne, intuitive et collaborative pour la gestion de votre compagnie de transport.</p>
        <a href="{{ route('login') }}" class="btn btn-connexion text-white">Se connecter</a>
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
                        <i class="fas fa-check-circle"></i> +100 compagnies utilisent BETRO
                    </span>
                </div>
                
                <div class="d-flex flex-wrap mb-4">
                    <span class="feature-badge bg-info text-white">
                        <i class="fas fa-shield-alt"></i> Sécurité des données
                    </span>
                    <span class="feature-badge bg-success text-white">
                        <i class="fas fa-headset"></i> Support 24/7
                    </span>
                    <span class="feature-badge bg-warning text-dark">
                        <i class="fas fa-rocket"></i> Innovation continue
                    </span>
                </div>
                
                <div class="row mt-4">
                    <div class="col-4">
                        <div class="stats-container fade-in delay-1">
                            <div class="stat-number">+100</div>
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
                    <img src="{{ asset('all_image/bus_route.jpg') }}" alt="BETRO équipe" class="img-fluid rounded">
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
    <section id="contact" class="container py-5 fade-in">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title center">Contactez-nous</h2>
                <p class="lead">Une question ? Notre équipe est là pour vous aider</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form class="contact-form">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Votre nom" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Votre email" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Votre message" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary text-white">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-white text-center py-4 fade-in">
        <div class="container">
            <small>&copy; 2025 BETRO. Tous droits réservés.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
</body>
</html>