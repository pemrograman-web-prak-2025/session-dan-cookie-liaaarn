<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StudyTrack | History</title>
  <link rel="stylesheet" href="{{ asset('css/history.css') }}">
</head>
<body>
  <div class="wrapper">
    <aside class="sidebar">
      <h2 class="logo">StudyTrack</h2>
      <ul class="menu">
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('addSchedule') }}">Add Schedule</a></li>
        <li><a href="{{ route('history') }}" class="active">History</a></li>
        <li><a href="{{ route('account') }}">Account</a></li>
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
        <h2>History</h2>

        @if($histories->isEmpty())
        <p class="no-history">No completed tasks yet.</p>
        @else
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Date & Time</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($histories as $history)
              <tr>
                <td>{{ $history->datetime }}</td>
                <td>{{ $history->title }}</td>
                <td>{{ $history->description }}</td>
                <td>
                  <form
                  action="{{ route('history.delete', $history->id) }}"
                  method="POST"
                  onsubmit="return confirm('Delete this history?');"
                  >
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-delete">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>
  </main>
</div>
</body>
</html>
