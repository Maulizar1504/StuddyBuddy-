<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Jadwal Harian</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  @include('layouts.navigation')

  <div class="main-content">
<div class="planner-container">
    <div class="calendar-section">
        <div class="calendar-header">
            <button id="prevMonthBtn"><i class="fas fa-chevron-left"></i></button>
            <h2 id="currentMonthYear"></h2>
            <button id="nextMonthBtn"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="calendar-grid-header">
            <div class="calendar-day-header">Minggu</div>
            <div class="calendar-day-header">Senin</div>
            <div class="calendar-day-header">Selasa</div>
            <div class="calendar-day-header">Rabu</div>
            <div class="calendar-day-header">Kamis</div>
            <div class="calendar-day-header">Jumat</div>
            <div class="calendar-day-header">Sabtu</div>
        </div>
        <div class="calendar-grid" id="calendarBody">
        </div>
    </div>

    <div class="schedule-section">
        <h2 id="scheduleForDateHeader">Jadwal</h2>
        <div class="schedule-action-buttons">
            <button id="addScheduleBtn"><i class="fas fa-plus"></i> Tambah Jadwal</button>
            <button id="viewAllSchedulesBtn"><i class="fas fa-list"></i> Lihat Semua Jadwal</button>
        </div>
        <p id="noScheduleMessage" style="display: none;">Tidak ada jadwal untuk tanggal ini.</p>
        <div id="scheduleList">
        </div>
    </div>
</div>

{{-- Modal Tambah Jadwal --}}
<div id="addScheduleModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeAddModal">&times;</span>
        <h3>Tambah Jadwal Baru</h3>
        <form id="addScheduleForm">
            @csrf
            <div class="form-group">
                <label for="event_name">Nama Kegiatan:</label>
                <input type="text" id="event_name" name="event_name" required>
            </div>
            <div class="form-group">
                <label for="event_time">Waktu Kegiatan:</label>
                <input type="time" id="event_time" name="event_time" required>
            </div>
            <div class="form-group">
                <label>Tipe Jadwal:</label>
                <div class="radio-group">
                    <div>
                        <input type="radio" id="type_one_time" name="schedule_type" value="one_time" checked>
                        <label for="type_one_time">Jadwal Khusus</label>
                    </div>
                    <div>
                        <input type="radio" id="type_recurring" name="schedule_type" value="recurring">
                        <label for="type_recurring">Jadwal Rutin</label>
                    </div>
                </div>
            </div>
            <div class="form-group" id="addEventDateGroup">
                <label for="event_date">Tanggal Kegiatan:</label>
                <input type="date" id="event_date" name="event_date">
            </div>
            <div class="form-group" id="addRecurringDayGroup" style="display: none;">
                <label for="recurring_day">Hari Rutin:</label>
                <select id="recurring_day" name="recurring_day">
                    <option value="">Pilih Hari</option>
                    <option value="0">Minggu</option>
                    <option value="1">Senin</option>
                    <option value="2">Selasa</option>
                    <option value="3">Rabu</option>
                    <option value="4">Kamis</option>
                    <option value="5">Jumat</option>
                    <option value="6">Sabtu</option>
                </select>
            </div>
            <button type="submit">Tambah Jadwal</button>
        </form>
    </div>
</div>

{{-- Modal Edit Jadwal --}}
<div id="editScheduleModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeEditModal">&times;</span>
        <h3>Edit Jadwal</h3>
        <form id="editScheduleForm">
            @csrf
            <input type="hidden" id="editScheduleId" name="id">
            <div class="form-group">
                <label for="editEventName">Nama Kegiatan:</label>
                <input type="text" id="editEventName" name="event_name" required>
            </div>
            <div class="form-group">
                <label for="editEventTime">Waktu Kegiatan:</label>
                <input type="time" id="editEventTime" name="event_time" required>
            </div>
            <div class="form-group">
                <label>Tipe Jadwal:</label>
                <div class="radio-group">
                    <div>
                        <input type="radio" id="edit_type_one_time" name="schedule_type" value="one_time">
                        <label for="edit_type_one_time">Jadwal Khusus</label>
                    </div>
                    <div>
                        <input type="radio" id="edit_type_recurring" name="schedule_type" value="recurring">
                        <label for="edit_type_recurring">Jadwal Rutin</label>
                    </div>
                </div>
            </div>
            <div class="form-group" id="editEventDateGroup">
                <label for="editEventDate">Tanggal Kegiatan:</label>
                <input type="date" id="editEventDate" name="event_date">
            </div>
            <div class="form-group" id="editRecurringDayGroup" style="display: none;">
                <label for="editRecurringDay">Hari Rutin:</label>
                <select id="editRecurringDay" name="recurring_day">
                    <option value="">Pilih Hari</option>
                    <option value="0">Minggu</option>
                    <option value="1">Senin</option>
                    <option value="2">Selasa</option>
                    <option value="3">Rabu</option>
                    <option value="4">Kamis</option>
                    <option value="5">Jumat</option>
                    <option value="6">Sabtu</option>
                </select>
            </div>
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</div>
  <script src="{{ asset('js/planner.js') }}"></script>
</body>
</html>