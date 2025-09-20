<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua routes harus login
Route::middleware(['auth'])->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🚀 sementara tanpa role middleware biar tidak error
    // Project CRUD
    Route::resource('projects', ProjectController::class);

    // Task CRUD
    Route::resource('tasks', TaskController::class);

    // My Tasks (nanti bisa dikasih role lagi)
    Route::get('my-tasks', [TaskController::class, 'myTasks'])->name('tasks.myTasks');

    Route::patch('tasks/{task}/update-status', [TaskController::class, 'ajaxUpdateStatus'])->name('tasks.ajaxUpdateStatus');
});

require __DIR__.'/auth.php';
