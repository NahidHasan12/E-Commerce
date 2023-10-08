<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class childcategoryRequest extends FormRequest
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
            'child_cat_name' => ['required', 'min:2', 'max:50'],
            'child_cat_slug' => ['required', 'min:2', 'max:50'],
            'category_id' => ['required', 'min:1', 'max:50'],
            'subcategory_id' => ['required', 'min:1', 'max:50']
        ];
    }
}
