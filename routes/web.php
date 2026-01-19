<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    DashboardController,
    ProjectController,
    ToolController,
    ToolBorrowingController,
    ProgressReportController,
    UserController,
    ProfileController
};

// --- PUBLIC ROUTES ---
Route::get('/', [HomeController::class, 'index'])->name('home');
// --- AUTHENTICATED ROUTES ---
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Profile Management
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // --- ROLE: ADMIN ONLY ---
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
        // Project Management (CRUD)
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });

    // General Access (Semua Role)
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/maps', [ProjectController::class, 'map'])->name('projects.map');
    Route::get('/borrowings', [ToolBorrowingController::class, 'index'])->name('borrowings.index');

    // --- ROLE: ADMIN & PELAKSANA ---
    Route::middleware('role:admin,pelaksana')->group(function () {
        // Tool Management (CRUD)
        Route::resource('tools', ToolController::class);
        
        // Tool Borrowing Actions
        Route::post('/borrowings/{id}/return', [ToolBorrowingController::class, 'returnTool'])->name('borrowings.return');
        Route::post('/borrowings/{id}/approve', [ToolBorrowingController::class, 'approveBorrowing'])->name('borrowings.approve');
        Route::post('/borrowings/{id}/reject', [ToolBorrowingController::class, 'rejectBorrowing'])->name('borrowings.reject');
        // Feedback on Reports
        Route::post('/reports/{report}/feedback', [ProgressReportController::class, 'storeFeedback'])->name('reports.feedback');
    });
    

    // --- ROLE: MANDOR ONLY ---
    Route::middleware('role:mandor')->group(function () {
        Route::get('/projects/{project}/reports/create', [ProgressReportController::class, 'create'])->name('reports.create');
        Route::post('/projects/{project}/reports', [ProgressReportController::class, 'store'])->name('reports.store');
    });

    // --- ROLE: ADMIN, PELAKSANA, & MANDOR (Monitoring) ---
    Route::middleware('role:admin,pelaksana,mandor')->group(function () {
        Route::get('/reports', [ProgressReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/{report}', [ProgressReportController::class, 'show'])->name('reports.show');
        Route::get('/projects/{project}/reports', [ProgressReportController::class, 'showByProject'])->name('reports.by-project');
        Route::get('/borrowings/create', [ToolBorrowingController::class, 'create'])->name('borrowings.create');
        Route::post('/borrowings', [ToolBorrowingController::class, 'store'])->name('borrowings.store');
    });

});

require __DIR__.'/auth.php';