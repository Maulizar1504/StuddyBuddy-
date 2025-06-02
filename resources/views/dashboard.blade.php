<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - StudyBuddy</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
@include('layouts.navigation')

<main class="main">
  <h1 id="welcome"></h1>
  <h2 id="motivasi" class="animated-text"></h2>

<div class="dashboard-greeting">
    <p class="dashboard-intro">Yuk mulai atur kegiatanmu hari ini!</p>
    <p class="dashboard-subtext">Pantau tugas, kelola jadwal, dan tingkatkan konsistensi belajarmu</p>
</div>

<hr class="dashboard-divider">

<h3 class="summary-title">Ringkasan Kamu Hari Ini</h3>

<div class="summary-column">
    <div class="summary-box summary-schedule">
        <h4>Jadwal Hari Ini</h4>
        @if ($todaySchedules->isEmpty())
            <p>Tidak ada jadwal untuk hari ini. Tambahkan jadwal di <a href="{{ route('planner.index') }}">Jadwal Kegiatan</a>!</p>
        @else
            <ul>
                @foreach ($todaySchedules as $schedule)
                    <li>
                        <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($schedule->event_time)->format('H:i') }} -
                        <strong>{{ $schedule->event_name }}</strong>
                        @if ($schedule->schedule_type == 'recurring')
                            (Setiap {{ $days[$schedule->recurring_day] }})
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="summary-box summary-task-today">
        <h4>Tugas Hari Ini (Belum Selesai)</h4>
        @if ($todayIncompleteTasks->isEmpty())
            <p>Hebat! Tidak ada tugas yang belum selesai hari ini.</p>
        @else
            <ul>
                @foreach ($todayIncompleteTasks as $task)
                    <li>
                        <i class="fas fa-tasks"></i> <strong>{{ $task->description }}</strong>
                        <span class="task-priority-{{ $task->priority }}">
                            (Prioritas:
                            @if ($task->priority == 'now') <i class="fas fa-fire"></i> Now
                            @elseif ($task->priority == 'rush') <i class="fas fa-clock"></i> Rush
                            @else <i class="fas fa-brain"></i> Plan
                            @endif
                            )
                        </span>
                    </li>
                @endforeach
            </ul>
            <p><a href="{{ route('tasks.index') }}">Lihat semua tugas</a></p>
        @endif
    </div>

    <div class="summary-box summary-task-upcoming">
        <h4>Tugas Mendatang</h4>
        <p>Kamu memiliki <strong>{{ $upcomingTasksCount }}</strong> tugas mendatang yang belum selesai.</p>
        <p><a href="{{ route('tasks.index') }}">Kelola Tugas Mendatang</a></p>
    </div>

    <div class="summary-box summary-progress">
        <h4>Progres Tugas Keseluruhan</h4>
        <p>Kamu telah menyelesaikan <strong>{{ $progressPercentage }}%</strong> dari total tugas Kamu.</p>
        <div class="progress-bar-container">
            <div class="progress-bar" style="width: {{ $progressPercentage }}%;">
                {{ $progressPercentage }}%
            </div>
        </div>
    </div>
</div>

<section class="video-recommendation">
  <h2>Rekomendasi Video Untukmu</h2>
 @php
$videos = [
    [
        'id' => 'p3GkTO7t3rU',
        'title' => 'Learning Tips - Rahasia Hobi Belajar'
    ],
    [
        'id' => 'mNBmG24djoY',
        'title' => 'Pomodoro Technique Explained'
    ],
    [
        'id' => '4emsIjeGZwk',
        'title' => 'Gimana Cara Belajar Paling Efektif?'
    ],
    [
        'id' => '8ZhoeSaPF-k',
        'title' => 'How to Stay Motivated While Studying'
    ],
];
@endphp

<div class="video-grid">
    @foreach ($videos as $video)
        <div class="video-embed">
            <iframe
                width="100%"
                height="200"
                src="https://www.youtube.com/embed/{{ $video['id'] }}"
                title="{{ $video['title'] }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
            <p>{{ $video['title'] }}</p>
        </div>
    @endforeach
</div>

  </div>
</section>
</main>

<script>
  const welcomeText = "Selamat datang kembali, {{ Auth::user()->name }}!";
  let i = 0;
  const speed = 70; 

  function typeWriter() {
    if (i < welcomeText.length) {
      document.getElementById("welcome").innerHTML += welcomeText.charAt(i);
      i++;
      setTimeout(typeWriter, speed);
    }
  }

  window.onload = typeWriter;
</script>
</body>
</html>