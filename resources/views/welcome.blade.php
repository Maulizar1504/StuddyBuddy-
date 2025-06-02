<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>StudyBuddy - Selamat Datang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #f5faff;
      color: #333;
    }
    .section {
      padding: 60px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    .section-blue {
      background-color: #e9f3fc;
    }
    .section-light {
      background-color: #ffffff;
    }
    .feature-icon {
      width: 140px;
      margin-bottom: 20px;
    }
    .section h2 {
      font-size: 1.8em;
      margin-bottom: 15px;
      color: #004080;
    }
    .section p {
      font-size: 1em;
      max-width: 700px;
      color: #444;
      line-height: 1.6;
    }
    .hero-img {
      max-width: 180px;
      margin-bottom: 15px;
    }
    .hero-title {
      font-size: 2.5em;
      color: #0050a3;
      margin-bottom: 5px;
    }
    .hero-sub {
      font-size: 1.6em;
      color: #004070;
      margin-bottom: 15px;
    }
    .hero-desc {
      font-size: 1em;
      max-width: 600px;
      margin-bottom: 25px;
      color: #333;
    }
    .btn-group {
      display: flex;
      gap: 15px;
    }
    .btn {
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
    }
    .btn-login {
      background-color: #007bff;
      color: white;
    }
    .btn-register {
      background-color: #f0f0f0;
      color: #333;
    }
    /* Alternating layout */
    .section-layout {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 40px;
      flex-wrap: wrap;
      max-width: 1100px;
      margin: auto;
    }
    .section-layout.reverse {
      flex-direction: row-reverse;
    }
    .section-layout img {
      max-width: 220px;
    }
    .section-layout .text {
      flex: 1;
      min-width: 280px;
    }
  </style>
</head>
<body>

  <section class="section section-hero">
  <img src="{{ asset('images/logo.png') }}" class="hero-logo" alt="StudyBuddy Logo">
  <h1>Belajar Lebih Teratur<br>Hidup Lebih Tenang</h1>
  <p>Atur hari-harimu dengan lebih fokus dan produktif melalui platform belajar yang membantu menyusun, mengingat, dan menyemangati.</p>
  <div class="btn-group">
    <a href="{{ route('login') }}" class="btn btn-login">Masuk</a>
    <a href="{{ route('register') }}" class="btn btn-register">Daftar Akun</a>
  </div>
</section>


  <section class="section section-light">
    <div class="section-layout">
      <img src="{{ asset('images/dashboard-icon.png') }}" alt="Dashboard">
      <div class="text">
        <h2>Dashboard Cerdas</h2>
        <p>Dapatkan ringkasan jadwal, tugas, dan progres setiap hari. Termasuk rekomendasi video motivasi agar kamu tetap semangat belajar.</p>
      </div>
    </div>
  </section>

  <section class="section section-blue">
    <div class="section-layout reverse">
      <img src="{{ asset('images/tasks-icon.png') }}" alt="Task Manager">
      <div class="text">
        <h2>Manajemen Tugas Efisien</h2>
        <p>Tambahkan, tandai selesai, atur prioritas, dan edit tugasmu dengan mudah. StudyBuddy bantu kamu tetap fokus pada yang penting.</p>
      </div>
    </div>
  </section>

  <section class="section section-light">
    <div class="section-layout">
      <img src="{{ asset('images/planner-icon.png') }}" alt="Planner">
      <div class="text">
        <h2>Planner Studi Interaktif</h2>
        <p>Atur rencana belajar mingguan atau harian secara visual menggunakan kalender yang mendukung kebiasaan produktif.</p>
      </div>
    </div>
  </section>

  <section class="section section-blue">
    <div class="section-layout reverse">
      <img src="{{ asset('images/profile-icon.png') }}" alt="Notifikasi">
      <div class="text">
        <h2>Akunmu, Kendalimu</h2>
       <p>Kelola akunmu dengan mudah: edit nama dan foto profil, reset kata sandi, dan hapus akun kapan pun kamu mau.</p>
      </div>
    </div>
  </section>

</body>
</html>
