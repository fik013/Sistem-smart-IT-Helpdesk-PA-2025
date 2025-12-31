<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Routes
    Route::middleware('role:employee')->group(function () {
        Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::get('/inventory', [App\Http\Controllers\User\InventoryController::class, 'index'])->name('user.inventory');
        Route::get('/faq', [App\Http\Controllers\User\FaqController::class, 'index'])->name('user.faq');
        Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');
        Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    });

    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/kelola-akun', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::post('/kelola-akun', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
        Route::resource('faq', App\Http\Controllers\Admin\FaqController::class);
        Route::get('/prioritas-saw', [App\Http\Controllers\Admin\SawPriorityController::class, 'index'])->name('prioritas.index');
        Route::resource('departments', App\Http\Controllers\Admin\DepartmentController::class)->except(['create', 'edit', 'show']);
        Route::resource('inventory', App\Http\Controllers\Admin\InventoryController::class);
        Route::resource('tickets', App\Http\Controllers\Admin\TicketController::class)->only(['index', 'show', 'update']);
        Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
