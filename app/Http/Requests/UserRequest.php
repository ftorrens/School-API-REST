<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
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
            "first_name" => "required|max:255",
            "last_name" => "required|max:255",
            "email" => "required|email",
            "password" => "required"
        ];
    }

    public function messages()
    {
        return [
            "first_name.required" => "This field is required",
            "first_name.max" => "This field must not have more than 255 characters",
            "last_name.required" => "This field is required",
            "last_name.max" => "This field must not have more than 255 characters",
            "email.required" => "This field is required",
            "email.email" => "The email format is incorrect",
            "password.required" => "This field is required",
        ];
    }

    public function failedValidation(Validator $validator){

        throw new HttpResponseException(response()->json([
            "status"   => "error",
            "message"   => 'Validation errors',
            "data"      => $validator->errors()
        ]));
    }
}
