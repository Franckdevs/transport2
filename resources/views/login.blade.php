<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - UTA</title>
  <link rel="icon" href="../log.png" type="image/x-icon"> <!-- Favicon-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #6d2077;
      --primary-light: #8c3a9a;
      --primary-dark: #5a1a63;
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
      --radius-sm: 4px;
      --radius-md: 8px;
      --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
      --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', 'Roboto', system-ui, sans-serif;
    }

    body {
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                  url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') no-repeat center center fixed;
      background-size: cover;
      color: var(--white);
      line-height: 1.5;
      display: flex;
      min-height: 100vh;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .login-container {
      width: 100%;
      max-width: 450px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-md);
      overflow: hidden;
      animation: fadeIn 0.5s ease;
      backdrop-filter: blur(5px);
    }

    .login-header {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: var(--white);
      padding: 30px;
      text-align: center;
    }

    .login-header img {
      width: 120px;
      height: auto;
      margin-bottom: 15px;
    }

    .login-header h1 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .login-header p {
      font-size: 14px;
      opacity: 0.9;
    }

    .login-form {
      padding: 30px;
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
    }

    .input-field {
      position: relative;
    }

    .input-field input {
      width: 100%;
      padding: 12px 15px 12px 40px;
      font-size: 15px;
      border: 1px solid var(--gray-300);
      border-radius: var(--radius-sm);
      transition: all 0.2s;
      background-color: var(--white);
    }

    .input-field input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(109, 32, 119, 0.1);
    }

    .input-field i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray-500);
    }

    .error-message {
      color: var(--red);
      font-size: 13px;
      margin-top: 5px;
      display: flex;
      align-items: center;
      gap: 5px;
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
      gap: 5px;
      color: var(--gray-700);
    }

    .remember-me input {
      accent-color: var(--primary);
    }

    .forgot-password a {
      color: var(--primary);
      text-decoration: none;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }

    .login-button {
      width: 100%;
      padding: 12px;
      background: var(--primary);
      color: var(--white);
      border: none;
      border-radius: var(--radius-sm);
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      margin-bottom: 20px;
    }

    .login-button:hover {
      background: var(--primary-dark);
      box-shadow: var(--shadow-sm);
    }

    .login-footer {
      text-align: center;
      font-size: 13px;
      color: var(--gray-500);
      padding: 0 30px 20px;
    }

    .login-footer a {
      color: var(--primary);
      text-decoration: none;
    }

    .login-footer a:hover {
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media screen and (max-width: 480px) {
      .login-container {
        border-radius: 0;
      }

      body {
        padding: 0;
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                    url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') no-repeat center center fixed;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    {{-- <div class="login-header">

    </div> --}}

    <form method="POST" action="{{ route('login') }}" class="login-form">
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
      // Focus on email field by default
      document.getElementById('email').focus();

      // Add animation to form elements
      const formGroups = document.querySelectorAll('.form-group');
      formGroups.forEach((group, index) => {
        group.style.animation = `fadeIn 0.3s ease forwards ${index * 0.1}s`;
        group.style.opacity = '0';
      });
    });
  </script>
</body>
</html>
