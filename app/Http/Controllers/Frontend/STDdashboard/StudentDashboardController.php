<?php

namespace App\Http\Controllers\Frontend\STDdashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use \App\Models\Student;
use \App\Models\Course;
use \App\Models\Exam;
use \App\Models\StudentExamAttempt;

class StudentDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        // Fetch all courses for the given student ID with required relationships
        $student = Student::with(['courses.category', 'courses.courseClass', 'courses.courseClass.videoUrl'])
            ->findOrFail($id);

        // Pass the courses to the frontend
        return Inertia::render('Frontend/StudentDashboard/Course/STDCourses', [
            'settings' => config('app.settings'), // Example: pass global settings if needed
            'PaidCourses' => $student->courses->sortByDesc('created_at')->values(), // Order courses by creation date and reset keys
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {

        $course = Course::with('courseClass', 'courseClass.videoUrl', 'courseClass.exam', 'courseClass.exam.questions')
            ->where('slug', $slug)->firstOrFail();

        return Inertia::render('Frontend/StudentDashboard/Course/Classes', [
            'course' => $course,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function attend_exam($id)
    {
        // Fetch all courses for the given student ID with required relationships
        $AtendExam = Exam::with(['questions', 'questions.options'])
            ->findOrFail($id);

        return Inertia::render('Frontend/StudentDashboard/Course/Exam', [
            'AtendExam' => $AtendExam,
        ]);
    }

   
}
