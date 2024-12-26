<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequet extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string',
            'category_id' => $this->isMethod('PUT') ? 'nullable|exists:course_categories,id' : 'nullable|exists:course_categories,id', // 'exists' rule is used to check if the category exists
            'cover_image' => 'nullable|mimes:png,jpg,jpeg,webp,avif|max:1024',
            'short_description' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0', 
        ];
    }

    protected $stopOnFirstFailure = true;
}
