<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlannerController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Redirect root ke login
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes (Login and Register)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout Route 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Planner Routes
    Route::get('/planner/schedules-by-date', [PlannerController::class, 'getSchedulesByDate'])->name('planner.schedules.byDate');
    Route::get('/planner', [PlannerController::class, 'index'])->name('planner.index');
    Route::get('/planner/all-schedules', [PlannerController::class, 'getAllSchedules'])->name('planner.schedules.all');
    Route::post('/planner', [PlannerController::class, 'store'])->name('planner.store');
    Route::get('/planner/{schedule}/edit', [PlannerController::class, 'edit'])->name('planner.edit');
    Route::post('/planner/{schedule}', [PlannerController::class, 'update'])->name('planner.update');
    Route::delete('/planner/{schedule}', [PlannerController::class, 'destroy'])->name('planner.destroy');


    // Task Manager Routes
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggle');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/upload-picture', [ProfileController::class, 'uploadPicture'])->name('profile.upload-picture');
    Route::get('/profile/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('profile.change-password');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password.store');
    Route::post('/api/verify-password', [ProfileController::class, 'verifyPassword'])->name('api.verify-password');
    Route::delete('/profile', [ProfileController::class, 'deleteAccount'])->name('profile.destroy');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});