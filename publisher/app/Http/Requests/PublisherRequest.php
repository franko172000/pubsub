<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PublisherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required",
            "excerpt" => "required",
            "description" => "required",
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Please provide news title",
            "excerpt.required" => "Please provide news excerpt",
            "description.required" => "Please provide news description",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            "message" => "Invalid data",
            "errors" => $errors->getMessages()
        ], 422);

        throw new HttpResponseException($response);
    }
}
