<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>StudyBuddy Login</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
</head>
<body class="splash-screen">
  <div class="auth-container">
    <div class="auth-header"> <img src="{{ asset('images/studybuddy_logo.png') }}" alt="StudyBuddy Logo" class="auth-logo">
      <h1>StudyBuddy</h1>
    </div>
    <h3>Selamat Datang Kembali</h3>
    <form id="loginForm" method="POST" action="{{ route('login') }}">
      @csrf

      <input type="text" id="username" name="username" placeholder="Nama Pengguna" required />
      @error('username')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <input type="password" id="password" name="password" placeholder="Kata Sandi" required />
      @error('password')
        <div class="error-message">{{ $message }}</div>
      @enderror

      {{-- ERROR LOGIN GLOBAL (misal password/username salah) --}}
      @if(session('error'))
        <div class="error-message">{{ session('error') }}</div>
      @endif

      <button type="submit">Masuk</button>
    </form>

    <p class="auth-link-text">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
  </div>
</body>
</html>