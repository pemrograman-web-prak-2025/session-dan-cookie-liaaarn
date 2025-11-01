<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Schedule - StudyTrack</title>
  <link rel="stylesheet" href="{{ asset('css/addSchedule.css') }}">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2 class="logo">StudyTrack</h2>
      <ul class="menu">
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('addSchedule') }}" class="active">Add Schedule</a></li>
        <li><a href="{{ route('history') }}">History</a></li>
        <li><a href="{{ route('account') }}">Account</a></li>
      </ul>
      <div class="logout">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn-logout">Logout</button>
        </form>
      </div>
    </aside>

    <main class="main-content">
      <h2>Add New Schedule</h2>

      <form action="{{ route('addSchedule.store') }}" method="POST" class="schedule-form">
        @csrf
        <label for="date">Date</label>
        <input type="date" name="date" id="date" required>

        <label for="time">Time</label>
        <input type="time" name="time" id="time" required>

        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Enter schedule title" required>

        <label for="description">Description</label>
        <textarea name="description" id="description" placeholder="Write description..."></textarea>

        <button type="submit">Add Schedule</button>
      </form>
    </main>
  </div>
</body>
</html>
