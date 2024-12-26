<?php

use App\Http\Controllers\Dashboard\CourseCategoryController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\CourseClassesController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\FooterController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Frontend\StudentsAuthController;
use App\Http\Controllers\Frontend\StudentLoginController;
use App\Http\Controllers\Dashboard\PageControler;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category', [HomeController::class, 'categoryCourse']);
Route::resource('courses', \App\Http\Controllers\Frontend\CourseController::class);

Route::get('/Student/Login', [StudentLoginController::class, 'index'])->name('Student.Login');
Route::post('/Student/store', [StudentLoginController::class, 'store'])->name('Student.store');
Route::post('/Student/Login/store', [StudentsAuthController::class, 'loginSubmit'])->name('Student.Login.store');
Route::get('/Student/Register', [StudentLoginController::class, 'register'])->name('Student.Register');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('dashboard')->middleware(['auth:sanctum'])->group(function (): void {
    Route::resource('student', StudentController::class);
    Route::resource('course', CourseController::class);
    Route::resource('category', CourseCategoryController::class);
    Route::resource('course_classes', CourseClassesController::class);
    Route::resource('setting',SettingController::class);
    Route::resource('footer',FooterController::class);
    Route::resource('page',PageControler::class);

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth:student')->group(function () {
    Route::resource('students', StudentsAuthController::class);
    Route::post('Student/logout', [StudentsAuthController::class, 'destroy'])->name('Student.logout');
});

Route::get('/all-categories', function () {
    return \App\Models\CourseCategory::get();
});

require __DIR__ . '/auth.php';
