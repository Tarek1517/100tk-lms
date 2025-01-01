<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExamController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Exam/Exam');
    }

    public function create()
    {
         return inertia('Dashboard/Exam/CreateExam');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
			'course_class_id' => 'required|integer|exists:course_classes,id',
			'title' => 'required|string|max:255',
			'course_id' => 'required|integer',
		]);
		Exam::query()->create($data);

		return Inertia::location("/dashboard/course/{$data['course_id']}");
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $examdata = $request->all();
        $exam = Exam::query()->findOrFail($id);
		$data = $request->validate([
            'title' => 'required|string|max:255',
        ]);
		$exam->update($data);
		return Inertia::location("/dashboard/course/{$examdata['course_id']}");
    }
    public function destroy(string $id)
    {
        $exam = Exam::query()->findOrFail($id);
		$exam->delete();

		return response()->noContent();
    }
}
