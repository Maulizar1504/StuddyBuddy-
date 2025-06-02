<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Task Manager</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

@include('layouts.navigation')

<div class="task-section">
  <h2 class="section-title">Tambah Tugas</h2>

  @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

  @if ($errors->any())
    <div class="alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('tasks.store') }}" method="POST" class="task-form">
    @csrf
    <input type="text" name="description" placeholder="Nama Tugas" required>
    <input type="date" name="deadline">
    <select name="priority" required>
      <option value="">Pilih Prioritas</option>
      <option value="now">Segera 🔥</option>
      <option value="rush">penting ⏰</option>
      <option value="plan">Siapkan 🧠</option>
    </select>
    <button type="submit" class="btn-add">Tambah Tugas</button>
  </form>
</div>

<div class="task-section">
  <h2 class="section-title">Tugas Aktif</h2>
  <ul class="task-list">
    @foreach ($tasks as $task)
      @if (!$task->completed)
        <li class="task-item">
          <div class="task-content">
            <span class="task-description">{{ $task->description }}</span>
            <span class="task-details">
              Tenggat:
              {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : 'N/A' }}
              <br>
              Prioritas:
              @if ($task->priority == 'now') Segera 🔥
              @elseif ($task->priority == 'rush') penting ⏰
              @else Siapkan 🧠
              @endif
            </span>
          </div>
          <div class="task-actions">
            <form action="{{ route('tasks.toggle', $task) }}" method="POST">
              @csrf
              <button type="submit" class="btn-action btn-complete">
                <i class="fas fa-check"></i> Selesai
              </button>
            </form>
            <button type="button" class="btn-action btn-edit edit-task-btn"
              data-task-id="{{ $task->id }}"
              data-description="{{ $task->description }}"
              data-deadline="{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') : '' }}"
              data-priority="{{ $task->priority }}">
              <i class="fas fa-pen"></i> Edit
            </button>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-action btn-delete">
                <i class="fas fa-trash"></i> Hapus
              </button>
            </form>
          </div>
        </li>
      @endif
    @endforeach
  </ul>
</div>

<div class="task-section">
  <h2 class="section-title">Tugas Selesai</h2>
  <ul class="task-list">
    @foreach ($tasks as $task)
      @if ($task->completed)
        <li class="task-item completed-task">
          <div class="task-content">
            <span class="task-description">{{ $task->description }}</span>
            <span class="task-details">
              Tenggat:
              {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : 'N/A' }}
              <br>
              Prioritas:
              @if ($task->priority == 'now') Segera 🔥
              @elseif ($task->priority == 'rush') penting ⏰
              @else Siapkan 🧠
              @endif
            </span>
          </div>
          <div class="task-actions">
            <form action="{{ route('tasks.toggle', $task) }}" method="POST">
              @csrf
              <button type="submit" class="btn-action btn-uncomplete">
                <i class="fas fa-undo"></i> Uncomplete
              </button>
            </form>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-action btn-delete">
                <i class="fas fa-trash"></i> Delete
              </button>
            </form>
          </div>
        </li>
      @endif
    @endforeach
  </ul>
</div>

{{-- Modal Edit --}}
<div id="editTaskModal" class="modal">
  <div class="modal-content">
    <span class="close-button" onclick="closeModal('editTaskModal')">&times;</span>
    <h2>Edit Task</h2>
    <form id="editTaskForm" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="edit_task_description">Nama Tugas:</label>
        <input type="text" id="edit_task_description" name="description" required>
      </div>
      <div class="form-group">
        <label for="edit_task_deadline">Tenggat:</label>
        <input type="date" id="edit_task_deadline" name="deadline">
      </div>
      <div class="form-group">
        <label for="edit_task_priority">Prioritas:</label>
        <select id="edit_task_priority" name="priority" required>
          <option value="now">Segera 🔥</option>
          <option value="rush">penting ⏰</option>
          <option value="plan">Siapkan 🧠</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
  </div>
</div>

<script>
function openModal(id) {
  document.getElementById(id).style.display = 'block';
}
function closeModal(id) {
  document.getElementById(id).style.display = 'none';
}
document.querySelectorAll('.edit-task-btn').forEach(button => {
  button.addEventListener('click', () => {
    const id = button.dataset.taskId;
    document.getElementById('edit_task_description').value = button.dataset.description;
    document.getElementById('edit_task_deadline').value = button.dataset.deadline;
    document.getElementById('edit_task_priority').value = button.dataset.priority;
    document.getElementById('editTaskForm').action = `/tasks/${id}`;
    openModal('editTaskModal');
  });
});
</script>

</body>
</html>
