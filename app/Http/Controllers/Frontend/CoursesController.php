<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use \App\Models\Course;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Frontend/Course/Index');
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
    public function show(string $id)
    {
        $AllCourses = Course::with('courseClass')
            ->orderBy('created_at', 'desc') // Order by 'created_at' in descending order
            ->get();

        $showCourse = Course::with('category', 'courseClass')->findOrFail($id);
        return Inertia::render('Frontend/Course/Show', [
            'showCourse' => $showCourse,
            'AllCourses' => $AllCourses,
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

    public function checkout(string $id)
    {
        $showCourse = Course::with('category', 'courseClass')->findOrFail($id);
        return Inertia::render('Frontend/Course/CheckOut', [
            'showCourse' => $showCourse,
        ]);
    }

    public function thankYou(){
        return inertia('Frontend/Course/ThankYou');
    }
}
