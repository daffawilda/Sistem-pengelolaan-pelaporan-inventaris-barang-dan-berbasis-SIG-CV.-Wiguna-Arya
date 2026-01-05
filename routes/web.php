<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\ToolBorrowingController;
use App\Http\Controllers\ProgressReportController;
use App\Http\Controllers\UserController;

// Halaman utama menampilkan 3 proyek terbaru
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});

// Grup middleware untuk akses CRUD proyek (admin & pelaksana)
Route::middleware(['auth', 'role:admin,pelaksana'])->group(function () {
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});

// Grup middleware untuk akses CRUD alat (admin saja)
Route::middleware(['auth', 'role:admin,pelaksana'])->group(function () {
    Route::get('/tools', [ToolController::class, 'index'])->name('tools.index');
    Route::get('/tools/create', [ToolController::class, 'create'])->name('tools.create');
    Route::post('/tools', [ToolController::class, 'store'])->name('tools.store');
    Route::get('/tools/{tool}/edit', [ToolController::class, 'edit'])->name('tools.edit');
    Route::put('/tools/{tool}', [ToolController::class, 'update'])->name('tools.update');
    Route::delete('/tools/{tool}', [ToolController::class, 'destroy'])->name('tools.destroy');
});

// Grup middleware untuk akses peminjaman alat (admin & pelaksana)
Route::middleware(['auth', 'role:admin,pelaksana'])->group(function () {
    Route::get('/borrowings/create', [ToolBorrowingController::class, 'create'])->name('borrowings.create');
    Route::post('/borrowings', [ToolBorrowingController::class, 'store'])->name('borrowings.store');
    Route::post('/borrowings/{id}/return', [ToolBorrowingController::class, 'returnTool'])->name('borrowings.return');
});

// Grup middleware untuk laporan progres (mandor saja)
Route::middleware(['auth', 'role:mandor'])->group(function () {
    Route::get('/projects/{project}/reports/create', [ProgressReportController::class, 'create'])->name('reports.create');
    Route::post('/projects/{project}/reports', [ProgressReportController::class, 'store'])->name('reports.store');
});

// Pelaksana melihat laporan → hanya proyek yang dia kelola
Route::middleware(['auth', 'role:pelaksana,mandor,admin'])->group(function () {
    Route::get('/reports', [ProgressReportController::class, 'index'])->name('reports.index');
    // Detail: semua laporan dari satu proyek
    Route::get('/projects/{project}/reports', [ProgressReportController::class, 'showByProject'])
           ->name('reports.by-project');
    Route::get('/reports/{report}', [ProgressReportController::class, 'show'])->name('reports.show');
});
// === FEEDBACK: HANYA UNTUK PELAKSANA & ADMIN ===
Route::middleware(['auth', 'role:pelaksana,admin'])->group(function () {
    Route::post('/reports/{report}', [ProgressReportController::class, 'storeFeedback'])->name('reports.feedback');
});
// Grup hanya butuh login (semua role bisa lihat daftar & detail)
Route::middleware(['auth'])->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/maps', [ProjectController::class, 'map'])->name('projects.map');
    Route::get('/borrowings', [ToolBorrowingController::class, 'index'])->name('borrowings.index');
});

route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');    
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
