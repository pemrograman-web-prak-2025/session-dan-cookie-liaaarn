<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
  <div class="container">
    <div class="illustration">
      <img src="{{ asset('images/icons.jpg') }}" alt="Ilustrasi Login">
    </div>

    <div class="login-box">
      <h2>Login</h2>
      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <!-- Input Email -->
        <!-- Jika ada cookie, isi otomatis email sebelumnya -->
        <input type="email" name="email"
        value="{{ Cookie::get('remember_email') }}"
        placeholder="Masukkan email..." required>

        <input type="password" name="password" placeholder="Password" required>

      <!-- CheckBox "Ingatkan saya" -->
      <!-- Jika ada cookie email, check box otomatis dicentang -->
      <div class="remember-me">
        <input type="checkbox" name="remember"
        {{ Cookie::get('remember_email') ? 'checked' : '' }}>
        <label>Ingatkan saya</label>
      </div>

        <button type="submit">Login</button>
      </form>

       <div class="register-link">
        <a href="{{ url('/registrasi') }}" class="register-btn">Create Account</a>
      </div>
    </div>
  </div>
</body>
</html>
