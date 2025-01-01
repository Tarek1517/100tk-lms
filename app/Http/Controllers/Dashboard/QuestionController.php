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

    public function update(QuestionRequest $request, string $id)
    {
        $request->all();

        $question = Question::findOrFail($id);
        $data = $request->validated();
        $question->update($data);
        // $options = [];
        // foreach ($request->options as $option) {
        //     $options[] = [
        //         'question_id' => $question->id,
        //         'option_text' => $option['option_text'],
        //         'is_correct' => $option['is_correct'],
        //     ];
        // }
        // QuestionOption::query()->insert($options);
        return response()->noContent();
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
