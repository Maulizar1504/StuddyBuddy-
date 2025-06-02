<nav>
  <ul>
    {{-- Ubah 'profile.index' menjadi 'dashboard' --}}
    <li><a href="{{ route('dashboard') }}">Beranda</a></li>
    <li><a href="{{ route('tasks.index') }}">Daftar Tugas</a></li>
    <li><a href="{{ route('planner.index') }}">Jadwal Kegiatan</a></li>
    <li><a href="{{ route('profile.index') }}">Akun Saya</a></li>
  </ul>
</nav>