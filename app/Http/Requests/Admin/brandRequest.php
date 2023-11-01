<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class brandRequest extends FormRequest
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
        $rules = [
            'brand_name'=>['required','min:3','max:50'],
            'brand_slug'=>['required','min:2','max:20'],
            'brand_logo'=>['required'],
            'front_page'=>['required'],
        ];
        if(request()->update != ''){
            $rules['brand_logo'][0] = 'nullable';
        }
        return $rules;
    }
}
