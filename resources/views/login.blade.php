<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - UTA</title>
  <link rel="icon" href="../log.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #6d2077;
      --primary-light: #8c3a9a;
      --primary-dark: #5a1a63;
      --primary-gradient: linear-gradient(135deg, #6d2077, #8c3a9a);
      --white: #ffffff;
      --gray-100: #f8f9fa;
      --gray-200: #e9ecef;
      --gray-300: #dee2e6;
      --gray-500: #adb5bd;
      --gray-700: #495057;
      --gray-900: #212529;
      --red: #e63946;
      --green: #2a9d8f;
      --bg: #fef4fc;
      --radius-sm: 8px;
      --radius-md: 16px;
      --radius-lg: 20px;
      --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
      --shadow-md: 0 8px 24px rgba(0,0,0,0.12);
      --shadow-lg: 0 16px 40px rgba(0,0,0,0.15);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', 'Roboto', system-ui, sans-serif;
    }

    body {
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                  url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') no-repeat center center fixed;
      background-size: cover;
      color: var(--white);
      line-height: 1.6;
      display: flex;
      min-height: 100vh;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
    }

    .back-home {
      position: absolute;
      top: 30px;
      left: 30px;
      z-index: 100;
    }

    .back-home a {
      display: flex;
      align-items: center;
      gap: 10px;
      color: var(--white);
      text-decoration: none;
      font-weight: 500;
      padding: 10px 20px;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 50px;
      backdrop-filter: blur(10px);
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .back-home a:hover {
      background: rgba(255, 255, 255, 0.25);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .login-container {
      width: 100%;
      max-width: 500px;
      min-height: auto;
      background: rgba(255, 255, 255, 0.98);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-lg);
      overflow: hidden;
      animation: fadeInUp 0.6s ease;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      display: flex;
      flex-direction: column;
    }

    .login-header {
      background: var(--primary-gradient);
      color: var(--white);
      padding: 30px;
      text-align: center;
      position: relative;
      overflow: hidden;
      flex-shrink: 0;
    }

    .login-header::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
      animation: rotate 20s linear infinite;
    }

    .logo-container {
      position: relative;
      z-index: 2;
    }

    .logo-container img {
      width: 70px;
      height: 70px;
      margin-bottom: 12px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.2);
      padding: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .login-header h1 {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 6px;
      letter-spacing: 0.5px;
    }

    .login-header p {
      font-size: 14px;
      opacity: 0.9;
      font-weight: 400;
    }

    .login-form {
      padding: 30px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 8px;
      color: var(--gray-700);
      letter-spacing: 0.3px;
    }

    .input-field {
      position: relative;
    }

    .input-field input {
      width: 100%;
      padding: 14px 18px 14px 48px;
      font-size: 15px;
      border: 1px solid var(--gray-300);
      border-radius: var(--radius-sm);
      transition: all 0.3s;
      background-color: var(--white);
      box-shadow: var(--shadow-sm);
    }

    .input-field input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(109, 32, 119, 0.15);
      transform: translateY(-1px);
    }

    .input-field i {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray-500);
      transition: color 0.3s;
    }

    .input-field input:focus + i {
      color: var(--primary);
    }

    .error-message {
      color: var(--red);
      font-size: 13px;
      margin-top: 8px;
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 10px 12px;
      background: rgba(230, 57, 70, 0.08);
      border-radius: var(--radius-sm);
      border-left: 3px solid var(--red);
    }

    .remember-forgot {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .remember-me {
      display: flex;
      align-items: center;
      gap: 8px;
      color: var(--gray-700);
    }

    .remember-me input {
      accent-color: var(--primary);
      width: 16px;
      height: 16px;
    }

    .forgot-password a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      transition: all 0.2s;
    }

    .forgot-password a:hover {
      text-decoration: underline;
      color: var(--primary-dark);
    }

    .login-button {
      width: 100%;
      padding: 14px;
      background: var(--primary-gradient);
      color: var(--white);
      border: none;
      border-radius: var(--radius-sm);
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      margin-bottom: 20px;
      box-shadow: 0 4px 12px rgba(109, 32, 119, 0.25);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .login-button:hover {
      background: linear-gradient(135deg, var(--primary-dark), var(--primary));
      box-shadow: 0 6px 16px rgba(109, 32, 119, 0.35);
      transform: translateY(-2px);
    }

    .login-button:active {
      transform: translateY(0);
    }

    .login-footer {
      text-align: center;
      font-size: 14px;
      color: var(--gray-500);
      padding-top: 15px;
      border-top: 1px solid var(--gray-200);
      margin-top: 10px;
    }

    .login-footer a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      transition: all 0.2s;
    }

    .login-footer a:hover {
      text-decoration: underline;
      color: var(--primary-dark);
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

    @keyframes rotate {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    /* Responsive */
    @media screen and (max-width: 480px) {
      body {
        padding: 20px 15px;
      }

      .back-home {
        top: 20px;
        left: 20px;
      }

      .back-home a {
        padding: 8px 16px;
        font-size: 14px;
      }

      .login-container {
        max-width: 100%;
        border-radius: var(--radius-md);
      }

      .login-header {
        padding: 25px 20px;
      }

      .login-form {
        padding: 25px 20px;
      }

      .remember-forgot {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }
    }

    @media screen and (max-width: 350px) {
      body {
        padding: 15px 10px;
      }
      
      .login-header {
        padding: 20px 15px;
      }
      
      .login-form {
        padding: 20px 15px;
      }
    }

    /* Animation pour les éléments du formulaire */
    .form-group {
      animation: fadeInUp 0.5s ease forwards;
      opacity: 0;
      transform: translateY(10px);
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .remember-forgot { animation-delay: 0.3s; }
    .login-button { animation-delay: 0.4s; }
    .login-footer { animation-delay: 0.5s; }
  </style>
</head>
<body>
  <!-- Bouton de retour à l'accueil -->
  <div class="back-home">
    <a href="/">
      <i class="fas fa-arrow-left"></i>
      Retour à l'accueil
    </a>
  </div>

  <div class="login-container">
    <div class="login-header">
      <div class="logo-container">
        <img src="../log.png" alt="UTA Logo">
        <h1>Connexion</h1>
        <p>Accédez à votre espace</p>
      </div>
    </div>

    <form method="POST" action="{{ route('login_connexion') }}" class="login-form">
      @csrf

      @if ($errors->any())
        <div class="error-message" style="margin-bottom: 20px;">
          <i class="fas fa-exclamation-circle"></i>
          {{ $errors->first() }}
        </div>
      @endif

      <div class="form-group">
        <label for="email">Adresse email</label>
        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <input type="email" id="email" name="email" placeholder="votre@email.com" required>
        </div>
      </div>

      <div class="form-group">
        <label for="password">Mot de passe</label>
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>
      </div>

      <div class="remember-forgot">
        <div class="remember-me">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember">Se souvenir de moi</label>
        </div>
        <div class="forgot-password">
          <a href="#">Mot de passe oublié ?</a>
        </div>
      </div>

      <button type="submit" class="login-button">
        <i class="fas fa-sign-in-alt"></i> Se connecter
      </button>

      <div class="login-footer">
        <p>Vous n'avez pas de compte ? <a href="#">Contactez l'administrateur</a></p>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Focus sur le champ email par défaut
      document.getElementById('email').focus();

      // Animation des éléments du formulaire
      const formGroups = document.querySelectorAll('.form-group, .remember-forgot, .login-button, .login-footer');
      formGroups.forEach((element, index) => {
        element.style.animationDelay = `${(index + 1) * 0.1}s`;
      });

      // Effet de validation en temps réel
      const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
      inputs.forEach(input => {
        input.addEventListener('blur', function() {
          if (this.value.trim() !== '') {
            this.classList.add('filled');
          } else {
            this.classList.remove('filled');
          }
        });
      });

      // Animation du bouton de connexion au survol
      const loginButton = document.querySelector('.login-button');
      loginButton.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
      });
      
      loginButton.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });
  </script>
</body>
</html>