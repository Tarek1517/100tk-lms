<?php

use App\Http\Controllers\Dashboard\CourseCategoryController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Frontend\CoursesController;
use App\Http\Controllers\Dashboard\CourseClassesController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\FooterController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Dashboard\ExamController;
use App\Http\Controllers\Dashboard\QuestionController;
use App\Http\Controllers\Frontend\StudentsAuthController;
use App\Http\Controllers\Frontend\StudentLoginController;
use App\Http\Controllers\Frontend\STDdashboard\StudentDashboardController;
use App\Http\Controllers\Frontend\STDdashboard\OrderSuccessController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Dashboard\PageControler;
use App\Http\Controllers\Dashboard\StudentExamAttemtController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Route::post('/order-success', function () {
//     return Inertia::render('Frontend/Course/ThankYou');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category', [HomeController::class, 'categoryCourse']);
Route::resource('courses', CoursesController::class);
Route::get('/course/checkout/{id}', [CoursesController::class, 'checkout'])->name('course.checkout');
Route::post('/thank/page', [CoursesController::class, 'thankYou']);

Route::get('/student/login', [StudentLoginController::class, 'index'])->name('student.login');
Route::post('/student/store', [StudentLoginController::class, 'store'])->name('Student.store');
Route::post('/student/login/store', [StudentsAuthController::class, 'loginSubmit'])->name('Student.Login.store');
Route::post('/login/store', [StudentsAuthController::class, 'login'])->name('Login.store');
Route::get('/student/register', [StudentLoginController::class, 'register'])->name('Student.Register');
Route::post('/order-success', [OrderSuccessController::class, 'index'])->name('order-success');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('dashboard')->middleware('auth')->group(function (): void {
    Route::resource('student', StudentController::class);
    Route::resource('course', CourseController::class);
    Route::resource('category', CourseCategoryController::class);
    Route::resource('course_classes', CourseClassesController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('footer', FooterController::class);
    Route::resource('page', PageControler::class);

    // Exam
    Route::resource('exam', ExamController::class);
    Route::resource('exam-question', QuestionController::class);



});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth:student')->group(function () {
    Route::resource('students', StudentsAuthController::class);
    Route::post('student/logout', [StudentsAuthController::class, 'destroy'])->name('student.logout');
    Route::resource('/save_order', OrderController::class);

    //// Student Dashboard
    Route::get('/coures/{id}', [StudentDashboardController::class, 'index'])->name('Coures.index');
    Route::get('/exam/attend_exam/{id}', [StudentDashboardController::class, 'attend_exam'])->name('Exam.attend_exam');
    Route::get('/exam/result/{id}', [StudentExamAttemtController::class, 'result'])->name('Exam.Result');
    Route::get('/coures/{slug}/show', [StudentDashboardController::class, 'show'])->name('Coures.show');
    Route::resource('student-exam-attempt', StudentExamAttemtController::class);

    //SslCommerz route
    Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

});

// Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);



Route::get('/all-categories', function () {
    return \App\Models\CourseCategory::get();
});





//SSLCOMMERZ END

require __DIR__ . '/auth.php';
