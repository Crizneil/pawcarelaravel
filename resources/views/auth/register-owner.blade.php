<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Pet Owner Registration - PawCare</title>
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
      max-width: 500px;
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
    <h1 class="title-main">Join the Pack</h1>
    <p class="subtitle">Create your Pet Owner account</p>

    <form action="{{ route('pet-owner.register.post') }}" method="POST">
      @csrf
      
      <div class="field">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required />
        @error('name') <div class="status error">{{ $message }}</div> @enderror
      </div>

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

      <div class="field">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required />
      </div>

      <div class="field" style="display: flex; align-items: center; gap: 10px;">
        <input type="checkbox" id="showPassword" style="width: auto;">
        <label for="showPassword" style="margin: 0; cursor: pointer;">Show Passwords</label>
      </div>

      <hr style="margin: 2rem 0; border: none; border-top: 1px solid #eee;">
      <h3 style="margin-bottom: 1rem; font-size: 1.25rem;">Address Info (Automated Format)</h3>

      <div class="field">
        <label for="house_number">House Number & Street</label>
        <input type="text" id="house_number" name="house_number" placeholder="e.g. 123 Main St" value="{{ old('house_number') }}" required />
        @error('house_number') <div class="status error">{{ $message }}</div> @enderror
      </div>

      <div class="field">
        <label for="barangay">Barangay</label>
        <input type="text" id="barangay" name="barangay" placeholder="e.g. Camalig" value="{{ old('barangay') }}" required />
        @error('barangay') <div class="status error">{{ $message }}</div> @enderror
      </div>

      <!-- Automated/Fixed Fields -->
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <div class="field">
            <label>City</label>
            <input type="text" name="city" value="City of Meycauayan" readonly style="background: #f9f9f9; cursor: not-allowed;" />
        </div>
        <div class="field">
            <label>Province</label>
            <input type="text" name="province" value="Bulacan" readonly style="background: #f9f9f9; cursor: not-allowed;" />
        </div>
      </div>

      <button type="submit" class="btn-primary">Register</button>

      <p class="cta-text-center">
        Already have an account? <a href="{{ route('pet-owner.login') }}">Log in</a>
      </p>
    </form>
  </div>

  <script>
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const showPasswordCheckbox = document.getElementById('showPassword');

    showPasswordCheckbox.addEventListener('change', function() {
        const type = this.checked ? 'text' : 'password';
        passwordInput.type = type;
        confirmPasswordInput.type = type;
    });
  </script>
</body>
</html>
