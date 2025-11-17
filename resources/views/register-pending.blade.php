<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription en attente - BETRO</title>
  <link rel="icon" href="{{ asset('log.png') }}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root { --primary-color:#ffd000; --accent:#ffeb3b; --dark:#000; }
    body { min-height:100vh; background:#fff; display:flex; align-items:center; justify-content:center; padding:24px; }
    .shell { width:100%; max-width:840px; }
    .brand { display:flex; align-items:center; justify-content:center; gap:.5rem; margin-bottom:12px; }
    .brand .dot { width:10px; height:10px; border-radius:50%; background:var(--primary-color); }
    .card { border:none; border-radius:16px; box-shadow:0 10px 30px rgba(0,0,0,0.06); overflow:hidden; }
    .card-header { background: linear-gradient(90deg, var(--primary-color), var(--accent)); color:#000; font-weight:700; text-align:center; }
    .icon-wrap { width:84px; height:84px; border-radius:50%; background:rgba(255,208,0,.2); display:flex; align-items:center; justify-content:center; margin:0 auto 1rem; }
    .icon-wrap svg { width:40px; height:40px; color:#000; }
    .lead { color:#444; }
    .actions .btn-warning { background-color: var(--primary-color); border-color: var(--primary-color); color:#000; }
  </style>
  <script>
    setTimeout(function(){ window.scrollTo({top:0, behavior:'smooth'}); }, 50);
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
        <h4 class="mb-2">Votre demande a bien été reçue</h4>
        <p class="lead mb-4">
          BETRO va confirmer votre demande. Vous recevrez un email de <strong>confirmation</strong> ou de <strong>refus</strong> lorsque votre dossier aura été traité.
        </p>
        @if(isset($compagnie))
          <div class="text-start mx-auto mb-4" style="max-width:680px;">
            <div class="fw-bold mb-2">Informations de la compagnie</div>
            <div class="list-group">
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Nom complet</span>
                <span class="fw-semibold">{{ $compagnie->nom_complet_compagnies }}</span>
              </div>
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Email</span>
                <span class="fw-semibold">{{ $compagnie->email_compagnies }}</span>
              </div>
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Téléphone</span>
                <span class="fw-semibold">{{ $compagnie->telephone_compagnies }}</span>
              </div>
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="text-muted">Adresse</span>
                <span class="fw-semibold">{{ $compagnie->adresse_compagnies }}</span>
              </div>
            </div>
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
