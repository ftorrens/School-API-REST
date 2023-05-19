<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CoursesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|max:255",
            "hours" => "required|max:3",
            "price" => "required|numeric",
            "percent_teacher" => "required|numeric|max:3",
            "start_date" => "required|date",
            "finish_date" => "required|date|after_or_equal:start_date",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "This field is required.",
            "first_name.max" => "This field must not have more than 255 characters.",
            "hours.required" => "This field is required.",
            "hours.max" => "This field must not have more than 3 characters.",
            "price.required" => "This field is required.",
            "price.numeric" => "This field just contain numbers.",
            "percent_teacher.required" => "This field is required.",
            "percent_teacher.numeric" => "This field just contain numbers.",
            "percent_teacher.max" => "This field must not have more than 3 characters.",
            "start_date.required" => "This field is required.",
            "start_date.date" => "This field should be a date.",
            "finish_date.required" => "This field is required.",
            "finish_date.date" => "This field should be a date.",
            "finish_date.after_or_equal" => "This field should be before that start date."            
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "status"   => "error",
            "message"   => 'Validation errors',
            "data"      => $validator->errors()
        ], 405));
    }
}
