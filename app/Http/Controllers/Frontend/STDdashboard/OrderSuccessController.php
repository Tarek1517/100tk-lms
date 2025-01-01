<?php

namespace App\Http\Controllers\Frontend\STDdashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderSuccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {

        // $validatedData = $request->validate([
        //     'value_c' => 'required|exists:courses,id',
        // ]);

        // if ($request->has('value_c')) {
        //     $data = $request->validate([
        //         'value_c' => 'required|exists:courses,id',
        //     ]);

        //     Auth::user()->courses()->attach($validatedData['value_c'], [
        //         'student_id' => Auth::id(),
        //         'course_id' => $validatedData['value_c'], // Use value_c as course_id
        //         'created_at' => now(), // Optionally set the created_at timestamp
        //     ]);
        // }

        // Render the 'Thank You' page
        return Inertia::render('Frontend/Course/ThankYou');
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
}
