<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription en attente - BETRO</title>
  <link rel="icon" href="{{ asset('log.png') }}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <style>
    :root { --primary-color:#ffd000; --accent:#ffeb3b; --dark:#000; }
    body { 
      min-height:100vh; 
      background:#fff; 
      display:flex; 
      align-items:center; 
      justify-content:center; 
      padding:24px;
      opacity: 0;
      animation: fadeIn 0.8s ease-out forwards;
    }
    @keyframes fadeIn {
      to { opacity: 1; }
    }
    .shell { 
      width:100%; 
      max-width:840px; 
      transform: translateY(20px);
      opacity: 0;
      animation: slideUp 0.6s ease-out 0.3s forwards;
    }
    @keyframes slideUp {
      to { 
        transform: translateY(0);
        opacity: 1;
      }
    }
    .brand { 
      display:flex; 
      align-items:center; 
      justify-content:center; 
      gap:.5rem; 
      margin-bottom:12px;
      animation: bounceIn 1s ease-out 0.5s both;
    }
    @keyframes bounceIn {
      0% { transform: scale(0.8); opacity: 0; }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); opacity: 1; }
    }
    .brand .dot { 
      width:10px; 
      height:10px; 
      border-radius:50%; 
      background:var(--primary-color);
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.2); }
      100% { transform: scale(1); }
    }
    .card { 
      border:none; 
      border-radius:16px; 
      box-shadow:0 10px 30px rgba(0,0,0,0.1);
      overflow:hidden;
      transition: all 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    .card-header { 
      background: linear-gradient(90deg, var(--primary-color), var(--accent)); 
      color:#000; 
      font-weight:700; 
      text-align:center;
      padding: 1.25rem;
      position: relative;
      overflow: hidden;
    }
    .card-header::after {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      animation: shine 2s infinite;
    }
    @keyframes shine {
      to {
        left: 100%;
      }
    }
    .icon-wrap { 
      width:84px; 
      height:84px; 
      border-radius:50%; 
      background:rgba(255,208,0,.2); 
      display:flex; 
      align-items:center; 
      justify-content:center; 
      margin:0 auto 1.5rem;
      animation: bounceIn 1s ease-out 0.7s both;
    }
    .icon-wrap svg { 
      width:40px; 
      height:40px; 
      color:#000;
      animation: tada 2s infinite;
    }
    .lead { 
      color:#444;
      animation: fadeInUp 1s ease-out 0.9s both;
    }
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .list-group-item {
      transition: all 0.3s ease;
      opacity: 0;
      transform: translateX(-10px);
      animation: slideIn 0.5s ease-out forwards;
    }
    @keyframes slideIn {
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }
    /* Stagger animations for list items */
    .list-group-item:nth-child(1) { animation-delay: 0.5s; }
    .list-group-item:nth-child(2) { animation-delay: 0.6s; }
    .list-group-item:nth-child(3) { animation-delay: 0.7s; }
    .list-group-item:nth-child(4) { animation-delay: 0.8s; }
    .list-group-item:nth-child(5) { animation-delay: 0.9s; }
    .list-group-item:nth-child(6) { animation-delay: 1.0s; }
    .list-group-item:nth-child(7) { animation-delay: 1.1s; }
    .list-group-item:hover {
      background-color: rgba(255, 208, 0, 0.05);
      transform: translateX(5px);
    }
    .actions {
      opacity: 0;
      animation: fadeIn 0.8s ease-out 1.2s forwards;
    }
    .btn {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .btn-warning {
      background-color: var(--primary-color); 
      border-color: var(--primary-color); 
      color:#000;
    }
    .btn-outline-dark:hover {
      background-color: var(--dark);
      color: white;
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Smooth scroll to top
      window.scrollTo({top: 0, behavior: 'smooth'});
      
      // Add hover effect to buttons
      const buttons = document.querySelectorAll('.btn');
      buttons.forEach(button => {
        button.addEventListener('mousemove', function(e) {
          const rect = this.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;
          
          const ripple = document.createElement('span');
          ripple.classList.add('ripple-effect');
          ripple.style.left = `${x}px`;
          ripple.style.top = `${y}px`;
          
          this.appendChild(ripple);
          
          setTimeout(() => {
            ripple.remove();
          }, 1000);
        });
      });
    });
  </script>
</head>
<body>
  <div class="shell">
    <div class="brand"><span class="dot"></span><strong>BETRO</strong><span class="dot"></span></div>
    <div class="card">
      <div class="card-header py-3">Inscription envoyée</div>
     
      <div class="card-body p-4 p-md-5 text-center">
        @if(session('success'))
          <div class="alert alert-success mb-4" role="alert">{{ session('success') }}</div>
        @endif
        <div class="icon-wrap mb-2">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-2.31a.75.75 0 1 0-1.22-.88l-3.406 4.73-1.61-1.61a.75.75 0 1 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.15-.09l3.9-5.46Z" clip-rule="evenodd"/></svg>
        </div>
        <h4 class="mb-2">Votre demande a bien été envoyée</h4>
        <p class="lead mb-4">
          BETRO va confirmer votre demande. Vous recevrez un email de <strong>confirmation</strong> ou de <strong>refus</strong> lorsque votre dossier aura été traité.
        </p>
        @if(isset($compagnie))
          <div class="text-start mx-auto mb-4" style="max-width:680px;">
            <div class="fw-bold mb-2">Informations de la compagnie</div>
            <div class="list-group">
              @if($compagnie->nom_complet_compagnies)
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Nom compagnie</span>
                <span class="fw-semibold">{{ $compagnie->nom_complet_compagnies }}</span>
              </div>
              @endif
              @if($compagnie->email_compagnies)
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Email</span>
                <span class="fw-semibold">{{ $compagnie->email_compagnies }}</span>
              </div>
              @endif
              @if($compagnie->telephone_compagnies)
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Téléphone</span>
                <span class="fw-semibold">{{ $compagnie->telephone_compagnies }}</span>
              </div>
              @endif
              @if($compagnie->adresse_compagnies)
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Adresse</span>
                <span class="fw-semibold">{{ $compagnie->adresse_compagnies }}</span>
              </div>
              @endif
              @if($compagnie->logo_compagnies)
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Logo</span>
                <span class="fw-semibold">
                  {{-- <img src="{{ asset('logo_compagnie/' . $compagnie->logo_compagnies) }}" alt="Logo" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;"></span>
                   --}}
                   <img src="{{ asset($compagnie->logo_compagnies) }}" 
                         alt="Logo {{ $compagnie->nom_complet_compagnies }}" 
                         alt="Logo" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                </span>
              </div>
              @endif
            </div>
            <hr>
            <span>Informations de l'administrateur</span>
            <hr>
            <div class="list-group mb-3">
              @if($user_utilisateur->nom)
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Nom administrateur</span>
                <span class="fw-semibold">{{ $user_utilisateur->nom }}</span>
              </div>
              @endif
              @if($user_utilisateur->prenom)
               <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Prenom administrateur</span>
                <span class="fw-semibold">{{ $user_utilisateur->prenom }}</span>
              </div>
              @endif
              @if($user_utilisateur->email)
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Email administrateur</span>
                <span class="fw-semibold">{{ $user_utilisateur->email }}</span>
              </div>
              @endif
              @if($user_utilisateur->telephone)
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Téléphone administrateur</span>
                <span class="fw-semibold">{{ $user_utilisateur->telephone }}</span>
              </div>
              @endif
          </div>
        @endif
        <div class="actions d-flex flex-wrap gap-2 justify-content-center">
          <a href="{{ url('/') }}" class="btn btn-outline-dark">Retour à l'accueil</a>
          <a href="{{ route('login') }}" class="btn btn-warning">Aller à la connexion</a>
        </div>
      </div>
      
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
