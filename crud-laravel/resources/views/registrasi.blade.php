<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrasi</title>
<link rel="stylesheet" href="{{ asset('css/registrasi.css') }}">

</head>
<body>
  <div class="container">
    <div class="illustration">
      <img src="{{ asset('images/icons.jpg') }}" alt="Ilustrasi Registrasi">
    </div>

    <div class="registrasi-box">
      <h2>Create Account</h2>
      <form method="POST" action="{{ route('register.post') }}">
         @csrf
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Create</button>
      </form>

      <div class="login-link">
        <a href="{{ url('/') }}" class="login-btn">Login</a>
      </div>
    </div>
  </div>
</body>
</html>
