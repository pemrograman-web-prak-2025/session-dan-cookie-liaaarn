<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StudyTrack | Account</title>
  <link rel="stylesheet" href="{{ asset('css/account.css') }}">
</head>
<body>
  <div class="wrapper">
    <aside class="sidebar">
      <h2 class="logo">StudyTrack</h2>
      <ul class="menu">
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('addSchedule') }}">Add Schedule</a></li>
        <li><a href="{{ route('history') }}">History</a></li>
        <li><a href="{{ route('account') }}" class="active">Account</a></li>
      </ul>

      <div class="logout">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn-logout">Logout</button>
        </form>
      </div>
    </aside>

    <main class="content">
      <div class="container">
        <h2>Account Settings</h2>

        @if(session('success'))
          <div class="alert success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('account.update') }}" method="POST" class="account-form">
          @csrf
          <label>Username</label>
          <input type="text" name="username" value="{{ old('username', $user->username) }}" required>

          <label>Email</label>
          <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

          <label>New Password</label>
          <input type="password" name="password" placeholder="Leave blank to keep current password">

          <button type="submit" class="btn-save">Save Changes</button>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
