<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Pastikan ini ada --}}
  <title>Profil - StudyBuddy</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  @include('layouts.navigation')

  <div class="profile-layout">
    <h1 class="profile-heading">Akun Saya</h1>

    <div class="profile-avatar-wrapper">
    <img id="profileImage" 
     src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('images/profile-icon.png') }}" 
     alt="Foto Profil" class="profile-avatar">

    </div>

    <p class="profile-username" id="displayName">
    {{ Auth::user()->name }}
</p>

<button class="edit-profile-btn" id="editProfileToggle">
    <i class="fas fa-pen"></i> Edit Profil
</button>

<form id="editProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="edit-profile-form" style="display:none;">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama Baru:</label>
        <input type="text" name="name" value="{{ Auth::user()->name }}" required>
    </div>
    <div class="form-group">
        <label for="profile_picture">Foto Baru (opsional):</label>
        <input type="file" name="profile_picture" accept="image/*">
    </div>
    <button type="submit">Simpan Perubahan</button>
</form>

    {{-- Aksi akun --}}
    <div class="profile-options">
      <div class="profile-option" onclick="document.getElementById('resetPasswordBtn').click()">
        <i class="fas fa-key"></i>
        <span>Reset Kata Sandi</span>
        <i class="fas fa-chevron-right right-icon"></i>
      </div>

      <div class="profile-option" onclick="document.getElementById('deleteAccountBtn').click()">
        <i class="fas fa-user-times"></i>
        <span>Hapus Akun</span>
        <i class="fas fa-chevron-right right-icon"></i>
      </div>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="profile-option">
            <i class="fas fa-sign-out-alt"></i>
            <span>Keluar</span>
            <i class="fas fa-chevron-right right-icon"></i>
        </button>
        </form>

    </div>

    <button id="resetPasswordBtn" style="display:none;"></button>
    <button id="deleteAccountBtn" style="display:none;"></button>
  </div>

  {{-- Modal konfirmasi --}}
  <div id="passwordConfirmModal" class="modal">
    <div class="modal-content">
      <span class="close-button">&times;</span>
      <h2>Konfirmasi Kata Sandi</h2>
      <p>Masukkan kata sandi Anda untuk melanjutkan.</p>
      <form id="confirmPasswordForm">
        <div class="form-group">
          <label for="confirm_password">Kata Sandi:</label>
          <input type="password" id="confirm_password" name="password" required>
        </div>
        <input type="hidden" id="confirmActionType" value="">
        <button type="submit">Konfirmasi</button>
      </form>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const resetPasswordBtn = document.getElementById('resetPasswordBtn');
        const deleteAccountBtn = document.getElementById('deleteAccountBtn');
        const passwordConfirmModal = document.getElementById('passwordConfirmModal');
        const confirmPasswordForm = document.getElementById('confirmPasswordForm');
        const confirmActionTypeInput = document.getElementById('confirmActionType');
        const closeModalButtons = document.querySelectorAll('.modal .close-button'); 
        const editBtn = document.getElementById('editProfileToggle');
        const editForm = document.getElementById('editProfileForm');
        const displayName = document.getElementById('displayName');

        // Function untuk buka modal
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        // Function untuk tutup modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            document.getElementById('confirm_password').value = ''; 
        }

        // Open modal untuk Reset Password
        resetPasswordBtn.addEventListener('click', function() {
            confirmActionTypeInput.value = 'reset';
            openModal('passwordConfirmModal');
        });

        editBtn.addEventListener('click', () => {
            editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
        });

        // Open modal untuk hapus akun 
        deleteAccountBtn.addEventListener('click', function() {
            confirmActionTypeInput.value = 'delete';
            openModal('passwordConfirmModal');
        });

        // tutup modal
        closeModalButtons.forEach(button => {
            button.addEventListener('click', function() {
                closeModal('passwordConfirmModal');
            });
        });

        window.addEventListener('click', function(event) {
            if (event.target == passwordConfirmModal) {
                closeModal('passwordConfirmModal');
            }
        });

        // konfirmasi password
        confirmPasswordForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            const password = document.getElementById('confirm_password').value;
            const actionType = document.getElementById('confirmActionType').value;

            try {
                const response = await fetch('{{ route('api.verify-password') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ password: password })
                });

                const data = await response.json();

                if (response.ok && data.verified) {
                    closeModal('passwordConfirmModal');
                    if (actionType === 'reset') {
                        window.location.href = '{{ route('profile.change-password') }}'; 
                    } else if (actionType === 'delete') {
                        if (confirm('Verifikasi berhasil! Anda yakin ingin menghapus akun Anda? Ini tidak bisa dibatalkan.')) {
                            fetch('{{ route('profile.destroy') }}', {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    window.location.href = '/'; 
                                } else {
                                    alert('Gagal menghapus akun: ' + (data.message || 'Terjadi kesalahan.'));
                                }
                            })
                            .catch(error => {
                                console.error('Error during account deletion:', error);
                                alert('Terjadi kesalahan saat menghapus akun.');
                            });
                        }
                    }
                } else {
                    alert('Kata sandi salah. Mohon coba lagi.');
                }
            } catch (error) {
                console.error('Error during password verification:', error);
                alert('Terjadi kesalahan saat verifikasi kata sandi.');
            }
        });
    });
  </script>
</body>
</html>