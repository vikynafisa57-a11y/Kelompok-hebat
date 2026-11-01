
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\ProgressController;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| Authentication - Guest
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

});


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Halaman yang Membutuhkan Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // Target Karier
    Route::get('/careers', [CareerController::class, 'index'])
        ->name('careers.index');

    Route::post('/careers', [CareerController::class, 'select'])
        ->name('careers.select');


    // Assessment
    Route::get('/assessment', [AssessmentController::class, 'index'])
        ->name('assessment.index');

    Route::post('/assessment', [AssessmentController::class, 'submit'])
        ->name('assessment.submit');


    // Skill Gap Analysis
    Route::get('/skill-gap', [CareerController::class, 'skillGap'])
        ->name('skill-gap');


    // Learning Roadmap
    Route::get('/roadmap', [RoadmapController::class, 'index'])
        ->name('roadmap.index');

    Route::post('/roadmap/{resource}/progress', [ProgressController::class, 'toggle'])
        ->name('roadmap.progress');


    // Skill Progress
    Route::get('/progress', [ProgressController::class, 'index'])
        ->name('progress.index');

});
