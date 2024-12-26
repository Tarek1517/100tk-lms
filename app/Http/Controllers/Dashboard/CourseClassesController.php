<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\CourseClass;
use \App\Models\ClassVideo;
use Inertia\Inertia;
use App\Http\Requests\CourseClassRequest;
use Illuminate\Support\Str;

class CourseClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function store(CourseClassRequest $request)
    {
        $data = $request->validated();

        $data['is_active'] = filter_var($data['is_active'], FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false';
        $data['slug'] = Str::slug($data['name']);
        $saveClass = CourseClass::create($data);

        if ($request->filled('video_url')) {
            ClassVideo::create([
                'course_classe_id' => $saveClass->id,
                'video_url' => $request->video_url,
            ]);
        }

        return Inertia::location("/dashboard/course/{$data['course_id']}");
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CourseClassRequest $request, string $id)
    {
        $validated = $request->validated();
        $courseClass = CourseClass::findOrFail($id); // Find the class by ID

        // Update the class details
        $courseClass->update([
            'name' => $validated['name'],
            'is_active' => $validated['is_active'],
            'course_id' => $validated['course_id'], // Update course ID if necessary
        ]);

        // Update the associated video URL if it exists
        if (isset($validated['video_url'])) {
            // If the class has a video, update the video URL
            if ($courseClass->videoUrl) {
                $courseClass->videoUrl()->update([
                    'video_url' => $validated['video_url'],
                ]);
            } else {
                // If no video exists, create a new one
                $courseClass->video()->create([
                    'video_url' => $validated['video_url'],
                ]);
            }
        }

        return Inertia::location("/dashboard/course/{$validated['course_id']}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $courseClass = CourseClass::findOrFail($id);
        ClassVideo::where('course_classe_id', $courseClass->id)->delete();
        $courseClass->delete();
        return Inertia::location("/dashboard/course/{$courseClass['course_id']}");
    }

}
