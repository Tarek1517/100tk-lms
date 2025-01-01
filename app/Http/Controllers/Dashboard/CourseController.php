<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use \App\Models\CourseCategory;
use App\Http\Requests\CourseRequet;
use Illuminate\Support\Str;
use \App\Models\Course;
use \App\Models\Exam;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $AllCourses = Course::with('category')->orderBy('created_at', 'DESC')->get();

        return Inertia::render('Dashboard/Course/Index', [
            'AllCourses' => $AllCourses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $AllCategories = CourseCategory::get();

        return Inertia::render('Dashboard/Course/Add', [
            'allCategories' => $AllCategories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequet $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('cover_image')) {
            $img_file = $request->file('cover_image');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;

            $path = $img_file->storeAs('img', $image_full_name, 'public');
            $data['cover_image'] = $image_full_name;
        }



        $course = Course::create($data);

        return Inertia::location(route('course.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $showCourse = Course::with('category', 'courseClass', 'courseClass.videoUrl', 'courseClass.exam', 'courseClass.exam.questions')->findOrFail($id);

        $showCourse->courseClass = $showCourse->courseClass->toArray();

        return Inertia::render('Dashboard/Course/Show', [
            'showCourse' => $showCourse,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editCourse = Course::findOrFail($id);
        $AllCategories = CourseCategory::where('parent_id', '!=', 0)->get();
        return Inertia::render('Dashboard/Course/Edit', [
            'allCategories' => $AllCategories,
            'editCourse' => $editCourse,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequet $request, string $id)
    {
        $course = Course::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('cover_image')) {

            if ($course->cover_image) {
                $oldImagePath = storage_path('app/public/img/' . $course->cover_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $image_name = Str::random(20) . '.' . $request->file('cover_image')->getClientOriginalExtension();
            $request->file('cover_image')->storeAs('img', $image_name, 'public');
            $validated['cover_image'] = $image_name;
        } else {
            $validated['cover_image'] = $course->cover_image;
        }
        $course->update($validated);
        return Inertia::location(route('course.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        if ($course->cover_image) {
            Storage::disk('public')->delete('img/' . $course->cover_image);
        }
        $course->delete();

        return Inertia::location(route('course.index'));
    }
}
