<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class categoryRequest extends FormRequest
{
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ],200)
        );
    }
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

            'icon' => ['required'],
            'category_name' => ['required', 'min:2', 'max:50'],
            'category_slug' => ['required', 'min:2', 'max:50'],
            'home_page' => ['required']
        ];
    }
}
