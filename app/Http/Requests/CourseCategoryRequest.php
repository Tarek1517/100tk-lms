<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseCategoryRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string', // You may want to validate the slug format or uniqueness
            'parent_id' => $this->isMethod('PUT') ? 'nullable|exists:course_categories,id' : 'nullable', // Conditional rule for PUT
            'image' => 'nullable|mimes:png,jpg,jpeg,webp,avif|max:1024', // Image format and size validation
            'subtitle' => 'nullable|string|max:255', // Subtitle is optional in your rules
            'order_number' => 'required|integer', // Order number is required
        ];
    }
    protected  $stopOnFirstFailure = true;
}
