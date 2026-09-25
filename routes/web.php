<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Redirect root to students index
Route::get('/', function () {
    return redirect()->route('students.index');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected student routes — guests are redirected to /login
Route::middleware('auth')->group(function () {
    Route::resource('students', StudentController::class);
});

// Courses are also protected
Route::middleware('auth')->group(function () {
    Route::resource('courses', CourseController::class);
});
