<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StudentRequest extends FormRequest
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
            "name"=>"required|max:255",
            "last_name" => "required|max:255",
        ];
    }

    public function messages(){
        return [
            "name.required" => "This field is required",
            "name.max" => "This field must not have more than 255 characters",
            "last_name.required" => "This field is required",
            "last_name.max" => "This field must not have more than 255 characters",
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
