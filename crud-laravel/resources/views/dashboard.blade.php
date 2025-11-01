<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - StudyTrack</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2 class="logo">StudyTrack</h2>
      <ul class="menu">
        <li><a href="{{ route('dashboard') }}" class="active">Dashboard</a></li>
        <li><a href="{{ route('addSchedule') }}">Add Schedule</a></li>
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
      <header>
        <h2>My Schedule</h2>
        <button id="theme-toggle" style="background:none; border:none; cursor:pointer;">
          <!-- Light or Dark -->
          <span id="theme-label">Light</span>
        </button>
      </header>
      
      <p class="date">{{ now()->translatedFormat('l, d F Y') }}</p>

      <section class="top-section">
        <div class="greeting">
         <h3>Welcome, {{ Auth::user()->username }}!</h3>
          <p>Let's do something positive and productive today.</p>
        </div>

        <div class="course-card">
          <div class="course-header">
            <h4>Daftar Mata Kuliah</h4>
            <button class="add-btn" id="openAddModal" title="Tambah Mata Kuliah">+</button>
          </div>
      
          <div id="addModal" class="modal" style="display:none;">
            <div class="modal-content">
              <h3>Tambah Mata Kuliah</h3>
              <form action="{{ route('matkul.store') }}" method="POST">
                @csrf
                <input type="text" name="nama_matkul" placeholder="Nama Mata Kuliah" required>
                <div class="modal-actions">
                  <button type="submit" class="save-btn">Simpan</button>
                  <button type="button" id="closeAddModal" class="cancel-btn">Batal</button>
                </div>
              </form>
            </div>
          </div>
          
          <div class="course-list">
            @forelse ($matkul as $m)
            <div class="course-item">
              <span>{{ $m->nama_matkul }}</span>
              <form action="{{ route('matkul.destroy', $m->id) }}" method="POST" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn" onclick="return confirm('Yakin ingin menghapus mata kuliah ini?')">🗑</button>
              </form>
            </div>
            
            @empty
            <p class="no-course">Belum ada mata kuliah.</p>
            @endforelse
          </div>
        </div>
      </section>

      <section class="today-task">
        <h4>Today Task</h4>
        @if($schedules->isEmpty())
        <p class="no-task">No schedule yet.</p>
        @else
        <div class="task-list">
          @foreach($schedules as $schedule)
          <div class="task-row">
            <span class="datetime">
            {{ \Carbon\Carbon::parse($schedule->date)->format('d M') }}
            — {{ date('H:i', strtotime($schedule->time)) }}
          </span>

          <div class="bar">
            <div class="task-info">
              <strong>{{ $schedule->title }}</strong><br>
              <small>{{ $schedule->description }}</small>
            </div>
            <form action="{{ route('schedule.done', $schedule->id) }}" method="POST" style="margin-left:auto;">
              @csrf
              <button type="submit" class="done-btn" title="Mark as Done">✅</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</section>
    </main>
  </div>

  <script src="{{ asset('js/addMatkul.js') }}"></script>
  <script src="{{ asset('js/theme.js') }}"></script>

</body>
</html>
