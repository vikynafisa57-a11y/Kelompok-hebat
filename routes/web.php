<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\ProgressController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
    Route::post('/careers', [CareerController::class, 'select'])->name('careers.select');

    Route::get('/assessment', [AssessmentController::class, 'index'])->name('assessment.index');
    Route::post('/assessment', [AssessmentController::class, 'submit'])->name('assessment.submit');

    Route::get('/skill-gap', [CareerController::class, 'skillGap'])->name('skill-gap');

    Route::get('/roadmap', [RoadmapController::class, 'index'])->name('roadmap.index');
    Route::post('/roadmap/{resource}/progress', [ProgressController::class, 'toggle'])
        ->name('roadmap.progress');

    Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');
});
