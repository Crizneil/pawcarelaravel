<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Pet Owner Login - PawCare</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/newicon.png') }}" />
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/sass/style.css') }}" rel="stylesheet" />
  <style>
    /* Reuse login styles for consistency */
    body.pawcare-login {
      background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Outfit', sans-serif;
    }
    .card {
      background: white;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }
    .title-main {
      font-size: 2rem;
      font-weight: 700;
      color: #333;
      text-align: center;
      margin-bottom: 0.5rem;
    }
    .subtitle {
      text-align: center;
      color: #666;
      margin-bottom: 2rem;
    }
    .field {
      margin-bottom: 1.5rem;
    }
    .field label {
      display: block;
      margin-bottom: 0.5rem;
      color: #333;
      font-weight: 500;
    }
    .field input {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ddd;
      border-radius: 10px;
      outline: none;
      transition: border-color 0.3s;
    }
    .field input:focus {
      border-color: #ff6b6b;
    }
    .btn-primary {
      background: #ff6b6b;
      color: white;
      border: none;
      padding: 1rem;
      width: 100%;
      border-radius: 10px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s;
    }
    .btn-primary:hover {
      background: #ff5252;
    }
    .status.error {
      color: #ff5252;
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }
    .cta-text-center {
        text-align: center;
        margin-top: 1.5rem;
    }
    .logo-wrap {
        text-align: center;
        margin-bottom: 1rem;
    }
    .logo-wrap img {
        height: 60px;
    }
  </style>
</head>
<body class="pawcare-login">
  <div class="card">
    <header class="logo-wrap">
        <img src="{{ asset('assets/images/newlogo.png') }}" alt="PawCare" />
    </header>
    <h1 class="title-main">Pet Owner Login</h1>
    <p class="subtitle">Welcome back to PawCare</p>

    <form action="{{ route('pet-owner.login.post') }}" method="POST">
      @csrf
      
      <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required />
        @error('email') <div class="status error">{{ $message }}</div> @enderror
      </div>

      <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
        @error('password') <div class="status error">{{ $message }}</div> @enderror
      </div>

      <div class="field" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
        <input type="checkbox" id="showPassword" style="width: auto;">
        <label for="showPassword" style="margin: 0; cursor: pointer;">Show Password</label>
      </div>

      <button type="submit" class="btn-primary">Log In</button>

      <p class="cta-text-center">
        Don't have an account? <a href="{{ route('pet-owner.register') }}">Register here</a>
      </p>
    </form>
  </div>

  <script>
    const passwordInput = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('showPassword');

    showPasswordCheckbox.addEventListener('change', function() {
        passwordInput.type = this.checked ? 'text' : 'password';
    });
  </script>
</body>
</html>
