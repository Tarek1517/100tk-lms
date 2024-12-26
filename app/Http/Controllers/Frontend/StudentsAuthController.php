<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use \App\Models\Student;

class StudentsAuthController extends Controller
{
    public function index()
    {
        //
    }
    public function loginSubmit(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('student')->attempt($credentials)) {
            // Get the authenticated student
            $student = Auth::guard('student')->user();

            // Redirect to the students.show route with the student ID
            return Inertia::location(route('students.show', ['student' => $student->id]));
        }

        return back()->withErrors(['email' => 'Your Email or Password is wrong !!!']);
    }


    public function destroy(Request $request)
    {
        Auth::guard('student')->logout();  // Log the student out
        return Inertia::location(route('Student.Login'));  // Redirect to login page after logout
    }

    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        return Inertia::render('Frontend/Dashboard', [
            'student' => $student,
        ]);
    }

}
