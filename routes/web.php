<?php

use App\Http\Controllers\Dashboard\CourseCategoryController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category', [HomeController::class, 'categoryCourse']);
Route::resource('courses', \App\Http\Controllers\Frontend\CourseController::class);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Index');
    })->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('dashboard')->group(function():void{
    Route::resource('student', StudentController::class);
   Route::resource('course', CourseController::class);
   Route::resource('category', CourseCategoryController::class);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
