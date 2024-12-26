<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseClassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Check if the request is for an update (i.e., the ID is present in the route parameters)
        $isUpdate = $this->route('course_class'); // Assuming the route parameter is 'course_class'

        $rules = [
            'name' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'is_active' => 'required',
        ];

        // If it's an update request, make course_id optional (or ensure it remains the same if not provided)
        if ($isUpdate) {
            $rules['course_id'] = 'nullable|exists:courses,id'; // Course_id is optional for updates
        } else {
            // If it's a create request, course_id is required
            $rules['course_id'] = 'required|exists:courses,id';
        }

        return $rules;
    }

    protected $stopOnFirstFailure = true;
}

