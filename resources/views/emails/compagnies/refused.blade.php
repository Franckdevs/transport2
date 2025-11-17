<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande d'inscription – BETRO</title>
    <style>
        body {background:#f8fafc;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;color:#0f172a;margin:0;padding:0;}
        .wrapper {width:100%;padding:32px 0;}
        .container {max-width:640px;margin:0 auto;background:#fff;border-radius:16px;box-shadow:0 20px 40px rgba(15,23,42,.08);overflow:hidden;}
        .header {padding:28px 36px;background:linear-gradient(135deg,#dc2626,#ef4444);color:#fff;}
        .header h1 {margin:0;font-size:22px;font-weight:600;}
        .content {padding:36px;}
        .badge {display:inline-block;padding:6px 14px;border-radius:999px;background:rgba(220,38,38,.15);color:#b91c1c;font-weight:600;font-size:12px;text-transform:uppercase;letter-spacing:.6px;margin-bottom:18px;}
        .card {border:1px solid #e2e8f0;border-radius:12px;padding:20px;margin:24px 0;background:#fdf2f2;}
        .card-title {font-weight:600;font-size:15px;margin-bottom:10px;color:#991b1b;}
        .reason {margin:0;color:#991b1b;line-height:1.6;}
        ul {padding-left:20px;margin:0;color:#475569;line-height:1.7;}
        .next {background:#f8fafc;border-radius:12px;padding:20px;border:1px dashed #cbd5f5;color:#0f172a;}
        .footer {padding:0 36px 32px;font-size:13px;color:#64748b;line-height:1.6;}
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="header">
            <h1>Votre demande n'a pas été validée</h1>
            <p style="margin:6px 0 0;opacity:.9;">BETRO – Plateforme de gestion des compagnies</p>
        </div>
        <div class="content">
            <div class="badge">Décision négative</div>
            <p>Bonjour,<br><br>
                Après analyse, nous ne pouvons pas donner suite pour le moment à l'inscription de
                <strong>{{ $compagnie->nom_complet_compagnies }}</strong>.
            </p>

            <div class="card">
                <div class="card-title">Motif principal</div>
                <p class="reason">{{ $reason }}</p>
            </div>

            <div class="card" style="background:#fff;">
                <div class="card-title" style="color:#1d4ed8;">Rappel des informations transmises</div>
                <ul>
                    <li><strong>Email</strong> : {{ $compagnie->email_compagnies }}</li>
                    <li><strong>Téléphone</strong> : {{ $compagnie->telephone_compagnies }}</li>
                    <li><strong>Adresse</strong> : {{ $compagnie->adresse_compagnies }}</li>
                </ul>
            </div>

            <div class="next">
                <strong>Que faire maintenant ?</strong>
                <p style="margin:10px 0 0;line-height:1.6;">
                    Vous pouvez mettre à jour les informations demandées puis soumettre une nouvelle demande.
                    Notre équipe reste disponible pour toute assistance complémentaire.
                </p>
            </div>
        </div>
        <div class="footer">
            Cordialement,<br>
            L’équipe BETRO<br>
            —<br>
            Ce message est généré automatiquement, merci de ne pas y répondre.
        </div>
    </div>
</div>
</body>
</html>

