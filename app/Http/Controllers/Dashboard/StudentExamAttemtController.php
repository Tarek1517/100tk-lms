<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\StudentExamAttempt;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StudentExamAttemtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $examsAttemps = StudentExamAttempt::query()->where('student_id', Auth::id())->with('exam')->get();

		// return inertia();
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
         $validated = $request->validate([
			'student_id' => 'required|exists:students,id',
			'exam_id' => 'required|exists:exams,id',
			'answers' => 'required|array',
			'answers.*.question_id' => 'required|exists:questions,id',
			'answers.*.option_id' => 'required|exists:question_options,id',
		]);
		$score = 0;
		foreach ($validated['answers'] as $answer) {
			$isCorrect = QuestionOption::where('id', $answer['option_id'])
				->where('is_correct', true)
				->exists();
			if ($isCorrect) $score++;
		}

		StudentExamAttempt::create([
			'student_id' => $validated['student_id'],
			'exam_id' => $validated['exam_id'],
			'score' => $score,
			'is_passed' => $score >= 50 ? 1 : 0,
		]);

        return Inertia::location("/exam/result/{$validated['student_id']}");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    public function result($id)
    {
        // Fetch all courses for the given student ID with required relationships
        $Results = StudentExamAttempt::where('student_id', $id)
            ->with('exam')
            ->get();

        return Inertia::render('Frontend/StudentDashboard/Course/Result', [
            'Results' => $Results,
        ]);
    }
}
