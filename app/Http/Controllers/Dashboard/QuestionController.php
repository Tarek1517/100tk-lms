<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Exam;
use App\Models\QuestionOption;
use Termwind\Question as TermwindQuestion;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        //
    }

    public function store(QuestionRequest $request)
    {

        foreach ($request->questions as $question) {
            $ques = Question::create([
                'exam_id' => $request->exam_id,
                'question_text' => $question['question_text'],
            ]);

            foreach ($question['options'] as $option) {
                QuestionOption::create([
                    'question_id' => $ques->id,
                    'option_text' => $option['option_text'],
                    'is_correct' => $option['is_correct'],
                ]);
            }
        }

        $exam = Exam::findOrFail($request->exam_id);
        $courseId = $exam->examClass->course_id;
        return Inertia::location("/dashboard/course/{$courseId}");
    }



    public function show(string $id)
    {
        $CreateQuestion = Exam::with('examClass', 'questions')
            ->orderBy('created_at', 'DESC')->findOrFail($id);

        return Inertia::render('Dashboard/Exam/CreateExam', [
            'CreateQuestion' => $CreateQuestion,
        ]);

    }

    public function edit(string $id)
    {
        $editQuestion = Question::with('exam', 'options')
            ->where('exam_id', $id)
            ->orderBy('created_at', 'DESC')->get();

        return Inertia::render('Dashboard/Exam/EditExam', [
            'editQuestion' => $editQuestion,
        ]);
    }

    public function update(Request $request, $examId)
    {
        $validated = $request->validate([
            'questions' => 'required|array',
            'questions.*.question_text' => 'required|string',
            'questions.*.options' => 'required|array',
            'questions.*.options.*.option_text' => 'required|string',
            'questions.*.options.*.is_correct' => 'required|boolean',
        ]);

        foreach ($validated['questions'] as $questionData) {
            $question = Question::updateOrCreate(
                ['id' => $questionData['id'] ?? null],
                [
                    'exam_id' => $examId,
                    'question_text' => $questionData['question_text'],
                ]
            );

            foreach ($questionData['options'] as $optionData) {
                QuestionOption::updateOrCreate(
                    ['id' => $optionData['id'] ?? null],
                    [
                        'question_id' => $question->id,
                        'option_text' => $optionData['option_text'],
                        'is_correct' => $optionData['is_correct'],
                    ]
                );
            }
        }

        $exam = Exam::findOrFail($request->exam_id);
        $courseId = $exam->examClass->course_id;
        return Inertia::location("/dashboard/course/{$courseId}");
    }


    public function deleteOption($id)
    {
        $option = QuestionOption::query()->findOrFail($id);
        $option->delete();

        return response()->noContent();
    }

    public function destroy(string $id)
    {
        $question = Question::query()->findOrFail($id);
        $question->delete();
        return response()->noContent();
    }
}
