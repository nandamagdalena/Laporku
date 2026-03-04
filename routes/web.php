<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndexUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardUserController;

Route::get('/', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return match (auth()->user()->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'user'  => redirect()->route('user.dashboard'),
        default => redirect()->route('login'),
    };
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Route::get('/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

        // Daftar Pengguna Management
        Route::get('/daftarpengguna', [IndexUserController::class, 'index'])->name('admin.users');
        Route::delete('/daftarpengguna/{id}', [IndexUserController::class, 'destroy'])->name('users.delete');
        Route::get('/admin/daftarpengguna/export', [IndexUserController::class, 'export'])->name('admin.users.export');

        // Category Management
        Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

        // Aspiration Management
        Route::get('/aspirations', [AspirationController::class, 'index'])->name('aspiration.index');
        Route::get('/aspirations/menunggu', [AspirationController::class, 'menunggu'])->name('aspirations.menunggu');
        Route::get('/aspirations/diproses', [AspirationController::class, 'diproses'])->name('aspirations.diproses');
        Route::get('/aspirations/selesai', [AspirationController::class, 'selesai'])->name('aspirations.selesai');
        Route::get('/aspirations/ditolak', [AspirationController::class, 'ditolak'])->name('aspirations.ditolak');
        Route::get('/aspirations/{aspiration}', [AspirationController::class, 'show'])->name('aspiration.show');
        Route::put('/aspirations/{aspiration}', [AspirationController::class, 'update'])->name('aspiration.update');
        Route::get('/aspirations/{id}/export', [AspirationController::class, 'export'])->name('aspirations.export');
        Route::get('/aspirations-export-excel', [AspirationController::class, 'exportExcel'])->name('aspirations.export.excel');
    });

    // User Routes
    Route::middleware('role:user')->prefix('user')->group(function () {
        // Route::get('/dashboard', fn () => view('user.dashboard'))->name('user.dashboard');
        Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');

        Route::get('/pengaduan', [AspirationController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [AspirationController::class, 'store'])->name('pengaduan.store');
        Route::get('/pengaduan-saya', [AspirationController::class, 'myAspiration'])->name('pengaduan.mine');
        Route::get('/pengaduan/{aspiration}', [AspirationController::class, 'showUser'])->name('pengaduan.show');
        Route::delete('/pengaduan/{aspiration}', [AspirationController::class, 'destroy'])->name('pengaduan.destroy');
    });
});
