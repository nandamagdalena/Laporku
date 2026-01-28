<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndexUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AspirationController;

// Public Routes
// Home
Route::get('/', function () {
    return view('welcome');
});

// Register
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Login
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ADMIN
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/daftarpengguna', [IndexUserController::class, 'index'])->name('admin.users');
        Route::delete('/daftarpengguna/{id}', [IndexUserController::class, 'destroy'])->name('admin.usersdelete');

        //CATEGORY MANAGEMENT
        Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    // USER
    Route::middleware('role:user')->group(function () {
        Route::get('/user/dashboard', function () {
            return view('user.dashboard');
        })->name('user.dashboard');

        Route::get('/pengaduan', [AspirationController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [AspirationController::class, 'store'])->name('pengaduan.store');
        Route::get('/pengaduan-saya', [AspirationController::class, 'myAspiration'])->name('pengaduan.mine');
    });
});
