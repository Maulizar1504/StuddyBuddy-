<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ubah Kata Sandi</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f9fc;
      margin: 0;
      padding: 30px;
    }
    .password-container {
      background: #ffffff;
      max-width: 500px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    .password-container h1 {
      text-align: center;
      color: #004080;
      margin-bottom: 25px;
    }
    .form-group {
      margin-bottom: 18px;
    }
    .form-group label {
      display: block;
      font-weight: 600;
      color: #333;
      margin-bottom: 6px;
    }
    .form-group input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1em;
      background-color: #f9f9f9;
    }
    button {
      width: 100%;
      padding: 12px;
      background-color: #0066cc;
      color: white;
      font-weight: 600;
      font-size: 1em;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 10px;
    }
    button:hover {
      background-color: #004f99;
    }
    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #0066cc;
      text-decoration: none;
    }
    .alert-success, .alert-danger {
      padding: 10px 15px;
      margin-bottom: 20px;
      border-radius: 6px;
      font-size: 0.95em;
    }
    .alert-success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    .alert-danger {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
  </style>
</head>
<body>
  <div class="password-container">
    <h1>Ubah Kata Sandi</h1>

    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert-danger">
        <ul style="margin: 0; padding-left: 20px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('profile.change-password.store') }}">
      @csrf
      <div class="form-group">
        <label for="current_password">Kata Sandi Saat Ini</label>
        <input type="password" id="current_password" name="current_password" required>
      </div>
      <div class="form-group">
        <label for="new_password">Kata Sandi Baru</label>
        <input type="password" id="new_password" name="new_password" required>
      </div>
      <div class="form-group">
        <label for="new_password_confirmation">Konfirmasi Kata Sandi Baru</label>
        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
      </div>
      <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="{{ route('profile.index') }}" class="back-link">Kembali ke Profil</a>
  </div>
</body>
</html>
