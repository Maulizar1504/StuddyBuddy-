<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Task</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* Minimal styling to not interfere with your global style.css */
    .edit-container {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .edit-form-group {
      margin-bottom: 15px;
    }
    .edit-form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    .edit-form-group input[type="text"],
    .edit-form-group input[type="date"],
    .edit-form-group select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
    }
    .edit-form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
    }
    .edit-btn {
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      color: white;
    }
    .edit-btn-primary {
      background-color: #007bff;
    }
    .edit-btn-secondary {
      background-color: #6c757d;
    }
    .edit-alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: .75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: .25rem;
    }
  </style>
</head>
<body>
  @include('layouts.navigation')

  <div class="main-content">
    <div class="edit-container">
      <h1>Edit Task</h1>

      @if ($errors->any())
        <div class="edit-alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="edit-form-group">
          <label for="description">Task Description:</label>
          <input type="text" id="description" name="description" value="{{ old('description', $task->description) }}" required>
        </div>

        <div class="edit-form-group">
          <label for="deadline">Deadline:</label>
          <input type="date" id="deadline" name="deadline" value="{{ old('deadline', $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') : '') }}">
        </div>

        <div class="edit-form-group">
          <label for="priority">Priority:</label>
          <select id="priority" name="priority" required>
            <option value="now" {{ old('priority', $task->priority) == 'now' ? 'selected' : '' }}>Now</option>
            <option value="rush" {{ old('priority', $task->priority) == 'rush' ? 'selected' : '' }}>Rush</option>
            <option value="plan" {{ old('priority', $task->priority) == 'plan' ? 'selected' : '' }}>Plan</option>
          </select>
        </div>

        <div class="edit-form-actions">
          <button type="submit" class="edit-btn edit-btn-primary">Update Task</button>
          <a href="{{ route('tasks.index') }}" class="edit-btn edit-btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>