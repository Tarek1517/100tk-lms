<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \App\Models\User;
use \App\Models\Student;

class StudentRegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $existsInAdmin = User::where('email', $value)->exists();
                    $existsInUser = Student::where('email', $value)->exists();

                    if ($existsInAdmin || $existsInUser) {
                        $fail('The email is already taken!');
                    }
                },
            ],
            'mobile' => 'required|digits_between:1,15',
            'password' => 'required|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp,avif|max:1024',
        ];

    }

    protected $stopOnFristFailure = true;
}
