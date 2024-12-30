<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Change this to true if authorization logic is not implemented
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:students,id',
            'totals_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'order_status' => 'nullable|string|in:pending,confirmed',
            'payment_status' => 'nullable|string|in:paid,pending,cancelled',
            'order_code' => 'nullable|string|unique:orders,order_code',
            'order_date' => 'nullable|date',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'course_id.required' => 'The course ID is required.',
            'course_id.exists' => 'The selected course does not exist.',
            'student_id.required' => 'The student ID is required.',
            'student_id.exists' => 'The selected student does not exist.',
            'totals_amount.required' => 'The grand total is required.',
            'totals_amount.numeric' => 'The grand total must be a valid number.',
            'totals_amount.min' => 'The grand total must be at least 0.',
            'payment_method.required' => 'The payment method is required.',
            'payment_method.in' => 'The selected payment method is invalid.',
            'order_status.required' => 'The order status is required.',
            'order_status.in' => 'The selected order status is invalid.',
            'payment_status.required' => 'The payment status is required.',
            'payment_status.in' => 'The selected payment status is invalid.',
            'order_code.required' => 'The order code is required.',
            'order_code.unique' => 'The order code must be unique.',
            'order_date.date' => 'The order date must be a valid date.',
        ];
    }
}

